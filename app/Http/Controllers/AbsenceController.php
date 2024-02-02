<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Career;
use App\Models\Absence;
use Illuminate\Http\Request;
use App\Enums\PermissionStatusEnum;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use RealRashid\SweetAlert\Facades\Alert;
use App\Notifications\PermissionResponse;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreAbsenceRequest;
use App\Http\Requests\UpdateAbsenceRequest;
use App\Notifications\NewPermissionNotification;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

class AbsenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // test
    public function index()
    {
        $structure = Auth::user()->structure;

        if (Auth::user()->role == 'user') {
            $absences = $structure->absences()
                ->where('user_id', Auth::id())
                ->where('status', PermissionStatusEnum::Pending)
                ->get();
        } elseif (Auth::user()->role == 'supervisor') {
            $absences = $this->getAbsence(PermissionStatusEnum::Pending);
        } else {
            $absences = $structure->absences()
                ->where('status', PermissionStatusEnum::Pending)
                ->get();
        }

        return view('app.absence.index', [
            'absences' => $absences,
            'my_attributes' => $this->absence_columns(),
            'my_actions' => $this->absence_actions(),
        ]);
    }


    /**
     * filter a listing of the resource by date.
     */

    public function indexFilter(Request $request)
    {
        $structure = Auth::user()->structure;
        $validate = Validator::make($request->all(), [
            'start' => 'required|before_or_equal:end',
            'end' => 'required|after_or_equal:start'
        ]);
        if (!$validate->fails()) {
            if (Auth::user()->role == 'user') {
                $absences = $structure->absences()
                    ->where('user_id', Auth::id())
                    ->where('status', PermissionStatusEnum::Pending)
                    ->whereBetween('start_date', [$request->start, $request->end])
                    ->orWhereBetween('end_date', [$request->start, $request->end])
                    ->get();
            } elseif (Auth::user()->role == 'supervisor') {
                $absences = $this->getAbsenceFiltered(PermissionStatusEnum::Pending, $request->start, $request->end);
            } else {
                $absences = $structure->absences()
                    ->where('status', PermissionStatusEnum::Pending)
                    ->whereBetween('start_date', [$request->start, $request->end])
                    ->orWhereBetween('end_date', [$request->start, $request->end])
                    ->get();
            }
            return view('app.absence.index', [
                'absences' => $absences,
                'my_attributes' => $this->absence_columns(),
                'my_actions' => $this->absence_actions(),
            ]);
        } else {
            return redirect('absence');
        }
    }

    public function indexAllowed()
    {
        $structure = Auth::user()->structure;
        if (Auth::user()->role == 'user') {
            $absences = $structure->absences()
                ->where('user_id', Auth::id())
                ->where('status', PermissionStatusEnum::Allowed)
                ->get();
        } elseif (Auth::user()->role == 'supervisor') {
            $absences = $this->getAbsence(PermissionStatusEnum::Allowed);
        } else {
            $absences = $structure->absences()
                ->where('status', PermissionStatusEnum::Allowed)
                ->get();
        }
        return view('app.absence.index', [
            'absences' => $absences,
            'my_attributes' => $this->absence_columns(),
            'my_actions' => $this->absence_actions(),
        ]);
    }

    public function indexAllowedFilter(Request $request)
    {
        $structure = Auth::user()->structure;
        $validate = Validator::make($request->all(), [
            'start' => 'required|before_or_equal:end',
            'end' => 'required|after_or_equal:start'
        ]);
        if (!$validate->fails()) {
            if (Auth::user()->role == 'user') {
                $absences = $structure->absences()
                    ->where('user_id', Auth::id())
                    ->where('status', PermissionStatusEnum::Allowed)
                    ->whereBetween('start_date', [$request->start, $request->end])
                    ->orWhereBetween('end_date', [$request->start, $request->end])
                    ->get();
            } elseif (Auth::user()->role == 'supervisor') {
                $absences = $this->getAbsenceFiltered(PermissionStatusEnum::Allowed, $request->start, $request->end);
            } else {
                $absences = $structure->absences()
                    ->where('status', PermissionStatusEnum::Allowed)
                    ->whereBetween('start_date', [$request->start, $request->end])
                    ->orWhereBetween('end_date', [$request->start, $request->end])
                    ->get();
            }
            return view('app.absence.index', [
                'absences' => $absences,
                'my_attributes' => $this->absence_columns(),
                'my_actions' => $this->absence_actions(),
            ]);
        } else {
            return redirect()->route('absence.allowed');
        }
    }

    public function indexDenied()
    {
        $structure = Auth::user()->structure;
        if (Auth::user()->role == 'user') {
            $absences = $structure->absences()
                ->where('user_id', Auth::id())
                ->where('status', PermissionStatusEnum::Denied)
                ->get();
        } elseif (Auth::user()->role == 'supervisor') {
            $absences = $this->getAbsence(PermissionStatusEnum::Denied);
        } else {
            $absences = $structure->absences()
                ->where('status', PermissionStatusEnum::Denied)
                ->get();
        }
        return view('app.absence.index', [
            'absences' => $absences,
            'my_attributes' => $this->absence_columns(),
            'my_actions' => $this->absence_actions(),
        ]);
    }

    public function indexDeniedFilter(Request $request)
    {
        $structure = Auth::user()->structure;
        $validate = Validator::make($request->all(), [
            'start' => 'required|before_or_equal:end',
            'end' => 'required|after_or_equal:start'
        ]);
        if (!$validate->fails()) {
            if (Auth::user()->role == 'user') {
                $absences = $structure->absences()
                    ->where('user_id', Auth::id())
                    ->where('status', PermissionStatusEnum::Denied)
                    ->whereBetween('start_date', [$request->start, $request->end])
                    ->orWhereBetween('end_date', [$request->start, $request->end])
                    ->get();
            } elseif (Auth::user()->role == 'supervisor') {
                $absences = $this->getAbsenceFiltered(PermissionStatusEnum::Denied, $request->start, $request->end);
            } else {
                $absences = $structure->absences()
                    ->where('status', PermissionStatusEnum::Denied)
                    ->whereBetween('start_date', [$request->start, $request->end])
                    ->orWhereBetween('end_date', [$request->start, $request->end])
                    ->get();
            }
            return view('app.absence.index', [
                'absences' => $absences,
                'my_attributes' => $this->absence_columns(),
                'my_actions' => $this->absence_actions(),
            ]);
        } else {
            return redirect()->route('absence.denied');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('app.absence.create', [
            'my_fields' => $this->absence_fields(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAbsenceRequest $request)
    {
        $absence = new Absence();

        $absence->structure_id = Auth::user()->structure->id;
        $absence->user_id = Auth::id();
        $absence->start_date = $request->start_date;
        $absence->start_hour = $request->start_hour;
        $absence->end_date = $request->end_date;
        $absence->end_hour = $request->end_hour;
        $absence->cause = $request->cause;
        $absence->status = PermissionStatusEnum::Pending;

        if ($absence->save()) {
            $absence->reference = 'ABS00' . $absence->id;
            $absence->save();

            Alert::toast(Lang::get('message.success'), 'success');
            $users = User::where('structure_id', Auth::user()->structure_id)->where('role', 'admin')->get();
            foreach ($users as $user) {
                $user->notify(new NewPermissionNotification());
            };
            //$user->notify(new NewPermissionNotification());
            return redirect('absence');
        } else {
            Alert::toast(Lang::get('message.error'), 'error');
            return redirect()->back()->withInput($request->input());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Absence $absence)
    {
        return view('app.absence.show', [
            'absence' => $absence,
            'my_fields' => $this->absence_show(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Absence $absence)
    {
        return view('app.absence.edit', [
            'absence' => $absence,
            'my_fields' => $this->absence_fields(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAbsenceRequest $request, Absence $absence)
    {
        $absence = Absence::find($absence->id);

        if (Auth::user()->role == 'user') {
            $absence->start_date = $request->start_date;
            $absence->start_hour = $request->start_hour;
            $absence->end_date = $request->end_date;
            $absence->end_hour = $request->end_hour;
            $absence->cause = $request->cause;

            if ($absence->save()) {
                Alert::toast(Lang::get('message.edited'), 'success');
                return redirect('absence');
            } else {
                Alert::toast(Lang::get('message.error'), 'error');
                return back()->withInput($request->input());
            }
        } else {
            $absence->status = $request->status;

            if ($absence->save()) {
                Alert::toast(Lang::get('message.edited'), 'success');
                $user = $absence->user;
                $user->notify(new PermissionResponse($absence->status));
                return redirect('absence');
            } else {
                Alert::toast(Lang::get('message.error'), 'error');
                return back()->withInput($request->input());
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Absence $absence)
    {
        try {
            $absence = $absence->delete();
            Alert::success(Lang::get('message.del_success1'), Lang::get('message.del_success2'));
            return redirect('absence');
        } catch (\Exception $e) {
            Alert::error(Lang::get('message.del_error1'), Lang::get('message.del_error2'), );
            return redirect()->back();
        }
    }

    private function absence_columns()
    {
        $columns = (object) [
            'reference' => Lang::get('message.reference'),
            'user_fullname' => Lang::get('message.user_fullname'),
            'formatted_departure_date' => Lang::get('message.formatted_start_date'),
            'departure_hour' => Lang::get('message.start_hour'),
            'formatted_arrival_date' => Lang::get('message.formatted_end_date'),
            'arrival_hour' => Lang::get('message.end_hour'),
            // 'cause' => 'Motif',
            // 'status' => 'Statut',
        ];
        return $columns;
    }

    private function absence_actions()
    {
        if (Auth::user()->role == 'user') {
            $actions = (object) array(
                'show' => 'Voir',
                'edit' => 'Modifier',
                'delete' => "Supprimer",
            );
        } else {
            $actions = (object) array(
                'show' => 'Voir',
                'edit' => 'Modifier',
            );
        }

        return $actions;
    }

    private function absence_fields()
    {
        if (Auth::user()->role == 'user') {
            $fields = [
                'start_date' => [
                    'title' => Lang::get('message.formatted_start_date'),
                    'field' => 'date'
                ],
                'start_hour' => [
                    'title' => Lang::get('message.start_hour'),
                    'field' => 'time'
                ],
                'end_date' => [
                    'title' => Lang::get('message.formatted_end_date'),
                    'field' => 'date'
                ],
                'end_hour' => [
                    'title' => Lang::get('message.end_hour'),
                    'field' => 'time'
                ],
                'cause' => [
                    'title' => 'Motif',
                    'field' => 'textarea'
                ],
            ];
        } else {
            $status = [
                Lang::get('message.allowed_no_modified') => PermissionStatusEnum::Allowed,
                Lang::get('message.allowed_modified') => PermissionStatusEnum::AllowedAndModify,
                Lang::get('message.denied') => PermissionStatusEnum::Denied,
            ];
            $fields = [
                'status' => [
                    'title' => 'Status',
                    'field' => 'select',
                    'options' => $status
                ],
            ];
        }

        return $fields;
    }

    private function absence_show()
    {
        $fields = [
            'cause' => [
                'title' => 'Motif',
                'field' => 'richtext',
                'colspan' => true
            ],
        ];

        return $fields;
    }

    private function getAbsence($status)
    {
        $departments = Auth::user()->departments;
        $places = new EloquentCollection();
        foreach ($departments as $department) {
            $places[] = $department->places()->get();
        }
        $places = $places->collapse();

        $careers = new EloquentCollection();
        foreach ($places as $place) {
            $careers[] = Career::where('place_id', $place->id)->get();
        }
        $careers = $careers->collapse();

        $users = new EloquentCollection();
        foreach ($careers as $career) {
            $users[] = User::where('id', $career->user_id)->get();
        }
        $users = $users->collapse();

        $allAbsences = new EloquentCollection();
        foreach ($users as $user) {
            $allAbsences[] = Absence::where('user_id', $user->id)
                ->where('status', $status)
                ->get();
        }
        $allAbsences = $allAbsences->collapse();

        foreach ($allAbsences as $allAbsence) {
            if ($allAbsence->status == $status) {
                $absences[] = $allAbsence;
            }
        }
        return $absences;
    }

    private function getAbsenceFiltered($status, $start_post, $end_post)
    {
        $departments = Auth::user()->departments;
        $places = new EloquentCollection();
        foreach ($departments as $department) {
            $places[] = $department->places()->get();
        }
        $places = $places->collapse();

        $careers = new EloquentCollection();
        foreach ($places as $place) {
            $careers[] = Career::where('place_id', $place->id)->get();
        }
        $careers = $careers->collapse();

        $users = new EloquentCollection();
        foreach ($careers as $career) {
            $users[] = User::where('id', $career->user_id)->get();
        }
        $users = $users->collapse();

        $allAbsences = new EloquentCollection();
        foreach ($users as $user) {
            $allAbsences[] = Absence::where('user_id', $user->id)
                ->where('status', $status)
                ->whereBetween('start_date', [$start_post, $end_post])
                ->orWhere('end_date', [$start_post, $end_post])
                ->get();
        }
        $allAbsences = $allAbsences->collapse();

        foreach ($allAbsences as $allAbsence) {
            if ($allAbsence->status == $status) {
                $absences[] = $allAbsence;
            }
        }
        return $absences;
    }
}

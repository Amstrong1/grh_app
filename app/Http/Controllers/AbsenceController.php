<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Career;
use App\Models\Absence;
use App\Enums\UserRoleEnum;
use Illuminate\Http\Request;
use App\Enums\PermissionStatusEnum;
use Illuminate\Support\Facades\Auth;
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

        if (Auth::user()->role = UserRoleEnum::User) {
            $absences = $structure->absences()
                ->where('user_id', Auth::id())
                ->where('status', PermissionStatusEnum::Pending)
                ->get();
        } elseif (Auth::user()->role = UserRoleEnum::Supervisor) {
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
            if (Auth::user()->role = UserRoleEnum::User) {
                $absences = $structure->absences()
                    ->where('user_id', Auth::id())
                    ->where('status', PermissionStatusEnum::Pending)
                    ->whereBetween('start_date', [$request->start, $request->end])
                    ->orWhereBetween('end_date', [$request->start, $request->end])
                    ->get();
            } elseif (Auth::user()->role = UserRoleEnum::Supervisor) {
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
        if (Auth::user()->role = UserRoleEnum::User) {
            $absences = $structure->absences()
                ->where('user_id', Auth::id())
                ->where('status', PermissionStatusEnum::Allowed)
                ->get();
        } elseif (Auth::user()->role = UserRoleEnum::Supervisor) {
            $absences = $this->getAbsence(PermissionStatusEnum::Allowed);
        } else {
            $absences = $structure->absences()
                ->where('status', PermissionStatusEnum::Allowed)
                ->get();
        }
        return view('app.absence.index', [
            'absences' => $absences,
            'my_attributes' => $this->absence_columns(),
            'my_actions' => [],
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
            if (Auth::user()->role = UserRoleEnum::User) {
                $absences = $structure->absences()
                    ->where('user_id', Auth::id())
                    ->where('status', PermissionStatusEnum::Allowed)
                    ->whereBetween('start_date', [$request->start, $request->end])
                    ->orWhereBetween('end_date', [$request->start, $request->end])
                    ->get();
            } elseif (Auth::user()->role = UserRoleEnum::Supervisor) {
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
        if (Auth::user()->role = UserRoleEnum::User) {
            $absences = $structure->absences()
                ->where('user_id', Auth::id())
                ->where('status', PermissionStatusEnum::Denied)
                ->get();
        } elseif (Auth::user()->role = UserRoleEnum::Supervisor) {
            $absences = $this->getAbsence(PermissionStatusEnum::Denied);
        } else {
            $absences = $structure->absences()
                ->where('status', PermissionStatusEnum::Denied)
                ->get();
        }
        return view('app.absence.index', [
            'absences' => $absences,
            'my_attributes' => $this->absence_columns(),
            'my_actions' => [],
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
            if (Auth::user()->role = UserRoleEnum::User) {
                $absences = $structure->absences()
                    ->where('user_id', Auth::id())
                    ->where('status', PermissionStatusEnum::Denied)
                    ->whereBetween('start_date', [$request->start, $request->end])
                    ->orWhereBetween('end_date', [$request->start, $request->end])
                    ->get();
            } elseif (Auth::user()->role = UserRoleEnum::Supervisor) {
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

            Alert::toast("Données enregistrées", 'success');
            $user = User::where('structure_id', Auth::user()->structure_id)->where('role', 'admin')->first();
            $user->notify(new NewPermissionNotification());
            return redirect('absence');
        } else {
            Alert::toast('Une erreur est survenue', 'error');
            return redirect()->back()->withInput($request->input());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Absence $absence)
    {
        // 
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

        if (Auth::user()->role === 'user') {
            $absence->start_date = $request->start_date;
            $absence->start_hour = $request->start_hour;
            $absence->end_date = $request->end_date;
            $absence->end_hour = $request->end_hour;
            $absence->cause = $request->cause;

            if ($absence->save()) {
                Alert::toast('Les informations ont été modifiées', 'success');
                return redirect('absence');
            } else {
                Alert::toast('Une erreur est survenue', 'error');
                return back()->withInput($request->input());
            }
        } else {
            $absence->status = $request->status;

            if ($absence->save()) {
                Alert::toast('Les informations ont été modifiées', 'success');
                $user = $absence->user;
                $user->notify(new PermissionResponse($absence->status));
                return redirect('absence');
            } else {
                Alert::toast('Une erreur est survenue', 'error');
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
            Alert::success('Opération effectuée', 'Suppression éffectué');
            return redirect('absence');
        } catch (\Exception $e) {
            Alert::error('Erreur', 'Element introuvable');
            return redirect()->back();
        }
    }

    private function absence_columns()
    {
        $columns = (object) [
            'reference' => 'Référence',
            'user_fullname' => 'Nom et prénoms',
            'formatted_start_date' => 'Date de départ',
            'start_hour' => 'Heure de départ',
            'formatted_end_date' => 'Date d\'arrivé',
            'end_hour' => 'Heure d\'arrivé',
            'cause' => 'Motif',
            // 'status' => 'Statut',
        ];
        return $columns;
    }

    private function absence_actions()
    {
        if (Auth::user()->role === 'user') {
            $actions = (object) array(
                'edit' => 'Modifier',
                'delete' => "Supprimer",
            );
        } else {
            $actions = (object) array(
                'edit' => 'Modifier',
            );
        }

        return $actions;
    }

    private function absence_fields()
    {
        if (Auth::user()->role === 'user') {
            $fields = [
                'start_date' => [
                    'title' => 'Date de départ',
                    'field' => 'date'
                ],
                'start_hour' => [
                    'title' => 'Heure de départ',
                    'field' => 'time'
                ],
                'end_date' => [
                    'title' => 'Date de retour',
                    'field' => 'date'
                ],
                'end_hour' => [
                    'title' => 'Heure de retour',
                    'field' => 'time'
                ],
                'cause' => [
                    'title' => 'Motif',
                    'field' => 'textarea'
                ],
            ];
        } else {
            $status = [
                'Accordé' => PermissionStatusEnum::Allowed,
                'Refusé' => PermissionStatusEnum::Denied,
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

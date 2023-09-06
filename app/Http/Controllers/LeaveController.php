<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Leave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreLeaveRequest;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\UpdateLeaveRequest;
use Illuminate\Support\Facades\Validator;
use App\Notifications\NewLeaveNotification;
use App\Notifications\NewTempWorkNotification;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $structure = Auth::user()->structure;
        $leaves = $structure->leaves()->get();

        return view('app.leave.index', [
            'leaves' => $leaves,
            'my_actions' => $this->leave_actions(),
            'my_attributes' => $this->leave_columns(),
        ]);
    }

    /**
     * filter a listing of the resource by date.
     */
    public function indexFilter(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'start' => 'required|before_or_equal:end',
            'end' => 'required|after_or_equal:start'
        ]);
        if (!$validate->fails()) {
            $leaves = Leave::where('structure_id', Auth::user()->structure_id)
                ->whereBetween('date_start', [$request->start, $request->end])
                ->orWhereBetween('date_start', [$request->start, $request->end])
                ->get();
                
            return view('app.leave.index', [
                'leaves' => $leaves,
                'my_actions' => $this->leave_actions(),
                'my_attributes' => $this->leave_columns(),
            ]);
        } else {
            return redirect('leave');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('app.leave.create', [
            'my_fields' => $this->leave_fields(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLeaveRequest $request)
    {
        $leave = new Leave();

        $leave->structure_id = Auth::user()->structure->id;
        $leave->leave_type_id = $request->leave_type;
        $leave->user_id = $request->user;
        $leave->date_start = $request->date_start;
        $leave->hour_start = $request->hour_start;
        $leave->date_end = $request->date_end;
        $leave->hour_end = $request->hour_end;
        $leave->temp_worker = $request->temp_worker;

        if ($leave->save()) {
            Alert::toast("Données enregistrées", 'success');
            $user = User::find($leave->user_id);
            $temp_worker = User::find($leave->temp_worker);

            $post = $user->career->place->name;
            $period = $leave->date_start  . ' au ' .  $leave->hour_end;

            $user->notify(new NewLeaveNotification());
            $temp_worker->notify(new NewTempWorkNotification($post, $period));
            return redirect('leave');
        } else {
            Alert::toast('Une erreur est survenue', 'error');
            return redirect()->back()->withInput($request->input());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Leave $leave)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Leave $leave)
    {
        return view('app.leave.edit', [
            'leave' => $leave,
            'my_fields' => $this->leave_fields(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLeaveRequest $request, Leave $leave)
    {
        $leave = Leave::find($leave->id);

        $leave->structure_id = Auth::user()->structure->id;
        $leave->leave_type_id = $request->leave_type;
        $leave->user_id = $request->user;
        $leave->date_start = $request->date_start;
        $leave->hour_start = $request->hour_start;
        $leave->date_end = $request->date_end;
        $leave->hour_end = $request->hour_end;
        $leave->temp_worker = $request->temp_worker;

        if ($leave->save()) {
            Alert::toast('Les informations ont été modifiées', 'success');
            return redirect('leave');
        } else {
            Alert::toast('Une erreur est survenue', 'error');
            return redirect()->back()->withInput($request->input());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Leave $leave)
    {
        try {
            $leave = $leave->delete();
            Alert::success('Opération effectuée', 'Suppression éffectué');
            return redirect('leave');
        } catch (\Exception $e) {
            Alert::error('Erreur', 'Element introuvable');
            return redirect()->back();
        }
    }

    private function leave_columns()
    {
        $columns = (object) [
            'user_fullname' => 'Bénéficiaire',
            'user_interim_fullname' => 'Interim',
            'leave_type_name' => 'Type congé',
            'formatted_date_start' => 'Date début',
            'hour_start' => 'Heure début',
            'formatted_date_end' => 'Date fin',
            'hour_end' => 'Heure fin',
        ];
        return $columns;
    }

    private function leave_actions()
    {
        $actions = (object) array(
            'edit' => "Modifier",
            'delete' => "Supprimer",
        );
        return $actions;
    }

    private function leave_fields()
    {
        $structure = Auth::user()->structure;
        $users = $structure->users()->where('role', '!=', 'admin')->get();
        $leaveTypes = $structure->leaveTypes()->get();

        $fields = [
            'user' => [
                'title' => 'Employé',
                'field' => 'model',
                'options' => $users,
            ],
            'temp_worker' => [
                'title' => 'Interim',
                'field' => 'model',
                'options' => $users,
            ],
            'leave_type' => [
                'title' => 'Type de congé',
                'field' => 'model',
                'options' => $leaveTypes,
            ],
            'date_start' => [
                'title' => 'Date début',
                'field' => 'date'
            ],
            'hour_start' => [
                'title' => 'Heure début',
                'field' => 'time'
            ],
            'date_end' => [
                'title' => 'Date fin',
                'field' => 'date'
            ],
            'hour_end' => [
                'title' => 'Heure fin',
                'field' => 'time'
            ],
        ];
        return $fields;
    }
}

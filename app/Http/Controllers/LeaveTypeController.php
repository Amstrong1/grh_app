<?php

namespace App\Http\Controllers;

use App\Models\LeaveType;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\StoreLeaveTypeRequest;
use App\Http\Requests\UpdateLeaveTypeRequest;

class LeaveTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $structure = Auth::user()->structure;
        return view('app.leave-type.index', [
            'leaveTypes' => $structure->leaveTypes()->get(),
            'my_actions' => $this->leaveType_actions(),
            'my_attributes' => $this->leaveType_columns(),
            'my_fields' => $this->leaveType_fields(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLeaveTypeRequest $request)
    {
        $leaveType = new LeaveType();

        $leaveType->structure_id = Auth::user()->structure->id;
        $leaveType->name = $request->name;
        $leaveType->last = $request->last;
        $leaveType->description = $request->description;
        $leaveType->assign_to_all = $request->boolean('assign_to_all');

        if ($leaveType->save()) {
            Alert::toast('Les données ont été enregistrées', 'success');
            return redirect('leave_type');
        } else {
            Alert::toast('Les données ont été enregistrées', 'error');
            return redirect()->back()->withInput($request->input());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(LeaveType $leaveType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LeaveType $leaveType)
    {
        return view('app.leave-type.edit', [
            'leaveType' => $leaveType,
            'my_fields' => $this->leaveType_fields(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLeaveTypeRequest $request, LeaveType $leaveType)
    {
        $leaveType = LeaveType::find($leaveType->id);

        $leaveType->name = $request->name;
        $leaveType->last = $request->last;
        $leaveType->description = $request->description;
        $leaveType->assign_to_all = $request->boolean('assign_to_all');

        if ($leaveType->save()) {
            Alert::toast('Les informations ont été modifiées', 'success');
            return redirect('leave_type');
        } else {
            Alert::toast('Les informations ont été modifiées', 'success');
            return redirect()->back()->withInput($request->input());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LeaveType $leaveType)
    {
        try {
            $leaveType = $leaveType->delete();
            Alert::success('Opération effectuée', 'Suppression éffectué');
            return redirect('leave_type');
        } catch (\Exception $e) {
            Alert::error('Erreur', 'Element introuvable');
            return redirect()->back();
        }
    }

    private function leaveType_columns()
    {
        $columns = (object) [
            'name' => 'Nom',
            'last' => 'Durée en jours',
            'description' => 'Description',
            'formatted_assign_to_all' => 'Attribué à tous les employés',
        ];
        return $columns;
    }

    private function leaveType_actions()
    {
        $actions = (object) array(
            'edit' => 'Modifier',
            'delete' => "Supprimer",
        );
        return $actions;
    }

    private function leaveType_fields()
    {
        $fields = [
            'name' => [
                'title' => 'Nom',
                'field' => 'text'
            ],
            'last' => [
                'title' => 'Durée en jours',
                'field' => 'number'
            ],
            'description' => [
                'title' => 'Description',
                'field' => 'textarea'
            ],
            'assign_to_all' => [
                'title' => 'Attribuer à tous les employés',
                'field' => 'checkbox'
            ]
        ];
        return $fields;
    }
}

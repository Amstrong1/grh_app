<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;

class DepartmentController extends Controller
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
        return view('app.department.index', [
            'departments' => $structure->departments()->get(),
            'my_actions' => $this->department_actions(),
            'my_attributes' => $this->department_columns(),
            'my_fields' => $this->department_fields(),
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
    public function store(StoreDepartmentRequest $request)
    {
        $department = new Department();

        $department->structure_id = Auth::user()->structure->id;
        $department->name = $request->name;

        if ( $department->save()) {
            Alert::toast("Données enregistrées", 'success');
            return redirect('department');
        } else {
            Alert::toast('Une erreur est survenue', 'error');
            return redirect()->back()->withInput($request->input());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        return view('app.department.show', [
            'department' => $department,
            'my_fields' => $this->department_fields(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
        return view('app.department.edit', [
            'department' => $department,
            'my_fields' => $this->department_fields(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDepartmentRequest $request, Department $department)
    {
        $department = Department::find($department->id);

        $department->name = $request->name;

        if ($department->save()) {
            Alert::toast('Les informations ont été modifiées', 'success');
            return redirect('department');
        };
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        try {
            $department = $department->delete();
            Alert::success('Opération effectuée', 'Suppression éffectué');
            return redirect('department');
        } catch (\Exception $e) {
            Alert::error('Erreur', 'Element introuvable');
            return redirect()->back();
        }
    }

    private function department_columns()
    {
        $columns = (object) [
            'name' => 'Département',
        ];
        return $columns;
    }

    private function department_actions()
    {
        $actions = (object) array(
            'edit' => 'Modifier',
            'delete' => "Supprimer",
        );
        return $actions;
    }

    private function department_fields()
    {
        $fields = [
            'name' => [
                'title' => 'Nom',
                'field' => 'text'
            ]
        ];
        return $fields;
    }
}

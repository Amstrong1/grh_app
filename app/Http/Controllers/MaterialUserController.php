<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Material;
use App\Models\MaterialUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use RealRashid\SweetAlert\Facades\Alert;

class MaterialUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $structure = Auth::user()->structure;
        $materialsUsers = $structure->materialsUsers()->get();

        return view('app.user-material.index', [
            'materialsUsers' => $materialsUsers,
            'my_actions' => $this->materials_users_actions(),
            'my_attributes' => $this->materials_users_columns(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('app.user-material.create', [
            'my_fields' => $this->material_user_fields()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'material_id' => 'required',
            'quantity' => 'required',
            'user_id' => 'required'
        ]);

        MaterialUser::create([
            'user_id' => $request->user_id,
            'material_id' => $request->material_id,
            'structure_id' => Auth::user()->structure->id,
            'quantity' => $request->quantity
        ]);

        Alert::toast(Lang::get('message.success'), 'success');
        return redirect('material_user');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MaterialUser $materialUser)
    {
        //dd($materialUser);
        return view('app.user-material.edit', [
            'materialUser' => $materialUser,
            'my_fields' => $this->material_user_fields(),
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MaterialUser $materialUser)
    {
        try {
            $materialUser = $materialUser->delete();
            Alert::success(Lang::get('message.del_success1'), Lang::get('message.del_success2'));
            return redirect('material_user');
        } catch (\Exception $e) {
            Alert::error(Lang::get('message.del_error1'), Lang::get('message.del_error2'), );
            return redirect()->back();
        }
    }


    private function material_user_fields()
    {
        $users = User::where('structure_id', Auth::user()->structure->id)->get();
        $materials = Material::where('structure_id', Auth::user()->structure->id)->get();

        $fields = [
            'user_id' => [
                'title' => 'Selectionné l\'employer',
                'field' => 'model',
                'options' => $users,
            ],
            'material_id' => [
                'title' => 'Selectionné  materiel',
                'field' => 'model',
                'options' => $materials,
            ],
            'quantity' => [
                'title' => 'Selectionné la quantité',
                'field' => 'number',

            ],

        ];


        return $fields;
    }

    private function materials_users_columns()
    {
        $columns = (object) [
            'users_fullname' => 'Nom employé',
            'materials_fullname' => 'Nom Materiel',
            'quantity' => 'Nombre De Materiel',

        ];
        return $columns;
    }
    private function materials_users_actions()
    {
        $actions = (object) array(
            'edit' => 'Modifier',
            'delete' => "Supprimer",
        );
        return $actions;
    }
}

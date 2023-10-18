<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreMaterialRequest;
use App\Http\Requests\UpdateMaterialRequest;


use App\Models\User;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $structure = Auth::user()->structure;
        $materials = $structure->materials()->all();

        return view('app.material.index', [
            'materials' => $materials,
            'my_actions' => $this->material_actions(),
            'my_attributes' => $this->material_columns(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('app.material.create', [
            'my_fields' => $this->material_fields()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMaterialRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Material $material)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Material $material)
    {
        return view('app.material.edit', [
            'material' => $material,
            'my_fields' => $this->material_fields(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMaterialRequest $request, Material $material)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Material $material)
    {
        //
    }

    private function material_fields()
    {
       // $users = User::where('structure_id', Auth::user()->structure->id)->get();
            $states = ["Neuf"=>"Neuf", "Usagé"=>"Usagé", "Occasion"=>"Occasion"];
            $fields = [
                'name' => [
                    'title' => 'Nom',
                    'field' => 'text',
                ],
                'quantity' => [
                    'title' => 'Stock',
                    'field' => 'number',
                ],

                'state' => [
                    'title' => 'Sélectionner Etat',
                    'field' => 'select',
                    'options' => $states,
                ],
                
            ];
        

        return $fields;
    }
}

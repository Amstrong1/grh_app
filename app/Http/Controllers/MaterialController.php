<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Material;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;


use App\Http\Requests\StoreMaterialRequest;
use App\Http\Requests\UpdateMaterialRequest;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $structure = Auth::user()->structure;
        $materials = $structure->materials()->get();

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
        $material = new Material();

        $material->structure_id = Auth::user()->structure->id;
        $material->name = $request->name;
        $material->quantity = $request->quantity;
        $material->state = $request->state;
        $material->description = $request->description;
      
        if ($material->save()) {

            // foreach ($request->users as $user) {
            //     materialUser::create([
            //         'user_id' => $user,
            //         'id' =>  $material->id,
            //         'structure_id' => Auth::user()->structure->id,
            //     ]);

            //     $user = User::where('id', $user)->first();
            //    $user->notify(new NewmaterialNotification());
            // }

            Alert::toast("Données enregistrées", 'success');
            return redirect('material');
        } else {
            Alert::toast('Une erreur est survenue', 'error');
            return redirect()->back()->withInput($request->input());
        }
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
        $material = Material::find($material->id);
             $material->name = $request->name;
             $material->quantity = $request->quantity;
             $material->state = $request->state;
             $material->description = $request->description;

        // if (Auth::user()->role === 'admin') {
        //     $material->name = $request->name;
        //     $material->quantity = $request->quantity;
        //     $material->state = $request->state;

        //     foreach ($request->users as $user) {
        //         materialUser::where('id', $material->id)->delete();
        //         materialUser::create([
        //             'user_id' => $user,
        //             'id' => $material->id,
        //             'structure_id' => Auth::user()->structure->id,
        //         ]);
        //     }
        // } else {
        //     $material->status = $request->status;
        //     $material->report = $request->report;
        // }

        if ($material->save()) {
            Alert::toast('Les informations ont été modifiées', 'success');
            return redirect('material');
        } else {
            Alert::toast('Une erreur est survenue', 'error');
            return redirect()->back()->withInput($request->input());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Material $material)
    {
        // try {
        //     $usersDel = Material::where('id', $material->id)->delete();
        //     if ($usersDel) {
        //         $material = $material->delete();
        //         Alert::success('Opération effectuée', 'Suppression éffectué');
        //         return redirect('material');
        //     } else {
        //         Alert::error('Erreur', 'Element introuvable');
        //         return redirect()->back();
        //     }
        // } catch (\Exception $e) {
        //     Alert::error('Erreur', 'Element introuvable');
        //     return redirect()->back();
        // }
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
                'description' => [
                    'title' => 'Description',
                    'field' => 'text',
                ],
                
            ];
        
        return $fields;
    }
    private function material_columns()
    {
        $columns = (object) [
            'name' => 'Nom',
            'quantity' => 'Stock',
            'state' => 'Etat',
            'description' => 'Description',
           
        ];
        return $columns;
    }
    private function material_actions()
    {
       
            $actions = (object) array(
                'edit' => 'Modifier',
                // 'delete' => "Supprimer",
            );
        

        return $actions;
    }
}

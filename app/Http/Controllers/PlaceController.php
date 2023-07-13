<?php

namespace App\Http\Controllers;

use App\Models\Place;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePlaceRequest;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\UpdatePlaceRequest;

class PlaceController extends Controller
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
        return view('app.place.index', [
            'places' => $structure->places()->get(),
            'my_actions' => $this->place_actions(),
            'my_attributes' => $this->place_columns(),
            'my_fields' => $this->place_fields(),
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
    public function store(StorePlaceRequest $request)
    {
        $place = new Place();

        $place->structure_id = Auth::user()->structure->id;
        $place->department()->associate($request->department);
        $place->name = $request->name;
        $place->gross_wage = $request->gross_wage;
        $place->hourly_rate = $request->hourly_rate;
        $place->overtime_rate = $request->overtime_rate;

        $place->save();

        return redirect('place');
    }

    /**
     * Display the specified resource.
     */
    public function show(Place $place)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Place $place)
    {
        return view('app.place.edit', [
            'place' => $place,
            'my_fields' => $this->place_fields(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePlaceRequest $request, Place $place)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Place $place)
    {        
        try {
            $place = $place->delete();
            Alert::success('Opération effectuée', 'Suppression éffectué');
            return redirect('place');
        } catch (\Exception $e) {
            Alert::error('Erreur', 'Element introuvable');
            return redirect()->back();
        }
    }

    private function place_columns()
    {
        $columns = (object) [
            'name' => 'Poste',
            'department_name' => 'Département',
            'formatted_gross_wage' => 'Salaire da base',
            'formatted_hourly_rate' => 'Tarif horaire',
            'formatted_overtime_rate' => 'Tarif heure supplémentaire',
        ];
        return $columns;
    }

    private function place_actions()
    {
        $actions = (object) array(
            'edit' => 'Modifier',
            'delete' => "Supprimer",
        );
        return $actions;
    }

    private function place_fields()
    {
        $fields = [
            'department' => [
                'title' => 'Departement',
                'field' => 'model',
                'options' => Department::where('structure_id', Auth::user()->structure->id)->get(),
            ],
            'name' => [
                'title' => 'Nom',
                'field' => 'text'
            ],
            'gross_wage' => [
                'title' => 'Salaire brut',
                'field' => 'text'
            ],
            'hourly_rate' => [
                'title' => 'Tarif horaire',
                'field' => 'text'
            ],
            'overtime_rate' => [
                'title' => 'Tarif heure sup',
                'field' => 'text'
            ]
        ];
        return $fields;
    }
}

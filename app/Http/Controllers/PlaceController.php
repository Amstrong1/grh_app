<?php

namespace App\Http\Controllers;

use App\Models\Place;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
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
        $place->basis_wage = $request->basis_wage;
        $place->hourly_rate = $request->hourly_rate;
        $place->overtime_rate = $request->overtime_rate;

        if ($place->save()) {
            Alert::toast(Lang::get('message.success'), 'success');
            return redirect('place');
        }
        else {
            Alert::toast(Lang::get('message.success'), 'error');
            return redirect()->back()->withInput($request->input());
        } 
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
        $place = Place::find($place->id);

        $place->department()->associate($request->department);
        $place->name = $request->name;
        $place->basis_wage = $request->basis_wage;
        $place->hourly_rate = $request->hourly_rate;
        $place->overtime_rate = $request->overtime_rate;
        
        if ($place->save()) {
            Alert::toast(Lang::get('message.edited'), 'success');
            return redirect('place');
        }else {            
            Alert::toast(Lang::get('message.error'), 'error');
            return redirect()->back()->withInput($request->input());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Place $place)
    {        
        try {
            $place = $place->delete();
            Alert::success(Lang::get('message.del_success1'), Lang::get('message.del_success2'));
            return redirect('place');
        } catch (\Exception $e) {
            Alert::error(Lang::get('message.del_error1'), Lang::get('message.del_error2'), );
            return redirect()->back();
        }
    }

    private function place_columns()
    {
        $columns = (object) [
            'name' => 'Poste',
            'department_name' => 'Département',
            'formatted_basis_wage' => 'Salaire de base',
            'formatted_hourly_rate' => 'Tarif horaire',
            'formatted_overtime_rate' => 'Tarif heure sup semaine',
            'formatted_overtime_rate_week' => 'Tarif heure sup weekend/férié',
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
            'basis_wage' => [
                'title' => 'Salaire de base',
                'field' => 'text'
            ],
            'hourly_rate' => [
                'title' => 'Tarif horaire',
                'field' => 'text'
            ],
            'overtime_rate' => [
                'title' => 'Tarif heure sup',
                'field' => 'text'
            ],
            'overtime_rate_week' => [
                'title' => 'Tarif heure sup weekend/férié',
                'field' => 'text'
            ],
        ];
        return $fields;
    }
}

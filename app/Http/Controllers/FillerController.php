<?php

namespace App\Http\Controllers;

use App\Models\Filler;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\StoreFillerRequest;
use App\Http\Requests\UpdateFillerRequest;

class FillerController extends Controller
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
        return view('app.filler.index', [
            'fillers' => $structure->fillers()->get(),
            'my_actions' => $this->filler_actions(),
            'my_attributes' => $this->filler_columns(),
            'my_fields' => $this->filler_fields(),
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
    public function store(StoreFillerRequest $request)
    {
        $filler = new Filler();

        $filler->structure_id = Auth::user()->structure->id;
        $filler->name = $request->name;
        $filler->rate = $request->rate;
        $filler->amount = $request->amount;

        if ($filler->save()) {
            Alert::toast('Les données ont été enregistrées', 'success');
            return redirect('filler');
        }
        else {
            Alert::toast('Les données ont été enregistrées', 'error');
            return redirect()->back()->withInput($request->input());
        } 
    }

    /**
     * Display the specified resource.
     */
    public function show(Filler $filler)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Filler $filler)
    {
        return view('app.filler.edit', [
            'filler' => $filler,
            'my_fields' => $this->filler_fields(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFillerRequest $request, Filler $filler)
    {
        $filler = Filler::find($filler->id);

        $filler->name = $request->name;
        $filler->rate = $request->rate;
        $filler->amount = $request->amount;
        
        if ($filler->save()) {
            Alert::toast('Les informations ont été modifiées', 'success');
            return redirect('filler');
        }else {            
            Alert::toast('Les informations ont été modifiées', 'success');
            return redirect()->back()->withInput($request->input());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Filler $filler)
    {
        try {
            $filler = $filler->delete();
            Alert::success('Opération effectuée', 'Suppression éffectué');
            return redirect('filler');
        } catch (\Exception $e) {
            Alert::error('Erreur', 'Element introuvable');
            return redirect()->back();
        }
    }

    private function filler_columns()
    {
        $columns = (object) [
            'name' => 'Nom',
            'rate' => 'Valeur en pourcentage',
            'amount' => 'Montant',
        ];
        return $columns;
    }

    private function filler_actions()
    {
        $actions = (object) array(
            'edit' => 'Modifier',
            'delete' => "Supprimer",
        );
        return $actions;
    }

    private function filler_fields()
    {
        $fields = [
            'name' => [
                'title' => 'Nom',
                'field' => 'text'
            ],
            'rate' => [
                'title' => 'Pourcentage',
                'field' => 'number'
            ],
            'amount' => [
                'title' => 'Montant',
                'field' => 'number'
            ],
        ];
        return $fields;
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\SalaryAdvantages;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\StoreSalaryAdvantagesRequest;
use App\Http\Requests\UpdateSalaryAdvantagesRequest;

class SalaryAdvantagesController extends Controller
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
        return view('app.salaryAdvantage.index', [
            'salaryAdvantages' => $structure->salaryAdvantages()->get(),
            'my_actions' => $this->salaryAdvantage_actions(),
            'my_attributes' => $this->salaryAdvantage_columns(),
            'my_fields' => $this->salaryAdvantage_fields(),
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
    public function store(StoreSalaryAdvantagesRequest $request)
    {
        $salaryAdvantage = new SalaryAdvantages();

        $salaryAdvantage->structure_id = Auth::user()->structure->id;
        $salaryAdvantage->name = $request->name;
        $salaryAdvantage->rate = $request->rate;
        $salaryAdvantage->amount = $request->amount;

        if ($salaryAdvantage->save()) {
            Alert::toast('Les données ont été enregistrées', 'success');
            return redirect('salaryAdvantage');
        }
        else {
            Alert::toast('Les données ont été enregistrées', 'error');
            return redirect()->back()->withInput($request->input());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SalaryAdvantages $salaryAdvantages)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SalaryAdvantages $salaryAdvantages)
    {
        return view('app.salaryAdvantage.edit', [
            'salaryAdvantage' => $salaryAdvantages,
            'my_fields' => $this->salaryAdvantage_fields(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSalaryAdvantagesRequest $request, SalaryAdvantages $salaryAdvantages)
    {
        $salaryAdvantage = SalaryAdvantages::find($salaryAdvantages->id);

        $salaryAdvantage->name = $request->name;
        $salaryAdvantage->rate = $request->rate;
        $salaryAdvantage->amount = $request->amount;
        
        if ($salaryAdvantage->save()) {
            Alert::toast('Les informations ont été modifiées', 'success');
            return redirect('salaryAdvantage');
        }else {            
            Alert::toast('Les informations ont été modifiées', 'success');
            return redirect()->back()->withInput($request->input());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SalaryAdvantages $salaryAdvantages)
    {
        try {
            $salaryAdvantages = $salaryAdvantages->delete();
            Alert::success('Opération effectuée', 'Suppression éffectué');
            return redirect('salaryAdvantage');
        } catch (\Exception $e) {
            Alert::error('Erreur', 'Element introuvable');
            return redirect()->back();
        }
    }

    private function salaryAdvantage_columns()
    {
        $columns = (object) [
            'name' => 'Nom',
            'amount' => 'Montant',
            'rate' => 'Pourcentage',
        ];
        return $columns;
    }

    private function salaryAdvantage_actions()
    {
        $actions = (object) array(
            'edit' => 'Modifier',
            'delete' => "Supprimer",
        );
        return $actions;
    }

    private function salaryAdvantage_fields()
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

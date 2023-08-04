<?php

namespace App\Http\Controllers;

use App\Models\SalaryAdvantage;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\StoreSalaryAdvantageRequest;
use App\Http\Requests\UpdateSalaryAdvantageRequest;

class SalaryAdvantageController extends Controller
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
        return view('app.salary-advantage.index', [
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
    public function store(StoreSalaryAdvantageRequest $request)
    {
        $salaryAdvantage = new SalaryAdvantage();

        $salaryAdvantage->structure_id = Auth::user()->structure->id;
        $salaryAdvantage->name = $request->name;
        $salaryAdvantage->rate = $request->rate;
        $salaryAdvantage->amount = $request->amount;

        if ($salaryAdvantage->save()) {
            Alert::toast('Les données ont été enregistrées', 'success');
            return redirect('salary_advantage');
        }
        else {
            Alert::toast('Les données ont été enregistrées', 'error');
            return redirect()->back()->withInput($request->input());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SalaryAdvantage $salaryAdvantage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SalaryAdvantage $salaryAdvantage)
    {
        return view('app.salary-advantage.edit', [
            'salaryAdvantage' => $salaryAdvantage,
            'my_fields' => $this->salaryAdvantage_fields(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSalaryAdvantageRequest $request, SalaryAdvantage $salaryAdvantages)
    {
        $salaryAdvantage = SalaryAdvantage::find($salaryAdvantages->id);

        $salaryAdvantage->name = $request->name;
        $salaryAdvantage->rate = $request->rate;
        $salaryAdvantage->amount = $request->amount;
        
        if ($salaryAdvantage->save()) {
            Alert::toast('Les informations ont été modifiées', 'success');
            return redirect('salary_advantage');
        }else {            
            Alert::toast('Les informations ont été modifiées', 'success');
            return redirect()->back()->withInput($request->input());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SalaryAdvantage $salaryAdvantages)
    {
        try {
            $salaryAdvantages = $salaryAdvantages->delete();
            Alert::success('Opération effectuée', 'Suppression éffectué');
            return redirect('salary_advantage');
        } catch (\Exception $e) {
            Alert::error('Erreur', 'Element introuvable');
            return redirect()->back();
        }
    }

    private function salaryAdvantage_columns()
    {
        $columns = (object) [
            'name' => 'Nom',
            'formatted_amount' => 'Montant',
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
                'field' => 'text'
            ],
            'amount' => [
                'title' => 'Montant',
                'field' => 'text'
            ],
        ];
        return $fields;
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\HoldingWage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\StoreHoldingWageRequest;
use App\Http\Requests\UpdateHoldingWageRequest;

class HoldingWageController extends Controller
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
        return view('app.holding-wage.index', [
            'holdingWages' => $structure->holdingWages()->get(),
            'my_actions' => $this->holdingWage_actions(),
            'my_attributes' => $this->holdingWage_columns(),
            'my_fields' => $this->holdingWage_fields(),
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
    public function store(StoreHoldingWageRequest $request)
    {
        $holdingWage = new HoldingWage();

        $holdingWage->structure_id = Auth::user()->structure->id;
        $holdingWage->name = $request->name;
        $holdingWage->rate = $request->rate;
        $holdingWage->amount = $request->amount;

        if ($holdingWage->save()) {
            Alert::toast(Lang::get('message.success'), 'success');
            return redirect('holding_wage');
        }
        else {
            Alert::toast(Lang::get('message.error'), 'error');
            return redirect()->back()->withInput($request->input());
        } 
    }

    /**
     * Display the specified resource.
     */
    public function show(HoldingWage $holdingWage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HoldingWage $holdingWage)
    {
        return view('app.holding-wage.edit', [
            'holdingWage' => $holdingWage,
            'my_fields' => $this->holdingWage_fields(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHoldingWageRequest $request, HoldingWage $holdingWage)
    {
        $holdingWage = HoldingWage::find($holdingWage->id);

        $holdingWage->name = $request->name;
        $holdingWage->rate = $request->rate;
        $holdingWage->amount = $request->amount;
        
        if ($holdingWage->save()) {
            Alert::toast(Lang::get('message.edited'), 'success');
            return redirect('holding_wage');
        }else {            
            Alert::toast(Lang::get('message.edited'), 'success');
            return redirect()->back()->withInput($request->input());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HoldingWage $holdingWage)
    {
        try {
            $holdingWage = $holdingWage->delete();
            Alert::success(Lang::get('message.del_success1'), Lang::get('message.del_success2'));
            return redirect('holding_wage');
        } catch (\Exception $e) {
            Alert::error(Lang::get('message.del_error1'), Lang::get('message.del_error2'), );
            return redirect()->back();
        }
    }

    private function holdingWage_columns()
    {
        $columns = (object) [
            'name' => 'Nom',
            'rate' => 'Valeur en pourcentage',
            'formatted_amount' => 'Montant',
        ];
        return $columns;
    }

    private function holdingWage_actions()
    {
        $actions = (object) array(
            'edit' => 'Modifier',
            'delete' => "Supprimer",
        );
        return $actions;
    }

    private function holdingWage_fields()
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

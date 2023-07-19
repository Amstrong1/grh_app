<?php

namespace App\Http\Controllers;

use App\Models\Pay;
use App\Models\User;
use App\Models\Filler;
use App\Models\Department;
use App\Enums\UserRoleEnum;
use App\Models\SalaryAdvantage;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePayRequest;
use App\Http\Requests\UpdatePayRequest;
use App\Models\FillerPay;
use App\Models\PaySalaryAdvantage;
use RealRashid\SweetAlert\Facades\Alert;

class PayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $structure = Auth::user()->structure;
        return view('app.pay.index', [
            'pays' => $structure->pays()->get(),
            'my_actions' => $this->pay_actions(),
            'my_attributes' => $this->pay_columns(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $structure = Auth::user()->structure;
        $users = $structure->users()
            ->where('role', '!=', UserRoleEnum::Admin)
            ->where('role', '!=', UserRoleEnum::SuperAdmin)
            ->get();
        $departments = Department::all();
        $fillers = Filler::all();
        $salaryAdvantages = SalaryAdvantage::all();
        return view('app.pay.create', compact(
            'users',
            'departments',
            'fillers',
            'salaryAdvantages',
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePayRequest $request)
    {
        $net_wage = 0;
        $gross_wage = 0;

        $ads = 0;
        $fillers = 0;

        $salaryAdvantageCount = SalaryAdvantage::where('structure_id', Auth::user()->structure_id)->count();
        $fillersCount = Filler::where('structure_id', Auth::user()->structure_id)->count();
        $user = User::where('id', $request->user)->first();

        // somme des avantages salariales
        for ($i = 0; $i < $salaryAdvantageCount; $i++) {
            if ($request->boolean('advantageCheckbox' . $i) === true) {
                if (gettype($request->input('advantageAmount' . $i)) === 'integer') {
                    $ads += $request->input('advantageAmount' . $i);
                } else {
                    $ads += (intval($request->input('advantageAmount' . $i)) * $user->career->place->basis_wage) / 100;
                }
            }
        }

        // calcul du salaire brut
        if ($user->career->place->basis_wage !== null) {
            $gross_wage = $user->career->place->basis_wage + ($user->career->place->overtime_rate * $request->overtime_done) + $ads;
        } else {
            $gross_wage = ($user->career->place->hourly_rate * $request->hours_done) + ($user->career->place->overtime_rate * $request->overtime_done) + $ads;
        }

        // somme des imputations salariales
        for ($i = 0; $i < $fillersCount; $i++) {
            if ($request->boolean('fillerCheckbox' . $i) === true) {
                if (gettype($request->input('fillerAmount' . $i)) === 'integer') {
                    $fillers += $request->input('fillerAmount' . $i);
                } else {
                    $fillers += (intval($request->input('fillerAmount' . $i)) * $gross_wage) / 100;
                }
            }
        }

        // calcul du salaire net
        $net_wage = $gross_wage - $fillers;

        $pay = new Pay();

        $pay->structure_id = Auth::user()->structure->id;
        $pay->user_id = $request->user;
        $pay->period_start = $request->period_start;
        $pay->period_end = $request->period_end;
        $pay->hour_done = $request->hours_done;
        $pay->overtime_done = $request->overtime_done;
        $pay->gross_wage = $gross_wage;
        $pay->net_wage = $net_wage;
        $pay->created_by = Auth::user()->id;
        $pay->pay_date = $request->pay_date;

        if ($pay->save()) {
            for ($i = 0; $i < $salaryAdvantageCount; $i++) {
                if ($request->boolean('advantageCheckbox' . $i) === true) {
                    $salaryAdvantages = new PaySalaryAdvantage();

                    $salaryAdvantages->pay_id = $pay->id;
                    $salaryAdvantages->salary_advantage_id = $request->input('advantageId' . $i);
                    $salaryAdvantages->amount = $request->input('advantageAmount' . $i);

                    $salaryAdvantages->save();
                }
            }

            for ($i = 0; $i < $fillersCount; $i++) {
                if ($request->boolean('fillerCheckbox' . $i) === true) {
                    $filler = new FillerPay();

                    $filler->pay_id = $pay->id;
                    $filler->filler_id = $request->input('fillerId' . $i);

                    if (gettype($request->input('fillerAmount' . $i)) === 'integer') {
                        $filler->amount = $request->input('fillerAmount' . $i);
                    } else {
                        $filler->amount = (intval($request->input('fillerAmount' . $i)) * $gross_wage) / 100;
                    }

                    $filler->save();
                }
            }

            Alert::toast('Fiche de paie enregistrée', 'success');
            return redirect('pay');
        } else {
            Alert::toast('Une erreur est survenue', 'error');
            return back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Pay $pay)
    {
        $payFillers = $pay->fillers()->get();
        $payAds = $pay->salaryAdvantages()->get();

        return view('app.pay.show', [
            'pay' => $pay,
            'payAds' => $payAds,
            'payFillers' => $payFillers,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pay $pay)
    {
        return view('app.pay.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePayRequest $request, Pay $pay)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pay $pay)
    {
        try {
            $pay = $pay->delete();
            Alert::success('Opération effectuée', 'Suppression éffectué');
            return redirect('pay');
        } catch (\Exception $e) {
            Alert::error('Erreur', 'Element introuvable');
            return redirect()->back();
        }
    }

    private function pay_columns()
    {
        $columns = (object) [
            'user' => 'Nom et Prénoms',
            'formatted_pay_date' => 'Date de paiement',
            'period' => 'Période',
        ];
        return $columns;
    }

    private function pay_actions()
    {
        $actions = (object) array(
            'show' => 'Voir',
            // 'edit' => 'Modifier',
            'delete' => "Supprimer",
        );
        return $actions;
    }
}

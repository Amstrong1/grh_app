<?php

namespace App\Http\Controllers;

use PDF;

use App\Models\Pay;
use App\Models\User;
use App\Models\Filler;
use App\Models\FillerPay;
use App\Models\Department;
use App\Models\HoldingWage;
use App\Enums\UserRoleEnum;
use Illuminate\Support\Str;
use App\Models\HoldingWagePay;
use App\Models\SalaryAdvantage;
use App\Models\PaySalaryAdvantage;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePayRequest;
use App\Http\Requests\UpdatePayRequest;
use RealRashid\SweetAlert\Facades\Alert;
use App\Notifications\NewPayslipNotification;

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
        $holds = 0;
        $fillers = 0;

        $salaryAdvantageCount = SalaryAdvantage::where('structure_id', Auth::user()->structure_id)->count();
        $holdingWageCount = HoldingWage::where('structure_id', Auth::user()->structure_id)->count();
        $fillersCount = Filler::where('structure_id', Auth::user()->structure_id)->count();
        $user = User::where('id', $request->user)->first();

        // somme des avantages salariales
        for ($i = 0; $i < $salaryAdvantageCount; $i++) {
            if ($request->boolean('advantageCheckbox' . $i) === true) {
                $ads += intval($request->input('advantageAmount' . $i)) * intval($request->input('advantageQte' . $i));
            }
        }

        // calcul du salaire brut
        if ($user->career->place->basis_wage !== null) {
            $gross_wage = $user->career->place->basis_wage + ($user->career->place->overtime_rate * $request->overtime_done) + ($user->career->place->overtime_rate_week * $request->overtime_done_week) + $ads;
        } else {
            $gross_wage = ($user->career->place->hourly_rate * $request->hours_done) + ($user->career->place->overtime_rate * $request->overtime_done) + ($user->career->place->overtime_rate_week * $request->overtime_done_week) + $ads;
        }

        // somme des retenues salariales
        for ($i = 0; $i < $holdingWageCount; $i++) {
            if ($request->boolean('holdingWageCheckbox' . $i) === true) {
                if (str_contains($request->input('holdingWageAmount' . $i), '%')) {
                    $holds += ((intval($request->input('holdingWageAmount' . $i)) * $gross_wage) / 100) * $request->input('holdingWageQte' . $i);
                } else {
                    $holds += intval($request->input('holdingWageAmount' . $i)) * intval($request->input('holdingWageQte' . $i));
                }
            }
        }

        // somme des imputations salariales
        for ($i = 0; $i < $fillersCount; $i++) {
            if ($request->boolean('fillerCheckbox' . $i) === true) {
                if (str_contains($request->input('fillerAmount' . $i), '%')) {
                    $fillers += (intval($request->input('fillerAmount' . $i)) * $gross_wage) / 100;
                } else {
                    $fillers += intval($request->input('fillerAmount' . $i));
                }
            }
        }

        // calcul du salaire net
        $net_wage = $gross_wage - $fillers - $holds;

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
            // store each salary advantage
            for ($i = 0; $i < $salaryAdvantageCount; $i++) {
                if ($request->boolean('advantageCheckbox' . $i) === true) {

                    if (str_contains($request->input('advantageAmount' . $i), '%')) {
                        $amount = ((intval($request->input('advantageAmount' . $i)) * $gross_wage) / 100) * $request->input('advantageQte' . $i);
                    } else {
                        $amount = intval($request->input('advantageAmount' . $i)) * intval($request->input('advantageQte' . $i));
                    }

                    PaySalaryAdvantage::create([
                        'pay_id' => $pay->id,
                        'salary_advantage_id' => $request->input('advantageId' . $i),
                        'amount' => $amount,
                    ]);
                }
            }

            // store each filler
            for ($i = 0; $i < $fillersCount; $i++) {
                if ($request->boolean('fillerCheckbox' . $i) === true) {

                    if (str_contains($request->input('fillerAmount' . $i), '%')) {
                        $amount = (intval($request->input('fillerAmount' . $i)) * $gross_wage) / 100;
                    } else {
                        $amount = intval($request->input('fillerAmount' . $i));
                    }

                    FillerPay::create([
                        'pay_id' => $pay->id,
                        'filler_id' => $request->input('fillerId' . $i),
                        'amount' => $amount,
                    ]);
                }
            }

            // store each holding wages
            for ($i = 0; $i < $holdingWageCount; $i++) {
                if ($request->boolean('holdingWageCheckbox' . $i) === true) {

                    if (str_contains($request->input('holdingWagerAmount' . $i), '%')) {
                        $amount = ((intval($request->input('holdingWageAmount' . $i)) * $gross_wage) / 100) * $request->input('holdingWageQte' . $i);
                    } else {
                        $amount = intval($request->input('holdingWageAmount' . $i)) * intval($request->input('holdingWageQte' . $i));
                    }

                    HoldingWagePay::create([
                        'pay_id' => $pay->id,
                        'holding_wage_id' => $request->input('holdingWageId' . $i),
                        'amount' => $amount,
                    ]);
                }
            }

            //save payslip pdf
            $payFillers = $pay->fillers()->get();
            $payHolders = $pay->holdingWages()->get();
            $payAds = $pay->salaryAdvantages()->get();

            $path = Str::slug('payslip' . $pay->id . '_' . time()) . ".pdf";

            $pdf = PDF::loadView('app.pay.show', compact('pay', 'payFillers', 'payAds', 'payHolders'));
            $pdf->save(public_path('storage/payslips/' . $path));

            $pay->payslip = $path;

            if ($pay->save) {
                Alert::toast('Fiche de paie enregistrée', 'success');
                $user = User::find($pay->user_id);
                $user->notify(new NewPayslipNotification($pay->payslip, $pay->period_start, $pay->period_end));
                return redirect('pay');
            }
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
        $payHolders = $pay->holdingWages()->get();
        $payAds = $pay->salaryAdvantages()->get();

        $pdf = PDF::loadView('app.pay.show', compact('pay', 'payFillers', 'payAds', 'payHolders'));
        return $pdf->stream();
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
            FillerPay::where('pay_id', $pay->id)->delete();
            HoldingWagePay::where('pay_id', $pay->id)->delete();
            PaySalaryAdvantage::where('pay_id', $pay->id)->delete();

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

<?php

namespace App\Http\Controllers;

use App\Models\Pay;
use App\Models\User;
use App\Models\Filler;
use App\Models\Department;
use App\Enums\UserRoleEnum;
use App\Models\SalaryAdvantages;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePayRequest;
use App\Http\Requests\UpdatePayRequest;
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
        $salaryAdvantages = SalaryAdvantages::all();
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
        $salaryAdvantageCount = SalaryAdvantages::where('structure_id', Auth::user()->structure_id)->count();

        for ($i = 0; $i < $salaryAdvantageCount; $i++) {
            if ($request->boolean('advantageCheckbox' . $i) === true) {
                $ads += $request->input('advantageAmount' . [$i]);
            }
        }

        $fillers = 0;
        $fillersCount = Filler::where('structure_id', Auth::user()->structure_id)->count();
        for ($i = 0; $i < $fillersCount; $i++) {
            if ($request->boolean('fillerCheckbox' . $i) === true) {
                $fillers += $request->input('fillerAmount' . [$i]);
            }
        }

        $user = User::where('id', $request->user)->first();
        if ($user->career->place->basis_wage !== null) {
            $gross_wage = $user->career->place->basis_wage + ($user->career->place->overtime_rate * $request->overtime_done) + $ads;
        } else {
            $gross_wage = ($user->career->place->hourly_rate * $request->hours_done) + ($user->career->place->overtime_rate * $request->overtime_done) + $ads;
        }

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

        $payCheck = Pay::where('user_id', $request->user)
            ->where('period_start', $request->period_start)
            ->where('period_end', $request->period_end)
            ->count();

        if ($payCheck !== 0) {
            if ($pay->save()) {
                for ($i = 0; $i < $salaryAdvantageCount; $i++) {
                    if ($request->boolean('advantageCheckbox' . $i) === true) {
                        $salaryAdvantages = new SalaryAdvantages();

                        $salaryAdvantages->structure_id = Auth::user()->structure_id;
                        $salaryAdvantages->pay_id = $pay->id;
                        $salaryAdvantages->name = $request->input('advantageName' . [$i]);
                        $salaryAdvantages->amount = $request->input('advantageAmount' . [$i]);
                    }
                }

                for ($i = 0; $i < $fillersCount; $i++) {
                    if ($request->boolean('fillerCheckbox' . $i) === true) {
                        $filler = new Filler();

                        $filler->structure_id = Auth::user()->structure_id;
                        $filler->pay_id = $pay->id;
                        $filler->name = $request->input('fillerName' . [$i]);
                        $filler->amount = $request->input('fillerAmount' . [$i]);
                    }
                }

                Alert::toast('Fiche de paie enregistrée', 'success');
                return redirect('pay');
            } else {
                Alert::toast('Une erreur est survenue', 'error');
                return back();
            }
        } else {
            Alert::toast('Une fiche de paie pour cet employé sur la même période existe déja', 'error');
            return back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Pay $pay)
    {
        return view('app.pay.show');
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
            'pay_date' => 'Date de paiement',
            'period' => 'Période',
        ];
        return $columns;
    }

    private function pay_actions()
    {
        $actions = (object) array(
            'show' => 'Voir',
            'edit' => 'Modifier',
            'delete' => "Supprimer",
        );
        return $actions;
    }
}

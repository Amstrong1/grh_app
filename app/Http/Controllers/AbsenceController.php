<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Enums\UserRoleEnum;
use App\Enums\PermissionStatusEnum;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\StoreAbsenceRequest;
use App\Http\Requests\UpdateAbsenceRequest;
use App\Models\User;
use App\Notifications\NewPermissionNotification;
use App\Notifications\PermissionResponse;

class AbsenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $structure = Auth::user()->structure;
        if (Auth::user()->role === UserRoleEnum::User) {
            return view('app.absence.index', [
                'absences' => $structure->absences()
                    ->where('user_id', Auth::id())
                    ->where('status', PermissionStatusEnum::Pending)
                    ->get(),
                'my_attributes' => $this->absence_columns(),
                'my_actions' => $this->absence_actions(),
            ]);
        } else {
            return view('app.absence.index', [
                'absences' => $structure->absences()
                    ->where('status', PermissionStatusEnum::Pending)
                    ->get(),
                'my_attributes' => $this->absence_columns(),
                'my_actions' => $this->absence_actions(),
            ]);
        }
    }

    public function indexAllowed()
    {
        $structure = Auth::user()->structure;
        if (Auth::user()->role === UserRoleEnum::User) {
            return view('app.absence.index', [
                'absences' => $structure->absences()
                    ->where('user_id', Auth::id())
                    ->where('status', PermissionStatusEnum::Allowed)
                    ->get(),
                'my_attributes' => $this->absence_columns(),
                'my_actions' => [],
            ]);
        } else {
            return view('app.absence.index', [
                'absences' => $structure->absences()
                    ->where('status', PermissionStatusEnum::Allowed)
                    ->get(),
                'my_attributes' => $this->absence_columns(),
                'my_actions' => [],
            ]);
        }
    }

    public function indexDenied()
    {
        $structure = Auth::user()->structure;
        if (Auth::user()->role === UserRoleEnum::User) {
            return view('app.absence.index', [
                'absences' => $structure->absences()
                    ->where('user_id', Auth::id())
                    ->where('status', PermissionStatusEnum::Denied)
                    ->get(),
                'my_attributes' => $this->absence_columns(),
                'my_actions' => [],
            ]);
        } else {
            return view('app.absence.index', [
                'absences' => $structure->absences()
                    ->where('status', PermissionStatusEnum::Denied)
                    ->get(),
                'my_attributes' => $this->absence_columns(),
                'my_actions' => [],
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('app.absence.create', [
            'my_fields' => $this->absence_fields(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAbsenceRequest $request)
    {
        $absence = new Absence();

        $absence->structure_id = Auth::user()->structure->id;
        $absence->user_id = Auth::id();
        $absence->absence_date = $request->absence_date;
        $absence->cause = $request->cause;
        $absence->status = PermissionStatusEnum::Pending;

        if ($absence->save()) {
            Alert::toast("Données enregistrées", 'success');
            $user = User::where('structure_id', Auth::user()->structure_id)->where('role', 'admin')->first();
            $user->notify(new NewPermissionNotification());
            return redirect('absence');
        } else {
            Alert::toast('Une erreur est survenue', 'error');
            return redirect()->back()->withInput($request->input());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Absence $absence)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Absence $absence)
    {
        return view('app.absence.edit', [
            'absence' => $absence,
            'my_fields' => $this->absence_fields(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAbsenceRequest $request, Absence $absence)
    {
        $absence = Absence::find($absence->id);

        if (Auth::user()->role === 'user') {
            $absence->absence_date = $request->absence_date;
            $absence->cause = $request->cause;

            if ($absence->save()) {
                Alert::toast('Les informations ont été modifiées', 'success');
                return redirect('absence');
            } else {
                Alert::toast('Une erreur est survenue', 'error');
                return back()->withInput($request->input());
            }
        } else {
            $absence->status = $request->status;

            if ($absence->save()) {
                Alert::toast('Les informations ont été modifiées', 'success');
                $user = $absence->user;
                $user->notify(new PermissionResponse($absence->status));
                return redirect('absence');
            } else {
                Alert::toast('Une erreur est survenue', 'error');
                return back()->withInput($request->input());
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Absence $absence)
    {
        try {
            $absence = $absence->delete();
            Alert::success('Opération effectuée', 'Suppression éffectué');
            return redirect('absence');
        } catch (\Exception $e) {
            Alert::error('Erreur', 'Element introuvable');
            return redirect()->back();
        }
    }

    private function absence_columns()
    {
        $columns = (object) [
            'user_fullname' => 'Nom et prénoms',
            'absence_date' => 'Date',
            'cause' => 'Motif',
            // 'status' => 'Statut',
        ];
        return $columns;
    }

    private function absence_actions()
    {
        if (Auth::user()->role === UserRoleEnum::User) {
            $actions = (object) array(
                'edit' => 'Modifier',
                'delete' => "Supprimer",
            );
        } else {
            $actions = (object) array(
                'edit' => 'Modifier',
            );
        }

        return $actions;
    }

    private function absence_fields()
    {
        if (Auth::user()->role === 'user') {
            $fields = [
                'absence_date' => [
                    'title' => 'Date',
                    'field' => 'date'
                ],
                'cause' => [
                    'title' => 'Motif',
                    'field' => 'textarea'
                ],
            ];
        } else {
            $status = [
                'Accordé' => PermissionStatusEnum::Allowed,
                'Refusé' => PermissionStatusEnum::Denied,
            ];
            $fields = [
                'status' => [
                    'title' => 'Status',
                    'field' => 'select',
                    'options' => $status
                ],
            ];
        }

        return $fields;
    }
}

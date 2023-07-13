<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Conflict;
use App\Models\ConflictUser;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\StoreConflictRequest;
use App\Http\Requests\UpdateConflictRequest;

class ConflictController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $structure = Auth::user()->structure;
        return view('app.conflict.index', [
            'conflicts' => $structure->conflicts()->get(),
            'my_actions' => $this->conflict_actions(),
            'my_attributes' => $this->conflict_columns(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('app.conflict.create', [
            'my_fields' => $this->conflict_fields(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreConflictRequest $request)
    {
        $conflict = new Conflict();

        $conflict->structure_id = Auth::user()->structure->id;
        $conflict->conflict_date = $request->conflict_date;
        $conflict->cause = $request->cause;
        $conflict->created_by = Auth::user()->name . ' ' . Auth::user()->firstname;

        if ($conflict->save()) {
            $get_conflict = Conflict::where('structure_id', Auth::user()->structure->id)
                ->where('conflict_date', $request->conflict_date)
                ->where('cause', $request->cause)
                ->where('created_by', Auth::user()->name . ' ' . Auth::user()->firstname)
                ->first();

            foreach ($request->users as $user) {
                ConflictUser::create([
                    'user_id' => $user,
                    'conflict_id' => $get_conflict->id,
                    'structure_id' => Auth::user()->structure->id,
                ]);
            }
            Alert::toast("Données enregistrées", 'success');
            return redirect('conflict');
        } else {
            Alert::toast('Une erreur est survenue', 'error');
            return redirect()->back()->withInput($request->input());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Conflict $conflict)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Conflict $conflict)
    {
        // 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateConflictRequest $request, Conflict $conflict)
    {
        // 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Conflict $conflict)
    {
        try {
            $conflict = $conflict->delete();
            Alert::success('Opération effectuée', 'Suppression éffectué');
            return redirect('conflict');
        } catch (\Exception $e) {
            Alert::error('Erreur', 'Element introuvable');
            return redirect()->back();
        }
    }

    private function conflict_columns()
    {
        $columns = (object) [
            'users_fullname' => 'Nom et prénoms',
            'conflict_date' => 'Date',
            'cause' => 'Motif',
        ];
        return $columns;
    }

    private function conflict_actions()
    {
        $actions = (object) array(
            'delete' => "Supprimer",
        );
        return $actions;
    }

    private function conflict_fields()
    {
        $fields = [
            'users' => [
                'title' => 'Personnes en cause',
                'field' => 'multiple-select',
                'options' => User::where('structure_id', Auth::user()->structure->id)->get(),
            ],
            'conflict_date' => [
                'title' => 'Date',
                'field' => 'date'
            ],
            'cause' => [
                'title' => 'Motif',
                'field' => 'textarea'
            ],
        ];
        return $fields;
    }
}

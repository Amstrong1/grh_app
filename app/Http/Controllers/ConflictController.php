<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Conflict;
use App\Models\ConflictUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreConflictRequest;
use App\Http\Requests\UpdateConflictRequest;
use App\Notifications\NewConflictNotification;

class ConflictController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $structure = Auth::user()->structure;
        $conflicts = $structure->conflicts()->get();

        return view('app.conflict.index', [
            'conflicts' => $conflicts,
            'my_actions' => $this->conflict_actions(),
            'my_attributes' => $this->conflict_columns(),
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function indexFilter(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'start' => 'required|before_or_equal:end',
            'end' => 'required|after_or_equal:start'
        ]);
        if (!$validate->fails()) {
            $conflicts = Conflict::where('structure_id', Auth::user()->structure_id)
                ->whereBetween('conflict_date', [$request->start, $request->end])
                ->get();
        } else {
            return redirect('conflict');
        }

        return view('app.conflict.index', [
            'conflicts' => $conflicts,
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
        $conflict->status = 'En cours';
        $conflict->created_by = Auth::user()->name . ' ' . Auth::user()->firstname;

        if ($conflict->save()) {

            foreach ($request->users as $user) {
                ConflictUser::create([
                    'user_id' => $user,
                    'conflict_id' => $conflict->id,
                    'structure_id' => Auth::user()->structure->id,
                ]);
            }
            Alert::toast("Données enregistrées", 'success');
            $user = User::where('structure_id', Auth::user()->structure_id)->where('role', 'admin')->first();
            $user->notify(new NewConflictNotification());
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
        return view('app.conflict.edit', [
            'conflict' => $conflict,
            'my_fields' => $this->conflict_edit_fields(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateConflictRequest $request, Conflict $conflict)
    {
        $conflict = Conflict::find($conflict->id);

        if (Auth::user()->role === 'admin') {
            $conflict->due_date = $request->due_date;
            $conflict->due_time = $request->due_time;
            $conflict->task = $request->task;

            foreach ($request->users as $user) {
                ConflictUser::where('task_id', $conflict->id)->delete();
                ConflictUser::create([
                    'user_id' => $user,
                    'task_id' => $conflict->id,
                    'structure_id' => Auth::user()->structure->id,
                ]);
            }
        } else {
            $conflict->status = $request->status;
            $conflict->report = $request->report;
        }

        if ($conflict->save()) {
            Alert::toast('Les informations ont été modifiées', 'success');
            return redirect('conflict');
        } else {
            Alert::toast('Une erreur est survenue', 'error');
            return redirect()->back()->withInput($request->input());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Conflict $conflict)
    {
        try {
            $usersDel = ConflictUser::where('conflict_id', $conflict->id)->delete();

            if ($usersDel) {
                $conflict = $conflict->delete();
                Alert::success('Opération effectuée', 'Suppression éffectué');
                return redirect('conflict');
            } else {
                Alert::error('Erreur', 'Element introuvable');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            Alert::error('Erreur', 'Element introuvable');
            return redirect()->back();
        }
    }

    private function conflict_columns()
    {
        $columns = (object) [
            'users_fullname' => 'Nom et prénoms',
            'formatted_conflict_date' => 'Date',
            'cause' => 'Motif',
        ];
        return $columns;
    }

    private function conflict_actions()
    {
        if (Auth::user()->role === 'user') {
            $actions = (object) array(
                'edit' => "Modifier",
            );
        } else {
            $actions = (object) array(
                'edit' => "Modifier",
                'delete' => "Supprimer",
            );
        }
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

    private function conflict_edit_fields()
    {
        if (Auth::user()->role === 'user') {
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
        } else {
            $status = ['En cours' => 'En cours', 'Résolu' => 'Résolu'];

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
                'status' => [
                    'title' => 'Statut',
                    'field' => 'select',
                    'options' => $status,
                ],
            ];
        }

        return $fields;
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Temptation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreTemptationRequest;
use App\Http\Requests\UpdateTemptationRequest;
use App\Notifications\MewTemptationNotification;

class TemptationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $structure = Auth::user()->structure;
        $temptations = $structure->temptations()->get();

        if (request()->method() == 'POST') {
            $validate = Validator::make($request->all(), [
                'start' => 'required|before:end',
                'end' => 'required|after:start'
            ]);
            if (!$validate->fails()) {
                $temptations = Temptation::where('structure_id', Auth::user()->structure_id)
                    ->whereBetween('temptation_date', [$request->start, $request->end])
                    ->get();
            }
        }
        return view('app.temptation.index', [
            'temptations' => $temptations,
            'my_actions' => $this->temptation_actions(),
            'my_attributes' => $this->temptation_columns(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('app.temptation.create', [
            'my_fields' => $this->temptation_fields(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTemptationRequest $request)
    {
        $temptation = new Temptation();

        $temptation->structure_id = Auth::user()->structure->id;
        $temptation->user_id = $request->user;
        $temptation->object = $request->object;
        $temptation->message = $request->message;

        if ($temptation->save()) {
            Alert::toast("Données enregistrées", 'success');
            $user = User::where('role', 'admin')->where('structure_id', Auth::user()->structure_id)->first();
            $user->notify(new MewTemptationNotification());
            return redirect('temptation');
        } else {
            Alert::toast('Une erreur est survenue', 'error');
            return redirect()->back()->withInput($request->input());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Temptation $temptation)
    {
        return view('app.temptation.show', [
            'temptation' => $temptation,
            'my_fields' => $this->temptation_fields(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Temptation $temptation)
    {
        return view('app.temptation.edit', [
            'temptation' => $temptation,
            'my_fields' => $this->temptation_fields(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTemptationRequest $request, Temptation $temptation)
    {
        $temptation = Temptation::find($temptation->id);

        $temptation->structure_id = Auth::user()->structure->id;
        $temptation->user_id = Auth::id();
        $temptation->object = $request->object;
        $temptation->message = $request->message;

        if ($temptation->save()) {
            Alert::toast('Les informations ont été modifiées', 'success');
            return redirect('temptation');
        } else {
            Alert::toast('Une erreur est survenue', 'error');
            return redirect()->back()->withInput($request->input());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Temptation $temptation)
    {
        try {
            $temptation = $temptation->delete();
            Alert::success('Opération effectuée', 'Suppression éffectué');
            return redirect('temptation');
        } catch (\Exception $e) {
            Alert::error('Erreur', 'Element introuvable');
            return redirect()->back();
        }
    }

    private function temptation_columns()
    {
        $columns = (object) [
            'user_fullname' => 'Réquerant',
            'object' => 'Object',
            'formatted_temptation_date' => 'Date',
        ];
        return $columns;
    }

    private function temptation_actions()
    {
        if (Auth::user()->role === 'admin') {
            $actions = (object) array(
                'show' => "Voir",
                'edit' => "Modifier",
                'delete' => "Supprimer",
            );
        } else {
            $actions = (object) array(
                'show' => "Voir",
                'edit' => "Modifier",
                'delete' => "Supprimer",
            );
        }
        return $actions;
    }

    private function temptation_fields()
    {
        $fields = [
            'object' => [
                'title' => 'Objet',
                'field' => 'text',
            ],
            'message' => [
                'title' => 'Message',
                'field' => 'richtext',
                'colspan' => true
            ]
        ];
        return $fields;
    }
}

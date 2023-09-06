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
use App\Notifications\NewTemptationNotification;

class TemptationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role === 'admin') {
            $structure = Auth::user()->structure;
            $temptations = $structure->temptations()->where('recipient', null)->get();
        } else {
            $temptations = Temptation::where('recipient', Auth::user()->id)->get();
        }

        return view('app.temptation.index', [
            'temptations' => $temptations,
            'my_actions' => $this->temptation_actions(),
            'my_attributes' => $this->temptation_columns(),
        ]);
    }

    public function indexSent()
    {
        $temptations = Temptation::where('user_id', Auth::user()->id)->get();

        return view('app.temptation.index', [
            'temptations' => $temptations,
            'my_actions' => $this->temptation_actions_sent(),
            'my_attributes' => $this->temptation_columns(),
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
            if (Auth::user()->role === 'admin') {
                $structure = Auth::user()->structure;
                $temptations = $structure->temptations()->where('recipient', null)->whereBetween('updated_at', [$request->start, $request->end])
                    ->get();
            } else {
                $temptations = Temptation::where('recipient', Auth::user()->id)
                    ->whereBetween('updated_at', [$request->start, $request->end])
                    ->get();
            }
        } else {
            return redirect('temptation');
        }

        return view('app.temptation.index', [
            'temptations' => $temptations,
            'my_actions' => $this->temptation_actions(),
            'my_attributes' => $this->temptation_columns(),
        ]);
    }

    public function indexFilterSent(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'start' => 'required|before_or_equal:end',
            'end' => 'required|after_or_equal:start'
        ]);
        if (!$validate->fails()) {
            $temptations = Temptation::where('user_id', Auth::user()->id)
                ->whereBetween('updated_at', [$request->start, $request->end])
                ->get();
        } else {
            return redirect('temptation');
        }

        return view('app.temptation.index', [
            'temptations' => $temptations,
            'my_actions' => $this->temptation_actions_sent(),
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
        $temptation->user_id = Auth::user()->id;
        if (Auth::user()->role === 'admin' || Auth::user()->role === 'supervisor') {
            $temptation->recipient = $request->user;
        }
        $temptation->object = $request->object;
        $temptation->message = $request->message;

        if ($temptation->save()) {
            Alert::toast("Données enregistrées", 'success');
            if (Auth::user()->role === 'user') {
                $userNotify = User::where('role', 'admin')->where('structure_id', Auth::user()->structure_id)->first();
            } else {
                $userNotify = User::where('id', $request->user)->first();
            }
            $userNotify->notify(new NewTemptationNotification($temptation->object));
            return redirect('temptation/sent');
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
        // dd($temptation);
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
            'formatted_temptation_date' => 'Date de la demande',
        ];
        return $columns;
    }

    private function temptation_actions()
    {
        $actions = (object) array(
            'show' => "Voir",
        );
        return $actions;
    }

    private function temptation_actions_sent()
    {
        $actions = (object) array(
            'show' => "Voir",
            'edit' => "Modifier",
            'delete' => "Supprimer",
        );
        return $actions;
    }

    private function temptation_fields()
    {
        $structure = Auth::user()->structure;
        $users = $structure->users()->where('role', '!=', 'admin')->get();

        if (Auth::user()->role === 'user') {
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
        } else {
            $fields = [
                'object' => [
                    'title' => 'Objet',
                    'field' => 'text',
                ],
                'user' => [
                    'title' => 'Employé',
                    'field' => 'model',
                    'options' => $users,
                ],
                'message' => [
                    'title' => 'Message',
                    'field' => 'richtext',
                    'colspan' => true
                ]
            ];
        }

        return $fields;
    }
}

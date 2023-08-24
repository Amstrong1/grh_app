<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\TemptationBack;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreTemptationBackRequest;
use App\Http\Requests\UpdateTemptationBackRequest;
use App\Notifications\NewTemptationBackNotification;

class TemptationBackController extends Controller
{
 /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role === 'admin') {
            $structure = Auth::user()->structure;
            $temptationBacks = $structure->temptationBacks()->where('recipient', null)->get();
        } else {
            $temptationBacks = TemptationBack::where('recipient', Auth::user()->id)->get();
        }

        return view('app.temptation-back.index', [
            'temptationBacks' => $temptationBacks,
            'my_actions' => $this->temptation_actions(),
            'my_attributes' => $this->temptation_columns(),
        ]);
    }

    public function indexSent()
    {
        $temptationBacks = TemptationBack::where('user_id', Auth::user()->id)->get();

        return view('app.temptation-back.index', [
            'temptationBacks' => $temptationBacks,
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
            'start' => 'required|before:end',
            'end' => 'required|after:start'
        ]);
        if (!$validate->fails()) {
            if (Auth::user()->role === 'admin') {
                $structure = Auth::user()->structure;
                $temptationBacks = $structure->temptationBacks()->where('recipient', null)->whereBetween('updated_at', [$request->start, $request->end])
                    ->get();
            } else {
                $temptationBacks = TemptationBack::where('recipient', Auth::user()->id)
                    ->whereBetween('updated_at', [$request->start, $request->end])
                    ->get();
            }
        } else {
            return redirect('temptation-back');
        }

        return view('app.temptation-back.index', [
            'temptationBacks' => $temptationBacks,
            'my_actions' => $this->temptation_actions(),
            'my_attributes' => $this->temptation_columns(),
        ]);
    }

    public function indexFilterSent(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'start' => 'required|before:end',
            'end' => 'required|after:start'
        ]);
        if (!$validate->fails()) {
            $temptationBacks = TemptationBack::where('user_id', Auth::user()->id)
                ->whereBetween('updated_at', [$request->start, $request->end])
                ->get();
        } else {
            return redirect('temptation-back');
        }

        return view('app.temptation-back.index', [
            'temptationBacks' => $temptationBacks,
            'my_actions' => $this->temptation_actions_sent(),
            'my_attributes' => $this->temptation_columns(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('app.temptation-back.create', [
            'my_fields' => $this->temptation_fields(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTemptationBackRequest $request)
    {
        $temptationBack = new TemptationBack();

        $temptationBack->structure_id = Auth::user()->structure->id;
        // $temptationBack->temptation_id = $request->temptation;
        $temptationBack->user_id = Auth::user()->id;
        if (Auth::user()->role === 'admin' || Auth::user()->role === 'supervisor') {
            $temptationBack->recipient = $request->user;
        }
        $temptationBack->object = $request->object;
        $temptationBack->message = $request->message;

        if ($temptationBack->save()) {
            Alert::toast("Données enregistrées", 'success');
            if (Auth::user()->role === 'user') {
                $userNotify = User::where('role', 'admin')->where('structure_id', Auth::user()->structure_id)->first();
            } else {
                $userNotify = User::where('id', $request->user)->first();
            }
            $userNotify->notify(new NewTemptationBackNotification($temptationBack->object));
            return redirect('temptationBack/sent');
        } else {
            Alert::toast('Une erreur est survenue', 'error');
            return redirect()->back()->withInput($request->input());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(TemptationBack $temptationBack)
    {
        // dd($temptationBack);
        return view('app.temptation-back.show', [
            'temptationBack' => $temptationBack,
            'my_fields' => $this->temptation_fields(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TemptationBack $temptationBack)
    {
        return view('app.temptation-back.edit', [
            'temptationBack' => $temptationBack,
            'my_fields' => $this->temptation_fields(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTemptationBackRequest $request, TemptationBack $temptationBack)
    {
        $temptationBack = TemptationBack::find($temptationBack->id);

        $temptationBack->object = $request->object;
        $temptationBack->message = $request->message;

        if ($temptationBack->save()) {
            Alert::toast('Les informations ont été modifiées', 'success');
            return redirect('temptation_back');
        } else {
            Alert::toast('Une erreur est survenue', 'error');
            return redirect()->back()->withInput($request->input());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TemptationBack $temptationBack)
    {
        try {
            $temptationBack = $temptationBack->delete();
            Alert::success('Opération effectuée', 'Suppression éffectué');
            return redirect('temptation_back');
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

<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Place;
use App\Models\Career;
use App\Enums\UserRoleEnum;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\StoreCareerRequest;
use App\Http\Requests\UpdateCareerRequest;
use App\Notifications\NewUserNotification;
use App\Notifications\UpdateUserNotification;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Facades\Lang;

class CareerController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->except('show');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $structure = Auth::user()->structure;

        if (Auth::user()->role === 'admin') {
            $users = $structure->users()
                ->where('role', '!=', UserRoleEnum::Admin)
                ->where('role', '!=', UserRoleEnum::SuperAdmin)
                ->get();

            $careers = [];

            foreach ($users as $user) {
                $careers[] = $user->career()->first();
            }
        }
        // if auth user is supervisor
        else {
            $departments = Auth::user()->departments;

            $places = new EloquentCollection();
            foreach ($departments as $department) {
                $places[] = $department->places()->get();
            }
            $places = $places->collapse();

            $careers = new EloquentCollection();
            foreach ($places as $place) {
                $careers[] = Career::where('place_id', $place->id)->get();
            }
            $careers = $careers->collapse();
        }

        return view('app.user.index', [
            'careers' => $careers,
            'my_actions' => $this->user_actions(),
            'my_attributes' => $this->user_columns(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('app.user.create', [
            'my_fields' => $this->user_fields(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCareerRequest $request)
    {
        $user = new User();
        $user->structure_id = Auth::user()->structure->id;
        $user->name = $request->name;
        $user->firstname = $request->firstname;
        $user->email = $request->email;
        $user->role = UserRoleEnum::User;
        // $user->password = $request->password;

        if ($user->save()) {

            $career = Career::create([
                'user_id' => $user->id,
                'place_id' => $request->place,
                'birthday' => $request->birthday,
                'sex' => $request->sex,
                'marital_status' => $request->marital_status,
                'child' => $request->child,
                'contact' => $request->contact,
                'adress' => $request->adress,
                'contract' => $request->contract,
                'contract_start' => $request->contract_start,
                'contract_end' => $request->contract_end,
                'diploma' => $request->diploma,
                'social_security_number' => $request->social_security_number,
                'matricule' => $request->matricule,
                'registration_date' => $request->registration_date,
            ]);

            if ($career) {
                Alert::toast(Lang::get('message.success'), 'success');
                $user->notify(new NewUserNotification());
                return redirect('career');
            } else {
                Alert::toast(Lang::get('message.error'), 'error');
                $get_user = User::where('email', $request->email)->first();
                $get_user->delete();
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Career $career)
    {
        return view('app.user.show', [
            'career' => $career,
            'my_fields' => $this->user_show(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Career $career)
    {
        return view('app.user.edit', [
            'career' => $career,
            'my_fields' => $this->user_edit(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCareerRequest $request, Career $career)
    {
        $user_update = User::where('id', $career->user_id)
            ->update([
                'name' => $request->user_name,
                'firstname' => $request->user_firstname,
                'email' => $request->user_email,
            ]);

        $career_update = Career::where('id', $career->id)
            ->update([
                'birthday' => $request->birthday,
                'sex' => $request->sex,
                'marital_status' => $request->marital_status,
                'child' => $request->child,
                'contact' => $request->contact,
                'contract_start' => $request->contract_start,
                'contract_end' => $request->contract_end,
                'contract' => $request->contract,
                'place_id' => $request->post_name,
                'diploma' => $request->diploma,
                'adress' => $request->adress,
                'social_security_number' => $request->social_security_number,
                'matricule' => $request->matricule,
                'registration_date' => $request->registration_date,
            ]);

        if ($career_update && $user_update) {
            Alert::toast(Lang::get('message.edited'), 'success');
            $user = User::find($career->user_id);
            $user->notify(new UpdateUserNotification());
            return redirect('career');
        } else {
            Alert::toast(Lang::get('message.error'), 'error');
            return redirect()->back()->withInput($request->input());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Career $career)
    {
    }

    private function user_columns()
    {
        $columns = (object) [
            'user_name' => Lang::get('message.name'),
            'user_firstname' => Lang::get('message.firstname'),
            'user_email' => 'Email',
            'contact' => 'Tel',
            'department_name' => Lang::get('message.department'),
            'post_name' => Lang::get('message.job'),
        ];
        return $columns;
    }

    private function user_actions()
    {
        $actions = (object) array(
            'show' => "Détails",
            'edit' => "Modifier",
            // 'delete' => "Supprimer",
        );
        return $actions;
    }

    private function user_fields()
    {

        $sex = [
            'F' => 'F',
            'M' => 'M'
        ];
        $ms = [
            Lang::get('message.single') => Lang::get('message.single'),
            Lang::get('message.married') => Lang::get('message.married'),
            Lang::get('message.divorce') => Lang::get('message.divorce'),
            Lang::get('message.widow') => Lang::get('message.widow')
        ];
        $contract = [
            'CDD' => 'CDD',
            'CDI' => 'CDI',
            'Stage' => 'Stage',
            'Internat' => 'Internat'
        ];

        if (Auth::user()->role === "admin") {
            $places = Place::where('structure_id', Auth::user()->structure->id)->get();
        } else {
            $departments = Auth::user()->departments;
            $places = new EloquentCollection();
            foreach ($departments as $department) {
                $places[] = $department->places()->get();
            }
            $places = $places->collapse();
        }


        $fields = [
            'name' => [
                'title' => 'Nom',
                'field' => 'text',
            ],
            'firstname' => [
                'title' => 'Prénoms',
                'field' => 'text',
            ],
            'birthday' => [
                'title' => 'Date de naissance',
                'field' => 'date',
            ],
            'sex' => [
                'title' => 'Sexe',
                'field' => 'select',
                'options' => $sex
            ],
            'marital_status' => [
                'title' => 'Situation matrimoniale',
                'field' => 'select',
                'options' => $ms
            ],
            'child' => [
                'title' => 'Enfant à charge',
                'field' => 'number',
            ],
            'email' => [
                'title' => 'Email',
                'field' => 'email',
            ],
            'contact' => [
                'title' => 'Contact',
                'field' => 'tel',
            ],
            'adress' => [
                'title' => 'Adresse',
                'field' => 'text',
            ],
            'diploma' => [
                'title' => 'Diplome',
                'field' => 'text',
            ],
            'social_security_number' => [
                'title' => 'N° de sécurité social',
                'field' => 'text',
            ],
            'matricule' => [
                'title' => 'Matricule',
                'field' => 'text',
            ],
            'registration_date' => [
                'title' => 'Date d\'entrée',
                'field' => 'date',
            ],
            'place' => [
                'title' => 'Poste',
                'field' => 'model',
                'options' => $places,
            ],
            'contract' => [
                'title' => 'Type de contrat',
                'field' => 'select',
                'options' => $contract
            ],
            'contract_start' => [
                'title' => 'Debut de contrat',
                'field' => 'date',
            ],
            'contract_end' => [
                'title' => 'Fin de contrat',
                'field' => 'date',
            ],
            // 'password' => [
            //     'title' => 'Mot de passe du compte',
            //     'field' => 'password',
            // ],
            // 'password_confirmation' => [
            //     'title' => 'Confirmation du mot de passe',
            //     'field' => 'password',
            // ],
        ];
        return $fields;
    }

    private function user_show()
    {
        $fields = [
            'user_name' => [
                'title' => 'Nom',
                'field' => 'text',
            ],
            'user_firstname' => [
                'title' => 'Prénoms',
                'field' => 'text',
            ],
            'formatted_birthday' => [
                'title' => 'Date de naissance',
                'field' => 'text',
            ],
            'sex' => [
                'title' => 'Sexe',
                'field' => 'text',
            ],
            'marital_status' => [
                'title' => 'Situation matrimoniale',
                'field' => 'text',
            ],
            'child' => [
                'title' => 'Enfant à charge',
                'field' => 'text',
            ],
            'user_email' => [
                'title' => 'Email',
                'field' => 'text',
            ],
            'contact' => [
                'title' => 'Contact',
                'field' => 'text',
            ],
            'adress' => [
                'title' => 'Adresse',
                'field' => 'text',
            ],
            'diploma' => [
                'title' => 'Diplome',
                'field' => 'text',
            ],
            'department_name' => [
                'title' => 'Département',
                'field' => 'text',
            ],
            'post_name' => [
                'title' => 'Poste',
                'field' => 'text',
            ],
            'social_security_number' => [
                'title' => 'N° de sécurité sociale',
                'field' => 'text',
            ],
            'matricule' => [
                'title' => 'Matricule',
                'field' => 'text',
            ],
            'formatted_registration_date' => [
                'title' => 'Date d\'entrée',
                'field' => 'text',
            ],
            'contract' => [
                'title' => 'Type de contrat',
                'field' => 'text',
            ],
            'formatted_contract_start' => [
                'title' => 'Debut de contrat',
                'field' => 'text',
            ],
            'formatted_contract_end' => [
                'title' => 'Fin de contrat',
                'field' => 'text',
            ],
        ];
        return $fields;
    }

    private function user_edit()
    {
        $ms = ['Célibataire' => 'Célibataire', 'Marié(e)' => 'Marié(e)', 'Divorcé(e)' => 'Divorcé(e)', 'Veuf(ve)' => 'Veuf(ve)'];
        $sex = ['Masculin' => 'Masculin', 'Féminin' => 'Féminin'];
        $contract = ['CDD' => 'CDD', 'CDI' => 'CDI', 'Internat' => 'Internat', 'Stage' => 'Stage'];
        $fields = [
            'user_name' => [
                'title' => 'Nom',
                'field' => 'text',
            ],
            'user_firstname' => [
                'title' => 'Prénoms',
                'field' => 'text',
            ],
            'birthday' => [
                'title' => 'Date de naissance',
                'field' => 'date',
            ],
            'sex' => [
                'title' => 'Sexe',
                'field' => 'select',
                'options' => $sex,
            ],
            'marital_status' => [
                'title' => 'Situation matrimoniale',
                'field' => 'select',
                'options' => $ms,
            ],
            'child' => [
                'title' => 'Enfant à charge',
                'field' => 'number',
            ],
            'user_email' => [
                'title' => 'Email',
                'field' => 'email',
            ],
            'contact' => [
                'title' => 'Contact',
                'field' => 'tel',
            ],
            'adress' => [
                'title' => 'Adresse',
                'field' => 'tel',
            ],
            'diploma' => [
                'title' => 'Diplome',
                'field' => 'text',
            ],
            'social_security_number' => [
                'title' => 'N° de sécurité social',
                'field' => 'text',
            ],
            'matricule' => [
                'title' => 'Matricule',
                'field' => 'text',
            ],
            'registration_date' => [
                'title' => 'Date d\'entrée',
                'field' => 'date',
            ],
            'contract_start' => [
                'title' => 'Debut de contrat',
                'field' => 'date',
            ],
            'contract_end' => [
                'title' => 'Fin de contrat',
                'field' => 'date',
            ],
            'contract' => [
                'title' => 'Type de contrat',
                'field' => 'select',
                'options' => $contract,
            ],
            'post_name' => [
                'title' => 'Poste',
                'field' => 'model',
                'options' => Place::where('structure_id', Auth::user()->structure->id)->get(),
            ],
        ];
        return $fields;
    }
}

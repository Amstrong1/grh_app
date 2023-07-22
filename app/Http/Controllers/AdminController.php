<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Department;
use App\Enums\UserRoleEnum;
use App\Models\DepartmentUser;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $structure = Auth::user()->structure;

        return view('app.admin.index', [
            'admins' => $structure->users()->where('role',  UserRoleEnum::Supervisor)->get(),
            'my_actions' => $this->user_actions(),
            'my_attributes' => $this->user_columns(),
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('app.admin.create', [
            'my_fields' => $this->user_fields(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $user = User::where('id', $request->user)
            ->update([
                'role' => UserRoleEnum::Supervisor,
            ]);

        if ($user) {
            foreach ($request->departments as $department) {
                DepartmentUser::create([
                    'user_id' => $request->user,
                    'department_id' => $department,
                    'structure_id' => Auth::user()->structure->id,
                ]);
            }
            Alert::toast("Nouveau superviseur enregistré", 'success');
            return redirect()->route('admin.index');
        } else {
            Alert::toast('Une erreur est survenue', 'error');
            return redirect()->back()->withInput($request->input());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $admin)
    {
        return view('app.admin.edit', [
            'admin' => $admin,
            'my_fields' => $this->edit_fields(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $admin)
    {
        $delete = DepartmentUser::where('user_id', $admin->id)->delete();

        if ($delete) {
            foreach ($request->departments as $department) {
                DepartmentUser::create([
                    'user_id' => $admin,
                    'department_id' => $department,
                    'structure_id' => Auth::user()->structure->id,
                ]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $admin)
    {
        $delete = DepartmentUser::where('user_id', $admin->id)->delete();

        $user = User::where('id', $admin->id)
            ->update([
                'role' => UserRoleEnum::User,
            ]);

        if ($delete && $user) {
            Alert::toast("Superviseur supprimé", 'success');
            return redirect()->route('admin.index');
        } else {
            Alert::toast("Une erreur est survenue", 'error');
            return back();
        }
    }

    private function user_columns()
    {
        $columns = (object) [
            'name' => 'Nom',
            'firstname' => 'Prenom',
            'email' => 'Email du compte',
            'department_list' => 'Départements',
        ];
        return $columns;
    }

    private function user_actions()
    {
        $actions = (object) array(
            'edit' => "Modifier",
            'delete' => "Supprimer",
        );
        return $actions;
    }

    private function user_fields()
    {
        $fields = [
            'user' => [
                'title' => 'Choisir une option',
                'field' => 'model',
                'options' => User::where('structure_id', Auth::user()->structure->id)
                    ->where('role', 'user')
                    ->get(),
            ],
            'departments' => [
                'title' => 'Département(s) à suivre',
                'field' => 'multiple-select',
                'options' => Department::where('structure_id', Auth::user()->structure->id)->get(),
            ],
        ];
        return $fields;
    }

    private function edit_fields()
    {
        $fields = [
            'departments' => [
                'title' => 'Département(s) à suivre',
                'field' => 'multiple-select',
                'options' => Department::where('structure_id', Auth::user()->structure->id)->get(),
            ],
        ];
        return $fields;
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Career;
use App\Models\RegularTask;
use App\Models\RegularTaskUser;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Notifications\NewTaskNotification;
use App\Http\Requests\StoreRegularTaskRequest;
use App\Http\Requests\UpdateRegularTaskRequest;
use App\Models\Day;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

class RegularTaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->only('create', 'edit', 'delete');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role === 'user') {
            $regularTasks = Auth::user()->regularTasks;
        } elseif (Auth::user()->role === 'supervisor') {
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

            $users = new EloquentCollection();
            foreach ($careers as $career) {
                $users[] = User::where('id', $career->user_id)->get();
            }
            $users = $users->collapse();

            $regularTasks = new EloquentCollection();
            foreach ($users as $user) {
                $regularTasks[] = $user->regularTasks;
            }
            $regularTasks = $regularTasks->collapse();
        } else {
            $structure = Auth::user()->structure;
            $regularTasks = $structure->regularTasks()->get();
        }

        return view('app.regular-task.index', [
            'regularTasks' => $regularTasks,
            'my_actions' => $this->regularTask_actions(),
            'my_attributes' => $this->regularTask_columns(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('app.regular-task.create', [
            'my_fields' => $this->regularTask_fields()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRegularTaskRequest $request)
    {
        $task = new RegularTask();

        $days = [];
        foreach ($request->task_day as $day) {
            $days[] = $day;
        }
        $days = implode("-", $days);

        $task->structure_id = Auth::user()->structure->id;
        $task->frequency = $request->frequency;
        $task->task = $request->task;
        $task->task_hour = $request->task_hour;
        $task->task_day = $days;

        if ($task->save()) {
            foreach ($request->users as $user) {
                RegularTaskUser::create([
                    'user_id' => $user,
                    'regular_task_id' =>  $task->id,
                    'structure_id' => Auth::user()->structure->id,
                ]);

                $user = User::where('id', $user)->first();
                $user->notify(new NewTaskNotification());
            }

            Alert::toast('Les données ont été enregistrées', 'success');
            return redirect('regular_task');
        } else {
            Alert::toast('Les données ont été enregistrées', 'error');
            return redirect()->back()->withInput($request->input());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(RegularTask $regularTask)
    {
        return view('app.regular-task.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RegularTask $regularTask)
    {
        return view('app.regular-task.edit', [
            'regularTask' => $regularTask,
            'my_fields' => $this->regularTask_fields(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRegularTaskRequest $request, RegularTask $regularTask)
    {
        $regularTask = RegularTask::find($regularTask->id);
        $regularTask->task = $request->task;
        $regularTask->frequency = $request->frequency;
        $regularTask->task_hour = $request->task_hour;
        $regularTask->task_day = $request->task_day;

        foreach ($request->users as $user) {
            RegularTaskUser::where('regular_task_id', $regularTask->id)->delete();
            RegularTaskUser::create([
                'user_id' => $user,
                'regular_task_id' => $regularTask->id,
                'structure_id' => Auth::user()->structure->id,
            ]);
        }

        if ($regularTask->save()) {
            Alert::toast('Les informations ont été modifiées', 'success');
            return redirect('regular_task');
        } else {
            Alert::toast('Une erreur est survenue', 'error');
            return redirect()->back()->withInput($request->input());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RegularTask $regularTask)
    {
        try {
            $regularTask = $regularTask->delete();
            Alert::success('Opération effectuée', 'Suppression éffectué');
            return redirect('regular_task');
        } catch (\Exception $e) {
            Alert::error('Erreur', 'Element introuvable');
            return redirect()->back();
        }
    }

    private function regularTask_columns()
    {
        $columns = (object) [
            'task' => 'Tâche',
            'frequency' => 'Fréquence',
            'users_fullname' => 'Chargé(s) de la tâche',
            'task_day' => 'Jour(s)',
            'task_hour' => 'Heure'
        ];
        return $columns;
    }

    private function regularTask_actions()
    {
        if (Auth::user()->role === 'user') {
            $actions = (object) array();
        } else {
            $actions = (object) array(
                'edit' => 'Modifier',
                // 'delete' => "Supprimer",
            );
        }

        return $actions;
    }

    private function regularTask_fields()
    {
        if (Auth::user()->role === "admin") {
            $users = User::where('structure_id', Auth::user()->structure->id)->get();
        } else {
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

            $users = new EloquentCollection();
            foreach ($careers as $career) {
                $users[] = User::where('id', $career->user_id)->get();
            }
            $users = $users->collapse();
        }

        $frequency = ['Quotidien' => 'Quotidien', 'Hebdomadaire' => 'Hebdomadaire'];

        $fields = [
            'users' => [
                'title' => 'Sélectionner employés',
                'field' => 'multiple-select',
                'options' => $users,
            ],
            'frequency' => [
                'title' => 'Fréquence',
                'field' => 'select',
                'options' => $frequency
            ],
            'task_hour' => [
                'title' => 'Heure de debut',
                'field' => 'time',
            ],
            'task_day' => [
                'title' => 'Jour (si hebdomadaire)',
                'field' => 'multiple-select',
                'options' => Day::all('id', 'name')
            ],
            'task' => [
                'title' => 'Tache',
                'field' => 'textarea'
            ],
        ];

        return $fields;
    }
}

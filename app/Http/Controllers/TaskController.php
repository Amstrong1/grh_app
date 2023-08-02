<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\Career;
use App\Models\TaskUser;
use Illuminate\Http\Request;
use App\Enums\TaskStatusEnum;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use App\Notifications\NewTaskNotification;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->only('create', 'delete');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (Auth::user()->role === 'user') {
            $allTasks = Auth::user()->tasks;
            $taskToDo = [];

            foreach ($allTasks as $allTask) {
                if ($allTask->status == 'A faire') {
                    $taskToDo[] = $allTask;
                }
            }

            $tasks = $taskToDo;
        } elseif (Auth::user()->role === 'supervisor') {
            $tasks = $this->getTask('A faire');
        } else {
            $structure = Auth::user()->structure;
            $tasks = $structure->tasks()->where('status', "A faire")->get();
        }

        if (request()->method() == 'POST') {
            $validate = Validator::make($request->all(), [
                'start' => 'required|before:end',
                'end' => 'required|after:start'
            ]);
            if (!$validate->fails()) {
                if (Auth::user()->role === 'user') {
                    $allTasks = Auth::user()->tasks;
                    $taskToDo = [];

                    foreach ($allTasks as $allTask) {
                        if ($allTask->status == 'A faire') {
                            if ($allTask->due_date >= $request->start || $allTask->due_date <= $request->end) {
                                $taskToDo[] = $allTask;
                            }
                        }
                    }

                    $tasks = $taskToDo;
                } elseif (Auth::user()->role === 'supervisor') {
                    $tasks = $this->getTaskFiltered('A faire', $request->start, $request->end);
                } else {
                    $structure = Auth::user()->structure;
                    $tasks = $structure->tasks()
                        ->where('status', "A faire")
                        ->whereBetween('due_date', [$request->start, $request->end])
                        ->get();
                }
            }
        }

        return view('app.task.index', [
            'tasks' => $tasks,
            'my_actions' => $this->task_actions(),
            'my_attributes' => $this->task_columns(),
        ]);
    }

    public function indexPending(Request $request)
    {
        if (Auth::user()->role === 'user') {
            $allTasks = Auth::user()->tasks;
            $taskPending = [];

            foreach ($allTasks as $allTask) {
                if ($allTask->status == 'En cours') {
                    $taskPending[] = $allTask;
                }
            }

            $tasks = $taskPending;
        } elseif (Auth::user()->role === 'supervisor') {
            $tasks = $this->getTask('En cours');
        } else {
            $structure = Auth::user()->structure;
            $tasks = $structure->tasks()->where('status', "En cours")->get();
        }

        if (request()->method() == 'POST') {
            $validate = Validator::make($request->all(), [
                'start' => 'required|before:end',
                'end' => 'required|after:start'
            ]);
            if (!$validate->fails()) {
                if (Auth::user()->role === 'user') {
                    $allTasks = Auth::user()->tasks;
                    $taskPending = [];

                    foreach ($allTasks as $allTask) {
                        if ($allTask->status == 'En cours') {
                            if ($allTask->due_date >= $request->start || $allTask->due_date <= $request->end) {
                                $taskPending[] = $allTask;
                            }
                        }
                    }

                    $tasks = $taskPending;
                } elseif (Auth::user()->role === 'supervisor') {
                    $tasks = $this->getTaskFiltered('En cours', $request->start, $request->end);
                } else {
                    $structure = Auth::user()->structure;
                    $tasks = $structure->tasks()->where('status', "En cours")
                        ->whereBetween('due_date', [$request->start, $request->end])
                        ->get();
                }
            }
        }

        return view('app.task.index', [
            'tasks' => $tasks,
            'my_actions' => $this->task_actions(),
            'my_attributes' => $this->task_columns(),
        ]);
    }

    public function indexFinished(Request $request)
    {
        if (Auth::user()->role === 'user') {
            $allTasks = Auth::user()->tasks;
            $taskFinished = [];

            foreach ($allTasks as $allTask) {
                if ($allTask->status == 'Terminé') {
                    $taskFinished[] = $allTask;
                }
            }

            $tasks = $taskFinished;
        } elseif (Auth::user()->role === 'supervisor') {
            $tasks = $this->getTask('Terminé');
        } else {
            $structure = Auth::user()->structure;
            $tasks = $structure->tasks()->where('status', "Terminé")->get();
        }

        if (request()->method() == 'POST') {
            $validate = Validator::make($request->all(), [
                'start' => 'required|before:end',
                'end' => 'required|after:start'
            ]);
            if (!$validate->fails()) {
                if (Auth::user()->role === 'user') {
                    $allTasks = Auth::user()->tasks;
                    $taskFinished = [];

                    foreach ($allTasks as $allTask) {
                        if ($allTask->status == 'Terminé') {
                            if ($allTask->due_date >= $request->start || $allTask->due_date <= $request->end) {
                                $taskFinished[] = $allTask;
                            }
                        }
                    }

                    $tasks = $taskFinished;
                } elseif (Auth::user()->role === 'supervisor') {
                    $tasks = $this->getTaskFiltered('Terminé', $request->start, $request->end);
                } else {
                    $structure = Auth::user()->structure;
                    $tasks = $structure->tasks()->where('status', "Terminé")
                        ->whereBetween('due_date', [$request->start, $request->end])
                        ->get();
                }
            }
        }
        return view('app.task.index', [
            'tasks' => $tasks,
            'my_actions' => $this->task_actions(),
            'my_attributes' => $this->task_columns(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('app.task.create', [
            'my_fields' => $this->task_fields()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $task = new Task();

        $task->structure_id = Auth::user()->structure->id;
        $task->due_date = $request->due_date;
        $task->due_time = $request->due_time;
        $task->task = $request->task;
        $task->status = TaskStatusEnum::ToDo;

        if ($task->save()) {

            foreach ($request->users as $user) {
                TaskUser::create([
                    'user_id' => $user,
                    'task_id' =>  $task->id,
                    'structure_id' => Auth::user()->structure->id,
                ]);

                $user = User::where('id', $user)->first();
                $user->notify(new NewTaskNotification());
            }

            Alert::toast("Données enregistrées", 'success');
            return redirect('task');
        } else {
            Alert::toast('Une erreur est survenue', 'error');
            return redirect()->back()->withInput($request->input());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        return view('app.task.edit', [
            'task' => $task,
            'my_fields' => $this->task_fields(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $task = Task::find($task->id);

        if (Auth::user()->role === 'admin') {
            $task->due_date = $request->due_date;
            $task->due_time = $request->due_time;
            $task->task = $request->task;

            foreach ($request->users as $user) {
                TaskUser::where('task_id', $task->id)->delete();
                TaskUser::create([
                    'user_id' => $user,
                    'task_id' => $task->id,
                    'structure_id' => Auth::user()->structure->id,
                ]);
            }
        } else {
            $task->status = $request->status;
            $task->report = $request->report;
        }

        if ($task->save()) {
            Alert::toast('Les informations ont été modifiées', 'success');
            return redirect('task');
        } else {
            Alert::toast('Une erreur est survenue', 'error');
            return redirect()->back()->withInput($request->input());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        try {
            $usersDel = TaskUser::where('task_id', $task->id)->delete();
            if ($usersDel) {
                $task = $task->delete();
                Alert::success('Opération effectuée', 'Suppression éffectué');
                return redirect('task');
            } else {
                Alert::error('Erreur', 'Element introuvable');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            Alert::error('Erreur', 'Element introuvable');
            return redirect()->back();
        }
    }

    private function task_columns()
    {
        $columns = (object) [
            'task' => 'Tâche',
            'formatted_due_date' => 'Date d\'achèvement',
            'due_time' => 'Heure d\'achèvement',
            'users_fullname' => 'Chargé(s) de la tâche',
        ];
        return $columns;
    }

    private function task_actions()
    {
        if (Auth::user()->role === 'user') {
            $actions = (object) array(
                'edit' => 'Modifier',
            );
        } else {
            $actions = (object) array(
                'edit' => 'Modifier',
                'delete' => "Supprimer",
            );
        }

        return $actions;
    }

    private function task_fields()
    {
        if (Auth::user()->role === 'user') {
            $status = ['En cours' => 'En cours', 'Terminé' => 'Terminé'];
            $fields = [
                'status' => [
                    'title' => 'Statut',
                    'field' => 'select',
                    'options' => $status,
                ],
                'report' => [
                    'title' => 'Rapport',
                    'field' => 'textarea',
                ],

            ];
        } else {
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

            $fields = [
                'users' => [
                    'title' => 'Sélectionner employés',
                    'field' => 'multiple-select',
                    'options' => $users,
                ],
                'due_date' => [
                    'title' => 'Date d\'achèvement',
                    'field' => 'date'
                ],
                'due_time' => [
                    'title' => 'Heure d\'achèvement',
                    'field' => 'time'
                ],
                'task' => [
                    'title' => 'Tache',
                    'field' => 'textarea'
                ],
            ];
        }

        return $fields;
    }

    private function getTask($status)
    {
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

        $allTasks = new EloquentCollection();
        foreach ($users as $user) {
            $allTasks[] = $user->tasks;
        }
        $allTasks = $allTasks->collapse();

        foreach ($allTasks as $allTask) {
            if ($allTask->status == $status) {
                $tasks[] = $allTask;
            }
        }
        return $tasks;
    }

    private function getTaskFiltered($status, $post_start, $post_end)
    {
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

        $allTasks = new EloquentCollection();
        foreach ($users as $user) {
            $allTasks[] = $user->tasks;
        }
        $allTasks = $allTasks->collapse();

        foreach ($allTasks as $allTask) {
            if ($allTask->status == $status) {
                if ($allTask->due_date >= $post_start || $allTask->due_date <= $post_end) {
                    $tasks[] = $allTask;
                }
            }
        }
        return $tasks;
    }
}

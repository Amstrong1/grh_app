<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Task;
use App\Enums\TaskStatusEnum;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\TaskUser;
use RealRashid\SweetAlert\Facades\Alert;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->only('create', 'delete');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('app.task.index', [
            'tasks' => Auth::user()->tasks,
            'my_actions' => $this->task_actions(),
            'my_attributes' => $this->task_columns(),
        ]);
    }

    public function indexAll()
    {
        $structure = Auth::user()->structure;
        return view('app.task.index', [
            'tasks' => $structure->tasks()->get(),
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

            $get_task = Task::where('structure_id', Auth::user()->structure->id)
                ->where('due_date', $request->due_date)
                ->where('due_time', $request->due_time)
                ->where('task', $request->task)
                ->where('status', TaskStatusEnum::ToDo)
                ->first();

            foreach ($request->users as $user) {
                TaskUser::create([
                    'user_id' => $user,
                    'task_id' =>  $get_task->id,
                    'structure_id' => Auth::user()->structure->id,
                ]);
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
            $task->report = $request->status;
        }

        if ($task->save()) {
            Alert::toast('Les informations ont été modifiées', 'success');
            return redirect('task');
        };
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        try {
            $task = $task->delete();
            Alert::success('Opération effectuée', 'Suppression éffectué');
            return redirect('task');
        } catch (\Exception $e) {
            Alert::error('Erreur', 'Element introuvable');
            return redirect()->back();
        }
    }

    private function task_columns()
    {
        $columns = (object) [
            'task' => 'Tâche',
            'due_date' => 'Date d\'achèvement',
            'due_time' => 'Heure d\'achèvement',
            'users_fullname' => 'Chargé(s) de la tâche',
        ];
        return $columns;
    }

    private function task_actions()
    {
        if (Auth::user()->role === 'admin') {
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

    private function task_fields()
    {
        if (Auth::user()->role === 'admin') {
            $fields = [
                'users' => [
                    'title' => 'Sélectionner employés',
                    'field' => 'multiple-select',
                    'options' => User::where('structure_id', Auth::user()->structure->id)->get(),
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
        } else {
            $fields = [
                'status' => [
                    'title' => 'Statut',
                    'field' => 'select',
                    'option' => TaskStatusEnum::cases(),
                ],
                'report' => [
                    'title' => 'Rapport',
                    'field' => 'textarea',
                ],
            ];
        }

        return $fields;
    }
}

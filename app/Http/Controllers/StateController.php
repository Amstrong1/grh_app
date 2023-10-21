<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\Place;
use App\Models\Absence;
use App\Models\Conflict;
use App\Models\Structure;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StateController extends Controller
{
    public function indexstate()
    {
        $statistics = [
            'Nombre utilisateurs' => [
                'count' => User::where('structure_id', Auth::user()->structure_id)->count(),
                'url' => url('http://127.0.0.1:8000/career') // Remplacez 'users.index' par le nom réel de la route pour la vue d'index des utilisateurs
            ],
            'Nombre de départements' => [
                'count' => Department::where('structure_id', Auth::user()->structure_id)->count(),
                'url' => url('http://127.0.0.1:8000/department') // Remplacez 'departments.index' par le nom réel de la route pour la vue d'index des départements
            ],
            'Nombre de postes' => [
                'count' => Place::where('structure_id', Auth::user()->structure_id)->count(),
                'url' => url('http://127.0.0.1:8000/place') // Remplacez 'places.index' par le nom réel de la route pour la vue d'index des postes
            ],
            'Conflits signalés' => [
                'count' => Conflict::where('structure_id', Auth::user()->structure_id)->count(),
                'url' => url('http://127.0.0.1:8000/conflict') // Remplacez 'conflicts.index' par le nom réel de la route pour la vue d'index des conflits
            ],
            'Permissionnaires' => [
                'count' => Absence::where('structure_id', Auth::user()->structure_id)->where('status', 'En attente')->count(),
                'url' => url('http://127.0.0.1:8000/absence') // Remplacez 'absences.index' par le nom réel de la route pour la vue d'index des absences
            ],
            'Tâches en cours' => [
                'count' => Task::where('structure_id', Auth::user()->structure_id)->where('status', 'En cours')->count(),
                'url' => url('http://127.0.0.1:8000/task/pending') // Remplacez 'tasks.index' par le nom réel de la route pour la vue d'index des tâches
            ],
           
        ];

        $states = array_keys($statistics);

        return view('state', compact('states', 'statistics'));
    }
}
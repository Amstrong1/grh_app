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
    public function indexstate(){

        $states = ['Nombre utilisateurs','Nombre de départements', 'Nombre de postes','Conflits signalés','Permissionnaires','Tâches en cours','Sanctions','Motivations'];

        $statistics = [
            //'Nombre de départements' => Structure::all()->count(),
            'Nombre utilisateurs' => User::where('structure_id', Auth::user()->structure_id)->count(),
            'Nombre de départements' => Department::where('structure_id', Auth::user()->structure_id)->count(),
            'Nombre de postes' => Place::where('structure_id', Auth::user()->structure_id)->count(),
            'Conflits signalés' => Conflict::where('structure_id', Auth::user()->structure_id)->count(),
            'Permissionnaires' => Absence::where('structure_id', Auth::user()->structure_id)->where('status', 'En attente')->count(),
            'Tâches en cours' => Task::where('structure_id', Auth::user()->structure_id)->where('status', 'En cours')->count(),
            'Sanctions' => 0,
            'Motivations' => 0,
        ];
    
        $states = array_keys($statistics);
        
        return view('state',
                compact(['states', 'statistics'])
             );
    }
}

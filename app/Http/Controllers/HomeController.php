<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\Place;
use App\Models\Absence;
use App\Models\Conflict;
use App\Models\Department;
use App\Models\Structure;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __invoke()
    {
        $structures = Structure::all()->count();
        $users = User::where('structure_id', Auth::user()->structure_id)->count();
        $places = Place::where('structure_id', Auth::user()->structure_id)->count();
        $departments = Department::where('structure_id', Auth::user()->structure_id)->count();
        $conflicts = Conflict::where('structure_id', Auth::user()->structure_id)->count();
        $absences = Absence::where('structure_id', Auth::user()->structure_id)->where('status', 'En attente')->count();
        $tasks = Task::where('structure_id', Auth::user()->structure_id)->where('status', 'En cours')->count();
        $sanctions = 0;
        $rewards = 0;
        return view(
            'app.index',
            compact(
                'structures',
                'users',
                'places',
                'departments',
                'conflicts',
                'absences',
                'tasks',
                'sanctions',
                'rewards',
            )
        );
    }
}

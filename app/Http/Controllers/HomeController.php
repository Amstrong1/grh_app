<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\Place;
use App\Models\Absence;
use App\Models\Conflict;
use App\Models\LeaveType;
use App\Models\Structure;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Enums\PermissionStatusEnum;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function __invoke()
    {
        $structures = Structure::all()->count();
        $users = User::where('structure_id', Auth::user()->structure_id)->count();
        $places = Place::where('structure_id', Auth::user()->structure_id)->count();
        $departments = Department::where('structure_id', Auth::user()->structure_id)->count();
        $conflicts = Conflict::where('structure_id', Auth::user()->structure_id)->count();
        $current_absences = Absence::where('structure_id', Auth::user()->structure_id)->where('status', 'En attente')->count();
        $tasks = Task::where('structure_id', Auth::user()->structure_id)->where('status', 'En cours')->count();
        $sanctions = 0;
        $rewards = 0;

        $leaveSolds = LeaveType::where('assign_to_all', true)->get();
        $leaveSold = 0;

        foreach ($leaveSolds as $value) {
            $leaveSold += $value->last;
        }

        $structure = Auth::user()->structure;
        $absences = $structure->absences()
            ->where('user_id', Auth::id())
            ->where('status', PermissionStatusEnum::Allowed)
            ->get();

        $last = 0;
        foreach ($absences as $value) {
            $originalDate = "";
            $originalDate = $value->start_date . ' ' . $value->start_hour;
            $targetDate = $value->end_date . ' ' . $value->end_hour;
            $last += getDateDiff($originalDate, $targetDate);
        }

        if ($last > 3) {
            $leaveSold = $leaveSold - $last + 3;
        }

        return view(
            'app.index',
            compact(
                'structures',
                'users',
                'places',
                'departments',
                'conflicts',
                'current_absences',
                'tasks',
                'sanctions',
                'rewards',
                'leaveSold',
            )
        );
    }

    public function filter(Request $request)
    {
        $structures = Structure::all()->count();
        $users = User::where('structure_id', Auth::user()->structure_id)->count();
        $places = Place::where('structure_id', Auth::user()->structure_id)->count();
        $departments = Department::where('structure_id', Auth::user()->structure_id)->count();

        $validate = Validator::make($request->all(), [
            'start' => 'required|before_or_equal:end',
            'end' => 'required|after_or_equal:start'
        ]);
        if (!$validate->fails()) {
            $conflicts = Conflict::where('structure_id', Auth::user()->structure_id)
                ->whereBetween('conflict_date', [$request->start, $request->end])
                ->count();
            $absences = Absence::where('structure_id', Auth::user()->structure_id)
                ->where('status', 'En attente')
                ->whereBetween('start_date', [$request->start, $request->end])
                ->orWhere('end_date', [$request->start, $request->end])
                ->count();
            $tasks = Task::where('structure_id', Auth::user()->structure_id)
                ->where('status', 'En cours')
                ->whereBetween('due_date', [$request->start, $request->end])
                ->count();
            $sanctions = 0;
            $rewards = 0;

            $leaveSolds = LeaveType::where('assign_to_all', true)->get();
            $leaveSold = 0;

            foreach ($leaveSolds as $value) {
                $leaveSold += $value->last;
            }

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
                    'leaveSold',
                )
            );
        } else {
            return redirect('dashboard');
        }
    }
}

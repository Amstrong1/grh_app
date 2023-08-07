<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Models\AttendanceSchedule;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\StoreAttendanceScheduleRequest;
use App\Http\Requests\UpdateAttendanceScheduleRequest;

class AttendanceScheduleController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $structure = Auth::user()->structure;
        $attendanceSchedules = $structure->attendanceSchedules()->get();

        return view('app.attendance-schedule.index', [
            'attendanceSchedules' => $attendanceSchedules,
            'my_actions' => $this->attendanceSchedule_actions(),
            'my_attributes' => $this->attendanceSchedule_columns(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('app.attendance-schedule.create', [
            'my_fields' => $this->attendanceSchedule_fields()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAttendanceScheduleRequest $request)
    {

        foreach ($request->days as $day) {
            $attendanceSchedule = new attendanceSchedule();
            $attendanceSchedule->structure_id = Auth::user()->structure->id;
            $day_name = Day::where('id', $day)->first();
            $attendanceSchedule->day = $day_name->name;
            $attendanceSchedule->hour_start = $request->hour_start;
            $attendanceSchedule->break_start = $request->break_start;
            $attendanceSchedule->hour_end = $request->hour_end;
            $attendanceSchedule->break_end = $request->break_end;
            $attendanceSchedule->save();
        }

        if ($attendanceSchedule->save()) {
            Alert::toast('Les données ont été enregistrées', 'success');
            return redirect('attendance_schedule');
        } else {
            Alert::toast('Les données ont été enregistrées', 'error');
            return redirect()->back()->withInput($request->input());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(AttendanceSchedule $attendanceSchedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AttendanceSchedule $attendanceSchedule)
    {
        return view('app.attendance-schedule.edit', [
            'attendanceSchedule' => $attendanceSchedule,
            'my_fields' => $this->attendanceSchedule_fields(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAttendanceScheduleRequest $request, AttendanceSchedule $attendanceSchedule)
    {
        $attendanceSchedule = attendanceSchedule::find($attendanceSchedule->id);

        $attendanceSchedule->day = $request->day;
        $attendanceSchedule->hour_start = $request->hour_start;
        $attendanceSchedule->break_start = $request->break_start;
        $attendanceSchedule->hour_end = $request->hour_end;
        $attendanceSchedule->break_end = $request->break_end;
        $attendanceSchedule->save();

        if ($attendanceSchedule->save()) {
            Alert::toast('Les informations ont été modifiées', 'success');
            return redirect('attendance_schedule');
        } else {
            Alert::toast('Une erreur est survenue', 'error');
            return redirect()->back()->withInput($request->input());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AttendanceSchedule $attendanceSchedule)
    {
        try {
            $attendanceSchedule = $attendanceSchedule->delete();
            Alert::success('Opération effectuée', 'Suppression éffectué');
            return redirect('attendance_schedule');
        } catch (\Exception $e) {
            Alert::error('Erreur', 'Element introuvable');
            return redirect()->back();
        }
    }

    private function attendanceSchedule_columns()
    {
        $columns = (object) [
            'day' => 'Jour',
            'hour_start' => 'Début de journée',
            'break_start' => 'Début de pause',
            'break_end' => 'Fin de pause',
            'hour_end' => 'Fin de journée',
        ];
        return $columns;
    }

    private function attendanceSchedule_actions()
    {
        if (Auth::user()->role === 'admin') {
            $actions = (object) array(
                'edit' => 'Modifier',
                'delete' => "Supprimer",
            );
        } else {
            $actions = (object) array();
        }
        return $actions;
    }

    private function attendanceSchedule_fields()
    {
        if (request()->routeIs('attendance_schedule.create')) {
            $fields = [
                'days' => [
                    'title' => 'Jour',
                    'field' => 'multiple-select',
                    'options' => Day::all('id', 'name'),
                ],
                'hour_start' => [
                    'title' => 'Début de journée',
                    'field' => 'time',
                ],
                'break_start' => [
                    'title' => 'Début de pause',
                    'field' => 'time',
                ],
                'break_end' => [
                    'title' => 'Fin de pause',
                    'field' => 'time',
                ],
                'hour_end' => [
                    'title' => 'Fin de journée',
                    'field' => 'time',
                ],
            ];
        } else {
            $fields = [
                'hour_start' => [
                    'title' => 'Début de journée',
                    'field' => 'time',
                ],
                'break_start' => [
                    'title' => 'Début de pause',
                    'field' => 'time',
                ],
                'break_end' => [
                    'title' => 'Fin de pause',
                    'field' => 'time',
                ],
                'hour_end' => [
                    'title' => 'Fin de journée',
                    'field' => 'time',
                ],
            ];
        }

        return $fields;
    }
}

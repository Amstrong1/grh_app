<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Models\AttendanceSchedule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
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
            Alert::toast(Lang::get('message.success'), 'success');
            return redirect('attendance_schedule');
        } else {
            Alert::toast(Lang::get('message.error'), 'error');
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
            Alert::toast(Lang::get('message.edited'), 'success');
            return redirect('attendance_schedule');
        } else {
            Alert::toast(Lang::get('message.error'), 'error');
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
            Alert::success(Lang::get('message.del_success1'), Lang::get('message.del_success2'));
            return redirect('attendance_schedule');
        } catch (\Exception $e) {
            Alert::error(Lang::get('message.del_error1'), Lang::get('message.del_error2'), );
            return redirect()->back();
        }
    }

    private function attendanceSchedule_columns()
    {
        $columns = (object) [
            'day' => Lang::get('message.day'),
            'hour_start' => Lang::get('message.day_start'),
            'break_start' => Lang::get('message.break_start'),
            'break_end' => Lang::get('message.break_end'),
            'hour_end' => Lang::get('message.day_end'),
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
                    'title' => Lang::get('message.day'),
                    'field' => 'multiple-select',
                    'options' => Day::all('id', 'name'),
                ],
                'hour_start' => [
                    'title' => Lang::get('message.day_start'),
                    'field' => 'time',
                ],
                'break_start' => [
                    'title' => Lang::get('message.break_start'),
                    'field' => 'time',
                ],
                'break_end' => [
                    'title' => Lang::get('message.break_end'),
                    'field' => 'time',
                ],
                'hour_end' => [
                    'title' => Lang::get('message.day_end'),
                    'field' => 'time',
                ],
            ];
        } else {
            $fields = [
                'hour_start' => [
                    'title' => Lang::get('message.day_start'),
                    'field' => 'time',
                ],
                'break_start' => [
                    'title' => Lang::get('message.break_start'),
                    'field' => 'time',
                ],
                'break_end' => [
                    'title' => Lang::get('message.break_end'),
                    'field' => 'time',
                ],
                'hour_end' => [
                    'title' => Lang::get('message.day_end'),
                    'field' => 'time',
                ],
            ];
        }

        return $fields;
    }
}

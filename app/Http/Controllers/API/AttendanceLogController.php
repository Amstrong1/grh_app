<?php

namespace App\Http\Controllers\API;

use App\Models\AttendanceLog;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\AttendanceLogResource;
use App\Http\Requests\StoreAttendanceLogRequest;
use App\Http\Requests\UpdateAttendanceLogRequest;

class AttendanceLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attendanceLogs = AttendanceLog::all();
        return AttendanceLogResource::collection($attendanceLogs);
    }

    
    public function display()
    {
        $structure = Auth::user()->structure;

        return view('app.attendance-logs.index', [
            'attendanceLogs' => $structure->attendanceLogs()->get(),
            'my_attributes' => $this->attendanceLogs_columns(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAttendanceLogRequest $request)
    {
        $attendanceLogs = AttendanceLog::create($request->all());

        return new AttendanceLogResource($attendanceLogs);
    }

    /**
     * Display the specified resource.
     */
    public function show(AttendanceLog $attendanceLog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AttendanceLog $attendanceLog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAttendanceLogRequest $request, AttendanceLog $attendanceLog)
    {
        $attendanceLog->update($request->all());

        return new AttendanceLogResource($attendanceLog);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AttendanceLog $attendanceLog)
    {
        $attendanceLog->delete();

        return response(null, 204);
    }

    private function attendanceLogs_columns()
    {
        $columns = (object) [
            'user_fullname' => 'Nom et prénoms',
            'formatted_log_date' => 'Date',
            'formatted_log_time' => 'Heure',
            'formatted_direction' => 'Sens',
        ];
        return $columns;
    }
}

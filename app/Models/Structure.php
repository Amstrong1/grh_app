<?php

namespace App\Models;

use App\Models\MaterialUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Structure extends Model
{
    use HasFactory;

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function departments(): HasMany
    {
        return $this->hasMany(Department::class);
    }

    public function places(): HasMany
    {
        return $this->hasMany(Place::class);
    }

    public function careers(): HasMany
    {
        return $this->hasMany(Career::class);
    }

    public function fillers(): HasMany
    {
        return $this->hasMany(Filler::class);
    }

    public function holdingWages(): HasMany
    {
        return $this->hasMany(HoldingWage::class);
    }

    public function absences(): HasMany
    {
        return $this->hasMany(Absence::class);
    }

    public function conflicts(): HasMany
    {
        return $this->hasMany(Conflict::class);
    }

    public function regularTasks(): HasMany
    {
        return $this->hasMany(RegularTask::class);
    }

    public function regularTaskReports(): HasMany
    {
        return $this->hasMany(RegularTaskReport::class);
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function pays(): HasMany
    {
        return $this->hasMany(Pay::class);
    }

    public function salaryAdvantages(): HasMany
    {
        return $this->hasMany(SalaryAdvantage::class);
    }

    public function leaves(): HasMany
    {
        return $this->hasMany(Leave::class);
    }

    public function readers(): HasMany
    {
        return $this->hasMany(Reader::class);
    }

    public function attendanceSchedules(): HasMany
    {
        return $this->hasMany(AttendanceSchedule::class);
    }

    public function attendanceLogs(): HasMany
    {
        return $this->hasMany(AttendanceLog::class);
    }

    public function leaveTypes(): HasMany
    {
        return $this->hasMany(LeaveType::class);
    }

    public function temptations(): HasMany
    {
        return $this->hasMany(Temptation::class);
    }

    public function temptationBacks(): HasMany
    {
        return $this->hasMany(TemptationBack::class);
    }

    public function materials(): HasMany
    {
        return $this->hasMany(Material::class);
    }
    
    public function materialsUsers(): HasMany
    {
        return $this->hasMany(MaterialUser::class);
    }
    
    public function notices(): HasMany
    {
        return $this->hasMany(Notice::class);
    }
}

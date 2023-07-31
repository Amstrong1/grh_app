<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Leave extends Model
{
    use HasFactory;

    protected $append = [
        'user_fullname', 
        'user_interim_fullname', 
        'leave_type_name', 
        'formatted_date_start', 
        'formatted_date_end'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function userInterim(): BelongsTo
    {
        return $this->belongsTo(User::class, 'temp_worker');
    }

    public function leaveType(): BelongsTo
    {
        return $this->belongsTo(LeaveType::class);
    }
    
    public function getUserFullnameAttribute()
    {
        return $this->user->name . ' ' . $this->user->firstname;
    }
    
    public function getUserInterimFullnameAttribute()
    {
        return $this->userInterim->name . ' ' . $this->userInterim->firstname;
    }
    
    public function getLeaveTypeNameAttribute()
    {
        return $this->leaveType->name;
    }
    
    public function getFormattedDateStartAttribute()
    {
        return getFormattedDate($this->date_start);
    }

    public function getFormattedDateEndAttribute()
    {
        return getFormattedDate($this->date_end);
    }
}

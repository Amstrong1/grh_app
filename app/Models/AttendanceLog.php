<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AttendanceLog extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $append = [
        'user_fullname',
        'formatted_log_date',
        'formatted_log_time',
        'formatted_direction',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getUserFullnameAttribute() {
        return $this->user->name . ' ' . $this->user->firstname;
    }
    
    public function getFormattedLogDateAttribute()
    {
        return getFormattedDate($this->log_date);
    }
    
    public function getFormattedLogTimeAttribute()
    {
        return getFormattedTime($this->log_time);
    }
    
    public function getFormattedDirectionAttribute()
    {
        if ($this->direction == 'in') {
            $sens = 'Entrée';
        } else {
            $sens = 'Sortie';
        }
        
        return $sens;
    }
}

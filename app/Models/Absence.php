<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Absence extends Model
{
    use HasFactory;

    protected $append = ['user_fullname', 'formatted_start_date', 'formatted_end_date'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    public function getUserFullnameAttribute()
    {
        return $this->user->name . ' ' . $this->user->firstname;
    }
    
    public function getFormattedStartDateAttribute()
    {
        return getFormattedDate($this->start_date);
    }
    
    public function getFormattedEndDateAttribute()
    {
        return getFormattedDate($this->end_date);
    }
}

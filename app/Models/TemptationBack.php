<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TemptationBack extends Model
{
    use HasFactory;
    
    protected $append = ['user_fullname', 'formatted_temptation_date'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    public function getUserFullnameAttribute()
    {
        return $this->user->name . ' ' . $this->user->firstname;
    }
    
    public function getFormattedTemptationDateAttribute()
    {
        return getFormattedDate($this->updated_at);
    } 
}

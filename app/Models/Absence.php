<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Absence extends Model
{
    use HasFactory;

    protected $append = ['user_fullname'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    public function getUserFullnameAttribute()
    {
        return $this->user->name . ' ' . $this->user->firstname;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pay extends Model
{
    use HasFactory;

    protected $append = ['period', 'user'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getPeriodAttribute()
    {
        return $this->period_start . ' au ' . $this->period_end;
    }

    public function getUserAttribte()
    {
        return $this->user->name . ' ' . $this->user->firstname;
    }
}
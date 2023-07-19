<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Pay extends Model
{
    use HasFactory;

    protected $append = ['period', 'user', 'formatted_pay_date'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function salaryAdvantages(): BelongsToMany
    {
        return $this->belongsToMany(SalaryAdvantage::class, 'pay_salary_advantages')->withPivot('amount');
    } 

    public function fillers(): BelongsToMany
    {
        return $this->belongsToMany(Filler::class, 'filler_pays')->withPivot('amount');
    } 

    public function getPeriodAttribute()
    {
        return getFormattedDate($this->period_start) . ' au ' . getFormattedDate($this->period_end);
    }

    public function getUserAttribte()
    {
        return $this->user->name . ' ' . $this->user->firstname;
    }

    public function getFormattedPayDateAttribute()
    {
        return getFormattedDate($this->pay_date);
    }
}

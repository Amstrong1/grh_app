<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Place extends Model
{
    use HasFactory;

    protected $appends = [
        'department_name',
        'formatted_basis_wage',
        'formatted_hourly_rate', 
        'formatted_overtime_rate',
    ];

    /**
     * List of guarded properties
     * @var array
     */
    protected $guarded = [];

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function careers(): HasMany
    {
        return $this->hasMany(Career::class);
    }

    /**
     * Returns the parent department name
     */
    public function getDepartmentNameAttribute()
    {
        return $this->department->name;
    }

    public function getFormattedbasisWageAttribute()
    {
        return number_format($this->basis_wage, 2, ',', ' ');
    }

    public function getFormattedHourlyRateAttribute()
    {
        return number_format($this->hourly_rate, 2, ',', ' ');
    }

    public function getFormattedOvertimeRateAttribute()
    {
        return number_format($this->overtime_rate, 2, ',', ' ');
    }
}

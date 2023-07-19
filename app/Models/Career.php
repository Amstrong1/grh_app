<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    use HasFactory;

    protected $append = [
        'user_name', 
        'user_firstname', 
        'user_email', 
        'department_name', 
        'post_name',
        'formatted_registration_date',
        'formatted_birthday',
        'formatted_contract_start',
        'formatted_contract_end'
    ];

    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function place(): BelongsTo
    {
        return $this->belongsTo(Place::class);
    }
    
    public function getUserNameAttribute()
    {
        return $this->user->name;
    }
    
    public function getUserFirstnameAttribute()
    {
        return $this->user->firstname;
    }
    
    public function getUserEmailAttribute()
    {
        return $this->user->email;
    }
    
    public function getDepartmentNameAttribute()
    {
        return $this->place->department->name;
    }
    
    public function getPostNameAttribute()
    {
        return $this->place->name;
    }    
    
    public function getFormattedBirthdayAttribute()
    {
        return getFormattedDate($this->birthday);
    } 
    
    public function getFormattedContractStartAttribute()
    {
        return getFormattedDate($this->contract_start);
    } 
    
    public function getFormattedContractEndAttribute()
    {
        return getFormattedDate($this->contract_end);
    }
    
    public function getFormattedRegistrationDateAttribute()
    {
        return getFormattedDate($this->registration_date);
    }
}

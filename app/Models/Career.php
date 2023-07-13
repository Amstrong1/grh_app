<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    use HasFactory;

    protected $append = ['user_name', 'user_firstname', 'user_email', 'department_name', 'post_name'];

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
}

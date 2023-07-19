<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Conflict extends Model
{
    use HasFactory;

    protected $append = ['users_fullname', 'formatted_conflict_date'];
 
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'conflict_users');
    }

    public function getUsersFullnameAttribute()
    {
        $users_fullname = [];
        $getUsers = $this->users()->get();
        foreach ($getUsers as $getUser) {
            $users_fullname[] = $getUser->name . ' ' . $getUser->firstname;
        }
        return $users_fullname;
    }   
    
    public function getFormattedConflictDateAttribute()
    {
        return getFormattedDate($this->conflict_date);
    }
}

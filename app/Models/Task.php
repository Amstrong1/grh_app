<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Task extends Model
{
    use HasFactory;

    protected $append = ['users_fullname'];

    protected $guarded = [];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'task_users');
    } 

    public function getUsersFullnameAttribute() //users_fullname
    {
        $users_fullname = [];
        $getUsers = $this->users()->get();
        foreach ($getUsers as $getUser) {
            $users_fullname[] = $getUser->name . ' ' . $getUser->firstname;
        }
        return $users_fullname;
    }
}

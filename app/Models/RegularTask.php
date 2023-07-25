<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class RegularTask extends Model
{
    use HasFactory;

    protected $append = ['users_fullname', 'day_name'];

    protected $guarded = [];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'regular_task_users');
    }

    public function regularTaskReports(): HasMany
    {
        return $this->hasMany(RegularTaskReport::class);
    }

    public function days(): HasMany
    {
        return $this->hasMany(Day::class);
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

    public function getDayNameAttribute() {
        // return $day_name = $this->days()->name;
    }
}

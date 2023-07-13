<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Structure extends Model
{
    use HasFactory;

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function departments(): HasMany
    {
        return $this->hasMany(Department::class);
    }

    public function places(): HasMany
    {
        return $this->hasMany(Place::class);
    }

    public function careers(): HasMany
    {
        return $this->hasMany(Career::class);
    }

    public function fillers(): HasMany
    {
        return $this->hasMany(Filler::class);
    }

    public function absences(): HasMany
    {
        return $this->hasMany(Absence::class);
    }

    public function conflicts(): HasMany
    {
        return $this->hasMany(Conflict::class);
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }
}

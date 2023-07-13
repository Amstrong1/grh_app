<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
    use HasFactory;
   
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
   
    public function places(): HasMany
    {
        return $this->hasMany(Place::class);
    }    

    public function departmentUser(): HasMany
    {
        return $this->hasMany(DepartmentUser::class);
    }

}

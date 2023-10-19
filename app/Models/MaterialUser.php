<?php

namespace App\Models;

use App\Models\User;
use App\Models\Material;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MaterialUser extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $append = ['users_fullname', 'materials_fullname'];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function material(): BelongsTo
    {
        return $this->belongsTo(Material::class);
    }

    public function getUsersFullnameAttribute() //users_fullname
    {
        
        return $this->user->name . ' ' . $this->user->firstname;
    }
    public function getMaterialsFullnameAttribute() //users_fullname
    {
        
        return $this->material->name;
    }
}

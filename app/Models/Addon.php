<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Addon extends Model
{
    use HasFactory;

    protected $append = [
        'formatted_created_at',
        'formatted_active'
    ];

    public function getFormattedCreatedAtAttribute()
    {
        return getFormattedDate($this->updated_at);
    }

    public function getFormattedActiveAttribute()
    {
        if ($this->status == 0) {
            $status = "Non Actif";
        } else {
            $status = "Actif";
        }

        return $status;
    }
}

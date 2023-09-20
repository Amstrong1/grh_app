<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    use HasFactory;

    protected $append = [
        'formatted_created_at',
        'formatted_updated_at',
    ];
    
    public function getFormattedCreatedAtAttribute()
    {
        return getFormattedDate($this->created_at);
    }
    
    public function getFormattedUpdatedAtAttribute()
    {
        return getFormattedDate($this->updated_at);
    }
}

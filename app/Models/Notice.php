<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    use HasFactory;

    protected $append = ['formatted_date'];

    public function getFormattedDateAttribute()
    {
        return getFormattedDate($this->created_at);
    }
}

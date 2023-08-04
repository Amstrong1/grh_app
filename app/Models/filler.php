<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Filler extends Model
{
    use HasFactory;
    
    protected $append = ['formatted_amount'];

    public function structure(): BelongsTo
    {
        return $this->belongsTo(Structure::class);
    }

    public function pays(): BelongsToMany
    {
        return $this->belongsToMany(Pay::class, 'filler_pays');
    }

    public function getFormattedAmountAttribute()
    {
        return number_format($this->amount, 2, '.', ' ');
    }
}

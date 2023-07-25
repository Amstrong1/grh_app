<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RegularTaskReport extends Model
{
    use HasFactory;

    protected $append = ['task_label'];
    protected $guarded = [];

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function regularTask(): BelongsTo
    {
        return $this->belongsTo(RegularTask::class);
    }

    public function getTaskLabelAttribute()
    {
        return $this->regularTask->task;
    }
}

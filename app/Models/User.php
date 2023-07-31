<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $append = ['department_list'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Get the structure that owns the user.
     */
    public function structure(): BelongsTo
    {
        return $this->belongsTo(Structure::class);
    }

    /**
     * Get the user's department.
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function place(): HasOne
    {
        return $this->hasOne(Place::class);
    }

    public function career(): HasOne
    {
        return $this->hasOne(Career::class);
    }

    public function departments(): BelongsToMany
    {
        return $this->belongsToMany(Department::class, 'department_users');
    }

    public function conflicts(): BelongsToMany
    {
        return $this->belongsToMany(Conflict::class, 'conflict_users');
    }

    public function regularTasks(): BelongsToMany
    {
        return $this->belongsToMany(RegularTask::class, 'regular_task_users');
    }

    public function regularTaskReports(): HasMany
    {
        return $this->hasMany(RegularTaskReport::class);
    }

    public function tasks(): BelongsToMany
    {
        return $this->belongsToMany(Task::class, 'task_users');
    }

    public function pays(): HasMany
    {
        return $this->hasMany(Pay::class);
    }

    public function latestLeave(): HasOne
    {
        return $this->hasOne(Leave::class)->latestOfMany();
    }

    public function getDepartmentListAttribute()
    {
        $departmentName = [];
        $getDepartments = $this->departments()->get();
        foreach ($getDepartments as $getDepartment) {
            $departmentName[] = $getDepartment->name;
        }
        return $departmentName;
    }
}

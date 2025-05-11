<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'dni',
        'phone',
        'address',
        'hire_date',
        'department_id',
        'role',
        'birth_date',
        'is_active',
        'image'
    ];

    protected $casts = [
        'birth_date' => 'date',
        'hire_date' => 'date',
        'is_active' => 'boolean',
        'role' => 'string'
    ];

    protected $attributes = [
        'role' => null
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function scopeJefe($query)
    {
        return $query->where('role', 'jefe');
    }

    // Relación con horarios
    public function schedules(): HasMany
    {
        return $this->hasMany(Schedule::class);
    }

    protected static function boot()
    {
        parent::boot();

        // Cuando se elimina un empleado, se eliminan sus horarios
        static::deleting(function ($employee) {
            $employee->schedules()->delete();
        });
    }
}

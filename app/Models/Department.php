<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    /**
     * Los atributos que pueden asignarse masivamente.
     */
    protected $fillable = [
        'code',
        'name',
        'description',
        'manager_id',
        'budget',
        'phone',
        'email',
        'status',
    ];

    /**
     * Relación con el jefe del departamento.
     */
    public function manager()
    {
        return $this->belongsTo(Employee::class, 'manager_id');
    }

    /**
     * Relación con empleados (Todos los empleados en este departamento).
     */
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    // Relación con memos
    public function memos()
    {
        return $this->hasMany(Memo::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'dni',
        'name',
        'email',
        'password',
        'birth_date',
        'address',
        'phone',
        'is_active',
        'image',
        'role'
    ];
    public function departments()
    {
        return $this->belongsToMany(Department::class, 'employee_department');
    }

    public function scopeJefe($query)
    {
        return $query->where('role', 'jefe');
    }
    
}

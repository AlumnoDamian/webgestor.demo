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
    ];
}

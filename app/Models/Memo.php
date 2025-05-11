<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Memo extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'type',
        'content',
        'department_id',
        'published_at'
    ];

    protected $casts = [
        'published_at' => 'datetime'
    ];

    // Relación con el modelo Department
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}

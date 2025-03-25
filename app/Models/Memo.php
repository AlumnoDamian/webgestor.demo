<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Memo extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'type', 'content', 'published_at', 'department_id']; // Incluir department_id

    protected $dates = ['published_at'];

    // Relación con el modelo Department
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}

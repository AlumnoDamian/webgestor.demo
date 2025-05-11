<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = ['employee_id', 'day', 'shift'];

    protected $casts = [
        'day' => 'date'
    ];

    public function getDayAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d');
    }

    public function employee() {
        return $this->belongsTo(Employee::class);
    }
}

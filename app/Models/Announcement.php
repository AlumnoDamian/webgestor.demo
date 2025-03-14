<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'category', 'content', 'priority', 'author', 'published_at'];

    protected $dates = ['published_at'];
}


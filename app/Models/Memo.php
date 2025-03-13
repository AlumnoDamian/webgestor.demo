<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Memo extends Model
{
    protected $fillable = ['title', 'type', 'content', 'recipient', 'published_at'];
}

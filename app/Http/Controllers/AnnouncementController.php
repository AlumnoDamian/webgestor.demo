<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::latest()->take(5)->get();  // Últimos 5 anuncios
        return view('anuncio', compact('announcements'));
    }
}


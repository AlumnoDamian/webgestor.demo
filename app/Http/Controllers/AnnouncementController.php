<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function index() {
        $announcements = Announcement::latest()->paginate(10);
        return view('announcements.index', compact('announcements'));
    }

    public function create() {
        return view('announcements.create');
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required',
            'category' => 'required',
            'content' => 'required',
            'priority' => 'required',
            'author' => 'required',
            'published_at' => 'required|date',
        ]);

        Announcement::create($request->all());
        return redirect()->route('anuncios.index')->with('success', 'Anuncio creado correctamente.');
    }
}


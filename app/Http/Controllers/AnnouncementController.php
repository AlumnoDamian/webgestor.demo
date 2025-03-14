<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;


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
            'published_at' => now(), // Asigna la fecha actual automáticamente
        ]);

        Announcement::create([
            'title' => $request->title,
            'category' => $request->category,
            'content' => $request->content,
            'priority' => $request->priority,
            'author' => $request->author,
            'published_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        return redirect()->route('anuncios.index')->with('success', 'Anuncio creado correctamente.');
    }
}


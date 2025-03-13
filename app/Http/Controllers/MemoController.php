<?php

namespace App\Http\Controllers;
use App\Models\Memo;

use Illuminate\Http\Request;

class MemoController extends Controller
{
    public function index() {
        $memos = Memo::latest()->paginate(10);
        return view('memos.index', compact('memos'));
    }

    public function create() {
        return view('memos.create');
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required',
            'type' => 'required',
            'content' => 'required',
            'recipient' => 'required',
            'published_at' => 'required|date',
        ]);

        Memo::create($request->all());
        return redirect()->route('comunicados.index')->with('success', 'Comunicado creado correctamente.');
    }
}
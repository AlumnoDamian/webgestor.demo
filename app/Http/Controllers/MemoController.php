<?php

namespace App\Http\Controllers;

use App\Models\Memo;
use App\Models\Department;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class MemoController extends Controller
{
    public function index() {
        $memos = Memo::latest()->paginate(10);
        $departments = Department::all();
        return view('memos.index', compact('memos', 'departments'));
    }

    public function create() {
        $departments = Department::all(); // Obtén todos los departamentos
        return view('memos.create', compact('departments'));    
    }

    public function store(Request $request) {
       
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'department_id' => 'required|exists:departments,id',
            'type' => 'required|in:Importante,Informativo,Urgente',
            'published_at' => 'required|date'
        ]);

        $memo = Memo::create($validatedData);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Comunicado creado correctamente',
                'memo' => $memo
            ]);
        }

        return redirect()->route('memos.index')->with('success', 'Comunicado creado correctamente');
    }

    public function edit($id)
    {
        $memo = Memo::findOrFail($id);
        
        if (request()->ajax()) {
            return response()->json([
                'id' => $memo->id,
                'title' => $memo->title,
                'content' => $memo->content,
                'type' => $memo->type,
                'department_id' => $memo->department_id,
                'published_at' => $memo->published_at
            ]);
        }

        $departments = Department::all();
        return view('memos.edit', compact('memo', 'departments'));
    }

    public function update(Request $request, $id) {
        
        $memo = Memo::findOrFail($id);

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'department_id' => 'required|exists:departments,id',
            'type' => 'required|in:Importante,Informativo,Urgente',
            'published_at' => 'required|date'
        ]);

        $memo->update($validatedData);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Comunicado actualizado correctamente',
                'memo' => $memo
            ]);
        }

        return redirect()->route('memos.index')->with('success', 'Comunicado actualizado correctamente');
    }

    public function destroy($id)
    {
        $memo = Memo::findOrFail($id);
        $memo->delete();

        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Comunicado eliminado correctamente'
            ]);
        }

        return redirect()->route('memos.index')->with('success', 'Comunicado eliminado correctamente');
    }
}
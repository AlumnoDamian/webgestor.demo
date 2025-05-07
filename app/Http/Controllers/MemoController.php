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
        try {
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required|string',
                'department_id' => 'required|exists:departments,id',
                'priority' => 'required|in:low,medium,high',
                'status' => 'required|in:draft,published'
            ]);

            $memo = Memo::create($validatedData);

            return response()->json([
                'message' => 'Comunicado creado correctamente',
                'memo' => $memo
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al crear el comunicado',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id) {
        try {
            $memo = Memo::findOrFail($id);

            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required|string',
                'department_id' => 'required|exists:departments,id',
                'priority' => 'required|in:low,medium,high',
                'status' => 'required|in:draft,published'
            ]);

            $memo->update($validatedData);

            return response()->json([
                'message' => 'Comunicado actualizado correctamente',
                'memo' => $memo
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al actualizar el comunicado',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
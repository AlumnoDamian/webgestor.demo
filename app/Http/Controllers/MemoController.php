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
            $request->validate([
                'title' => 'required',
                'type' => 'required',
                'content' => 'required',
                'department_id' => 'required|exists:departments,id',
                'published_at' => 'required|date'
            ]);
    
            Memo::create([
                'title' => $request->title,
                'type' => $request->type,
                'content' => $request->content,
                'department_id' => $request->department_id,
                'published_at' => Carbon::parse($request->published_at)->format('Y-m-d H:i:s'),
            ]);
    
            \Log::info('Comunicado creado: ', ['title' => $request->title]);
    
            return redirect()->route('memos.index')->with('success', 'Comunicado creado correctamente.');
        } catch (\Exception $e) {
            \Log::error('Error al crear comunicado: ', ['error' => $e->getMessage()]);
            return back()->withErrors('Error al crear el comunicado.');
        }
    }

    public function update(Request $request, $id) {
        try {
            \Log::info('Iniciando actualización de comunicado', [
                'id' => $id,
                'request_data' => $request->all(),
                'method' => $request->method()
            ]);

            $memo = Memo::findOrFail($id);
            \Log::info('Comunicado encontrado', [
                'memo' => $memo,
                'department_id_actual' => $memo->department_id
            ]);

            $request->validate([
                'title' => 'required',
                'type' => 'required',
                'content' => 'required',
                'department_id' => 'required|exists:departments,id'
            ]);

            \Log::info('Validación pasada, procediendo a actualizar', [
                'title' => $request->title,
                'type' => $request->type,
                'department_id' => $request->department_id
            ]);

            $updateData = [
                'title' => $request->title,
                'type' => $request->type,
                'content' => $request->content,
                'department_id' => $request->department_id
            ];

            \Log::info('Datos a actualizar', ['update_data' => $updateData]);

            $memo->update($updateData);

            \Log::info('Comunicado actualizado correctamente', [
                'id' => $id,
                'new_data' => $memo->fresh()->toArray(),
                'department_id_nuevo' => $memo->fresh()->department_id
            ]);

            return redirect()->route('memos.index')->with('success', 'Comunicado actualizado correctamente.');
        } catch (\Exception $e) {
            \Log::error('Error al actualizar comunicado', [
                'id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ]);
            return back()->withErrors('Error al actualizar el comunicado: ' . $e->getMessage());
        }
    }
}
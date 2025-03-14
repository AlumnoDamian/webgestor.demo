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
        return view('memos.index', compact('memos'));
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
                    'published_at' => now(),
                    'department_id' => 'required|exists:departments,id'
                ]);
        
                Memo::create([
                    'title' => $request->title,
                    'type' => $request->type,
                    'content' => $request->content,
                    'published_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'department_id' => $request->department_id ?? null, // Usar department_id correctamente
                ]);
        
                // Esto te ayudará a ver si la creación del comunicado es exitosa
                \Log::info('Comunicado creado: ', ['title' => $request->title]);
        
                return redirect()->route('comunicados.index')->with('success', 'Comunicado creado correctamente.');
            } catch (\Exception $e) {
                // Si ocurre un error, se guarda en el log
                \Log::error('Error al crear comunicado: ', ['error' => $e->getMessage()]);
                return back()->withErrors('Error al crear el comunicado.');
            }
        }
        
}
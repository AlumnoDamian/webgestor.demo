<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Memo;
use Illuminate\Support\Facades\Auth;

class Announcements extends Component
{
    public function render()
    {
        $user = Auth::user();
        
        // Obtener comunicados importantes que:
        // 1. Sean de tipo 'Importante'
        // 2. O bien sean para el departamento del usuario O sean para todos los departamentos
        // 3. Ya estén publicados
        $memos = Memo::where('type', 'Importante')
                    ->where(function($query) use ($user) {
                        $query->where('department_id', $user->employee->department_id)
                              ->orWhereNull('department_id');
                    })
                    ->where('published_at', '<=', now())
                    ->orderBy('published_at', 'desc')
                    ->get();

        return view('livewire.dashboard.announcements', [
            'memos' => $memos
        ]);
    }
}

<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Memo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;

class Announcements extends Component
{
    public function render()
    {
        $user = Auth::user();
        $employee = $user->employee;
        
        $memos = Memo::with('department')
            ->whereHas('department', function($query) use ($employee) {
                $query->where('id', $employee->department_id);
            })
            ->orderBy('published_at', 'desc')
            ->get();

        return view('livewire.dashboard.announcements', [
            'memos' => $memos
        ]);
    }
}

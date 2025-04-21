<?php

namespace App\Livewire\Dashboard;

use App\Models\Announcement;
use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;

class Announcements extends Component
{
    use WithPagination;

    public $searchTerm = '';

    protected $listeners = ['searchUpdated'];

    public function searchUpdated($searchTerm)
    {
        $this->searchTerm = $searchTerm;
        $this->resetPage();
    }

    public function getRecentAnnouncements()
    {
        return Announcement::latest('published_at')
            ->when($this->searchTerm, function($query) {
                $query->where('title', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('content', 'like', '%' . $this->searchTerm . '%');
            })
            ->paginate(5);
    }

    public function render()
    {
        $announcements = $this->getRecentAnnouncements()->through(function ($announcement) {
            $announcement->published_at = Carbon::parse($announcement->published_at);
            return $announcement;
        });

        return view('livewire.dashboard.announcements', [
            'announcements' => $announcements
        ]);
    }
}

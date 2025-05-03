<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;

class Search extends Component
{
    public $searchTerm = '';

    public function updatedSearchTerm()
    {
        $this->dispatch('searchUpdated', $this->searchTerm);
    }

    public function render()
    {
        return view('livewire.dashboard.search');
    }
}

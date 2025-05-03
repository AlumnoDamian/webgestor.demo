<?php

namespace App\Livewire;

use Livewire\Component;

class FluxSidebar extends Component
{
    public bool $isOpen = false;

    public function toggle()
    {
        $this->isOpen = !$this->isOpen;
    }

    public function render()
    {
        return view('livewire.flux-sidebar');
    }
}

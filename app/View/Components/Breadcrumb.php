<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Breadcrumb extends Component
{
    public $items;

    /**
     * Crea una nueva instancia del componente.
     *
     * @param  array  $items
     * @return void
     */
    public function __construct($items)
    {
        $this->items = $items;
    }

    /**
     * Renderiza la vista del componente.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('components.breadcrumb');
    }
}

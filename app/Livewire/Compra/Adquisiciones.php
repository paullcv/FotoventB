<?php

namespace App\Livewire\Compra;

use App\Models\Compra;
use Livewire\Component;

class Adquisiciones extends Component
{
    public $compras;

    public function mount()
    {
        // Obtener todas las compras del usuario autenticado
        $this->compras = auth()->user()->compras;
    }

    public function render()
    {
        return view('livewire.compra.adquisiciones');
    }
}

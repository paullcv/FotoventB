<?php

namespace App\Livewire\Evento;

use Livewire\Component;

class Show extends Component
{   
    public $events;

    public function mount()
    {
        // Obtener eventos del usuario autenticado
        $this->events = auth()->user()->events;
    }

    public function render()
    {
        return view('livewire.evento.show');
    }
}

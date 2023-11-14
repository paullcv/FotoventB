<?php

namespace App\Livewire\Evento;

use App\Models\Event;
use Livewire\Component;

use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Show extends Component
{   
    
    use WithPagination;
    use WithFileUploads;

    public $events;
    
    public function mount()
    {
        // Obtener eventos del usuario autenticado
        $this->events = auth()->user()->events;
    }

    
    public function deleteEvent($eventId)
    {
        $event = Event::find($eventId);

        if ($event) {
            $event->delete();
            // Actualizar la lista de eventos después de eliminar
            $this->events = auth()->user()->events;
        }
    }

    public function render()
    {
        return view('livewire.evento.show');
    }
}

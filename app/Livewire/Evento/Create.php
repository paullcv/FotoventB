<?php

namespace App\Livewire\Evento;

use App\Models\Event;
use Livewire\Component;

class Create extends Component
{
    public $nombre, $descripcion, $fecha, $hora, $visibilidad, $ubicacion;

    protected $rules = [
        'nombre' => 'required',
        'descripcion' => 'required',
        'ubicacion' => 'required',
        'fecha' => 'required|date',
        'hora' => 'required|date_format:H:i',
        'visibilidad' => 'required',
    ];

    public function save()
    {
        $this->validate();

        Event::create([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'ubicacion' => $this->ubicacion,
            'fecha' => $this->fecha,
            'hora' => $this->hora,
            'visibilidad' => $this->visibilidad,
            'user_id' => auth()->id(), // Asignar el ID del usuario actual
        ]);

        session()->flash('message', 'Evento creado exitosamente.');

        $this->reset(); // Limpiar los campos después de la creación
    }

    public function mount()
    {
        // Asignar un valor predeterminado, por ejemplo, 'publico'
        $this->visibilidad = 'publico';
    }

    public function render()
    {
        return view('livewire.evento.create');
    }
}

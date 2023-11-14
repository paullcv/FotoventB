<?php

namespace App\Livewire\Evento;

use App\Models\Event;
use Livewire\Component;


class Edit extends Component
{
    public $event;
    public $nombre;
    public $descripcion;
    public $ubicacion;
    public $fecha;
    public $hora;
    public $visibilidad;

    protected $rules = [
        'nombre' => 'required|string|max:255',
        'descripcion' => 'required|string',
        'ubicacion' => 'required|string|max:255',
        'fecha' => 'required|date',
        'hora' => 'required',
        'visibilidad' => 'required|in:publico,privado',
    ];

    public function mount(Event $event)
    {
        $this->event = $event;
        $this->nombre = $event->nombre;
        $this->descripcion = $event->descripcion;
        $this->ubicacion = $event->ubicacion;
        $this->fecha = $event->fecha;
        $this->hora = $event->hora;
        $this->visibilidad = $event->visibilidad;
    }

    public function update()
    {
        $this->validate();

        // Actualizar las propiedades del evento antes de guardar
        $this->event->nombre = $this->nombre;
        $this->event->descripcion = $this->descripcion;
        $this->event->ubicacion = $this->ubicacion;
        $this->event->fecha = $this->fecha;
        $this->event->hora = $this->hora;
        $this->event->visibilidad = $this->visibilidad;

        $this->event->save();

        session()->flash('message', 'Evento actualizado exitosamente.');

    }

    public function render()
    {
        return view('livewire.evento.edit');
    }
}

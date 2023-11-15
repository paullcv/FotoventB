<?php

namespace App\Livewire\Catalogo;

use App\Models\Event;
use Livewire\Component;
use Livewire\WithFileUploads; // Importa el trait necesario


class Create extends Component
{
    use WithFileUploads; // Agrega el trait

    public $image;
    public $price;
    public $eventId;
    public $message;

    protected $rules = [
        'image' => 'required|image|max:4096', 
        'price' => 'required|numeric',
        'eventId' => 'required|exists:events,id',
    ];

    public function save()
    {
        $this->validate();

        // Procesa el archivo de imagen, almacénalo y obtén la ruta
        $imagePath = $this->image->store('fotos', 'public');

        // Crea la foto en la base de datos
        auth()->user()->photos()->create([
            'image' => $imagePath,
            'price' => $this->price,
            'event_id' => $this->eventId,
        ]);

        // Mostrar un mensaje de éxito
        session()->flash('message', 'Foto subida exitosamente.');

        // Limpiar los campos después de la creación
        $this->reset(['image', 'price', 'eventId']);
    }

    public function render()
    {
        $events = Event::all(); // Asegúrate de obtener la lista de eventos
        return view('livewire.catalogo.create', compact('events'));
    }
}

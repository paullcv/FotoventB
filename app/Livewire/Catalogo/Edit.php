<?php

namespace App\Livewire\Catalogo;

use App\Models\Photo;
use App\Models\Event;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public $photo;
    public $newImage;
    public $events;

    public $event_id;
    public $price;

    protected $rules = [
        'price' => 'required|numeric',
        'newImage' => 'nullable|image|max:4096', // Puedes ajustar el tamaño máximo según tus necesidades
        'event_id' => 'required|exists:events,id',
    ];

    public function mount(Photo $photo)
    {
        $this->photo = $photo;
        $this->events = Event::all();
        $this->price = $photo->price;
        $this->event_id = $photo->event_id; 
    }

    public function updatePhoto()
    {
        $this->validate();

        // Actualiza la información de la foto
        $this->photo->update([
            'price' => $this->price,
            'event_id' => $this->event_id,
        ]);

        // Actualiza la imagen si se proporciona una nueva
        if ($this->newImage) {
            $imagePath = $this->newImage->store('fotos', 'public');
            $this->photo->update(['image' => $imagePath]);
        }

        // Muestra un mensaje de éxito
        session()->flash('message', 'Foto actualizada exitosamente.');

        // Redirige a la página de catálogo después de la actualización
       // return redirect()->route('catalogo.index');
    }

    public function render()
    {
        return view('livewire.catalogo.edit');
    }
}

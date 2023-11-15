<?php

namespace App\Livewire\Catalogo;

use App\Models\Photo;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Show extends Component
{

    public $photos;
    
    public function mount()
    {
        // Obtener eventos del usuario autenticado
        $this->photos = auth()->user()->photos;
    }

    public function deletePhoto($photoId)
    {
        $photo = Photo::findOrFail($photoId);

        // Eliminar la imagen del almacenamiento
        Storage::disk('public')->delete($photo->image);

        // Eliminar el registro de la base de datos
        $photo->delete();

        // Volver a cargar las fotos después de la eliminación
        $this->photos = auth()->user()->photos;
    }


    public function render()
    {
        return view('livewire.catalogo.show');
    }
}

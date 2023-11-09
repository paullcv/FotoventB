<?php

namespace App\Livewire\User;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Perfil extends Component
{
    use WithFileUploads;

    public $photo;

    protected $rules = [
        'photo' => 'image|max:2048', // Ajusta el tamaño máximo según tus necesidades
    ];


    public function updateProfilePhoto()
    {
        $this->validate();

        if ($this->photo) {
            $path = $this->photo->storeAs('perfil', auth()->user()->id . '.' . $this->photo->getClientOriginalExtension(), 'public');

            // Elimina la foto antigua si existe
            if (auth()->user()->photo_path1) {
                Storage::disk('public')->delete(auth()->user()->photo_path1);
            }

            // Actualiza el atributo photo_path1 en el modelo User y guarda el modelo
            auth()->user()->photo_path1 = $path;
            auth()->user()->save();
        }

        $this->reset('photo'); // Limpia el campo de la foto después de procesarla
    }

    public function deleteProfilePhoto()
    {
        // Verifica si hay una foto de perfil actual
        if (auth()->user()->photo_path1) {
            // Elimina la foto antigua
            Storage::disk('public')->delete(auth()->user()->photo_path1);
    
            // Actualiza el atributo photo_path1 en el modelo User y guarda el modelo
            auth()->user()->photo_path1 = null;
            auth()->user()->save();
        }
    }

    public function render()
    {
        return view('livewire.user.perfil');
    }

    
}

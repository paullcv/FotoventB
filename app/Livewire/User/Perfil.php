<?php

namespace App\Livewire\User;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Perfil extends Component
{
    use WithFileUploads;

    public $photo_path1;
    public $photo_path2;
    public $photo_path3;

    protected $rules = [
        'photo_path1' => 'image|max:2048',
        'photo_path2' => 'image|max:2048',
        'photo_path3' => 'image|max:2048',
    ];

    public function updateProfilePhoto($attribute)
    {
        $this->validateOnly($attribute);

        if ($this->$attribute) {
            $this->updatePhoto($attribute, $this->$attribute);
            $this->reset($attribute);
        }
    }

    private function updatePhoto($attribute, $photo)
    {
        try {
            $userId = auth()->user()->id;
            $folderName = 'perfil/' . $userId;

            // Obtener el número del atributo (1, 2, 3)
            $attributeNumber = substr($attribute, -1);

            $fileName = $attributeNumber . '.' . $photo->getClientOriginalExtension();

            $path = $photo->storeAs($folderName, $fileName, 'public');

            if (auth()->user()->$attribute) {
                Storage::disk('public')->delete(auth()->user()->$attribute);
            }

            auth()->user()->$attribute = $path;
            auth()->user()->save();
        } catch (\Exception $e) {
            $this->addError($attribute, 'Error al procesar la imagen.');
        }
    }

    public function deleteProfilePhoto($attribute)
    {
        if (auth()->user()->$attribute) {
            Storage::disk('public')->delete(auth()->user()->$attribute);

            auth()->user()->$attribute = null;
            auth()->user()->save();
        }
    }

    public function render()
    {
        return view('livewire.user.perfil');
    }
}

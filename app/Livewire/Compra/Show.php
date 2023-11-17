<?php

namespace App\Livewire\Compra;

use Livewire\Component;

class Show extends Component
{
    public $userPhotos;

    public function render()
    {
        return view('livewire.compra.show', [
            'userPhotos' => $this->userPhotos,
        ]);
    }
}

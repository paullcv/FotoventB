<?php

namespace App\Livewire\Evento;

use App\Models\Event;
use App\Traits\QrTrait;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
//use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Endroid\QrCode\QrCode;

class Create extends Component
{
    use QrTrait;
    
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

        // Crear un nuevo evento en la base de datos
        $evento = Event::create([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'ubicacion' => $this->ubicacion,
            'fecha' => $this->fecha,
            'hora' => $this->hora,
            'visibilidad' => $this->visibilidad,
            'user_id' => auth()->id(),
        ]);

        // Generar el código QR y obtener la URL
        $url = $this->generateQr($evento->id);

        // Almacenar la ruta de la imagen QR en la base de datos
        $evento->update(['imageQR' => $url]);

        // Mostrar un mensaje de éxito
        session()->flash('message', 'Evento creado exitosamente.');

        // Limpiar los campos después de la creación
        $this->reset();
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

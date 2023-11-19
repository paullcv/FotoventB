<?php

namespace App\Livewire\Catalogo;

use App\Models\Coincidencia;
use App\Models\Event;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads; // Importa el trait necesario


class Create extends Component
{
    use WithFileUploads; // Agrega el trait
    protected $listeners = ["notificacionAparecesFoto"];

    public $image;
    public $price;
    public $eventId;
    public $message;
    public $imagepath;

    protected $rules = [
        'image' => 'required|image|max:4096',
        'price' => 'required|numeric',
        'eventId' => 'required|exists:events,id',
    ];


    public function save()
    {
        $this->validate();

        // Procesa el archivo de imagen, almacénalo y obtén la ruta
        $this->imagepath = $this->image->store('fotos', 'public');

        // Crea la foto en la base de datos
        auth()->user()->photos()->create([
            'image' => $this->imagepath,
            'price' => $this->price,
            'event_id' => $this->eventId,
        ]);

        // Mostrar un mensaje de éxito
        session()->flash('message', 'Foto subida exitosamente.');

        $usuarios = [];

        $directorios = Storage::Directories('public/perfil');
        foreach ($directorios as $dir) {
            $carpeta = str_replace('public/perfil/', '', $dir);
            array_push($usuarios, $carpeta);
        }

        //dd($usuarios, $directorios );

        $this->dispatch('face-api', $usuarios);

        // Limpiar los campos después de la creación
        $this->reset(['image', 'price', 'eventId']);
    }

    public function notificacionAparecesFoto($idusuarios)
    {
        // Elimina IDs duplicados
        $idusuariosUnicos = array_unique($idusuarios);
    
        foreach ($idusuariosUnicos as $idusuario) {
            // Verifica si el id de usuario no es "unknown"
            if ($idusuario !== "unknown") {
                // Verifica si ya existe una coincidencia con la misma ruta de imagen y usuario
                $existeCoincidencia = Coincidencia::where('image', $this->imagepath)
                    ->where('user_id', $idusuario)
                    ->exists();
    
                // Si no existe, crea la coincidencia
                if (!$existeCoincidencia) {
                    Coincidencia::create([
                        'image' => $this->imagepath, 
                        'user_id' => $idusuario,
                    ]);
                }
            }
        }
    }
    


    public function render()
    {
        $events = Event::all(); // Asegúrate de obtener la lista de eventos
        return view('livewire.catalogo.create', compact('events'));
    }
}

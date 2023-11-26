<?php

namespace App\Livewire\Evento;

use App\Models\User;
use App\Models\Event;
use Livewire\Component;

class Fotografos extends Component
{
    public $fotografos;
    public $selectedFotografo;
    public $event;

    public function mount(Event $event)
    {
        $this->event = $event;

        // Verificar si ya hay un fotógrafo contratado y establecer la variable correspondiente
        $this->selectedFotografo = $event->fotografo ?? null;

        // Obtener la lista de usuarios que cumplen con la condición de suscripción
        $this->fotografos = User::where('id', '!=', auth()->id())
            ->where(function ($query) {
                $query->whereHas('subscriptions', function ($q) {
                    $q->where('stripe_price', 'price_1O8rF5Dh3Rgs6haXBpBaq63L');
                    $q->where('name', 'Fotovent');
                });
            })
            ->get();
    }

    public function contratarFotografo($fotografoId)
    {
        // Obtener el modelo completo del fotógrafo seleccionado
        $fotografo = User::find($fotografoId);

        // Actualizar el fotógrafo contratado en la tabla de eventos
        $this->event->update(['fotografo_id' => $fotografo->id]);

        // Actualizar la variable para mostrar el fotógrafo contratado
        $this->selectedFotografo = $fotografo;
    }

    public function render()
    {
        return view('livewire.evento.fotografos', [
            'selectedFotografo' => $this->selectedFotografo,
        ]);
    }
}

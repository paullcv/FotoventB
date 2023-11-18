<?php

namespace App\Livewire\Compra;

use App\Models\Compra;
use Livewire\Component;
use PhpParser\Node\Stmt\TryCatch;

class PayPhoto extends Component
{
    public $photo;
    public $paymentMethodId;

    public function getDefaultPaymentMethodProperty()
    {
        return auth()->user()->defaultPaymentMethod();
    }

    public function mount()
    {
        if (auth()->user()->defaultPaymentMethod()) {
            $this->paymentMethodId = $this->defaultPaymentMethod->id;
        }
    }

    public function purchase()
    {

        //Capturar posible error
        try {
            auth()->user()->charge($this->photo->price * 100, $this->paymentMethodId);
            // Guarda la compra en la tabla 'compras'
            Compra::create([
                'image' => $this->photo->image,
                'user_id' => auth()->user()->id,
            ]);
            return redirect()->route('gracias');
            //dd('Compra Realizada con exito');
        } catch (\Exception $e) {
            session()->flash('error', 'La compra fallo por algun motivo');
        }
    }

    public function render()
    {
        return view(
            'livewire.compra.pay-photo',
            [
                'paymentMethods' => auth()->user()->paymentMethods(),
            ]
        );
    }
}

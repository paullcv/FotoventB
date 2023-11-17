<?php

namespace App\Livewire\Compra;

use Livewire\Component;

class PayPhoto extends Component
{
    public $photo;
    public $paymentMethodId;

    public function getDefaultPaymentMethodProperty()
    {
        return auth()->user()->defaultPaymentMethod();
    }

    public function mount(){
        if (auth()->user()->defaultPaymentMethod()) {
            $this->paymentMethodId = $this->defaultPaymentMethod->id;
        }
    }

    public function purchase(){
        auth()->user()->charge($this->photo->price * 100, $this->paymentMethodId);
        dd('Compra Realizada con exito');
    }

    public function render()
    {
        return view('livewire.compra.pay-photo',[
            'paymentMethods'=> auth()->user()->paymentMethods(),
        ]
    );   

    }
}

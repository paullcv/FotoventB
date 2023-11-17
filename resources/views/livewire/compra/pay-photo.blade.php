<div>
    <div class="card bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="card-body px-8 py-6">

            <div class="flex justify-between items-center mb-4">
                <h1 class="text-lg font-semibold">
                    Metodo de Pago
                </h1>
                <img class="h-12" src="https://codersfree.com/img/payments/credit-cards.png" alt="">
            </div>

            <ul>
                @foreach ($paymentMethods as $paymentMethod)
                    <li>
                        <label>
                            <input wire:model="paymentMethodId" type="radio" name="paymentMethod" value="{{ $paymentMethod->id }}">

                            {{ $paymentMethod->billing_details->name }}
                            (xxxx-xxxx-xxxx-{{ $paymentMethod->card->last4 }})
                            @if ($this->defaultPaymentMethod->id == $paymentMethod->id)
                            <span
                                class="ml-2 bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">
                                Predeterminado
                            </span>
                            @endif
                        </label>
                    </li>
                @endforeach
            </ul>

            <button wire:click="purchase" class="text-white bg-red-500 px-2 py-1 rounded-full hover:bg-red-600 focus:outline-none transition duration-300 ml-2">
                Pagar
            </button>
        </div>
    </div>
</div>

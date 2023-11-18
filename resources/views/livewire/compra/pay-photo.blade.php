<div>
    <div class="card bg-gradient-to-r from-blue-500 via-blue-400 to-blue-300 shadow-lg rounded-lg overflow-hidden">
        <div class="card-body px-8 py-6">

            <div class="flex justify-between items-center mb-4">
                <h1 class="text-lg font-semibold text-white">
                    Método de Pago
                </h1>
                <img class="h-12" src="https://codersfree.com/img/payments/credit-cards.png" alt="">
            </div>

            <ul class="text-white">
                @foreach ($paymentMethods as $paymentMethod)
                    <li class="mb-2">
                        <label class="flex items-center">
                            <input wire:model="paymentMethodId" type="radio" name="paymentMethod"
                                value="{{ $paymentMethod->id }}" class="mr-2">

                            <span>
                                {{ $paymentMethod->billing_details->name }}
                                (xxxx-xxxx-xxxx-{{ $paymentMethod->card->last4 }})
                                @if ($this->defaultPaymentMethod->id == $paymentMethod->id)
                                    <span
                                        class="ml-2 bg-yellow-300 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded">
                                        Predeterminado
                                    </span>
                                @endif
                            </span>
                        </label>
                    </li>
                @endforeach
            </ul>
            <x-danger-button wire:click="purchase" wire:target="purchase" wire:loading.attr="disabled" class="mt-4">
                <x-spinner size="4" wire:target="purchase" wire:loading />
                Pagar
            </x-danger-button>
        </div>
    </div>
    @if (session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 relative" role="alert">
            {{ session('error') }}
            <button class="absolute top-0 right-0 -mt-2 -mr-2 p-2" onclick="this.parentElement.style.display='none'">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    @endif
</div>

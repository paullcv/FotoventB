<div>
    <h2 class="text-2xl font-semibold text-gray-900 dark:text-gray-200 mb-4">
        Fotografos Disponibles
    </h2>

    @if ($selectedFotografo)
        <div class="bg-white rounded-lg overflow-hidden shadow-md">
            <div class="p-4">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">{{ $selectedFotografo->name }}</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400">{{ $selectedFotografo->email }}</p>
            </div>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
            @if ($fotografos->count() > 0)
                @foreach ($fotografos as $fotografo)
                    <div class="bg-white rounded-lg overflow-hidden shadow-md">
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">{{ $fotografo->name }}</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">{{ $fotografo->email }}</p>
                            <button wire:click="contratarFotografo({{ $fotografo->id }})"
                                class="mt-2 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-300">
                                Contratar
                            </button>
                        </div>
                    </div>
                @endforeach
            @else
                <h2 class="text-2xl font-semibold text-gray-900 dark:text-gray-200 mb-4">
                    No tiene ningún fotógrafo contratado en este momento.
                </h2>
            @endif
        </div>
    @endif
</div>

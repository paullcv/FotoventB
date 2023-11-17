<div>
    <div class="py-12">
        @if(count($userPhotos) > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($userPhotos as $userPhoto)
                    <div class="bg-white rounded shadow-lg overflow-hidden relative hover:shadow-xl transition duration-300">
                        <div class="h-56 md:h-64 lg:h-72 xl:h-96 overflow-hidden">
                            <img src="{{ asset('storage/' . $userPhoto->image) }}" alt="Photo" class="w-full h-full object-cover transition-transform transform hover:scale-105">
                        </div>
                        <div class="absolute top-2 left-2 bg-red-600 text-white text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">
                            {{ $userPhoto->price }} Bs
                        </div>
                        <div class="p-4">
                            <a href="{{ route('compra.detalles', ['photo' => $userPhoto->id]) }}" class="bg-blue-500 text-white px-4 py-2 rounded-full mt-2 hover:bg-blue-600 transition duration-300 w-full">
                                Comprar
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center text-gray-500">
                <p class="text-lg">No hay fotos disponibles.</p>
            </div>
        @endif
    </div>
</div>

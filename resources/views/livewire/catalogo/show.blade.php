<div>
    <div class="container mx-auto p-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @foreach($photos as $photo)
                <div class="border rounded-lg overflow-hidden shadow-md bg-white relative">
                    <div class="relative overflow-hidden">
                        <img src="{{ asset('storage/' . $photo->image) }}" alt="Photo" class="w-full h-72 object-cover transition-transform transform hover:scale-105 duration-300">
                        <div class="absolute bottom-2 left-2">
                            <button class="text-white bg-blue-500 px-2 py-1 rounded-full hover:bg-blue-600 focus:outline-none transition duration-300">
                                Editar
                            </button>
                            <button wire:click="deletePhoto({{ $photo->id}})" class="text-white bg-red-500 px-2 py-1 rounded-full hover:bg-red-600 focus:outline-none transition duration-300 ml-2">
                                Eliminar
                            </button>
                        </div>
                    </div>
                    <div class="p-4 bg-gray-50 border-t border-gray-200">
                        <div class="flex justify-between items-center">
                            <p class="text-lg font-semibold text-gray-800">{{ $photo->event->nombre }}</p>
                            <p class="text-gray-600">{{ $photo->price }} Bs</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

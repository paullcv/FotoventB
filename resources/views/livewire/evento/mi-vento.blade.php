<div class="container mx-auto p-8">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
        @foreach($events as $event)
            <div class="border rounded-lg overflow-hidden shadow-md bg-white">
                <div class="p-4">
                    <div class="mb-4">
                        <h2 class="text-xl font-bold text-gray-800 text-center">{{ $event->nombre }}</h2>
                        <div class="flex items-center text-gray-600">
                            <i class="fas fa-calendar mr-2"></i> <strong>Fecha:</strong> {{ $event->fecha }}
                        </div>
                        <div class="flex items-center text-gray-600">
                            <i class="fas fa-clock mr-2"></i> <strong>Hora:</strong> {{ $event->hora }}
                        </div>
                        <div class="flex items-center text-gray-600">
                            <i class="fas fa-map-marker-alt mr-2"></i> <strong>Ubicación:</strong> {{ $event->ubicacion }}
                        </div>
                        <div class="flex items-center text-gray-600">
                            <i class="fas fa-eye mr-2"></i> <strong>Visibilidad:</strong> {{ $event->visibilidad }}
                        </div>
                    </div>

                    <div class="text-center">
                        <!-- Mostrar la imagen QR -->
                        <img src="{{ asset($event->imageQR) }}" alt="QR Code" class="w-full h-auto">
                    </div>
                </div>

                <div class="p-4 bg-gray-50 border-t border-gray-200">
                    <!-- Botones de Acción -->
                    <div class="flex justify-center items-center">
                        <!-- Botón para descargar la imagen del QR -->
                        <a href="{{ asset($event->imageQR) }}" download="{{ $event->nombre }}_QR.png" 
                            class="bg-blue-500 text-white p-2 text-center hover:bg-blue-600 transition duration-300 block">
                            Descargar QR
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

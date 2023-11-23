<div class="container mx-auto p-8">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
        @foreach($compras as $compra)
            <div class="border rounded-lg overflow-hidden shadow-md bg-white">
                <div class="p-4">
                    <div class="mb-4">
                        <h2 class="text-xl font-bold text-gray-800 text-center">Imagen de Compra #{{ $compra->id }}</h2>
                    </div>

                    <div class="text-center">
                        <!-- Mostrar la imagen de la compra -->
                        <img src="{{ asset('storage/'. $compra->image) }}" alt="Imagen de Compra" class="w-full h-auto">
                    </div>
                </div>

                <div class="p-4 bg-gray-50 border-t border-gray-200">
                    <!-- Botones de Acción -->
                    <div class="flex justify-center items-center">
                        <!-- Botón para descargar la imagen -->
                        <a href="{{ asset('storage/' . $compra->image) }}" download="{{ 'compra_' . $compra->id . '_imagen.jpg' }}" 
                            class="bg-blue-500 text-white p-2 text-center hover:bg-blue-600 transition duration-300 block">
                            Descargar Imagen
                         </a>
                         
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

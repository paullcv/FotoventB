<div>
    <div class="max-w-3xl mx-auto mt-8 p-6 bg-white rounded-md shadow-md">
        <h1 class="text-4xl font-bold text-center mb-8 text-green-600">Crear Nuevo Evento</h1>

        <form wire:submit.prevent="save" class="space-y-6">
            <div>
                <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre:</label>
                <input wire:model="nombre" type="text" id="nombre"
                    class="mt-1 p-3 w-full border border-gray-300 rounded-md focus:outline-none focus:border-green-500">
                @error('nombre')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción:</label>
                <textarea wire:model="descripcion" id="descripcion"
                    class="mt-1 p-3 w-full border border-gray-300 rounded-md focus:outline-none focus:border-green-500"></textarea>
                @error('descripcion')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="ubicacion" class="block text-sm font-medium text-gray-700">Ubicación:</label>
                <input wire:model="ubicacion" id="ubicacion"
                    class="mt-1 p-3 w-full border border-gray-300 rounded-md focus:outline-none focus:border-green-500">
                @error('ubicacion')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="fecha" class="block text-sm font-medium text-gray-700">Fecha:</label>
                    <input wire:model="fecha" type="date" id="fecha"
                        class="mt-1 p-3 w-full border border-gray-300 rounded-md focus:outline-none focus:border-green-500">
                    @error('fecha')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="hora" class="block text-sm font-medium text-gray-700">Hora:</label>
                    <input wire:model="hora" type="time" id="hora"
                        class="mt-1 p-3 w-full border border-gray-300 rounded-md focus:outline-none focus:border-green-500">
                    @error('hora')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div>
                <label for="visibilidad" class="block text-sm font-medium text-gray-700">Visibilidad:</label>
                <select wire:model="visibilidad" id="visibilidad"
                    class="mt-1 p-3 w-full border border-gray-300 rounded-md focus:outline-none focus:border-green-500">
                    <option value="publico">Público</option>
                    <option value="privado">Privado</option>
                </select>
                @error('visibilidad')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit"
                class="bg-green-500 text-white p-4 rounded-md hover:bg-green-600 transition duration-300 w-full">Guardar
                Evento</button>
        </form>

        @if (session()->has('message'))
        <div class="mt-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-md relative">
            <span class="block sm:inline">{{ session('message') }}</span>
            <button wire:click="$set('message', null)" class="absolute top-0 right-0 p-2">
                <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    @endif
    </div>
</div>

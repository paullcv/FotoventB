<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    @foreach (['photo_path1', 'photo_path2', 'photo_path3'] as $attribute)
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4 flex flex-col items-center">
            @if (auth()->user()->$attribute)
                <img src="{{ asset('storage/' . auth()->user()->$attribute) }}" alt="Current Profile Photo" class="rounded-full h-20 w-20 object-cover mb-2">
            @else
                <div class="flex items-center justify-center h-20 w-20 bg-gray-100 rounded-full mb-2">
                    <span class="text-gray-500">Sin Foto</span>
                </div>
            @endif

            <!-- Remove Current Photo Button -->
            <x-secondary-button type="button" class="mt-auto" wire:click="deleteProfilePhoto('{{ $attribute }}')">
                {{ __('Eliminar Foto') }}
            </x-secondary-button>
        </div>
    @endforeach

    <!-- New Profile Photos Inputs -->
    @foreach (['photo_path1', 'photo_path2', 'photo_path3'] as $attribute)
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4 flex flex-col items-center">
            <label for="{{ $attribute }}" class="block text-sm font-medium text-gray-700">
                {{ __('Subir Foto') }}
            </label>
            <div class="mt-1 flex items-center flex-col space-y-2">
                <input type="file" wire:model="{{ $attribute }}" id="{{ $attribute }}" class="sr-only">
                <label for="{{ $attribute }}" class="cursor-pointer text-sm leading-5 font-medium text-blue-600 hover:text-blue-500 focus:outline-none focus:underline transition duration-150 ease-in-out">
                    {{ __('Elegir Foto') }}
                </label>
                @if ($$attribute)
                    <x-button wire:click="updateProfilePhoto('{{ $attribute }}')" wire:loading.attr="disabled">
                        {{ __('Subir') }}
                    </x-button>
                @endif
            </div>

            <!-- Preview of the New Photo -->
            @if ($$attribute)
                <img src="{{ $$attribute->temporaryUrl() }}" alt="New Photo Preview" class="mt-2 mx-auto">
            @endif

            <!-- Input Errors -->
            <x-input-error for="{{ $attribute }}" class="mt-2" />
        </div>
    @endforeach
</div>

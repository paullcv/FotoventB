<div>
    <!-- Current Profile Photos -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @foreach (['photo_path1', 'photo_path2', 'photo_path3'] as $attribute)
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                @if (auth()->user()->$attribute)
                    <img src="{{ asset('storage/' . auth()->user()->$attribute) }}" alt="Current Profile Photo" class="rounded-full h-20 w-20 object-cover mx-auto">
                @else
                    <span class="text-gray-500">No photo</span>
                @endif

                <!-- Remove Current Photo Button -->
                <x-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto('{{ $attribute }}')">
                    {{ __('Remove Photo') }}
                </x-secondary-button>
            </div>
        @endforeach

        <!-- New Profile Photos Inputs -->
        @foreach (['photo_path1', 'photo_path2', 'photo_path3'] as $attribute)
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                <input type="file" wire:model="{{ $attribute }}" class="mt-2">
                @if ($$attribute)
                    <x-button wire:click="updateProfilePhoto('{{ $attribute }}')" wire:loading.attr="disabled">
                        {{ __('Upload Photo') }}
                    </x-button>
                    <img src="{{ $$attribute->temporaryUrl() }}" alt="New Photo Preview" class="mt-2">
                @endif

                <!-- Input Errors -->
                <x-input-error for="{{ $attribute }}" class="mt-2" />
            </div>
        @endforeach
    </div>
</div>

<div>
    <!-- Current Profile Photo -->
    @if (auth()->user()->photo_path1)
        <div class="mt-2">
            <img src="{{ asset('storage/' . auth()->user()->photo_path1) }}" alt="Current Profile Photo" class="rounded-full h-20 w-20 object-cover">
        </div>

        <!-- Remove Current Photo Button -->
        <x-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
            {{ __('Remove Photo') }}
        </x-secondary-button>
    @endif

    <!-- New Profile Photo Input -->
    <input type="file" wire:model="photo" class="mt-2">

    <!-- Preview of the New Photo -->
    @if ($photo)
        <img src="{{ $photo->temporaryUrl() }}" alt="New Photo Preview" class="mt-2">
    @endif

    <!-- Upload Button -->
    <x-button wire:click="updateProfilePhoto" wire:loading.attr="disabled">
        {{ __('Upload Photo') }}
    </x-button>

    <x-input-error for="photo" class="mt-2" />
</div>

<div>
    <!-- Current Profile Photos -->
    @if (auth()->user()->photo_path1)
        <div class="mt-2">
            <img src="{{ asset('storage/' . auth()->user()->photo_path1) }}" alt="Current Profile Photo 1" class="rounded-full h-20 w-20 object-cover">
        </div>
    @endif

    @if (auth()->user()->photo_path2)
        <div class="mt-2">
            <img src="{{ asset('storage/' . auth()->user()->photo_path2) }}" alt="Current Profile Photo 2" class="rounded-full h-20 w-20 object-cover">
        </div>
    @endif

    @if (auth()->user()->photo_path3)
        <div class="mt-2">
            <img src="{{ asset('storage/' . auth()->user()->photo_path3) }}" alt="Current Profile Photo 3" class="rounded-full h-20 w-20 object-cover">
        </div>
    @endif

    <!-- Remove Current Photos Buttons -->
    <x-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto('photo_path1')">
        {{ __('Remove Photo 1') }}
    </x-secondary-button>
    <x-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto('photo_path2')">
        {{ __('Remove Photo 2') }}
    </x-secondary-button>
    <x-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto('photo_path3')">
        {{ __('Remove Photo 3') }}
    </x-secondary-button>

    <!-- New Profile Photos Inputs -->
    <input type="file" wire:model="photo_path1" class="mt-2">
    @if ($photo_path1)
        <x-button wire:click="updateProfilePhoto('photo_path1')" wire:loading.attr="disabled">
            {{ __('Upload Photo 1') }}
        </x-button>
    @endif

    <input type="file" wire:model="photo_path2" class="mt-2">
    @if ($photo_path2)
        <x-button wire:click="updateProfilePhoto('photo_path2')" wire:loading.attr="disabled">
            {{ __('Upload Photo 2') }}
        </x-button>
    @endif

    <input type="file" wire:model="photo_path3" class="mt-2">
    @if ($photo_path3)
        <x-button wire:click="updateProfilePhoto('photo_path3')" wire:loading.attr="disabled">
            {{ __('Upload Photo 3') }}
        </x-button>
    @endif

    <!-- Previews of the New Photos -->
    @if ($photo_path1)
        <img src="{{ $photo_path1->temporaryUrl() }}" alt="New Photo 1 Preview" class="mt-2">
    @endif
    @if ($photo_path2)
        <img src="{{ $photo_path2->temporaryUrl() }}" alt="New Photo 2 Preview" class="mt-2">
    @endif
    @if ($photo_path3)
        <img src="{{ $photo_path3->temporaryUrl() }}" alt="New Photo 3 Preview" class="mt-2">
    @endif

    <!-- Input Errors -->
    <x-input-error for="photo_path1" class="mt-2" />
    <x-input-error for="photo_path2" class="mt-2" />
    <x-input-error for="photo_path3" class="mt-2" />
</div>

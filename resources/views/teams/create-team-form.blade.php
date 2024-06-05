<x-form-section submit="createTeam">
    <x-slot name="title">
        <h2 class="text-2xl font-semibold text-gray-100">{{ __('Team Details') }}</h2>
    </x-slot>

    <x-slot name="description">
        <p class="text-sm text-white">{{ __('Create a new team to collaborate with others on projects.') }}</p>
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6">
            <x-label value="{{ __('Team Owner') }}" class="text-white" />

            <div class="flex items-center mt-2">

                <div class="ms-4 leading-tight">
                    <div class="text-white text-sm">{{ $this->user->email }}</div>
                </div>
            </div>
        </div>

        <div class="col-span-6 sm:col-span-4 mt-4">
            <x-label for="name" value="{{ __('Team Name') }}" class="text-white" />
            <x-input id="name" type="text" class="mt-1 block w-full bg-gray-700 border-gray-600 text-white placeholder-gray-400 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" wire:model="state.name" autofocus />
            <x-input-error for="name" class="mt-2 text-red-500" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-button class="bg-teal-600 hover:bg-teal-500 text-white font-bold py-2 px-4 rounded-full transition-colors duration-300 ease-in-out">
            {{ __('Create') }}
        </x-button>
    </x-slot>
</x-form-section>

<x-form-section submit="updateTeamName">
    <x-slot name="title">
        <h2 class="text-2xl font-semibold text-white">{{ __('Team Name') }}</h2>
    </x-slot>

    <x-slot name="description">
        <p class="text-sm text-gray-300">{{ __('The team\'s name and owner information.') }}</p>
    </x-slot>

    <x-slot name="form">
        <!-- Team Owner Information -->
        <div class="col-span-6">
            <x-label value="{{ __('Team Owner') }}" class="text-gray-300" />

            <div class="flex items-center mt-2">

                <div class="ms-4 leading-tight">
                    <div class="text-gray-300 text-sm">{{ $team->owner->email }}</div>
                </div>
            </div>
        </div>

        <!-- Team Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="name" value="{{ __('Team Name') }}" class="text-gray-300" />

            <x-input id="name"
                        type="text"
                        class="mt-1 block w-full bg-gray-700 border-gray-600 text-gray-300 placeholder-gray-400 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        wire:model="state.name"
                        :disabled="! Gate::check('update', $team)" />

            <x-input-error for="name" class="mt-2 text-red-500" />
        </div>
    </x-slot>

    @if (Gate::check('update', $team))
        <x-slot name="actions">
            <x-action-message class="me-3 text-teal-400" on="saved">
                {{ __('Saved.') }}
            </x-action-message>

            <x-button class="bg-teal-600 hover:bg-teal-500 text-gray-100 font-bold py-2 px-4 rounded-full shadow-lg transition-colors duration-300 ease-in-out">
                {{ __('Save') }}
            </x-button>
        </x-slot>
    @endif
</x-form-section>

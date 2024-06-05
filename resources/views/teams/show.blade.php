<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Team Settings') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8 space-y-10">
            <div>
                @livewire('teams.update-team-name-form', ['team' => $team])
            </div>

            <div>
                @livewire('teams.team-member-manager', ['team' => $team])
            </div>

            @if (Gate::check('delete', $team) && ! $team->personal_team)
                <x-section-border />

                <div">
                    @livewire('teams.delete-team-form', ['team' => $team])
                </div>
            @endif
        </div>
    </div>
</x-app-layout>

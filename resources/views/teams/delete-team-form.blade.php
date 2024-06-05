<x-action-section>
    <x-slot name="title">
        {{ __('Delete Team') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Permanently delete this team.') }}
    </x-slot>

    <x-slot name="content">
        <div class="mt-5">
            <x-danger-button wire:click="$toggle('confirmingTeamDeletion')" wire:loading.attr="disabled">
                {{ __('Delete Team') }}
            </x-danger-button>
        </div>

        <!-- Delete Team Confirmation Modal -->
        <x-confirmation-modal wire:model.live="confirmingTeamDeletion">
            <x-slot name="title">
                
            </x-slot>

            <x-slot name="content">
                {{ __('Are you sure you want to delete this team?') }}
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="$toggle('confirmingTeamDeletion')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ms-3" wire:click="deleteTeam" wire:loading.attr="disabled">
                    {{ __('Delete Team') }}
                </x-danger-button>
            </x-slot>
        </x-confirmation-modal>
    </x-slot>
</x-action-section>

<div>
    @if (Gate::check('addTeamMember', $team))
        <x-section-border />

        <!-- Add Team Member -->
        <div class="mt-10 sm:mt-0">
            <x-form-section submit="addTeamMember">
                <x-slot name="title">
                    <h2 class="text-2xl font-semibold text-white">{{ __('Add Team Member') }}</h2>
                </x-slot>

                <x-slot name="description">
                    <p class="text-sm text-gray-300">{{ __('Add a new team member to your team, allowing them to collaborate with you.') }}</p>
                </x-slot>

                <x-slot name="form">
                    <div class="col-span-6">
                        <div class="max-w-xl text-sm text-white">
                            {{ __('Please provide the email address of the person you would like to add to this team.') }}
                        </div>
                    </div>

                    <!-- Member Email -->
                    <div class="col-span-6 sm:col-span-4">
                        <x-label for="email" value="{{ __('Email') }}" class="text-gray-300" />
                        <x-input id="email" type="email" class="mt-1 block w-full bg-gray-700 border-gray-600 text-gray-300 placeholder-gray-400 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" wire:model="addTeamMemberForm.email" />
                        <x-input-error for="email" class="mt-2 text-red-500" />
                    </div>

                    <!-- Role -->
                    @if (count($this->roles) > 0)
                    <div class="col-span-6 lg:col-span-4">
                        <x-label for="role" value="{{ __('Role') }}" class="text-gray-300" />
                        <x-input-error for="role" class="mt-2 text-red-500" />
                    
                        <div class="mt-4 bg-gray-800 rounded-lg overflow-hidden border border-gray-700">
                            @foreach ($this->roles as $index => $role)
                                <button type="button" class="block w-full text-left py-3 px-4 text-white hover:bg-gray-700 focus:outline-none focus:bg-gray-700 {{ $index > 0 ? 'border-t border-gray-700' : '' }}" wire:click="$set('addTeamMemberForm.role', '{{ $role->key }}')">
                                    <div class="{{ isset($addTeamMemberForm['role']) && $addTeamMemberForm['role'] !== $role->key ? 'opacity-50' : '' }}">
                                        <div class="flex items-center justify-between">
                                            <div class="text-sm font-semibold">
                                                {{ $role->name }}
                                            </div>
                                            @if ($addTeamMemberForm['role'] == $role->key)
                                                <svg class="h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m0 0l2-2M5 10v7a2 2 0 002 2h10a2 2 0 002-2v-7l-5 5-5-5z" />
                                                </svg>
                                            @endif
                                        </div>
                                        <div class="text-xs text-gray-400 mt-1">
                                            {{ $role->description }}
                                        </div>
                                    </div>
                                </button>
                            @endforeach
                        </div>
                    </div>
                    
                    @endif
                </x-slot>

                <x-slot name="actions">
                    <x-action-message class="me-3" on="saved">
                        {{ __('Added.') }}
                    </x-action-message>

                    <x-button class="bg-teal-600 hover:bg-teal-500 text-gray-100 font-bold py-2 px-4 rounded-full shadow-lg transition-colors duration-300 ease-in-out">
                        {{ __('Add') }}
                    </x-button>
                </x-slot>
            </x-form-section>
        </div>
    @endif

    @if ($team->teamInvitations->isNotEmpty() && Gate::check('addTeamMember', $team))
        <x-section-border />

        <!-- Team Member Invitations -->
        <div class="mt-10 sm:mt-0">
            <x-action-section>
                <x-slot name="title">
                    <h2 class="text-2xl font-semibold text-white">{{ __('Pending Team Invitations') }}</h2>
                </x-slot>

                <x-slot name="description">
                    <p class="text-sm text-gray-300">{{ __('These people have been invited to your team and have been sent an invitation email. They may join the team by accepting the email invitation.') }}</p>
                </x-slot>

                <x-slot name="content">
                    <div class="space-y-6">
                        @foreach ($team->teamInvitations as $invitation)
                            <div class="flex items-center justify-between">
                                <div class="text-gray-600">{{ $invitation->email }}</div>

                                <div class="flex items-center">
                                    @if (Gate::check('removeTeamMember', $team))
                                        <!-- Cancel Team Invitation -->
                                        <button class="cursor-pointer ms-6 text-sm text-red-500 focus:outline-none"
                                                            wire:click="cancelTeamInvitation({{ $invitation->id }})">
                                            {{ __('Cancel') }}
                                        </button>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </x-slot>
            </x-action-section>
        </div>
    @endif

    @if ($team->users->isNotEmpty())
        <x-section-border />

        <!-- Manage Team Members -->
        <div class="mt-10 sm:mt-0">
            <x-action-section>
                <x-slot name="title">
                    <h2 class="text-2xl font-semibold text-white">{{ __('Team Members') }}</h2>
                </x-slot>

                <x-slot name="description">
                    <p class="text-sm text-gray-300">{{ __('All of the people that are part of this team.') }}</p>
                </x-slot>

                <!-- Team Member List -->
                <x-slot name="content">
                    <div class="space-y-6">
                        @foreach ($team->users->sortBy('name') as $user)
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <img class="w-8 h-8 rounded-full object-cover border-2 border-gray-700" src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}">
                                    <div class="ms-4 text-white">{{ $user->name }}</div>
                                </div>

                                <div class="flex items-center">
                                    <!-- Manage Team Member Role -->
                                    @if (Gate::check('updateTeamMember', $team) && Laravel\Jetstream\Jetstream::hasRoles())
                                        <button class="ms-2 text-sm text-gray-400 underline" wire:click="manageRole('{{ $user->id }}')">
                                            {{ Laravel\Jetstream\Jetstream::findRole($user->membership->role)->name }}
                                        </button>
                                    @elseif (Laravel\Jetstream\Jetstream::hasRoles())
                                        <div class="ms-2 text-sm text-gray-400">
                                            {{ Laravel\Jetstream\Jetstream::findRole($user->membership->role)->name }}
                                        </div>
                                    @endif

                                    <!-- Leave Team -->
                                    @if ($this->user->id === $user->id)
                                        <button class="cursor-pointer ms-6 text-sm text-red-500" wire:click="$toggle('confirmingLeavingTeam')">
                                            {{ __('Leave') }}
                                        </button>

                                    <!-- Remove Team Member -->
                                    @elseif (Gate::check('removeTeamMember', $team))
                                        <button class="cursor-pointer ms-6 text-sm text-red-500" wire:click="confirmTeamMemberRemoval('{{ $user->id }}')">
                                            {{ __('Remove') }}
                                        </button>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </x-slot>
            </x-action-section>
        </div>
    @endif

    <!-- Role Management Modal -->
    <x-dialog-modal wire:model.live="currentlyManagingRole">
        <x-slot name="title">
            <h2 class="text-2xl font-semibold text-white">{{ __('Manage Role') }}</h2>
        </x-slot>

        <x-slot name="content">
            <div class="relative z-0 mt-1 border border-gray-700 rounded-lg cursor-pointer">
                @foreach ($this->roles as $index => $role)
                    <button type="button" class="relative px-4 py-3 inline-flex w-full rounded-lg focus:z-10 focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500 {{ $index > 0 ? 'border-t border-gray-700 focus:border-none rounded-t-none' : '' }} {{ ! $loop->last ? 'rounded-b-none' : '' }}"
                                    wire:click="$set('currentRole', '{{ $role->key }}')">
                        <div class="{{ $currentRole !== $role->key ? 'opacity-50' : '' }}">
                            <!-- Role Name -->
                            <div class="flex items-center">
                                <div class="text-sm text-white {{ $currentRole == $role->key ? 'font-semibold' : '' }}">
                                    {{ $role->name }}
                                </div>

                                @if ($currentRole == $role->key)
                                    <svg class="ms-2 h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                @endif
                            </div>

                            <!-- Role Description -->
                            <div class="mt-2 text-xs text-gray-300">
                                {{ $role->description }}
                            </div>
                        </div>
                    </button>
                @endforeach
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="stopManagingRole" wire:loading.attr="disabled" class="bg-gray-700 text-gray-300">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ms-3 bg-teal-600 hover:bg-teal-500 text-gray-100 font-bold py-2 px-4 rounded-full shadow-lg transition-colors duration-300 ease-in-out" wire:click="updateRole" wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>

    <!-- Leave Team Confirmation Modal -->
    <x-confirmation-modal wire:model.live="confirmingLeavingTeam">
        <x-slot name="title">
            <h2 class="text-2xl font-semibold text-white">{{ __('Leave Team') }}</h2>
        </x-slot>

        <x-slot name="content">
            <p class="text-sm text-gray-300">{{ __('Are you sure you would like to leave this team?') }}</p>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('confirmingLeavingTeam')" wire:loading.attr="disabled" class="bg-gray-700 text-gray-300">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-danger-button class="ms-3 bg-red-600 hover:bg-red-500 text-gray-100 font-bold py-2 px-4 rounded-full shadow-lg transition-colors duration-300 ease-in-out" wire:click="leaveTeam" wire:loading.attr="disabled">
                {{ __('Leave') }}
            </x-danger-button>
        </x-slot>
    </x-confirmation-modal>

    <!-- Remove Team Member Confirmation Modal -->
    <x-confirmation-modal wire:model.live="confirmingTeamMemberRemoval">
        <x-slot name="title">
            <h2 class="text-2xl font-semibold text-white">{{ __('Remove Team Member') }}</h2>
        </x-slot>

        <x-slot name="content">
            <p class="text-sm text-gray-300">{{ __('Are you sure you would like to remove this person from the team?') }}</p>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('confirmingTeamMemberRemoval')" wire:loading.attr="disabled" class="bg-gray-700 text-gray-300">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-danger-button class="ms-3 bg-red-600 hover:bg-red-500 text-gray-100 font-bold py-2 px-4 rounded-full shadow-lg transition-colors duration-300 ease-in-out" wire:click="removeTeamMember" wire:loading.attr="disabled">
                {{ __('Remove') }}
            </x-danger-button>
        </x-slot>
    </x-confirmation-modal>
</div>

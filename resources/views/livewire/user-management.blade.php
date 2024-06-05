<div>
    <div class="container mx-auto">
        {{-- Filters Section --}}
        <section class="flex flex-col lg:flex-row justify-between items-center mb-4">
            <div class="w-full lg:w-1/2 mb-2 lg:mb-0">
                <input wire:model.live="search" type="text"
                    class="w-full bg-gray-100 text-gray-700 placeholder-gray-500 rounded-md shadow-sm border border-gray-200 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent"
                    name="search" placeholder="Buscar usuario..." />
            </div>
            <div class="flex items-center lg:justify-end space-x-4">
                <button type="button" wire:click="openModal"
                    class="bg-emerald-500 text-white px-4 py-2 rounded-md shadow-md hover:bg-emerald-600 transition duration-300">
                    Crear usuario
                </button>
            </div>
        </section>

        {{-- Users Table --}}
        <div class="overflow-x-auto mb-4">
            <table class="min-w-full w-full">
                <thead class="bg-emerald-500 text-white">
                    <tr>
                        <th wire:click="sortBy('id')" class="px-6 py-3 cursor-pointer">ID</th>
                        <th class="px-6 py-3">Nombre</th>
                        <th class="px-6 py-3">Email</th>
                        <th class="px-6 py-3">Rol</th>
                        <th class="px-6 py-3">Estado</th>
                        <th class="px-6 py-3"></th>
                    </tr>
                </thead>

                <tbody class="bg-gray-100 divide-y divide-gray-200 text-gray-700">
                    @if ($users->count() > 0)
                        @foreach ($users as $user)
                            <tr class="shadow-md hover:bg-gray-200">
                                <td class="px-6 py-4">{{ $user->id }}</td>
                                <td class="px-6 py-4">{{ $user->name }}</td>
                                <td class="px-6 py-4">{{ $user->email }}</td>
                                <td class="px-6 py-4">
                                    @if ($user->roles->count() > 0)
                                        {{ $user->roles->first()->name }}
                                    @else
                                        Sin Rol
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full {{ $user->status == '1' ? 'bg-green-400 text-green-800' : 'bg-red-400 text-red-800' }}">
                                        {{ $user->status == '1' ? 'Activo' : 'Inactivo' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <button wire:click="assignTeam({{ $user->id }})"
                                        class="text-emerald-500 hover:text-emerald-700 transition duration-300">
                                        Editar
                                    </button>
                                    <button type="button" wire:click="$set('managingFiles', {{ $user->id }})"
                                        class="text-emerald-500 hover:text-emerald-700 transition duration-300">
                                        subir
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="8" class="px-6 py-4 whitespace-nowrap">
                                <p class="text-sm text-gray-700">No hay usuarios disponibles</p>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>


    {{-- * Create User Modal --}}
    <x-dialog-modal wire:model="isModalOpen" class="transform transition-transform ease-in-out duration-300 left-0">
        <x-slot name="title">
            <div class="text-emerald-500">
                Crear Usuario
            </div>
        </x-slot>

        <x-slot name="content">
            <form wire:submit.prevent="createUser">
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium">Nombre</label>
                    <input type="text" wire:model="newUser.name" id="name"
                        class="w-full bg-gray-200 text-zinc-500 placeholder-zinc-500 rounded-md shadow-sm border-transparent focus:outline-none focus:ring-transparent focus:border-transparent">
                    @error('newUser.name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium">Email</label>
                    <input type="email" wire:model="newUser.email" id="email"
                        class="w-full bg-gray-200 text-zinc-500 placeholder-zinc-500 rounded-md shadow-sm border-transparent focus:outline-none focus:ring-transparent focus:border-transparent">
                    @error('newUser.email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium">Contraseña</label>
                    <input type="password" wire:model="newUser.password" id="password"
                        class="w-full bg-gray-200 text-zinc-500 placeholder-zinc-500 rounded-md shadow-sm border-transparent focus:outline-none focus:ring-transparent focus:border-transparent">
                    @error('newUser.password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </form>
        </x-slot>

        <x-slot name="footer" class="flex items-center justify-end mt-4 bg-gray-200">
            <button
                class="inline-flex mr-2 items-center border border-transparent font-semibold text-xs uppercase tracking-widest hover:bg-emerald-600 active:bg-zinc-900 focus:outline-none focus:border-emerald-900 focus:ring focus:ring-emerald-300 disabled:opacity-25 transition bg-emerald-500 text-emerald-900 px-4 py-2 rounded-md"
                wire:click="createUser" wire:loading.attr="disabled">
                Crear
            </button>
            <x-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
                Cancelar
            </x-secondary-button>
        </x-slot>
    </x-dialog-modal>

    {{-- Edit User --}}
    @if ($isTeamModalOpen)
        <x-dialog-modal wire:model="isTeamModalOpen">
            <x-slot name="title" class="bg-teal-600 py-4 px-6 rounded-t-lg">
                <h2 class="text-lg font-semibold text-gray-100">Asignar Equipo a {{ $selectedUser['name'] ?? '' }}</h2>
            </x-slot>

            <x-slot name="content" class="bg-gray-200 px-6 py-8 rounded-b-lg">
                <div class="mb-6">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
                    <input
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-teal-500 focus:ring focus:ring-teal-200 focus:ring-opacity-50 sm:text-sm bg-white text-gray-900"
                        type="text" id="name" name="name" wire:model="selectedUser.name">
                </div>

                <div class="mb-6">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-teal-500 focus:ring focus:ring-teal-200 focus:ring-opacity-50 sm:text-sm bg-white text-gray-900"
                        type="email" id="email" name="email" wire:model="selectedUser.email">
                </div>

                <div class="mb-6">
                    <label for="team" class="block text-sm font-medium text-gray-700">Asignar nuevo equipo</label>
                    <select wire:model="selectedTeam" id="team" name="team"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-teal-500 focus:ring focus:ring-teal-200 focus:ring-opacity-50 sm:text-sm bg-white text-gray-900">
                        <option value="">Seleccionar Equipo</option>
                        @foreach ($teams as $teamId => $teamName)
                            <option value="{{ $teamId }}">{{ $teamName }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-6">
                    <label for="user_status" class="block text-sm font-medium text-gray-700">Estado del
                        Usuario</label>
                    <select wire:model="selectedUser.status" id="user_status" name="user_status"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-teal-500 focus:ring focus:ring-teal-200 focus:ring-opacity-50 sm:text-sm bg-white text-gray-900">
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                    </select>
                </div>

                <div class="mb-6">
                    <label for="spatie_role" class="block text-sm font-medium text-gray-700">Rol</label>
                    <select wire:model="selectedSpatieRole" id="spatie_role" name="spatie_role"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-teal-500 focus:ring focus:ring-teal-200 focus:ring-opacity-50 sm:text-sm bg-white text-gray-900">
                        <option value="">Seleccionar Rol</option>
                        @foreach ($spatieRoles as $spatieRole)
                            @if (Auth::user()->hasRole('Cliente') && $spatieRole->name === 'Administrador')
                            @else
                                <option value="{{ $spatieRole->name }}">{{ $spatieRole->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </x-slot>

            <x-slot name="footer" class="bg-gray-200 py-4 px-6 rounded-b-lg flex items-center justify-end mt-4">
                <x-secondary-button wire:click="closeTeamModal" wire:loading.attr="disabled"
                    class="text-teal-600 border-teal-600 hover:bg-teal-100 hover:text-teal-700">
                    Cancelar
                </x-secondary-button>

                <x-button class="ml-2 bg-teal-600 hover:bg-teal-700 text-gray-100" wire:click="saveTeam"
                    wire:loading.attr="disabled">
                    Asignar
                </x-button>
            </x-slot>
        </x-dialog-modal>
    @endif


    {{-- * Manage User Files Modal --}}
    @if ($managingFiles)
        <x-dialog-modal wire:model="managingFiles"
            class="transform transition-transform ease-in-out duration-300 left-0">
            <x-slot name="title">
                Cargar Documento
            </x-slot>

            <x-slot name="content">

                <form wire:submit.prevent="saveFile">
                    <div class="form-group">
                        <x-label for="document_type" class="">Tipo de Documento</x-label>
                        <input type="text" wire:model.defer="documentType"
                            class="form-control bg-gray-200 text-zinc-400 mt-1 block w-full border-transparent rounded-md shadow-sm focus:outline-none focus:ring-transparent focus:border-transparent sm:text-sm"
                            id="document_type" />
                    </div>

                    <div class="form-group mt-4">
                        <x-label for="expiry_date" class="">Fecha de Entrega</x-label>
                        <input type="date" wire:model.defer="expiryDate"
                            class="form-control bg-gray-200 text-zinc-400 mt-1 block w-full border-transparent rounded-md shadow-sm focus:outline-none focus:ring-transparent focus:border-transparent sm:text-sm"
                            id="expiry_date" />
                    </div>

                    <div class="form-group mt-4">

                        <label class="flex items-center cursor-pointer">
                            Subir archivos <span class="material-symbols-outlined ml-2">upload_file</span>
                            <input type="file" class="hidden" wire:model="file" />
                        </label>
                        @error('file')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex flex-row justify-end mt-4">
                        <button
                            class="inline-flex mr-2 items-center border border-transparent font-semibold text-xs uppercase tracking-widest hover:bg-emerald-600 active:bg-zinc-900 focus:outline-none focus:border-emerald-900 focus:ring focus:ring-emerald-300 disabled:opacity-25 transition bg-emerald-500 text-emerald-900 px-4 py-2 rounded-md"><span
                                class="material-symbols-outlined mr-2">upload_file</span>Subir</button>
                        <x-secondary-button wire:click="$toggle('managingFiles')"><span
                                class="material-symbols-outlined mr-2">file_upload_off</span>Cancelar</x-secondary-button>
                    </div>
                </form>
            </x-slot>

            <x-slot name="footer" class="flex flex-col bg-gray-200">
                {{-- * User Files Table --}}
                <div class="flex flex-col w-full">

                    @if (!empty($publicFiles))
                        <div class="overflow-x-auto">
                            <table class="min-w-full w-full text-center overflow-x-auto">
                                <thead class="bg-gray-200">
                                    <tr>
                                        <th class="px-6 py-3 text-xs font-medium uppercase tracking-wider">
                                            Tipo de documento
                                        </th>
                                        <th class="px-6 py-3 text-xs font-medium uppercase tracking-wider">
                                            Fecha de Entrega
                                        </th>
                                        <th class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider">

                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-zinc-800">
                                    @foreach ($documents as $file)
                                        <tr class="shadow">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ $file->document_type }} <span
                                                    class="text-xs text-emerald-500">({{ $this->getFileSize($file->file_path) }})</span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ $file->updated_at }}
                                            </td>
                                            <td
                                                class="border-t-0 px-6 align-middle border-l-0 text-right border-r-0 whitespace-nowrap p-2">
                                                <button type="button"
                                                    wire:click="download('{{ $file->file_path }}')"
                                                    class="text-black-600 material-symbols-outlined hover:text-yellow-500 transition duration-200 ease-in-out">
                                                    download
                                                </button>
                                                <button type="button"
                                                    wire:click="deleteFile('{{ $file->file_path }}')"
                                                    class="text-black-600 material-symbols-outlined hover:text-yellow-500 transition duration-200 ease-in-out">
                                                    delete
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4">
                            {{ $documents->links() }}
                        </div>
                    @else
                        <div class="w-full mt-4 flex justify-center">
                            <div class="container">
                                <div class="title">Sin archivos disponibles...</div>
                            </div>
                        </div>
                    @endif
                </div>
            </x-slot>
        </x-dialog-modal>
    @endif
</div>
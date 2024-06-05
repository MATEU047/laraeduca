<x-guest-layout>
    <div class="min-h-screen bg-gradient-to-b from-[#2F8984] to-gray-700 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-xl">
            <div class="bg-gray-100 bg-opacity-50 rounded-lg p-6 shadow-xl">
                <div class="flex justify-between mb-6">
                    <div class="w-2/3">
                        <x-input wire:model.live="search" type="text" class="w-full bg-gray-700 text-gray-300 placeholder-gray-400 rounded-md shadow-sm border-transparent focus:outline-none focus:ring-transparent focus:border-transparent" name="search" placeholder="Buscar curso..." />
                    </div>
                    <div class="flex items-center w-1/3 justify-end">
                        <a href="{{ route('teams.create') }}"
                            class="bg-indigo-600 hover:bg-indigo-500 text-gray-100 font-bold py-2 px-4 rounded inline-flex items-center transition-colors duration-300 ease-in-out">
                            <span class="material-symbols-outlined mr-2"></span>
                            Crear Curso
                        </a>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" wire:click="sortBy('name')"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider cursor-pointer">
                                    Nombre
                                    @if ($sortField === 'name')
                                        @if ($sortDirection === 'asc')
                                            <span>&#9650;</span>
                                        @else
                                            <span>&#9660;</span>
                                        @endif
                                    @endif
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    Fecha de Creación
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-center text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    Usuarios
                                </th>
                                <th scope="col" class="relative px-6 py-3">
                                </th>
                            </tr>
                        </thead>

                        <tbody class="bg-gray-200 divide-y divide-gray-300">
                            @if ($teams->count() > 0)
                                @foreach ($teams as $team)
                                    <tr class="shadow">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $team->name }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-left">
                                            <div class="text-sm text-gray-500">{{ $team->created_at->format('d/m/Y H:i:s') }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <div class="text-sm text-gray-500">{{ $team->users()->count() }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                            <button
                                                class="text-gray-800 hover:text-emerald-500 transition duration-200 ease-in-out text-1xl"
                                                onclick="window.location.href = '{{ route('teams.show', $team->id) }}'">
                                                ajustes
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="12" class="px-6 py-4 whitespace-nowrap">
                                        <p class="text-sm text-gray-500">No hay equipos disponibles</p>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $teams->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>

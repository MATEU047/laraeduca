<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-4xl text-white leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-b from-blue-500 to-purple-700">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="bg-white rounded-lg p-8">
                    <h3 class="text-2xl font-semibold text-gray-800 mb-4">
                        <span class="material-symbols-outlined mr-2 text-green-500"></span> Tus juegos
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div class="bg-gray-200 rounded-lg p-6 shadow-md">
                            <p class="text-xl font-semibold text-gray-800">Memory</p>
                            <div class="flex justify-center items-center mt-4">
                            </div>
                        </div>
                        <div class="bg-gray-200 rounded-lg p-6 shadow-md">
                            <p class="text-xl font-semibold text-gray-800">Orcado</p>
                            <div class="flex justify-center items-center mt-4">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-lg p-8">
                    <h3 class="text-2xl font-semibold text-gray-800 mb-4">
                        <span class="material-symbols-outlined mr-2 text-green-500"></span> Lecciones
                    </h3>
                    <ul class="grid grid-cols-1 gap-6">
                        <li class="bg-gray-200 p-6 rounded-lg shadow-md">
                            <span class="text-xl font-semibold text-gray-800">M7 - PHP</span>
                        </li>
                        <li class="bg-gray-200 p-6 rounded-lg shadow-md">
                            <span class="text-xl font-semibold text-gray-800">M9 - Diseño</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

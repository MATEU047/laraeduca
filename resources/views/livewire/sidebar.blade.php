<div x-data="{ open: false }" class="relative">
    <div id="sidebar" :class="{ 'w-256': open, 'w-16': !open }" class="bg-[#1D1D1D] lg:block shadow-xl">
        <div class="flex flex-col">
            <div class="flex-1 flex flex-col justify-center">
                <div class="flex flex-col content-between">
                    <div>
                        <x-nav-link class="text-lg sidebar-field w-full text-left text-white">
                            <p class="material-symbols-outlined text-3xl ml-2 mr-2">dashboard</p>
                            <p class="sidebar-text">{{ __('Panel') }}</p>
                            <span class="ml-auto" aria-hidden="true">
                                <!-- active class 'rotate-180' -->
                                <svg class="w-4 h-4 transition-transform transform" :class="{ 'rotate-180': open }" @click="open = !open"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </span>
                        </x-nav-link>

                        <!-- Dropdown content -->
                        <div x-show="open" class="transition-transform duration-200 ease-in-out" @click.away="open = false">
                            
                            <x-nav-link class="text-lg sidebar-field sub-sidebar-field w-full text-left border-b-gray-700" href="{{ route('courses') }}" :active="request()->routeIs('courses')">
                                <p class="material-symbols-outlined text-3xl ml-2 mr-2">school</p>
                                <p class="sidebar-text">{{ __('Cursos') }}</p>
                            </x-nav-link>
                        </div>
                    </div>
                    <div x-data="{ open: false }" @click="open = !open" class="relative">
                        <x-nav-link class="text-lg sidebar-field w-full text-left text-white">
                            <p class="material-symbols-outlined text-3xl ml-2 mr-2">shield_person</p>
                            <p class="sidebar-text">{{ __('Administración') }}</p>
                            <span class="ml-auto" aria-hidden="true">
                                <!-- active class 'rotate-180' -->
                                <svg class="w-4 h-4 transition-transform transform" :class="{ 'rotate-180': open }" @click="open = !open"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </span>
                        </x-nav-link>

                        <div x-show="open" class="">
                            <x-nav-link class="text-lg sidebar-field w-full text-left border-b-gray-700" href="{{ route('user-management') }}" :active="request()->routeIs('user-management')">
                                <p class="material-symbols-outlined text-3xl ml-2 mr-2">manage_accounts</p>
                                <p class="sidebar-text">{{ __('Usuarios') }}</p>
                            </x-nav-link>
                        </div>
                    </div>

                    <!-- Otros elementos del sidebar -->

                    <x-nav-link class="text-lg sidebar-field w-full text-left text-white" href="{{ route('student-attendance') }}" :active="request()->routeIs('student-attendance')">
                        <p class="material-symbols-outlined text-3xl ml-2 mr-2">checklist</p>
                        <p class="sidebar-text">{{ __('Asistencia') }}</p>
                    </x-nav-link>

                    <x-nav-link class="text-lg sidebar-field w-full text-left text-white" href="{{ route('tasks') }}" :active="request()->routeIs('tasks')">
                        <p class="material-symbols-outlined text-3xl ml-2 mr-2">description</p>
                        <p class="sidebar-text">{{ __('Tareas') }}</p>
                    </x-nav-link>

                    <x-nav-link class="text-lg sidebar-field w-full text-left text-white" href="{{ route('games') }}" :active="request()->routeIs('games')">
                        <p class="material-symbols-outlined text-3xl ml-2 mr-2">smart_toy</p>
                        <p class="sidebar-text">{{ __('Juegos') }}</p>
                    </x-nav-link>

                    <!-- Elemento de cierre de sesión -->
                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf
                        <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();"
                            class="text-lg sidebar-field w-full text-left text-white">
                            <span class="material-symbols-outlined  text-3xl ml-2 mr-2">logout</span>
                            <p class="sidebar-text">{{ __('Log Out') }} </p>
                        </x-dropdown-link>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <style>
        #sidebar {
            width: 256px;
        }

        #sidebar .sidebar-field {
            padding: 0.7rem;
            overflow: hidden;
        }

        #sidebar .sidebar-field .sidebar-text {
            opacity: 1;
            white-space: nowrap;
        }

        .profile-photo {
            width: 30px;
            height: 30px;
        }

        .sub-sidebar-field {}

        /* Estilos para el efecto de despliegue */
        /* #sidebar:hover {
            width: 300px;
        }

        #sidebar:hover .text-lg .sidebar-text {
            opacity: 1;
        }

        #sidebar .text-lg .sidebar-text {
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
        } */
    </style>
</div>

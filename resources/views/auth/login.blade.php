<x-guest-layout>
    <div class="min-h-screen bg-gradient-to-b from-[#2F8984] to-gray-700 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <div class="text-center">
                <x-authentication-card-logo />
            </div>

            <x-validation-errors class="mb-4" />

            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
                <div class="bg-[#2F8984] py-8 px-6 shadow-xl sm:rounded-lg sm:px-10">
                    <form class="space-y-6" method="POST" action="{{ route('login') }}">
                        @csrf

                        <div>
                            <x-label for="email" :value="__('Email')" class="text-gray-300" />

                            <x-input id="email" class="block mt-1 w-full bg-gray-700 border-gray-600 focus:border-indigo-500 focus:ring-indigo-500 text-gray-300 placeholder-gray-400" type="email" name="email" :value="old('email')" required autofocus />
                        </div>

                        <div>
                            <x-label for="password" :value="__('Password')" class="text-gray-300" />

                            <x-input id="password" class="block mt-1 w-full bg-gray-700 border-gray-600 focus:border-indigo-500 focus:ring-indigo-500 text-gray-300 placeholder-gray-400" type="password" name="password" required autocomplete="current-password" />
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <x-checkbox id="remember_me" name="remember" class="text-indigo-500" />

                                <x-label for="remember_me" class="ml-2 block text-sm text-gray-300" :value="__('Remember me')" />
                            </div>

                            <div class="text-sm">
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="font-medium text-indigo-500 hover:text-indigo-400">
                                        {{ __('Forgot your password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>

                        <div>
                            <x-button class="w-full bg-indigo-600 hover:bg-indigo-500 text-gray-100 hover:text-gray-200" type="submit">
                                {{ __('Log in') }}
                            </x-button>
                        </div>
                    </form>

                    <div class="mt-6">
                        <div class="mt-6">
                            <p class="mt-2 text-center text-sm text-gray-300">
                                {{ __("Don't have an account?") }}
                                <a href="{{ route('register') }}" class="font-medium text-indigo-500 hover:text-indigo-400">
                                    {{ __('Register') }}
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>

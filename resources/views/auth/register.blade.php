<x-guest-layout>
    <div class="min-h-screen bg-gradient-to-b from-[#2F8984] to-gray-700 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <div class="text-center mb-8">
                <x-authentication-card-logo class="h-20 w-auto mx-auto" />
            </div>

            <x-validation-errors class="mb-4" />

            <div class="bg-[#2F8984] rounded-lg p-8 shadow-xl">
                <form method="POST" action="{{ route('register') }}" class="space-y-6">
                    @csrf

                    <div>
                        <x-label for="name" :value="__('Name')" class="text-gray-300" />
                        <x-input id="name" type="text" name="name" :value="old('name')" required autofocus class="block mt-1 w-full rounded-md bg-gray-700 border-gray-600 focus:border-indigo-500 focus:ring-indigo-500 text-gray-300 placeholder-gray-400" />
                    </div>

                    <div>
                        <x-label for="email" :value="__('Email')" class="text-gray-300" />
                        <x-input id="email" type="email" name="email" :value="old('email')" required autocomplete="username" class="block mt-1 w-full rounded-md bg-gray-700 border-gray-600 focus:border-indigo-500 focus:ring-indigo-500 text-gray-300 placeholder-gray-400" />
                    </div>

                    <div>
                        <x-label for="password" :value="__('Password')" class="text-gray-300" />
                        <x-input id="password" type="password" name="password" required autocomplete="new-password" class="block mt-1 w-full rounded-md bg-gray-700 border-gray-600 focus:border-indigo-500 focus:ring-indigo-500 text-gray-300 placeholder-gray-400" />
                    </div>

                    <div>
                        <x-label for="password_confirmation" :value="__('Confirm Password')" class="text-gray-300" />
                        <x-input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" class="block mt-1 w-full rounded-md bg-gray-700 border-gray-600 focus:border-indigo-500 focus:ring-indigo-500 text-gray-300 placeholder-gray-400" />
                    </div>

                    @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                        <div>
                            <x-label for="terms" class="text-gray-300">
                                <div class="flex items-center">
                                    <x-checkbox name="terms" id="terms" required class="text-indigo-500" />

                                    <div class="ms-2">
                                        {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                                'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-300 hover:text-gray-400">'.__('Terms of Service').'</a>',
                                                'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-300 hover:text-gray-400">'.__('Privacy Policy').'</a>',
                                        ]) !!}
                                    </div>
                                </div>
                            </x-label>
                        </div>
                    @endif

                    <div class="flex items-center justify-end mt-4">
                        <a href="{{ route('login') }}" class="text-sm text-gray-300 hover:text-gray-400">{{ __('Already registered?') }}</a>
                        <x-button class="ms-4">{{ __('Register') }}</x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>

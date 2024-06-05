@props(['submit'])

<div {{ $attributes->merge(['class' => 'md:grid md:grid-cols-3 md:gap-6']) }}>
    <div class="bg-gradient-to-br from-[#2F8984] to-[#1D1D1D] p-8 rounded-xl shadow-2xl md:col-span-3">
        <form wire:submit="{{ $submit }}">
            <div class="px-6 py-8 bg-gray-800 bg-opacity-80 rounded-lg shadow-lg">
                <div class="grid grid-cols-6 gap-6">
                    {{ $form }}
                </div>
            </div>

            @if (isset($actions))
                <div class="flex items-center justify-end mt-6">
                    <div class="bg-teal-600 hover:bg-teal-500 text-white font-bold py-2 px-4 rounded-full shadow-lg transition-colors duration-300 ease-in-out">
                        {{ $actions }}
                    </div>
                </div>
            @endif
        </form>
    </div>
</div>

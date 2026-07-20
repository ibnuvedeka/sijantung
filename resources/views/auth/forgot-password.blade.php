<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400 leading-relaxed">
        {{ __('Lupa password? Tidak masalah. Beritahu Agus Jawa Sang Developer.') }}
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full bg-white/50 dark:bg-gray-900/50 backdrop-blur-sm" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-6">
            <button type="submit" class="w-full sm:w-auto px-6 py-2 bg-blue-600 text-white rounded-full font-semibold text-sm hover:bg-blue-500 focus:bg-blue-500 active:bg-blue-700 transition duration-150 ease-in-out shadow-lg shadow-blue-500/30">
                {{ __('Kirim Link Reset Password') }}
            </button>
        </div>

        <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700/50 flex justify-center">
            <a href="{{ url('/') }}" class="inline-flex items-center text-sm text-gray-500 dark:text-gray-400 hover:text-blue-500 dark:hover:text-blue-400 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Beranda
            </a>
        </div>
    </form>
</x-guest-layout>
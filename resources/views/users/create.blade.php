<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Tambah User Baru') }}
            </h2>
            <a href="{{ route('users.index') }}" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">
                &larr; Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-2xl border border-gray-100 dark:border-gray-700 relative">
                <!-- Decorative background blob -->
                <div class="absolute top-0 right-0 -mr-20 -mt-20 w-64 h-64 rounded-full bg-gradient-to-br from-blue-100 to-indigo-100 dark:from-blue-900/20 dark:to-indigo-900/20 opacity-50 blur-3xl pointer-events-none"></div>
                
                <div class="p-8 text-gray-900 dark:text-gray-100 relative z-10">
                    
                    <div class="mb-8 border-b border-gray-100 dark:border-gray-700 pb-4">
                        <h3 class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-indigo-600 dark:from-blue-400 dark:to-indigo-400">Informasi Pengguna Baru</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Silakan lengkapi form di bawah ini untuk menambahkan pengguna ke dalam sistem.</p>
                    </div>
                    
                    <form method="POST" action="{{ route('users.store') }}">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Name -->
                            <div class="mb-2">
                                <label for="name" class="block font-semibold text-sm text-gray-700 dark:text-gray-300 mb-1">Nama Lengkap</label>
                                <input id="name" class="block w-full border-gray-200 dark:border-gray-700 dark:bg-gray-900/50 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring focus:ring-indigo-500/20 rounded-xl shadow-sm transition-all duration-200 py-2.5 px-4" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="Agus Jawa" />
                                @error('name')
                                    <p class="text-sm text-red-600 dark:text-red-400 mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Username -->
                            <div class="mb-2">
                                <label for="username" class="block font-semibold text-sm text-gray-700 dark:text-gray-300 mb-1">Username</label>
                                <input id="username" class="block w-full border-gray-200 dark:border-gray-700 dark:bg-gray-900/50 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring focus:ring-indigo-500/20 rounded-xl shadow-sm transition-all duration-200 py-2.5 px-4" type="text" name="username" value="{{ old('username') }}" required autocomplete="username" placeholder="agusganteng" />
                                @error('username')
                                    <p class="text-sm text-red-600 dark:text-red-400 mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Email Address -->
                        <div class="mb-6 mt-6">
                            <label for="email" class="block font-semibold text-sm text-gray-700 dark:text-gray-300 mb-1">Email</label>
                            <input id="email" class="block w-full border-gray-200 dark:border-gray-700 dark:bg-gray-900/50 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring focus:ring-indigo-500/20 rounded-xl shadow-sm transition-all duration-200 py-2.5 px-4" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="agus@gmail.com" />
                            @error('email')
                                <p class="text-sm text-red-600 dark:text-red-400 mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Role -->
                        <div class="mb-6" x-data="{ open: false, role: '{{ old('role', '') }}' }">
                            <label class="block font-semibold text-sm text-gray-700 dark:text-gray-300 mb-1">Role</label>
                            <div class="relative">
                                <!-- Hidden input for form submission -->
                                <input type="hidden" name="role" x-model="role" required>
                                
                                <!-- Dropdown trigger -->
                                <button type="button" @click="open = !open" @click.away="open = false" 
                                        class="relative w-full border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900/50 text-left cursor-pointer focus:outline-none focus:ring focus:ring-indigo-500/20 focus:border-indigo-500 dark:focus:border-indigo-600 rounded-xl shadow-sm transition-all duration-200 py-2.5 pl-10 pr-10 text-gray-700 dark:text-gray-300">
                                    
                                    <!-- Dynamic Icon Left -->
                                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                        <svg x-show="role === ''" class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4"></path></svg>
                                        <svg x-show="role === 'user'" style="display: none;" class="h-5 w-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                        <svg x-show="role === 'developer'" style="display: none;" class="h-5 w-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                                    </div>
                                    
                                    <!-- Selected Text -->
                                    <span class="block truncate" x-text="role === 'user' ? 'User - Pengguna Standar' : (role === 'developer' ? 'Developer - Akses Penuh Sistem' : 'Pilih Hak Akses...')">
                                        Pilih Hak Akses...
                                    </span>

                                    <!-- Caret Right -->
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-4">
                                        <svg class="h-4 w-4 text-gray-500 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                    </div>
                                </button>

                                <!-- Dropdown Menu -->
                                <div x-show="open" style="display: none;"
                                     x-transition:enter="transition ease-out duration-100"
                                     x-transition:enter-start="transform opacity-0 scale-95"
                                     x-transition:enter-end="transform opacity-100 scale-100"
                                     x-transition:leave="transition ease-in duration-75"
                                     x-transition:leave-start="transform opacity-100 scale-100"
                                     x-transition:leave-end="transform opacity-0 scale-95"
                                     class="absolute z-50 mt-2 w-full rounded-xl bg-white dark:bg-gray-800 shadow-xl border border-gray-100 dark:border-gray-700 overflow-hidden">
                                    <ul class="py-1 text-sm text-gray-700 dark:text-gray-300">
                                        <li>
                                            <button type="button" @click="role = 'user'; open = false" 
                                                    class="flex items-center w-full px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors"
                                                    :class="role === 'user' ? 'bg-indigo-50 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-400 font-medium' : ''">
                                                <svg class="h-5 w-5 mr-3 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                                User - Pengguna Standar
                                            </button>
                                        </li>
                                        <li>
                                            <button type="button" @click="role = 'developer'; open = false" 
                                                    class="flex items-center w-full px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors"
                                                    :class="role === 'developer' ? 'bg-indigo-50 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-400 font-medium' : ''">
                                                <svg class="h-5 w-5 mr-3 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                                                Developer - Akses Penuh Sistem
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            @error('role')
                                <p class="text-sm text-red-600 dark:text-red-400 mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <hr class="my-6 border-gray-200 dark:border-gray-700">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Password -->
                            <div class="mb-2">
                                <label for="password" class="block font-semibold text-sm text-gray-700 dark:text-gray-300 mb-1">Password</label>
                                <input id="password" class="block w-full border-gray-200 dark:border-gray-700 dark:bg-gray-900/50 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring focus:ring-indigo-500/20 rounded-xl shadow-sm transition-all duration-200 py-2.5 px-4" type="password" name="password" required autocomplete="new-password" placeholder="••••••••" />
                                @error('password')
                                    <p class="text-sm text-red-600 dark:text-red-400 mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Confirm Password -->
                            <div class="mb-2">
                                <label for="password_confirmation" class="block font-semibold text-sm text-gray-700 dark:text-gray-300 mb-1">Konfirmasi Password</label>
                                <input id="password_confirmation" class="block w-full border-gray-200 dark:border-gray-700 dark:bg-gray-900/50 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring focus:ring-indigo-500/20 rounded-xl shadow-sm transition-all duration-200 py-2.5 px-4" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />
                                @error('password_confirmation')
                                    <p class="text-sm text-red-600 dark:text-red-400 mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-8 gap-4">
                            <a href="{{ route('users.index') }}" class="px-5 py-2.5 text-gray-600 dark:text-gray-300 font-medium hover:bg-gray-100 dark:hover:bg-gray-700 rounded-xl transition-colors">Batal</a>
                            <button type="submit" class="bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold py-2.5 px-6 rounded-xl shadow-lg shadow-blue-500/30 transition-all duration-300 transform hover:-translate-y-0.5 flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                Simpan Data
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

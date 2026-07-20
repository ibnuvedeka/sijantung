<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manajemen User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-2xl border border-gray-100 dark:border-gray-700">
                <div class="p-8 text-gray-900 dark:text-gray-100">
                    
                    <div class="flex justify-between items-center mb-8">
                        <div>
                            <h3 class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-indigo-600 dark:from-blue-400 dark:to-indigo-400">Daftar Pengguna</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Kelola data pengguna dan hak akses sistem.</p>
                        </div>
                        <a href="{{ route('users.create') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold py-2.5 px-5 rounded-full shadow-lg shadow-blue-500/30 transition-all duration-300 transform hover:-translate-y-1">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            Tambah User
                        </a>
                    </div>

                    <div class="overflow-x-auto rounded-xl border border-gray-200 dark:border-gray-700">
                        <table class="min-w-full bg-white dark:bg-gray-800 w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-50 dark:bg-gray-700/50 text-gray-500 dark:text-gray-400 text-xs uppercase tracking-wider">
                                    <th class="py-4 px-6 font-semibold">No</th>
                                    <th class="py-4 px-6 font-semibold">Pengguna</th>
                                    <th class="py-4 px-6 font-semibold">Username</th>
                                    <th class="py-4 px-6 font-semibold">Role</th>
                                    <th class="py-4 px-6 font-semibold text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 dark:text-gray-300 text-sm divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach($users as $key => $user)
                                <tr class="hover:bg-blue-50/50 dark:hover:bg-gray-700/50 transition-colors duration-200 group">
                                    <td class="py-4 px-6 whitespace-nowrap">
                                        <span class="text-gray-500 font-medium">{{ $users->firstItem() + $key }}</span>
                                    </td>
                                    <td class="py-4 px-6">
                                        <div class="flex items-center gap-3">
                                            <div class="h-10 w-10 rounded-full bg-gradient-to-tr from-blue-500 to-purple-500 flex items-center justify-center text-white font-bold shadow-md">
                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                            </div>
                                            <div>
                                                <p class="font-semibold text-gray-900 dark:text-white">{{ $user->name }}</p>
                                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ $user->email }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6">
                                        <span class="bg-gray-100 dark:bg-gray-700 px-3 py-1 rounded-md text-xs font-mono text-gray-600 dark:text-gray-300 border border-gray-200 dark:border-gray-600">
                                            {{ \Str::limit($user->username, 15) }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-6">
                                        @if($user->role === 'developer')
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-semibold rounded-full bg-purple-50 dark:bg-purple-900/30 text-purple-700 dark:text-purple-400 border border-purple-200 dark:border-purple-800">
                                                <span class="w-1.5 h-1.5 rounded-full bg-purple-500"></span> Developer
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-semibold rounded-full bg-emerald-50 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800">
                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> User
                                            </span>
                                        @endif
                                    </td>
                                    <td class="py-4 px-6 text-center">
                                        <div class="flex items-center justify-center space-x-3">
                                            <a href="{{ route('users.edit', $user->id) }}" class="p-2 text-blue-600 hover:bg-blue-100 dark:hover:bg-blue-900/30 rounded-lg transition-colors tooltip" title="Edit">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                            </a>
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?');" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2 text-red-600 hover:bg-red-100 dark:hover:bg-red-900/30 rounded-lg transition-colors tooltip" title="Hapus">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-4">
                        {{ $users->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SI-JANTUNG') }}</title>
    <link rel="icon" href="{{ asset('images/favicon.png') }}">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800,900&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body { font-family: 'Inter', sans-serif; }
        
        /* Base Background */
        .bg-theme {
            background-color: #ffffff;
            color: #1f2937;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        .dark .bg-theme {
            background-color: #0f172a;
            color: #f8fafc;
        }

        /* Glass Card */
        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.6);
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }
        .dark .glass-card {
            background: rgba(30, 41, 59, 0.6);
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5);
        }

        /* Glass Input */
        .glass-input {
            background: rgba(255, 255, 255, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.8);
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.02);
            color: #1f2937;
            transition: all 0.2s ease;
        }
        .glass-input:focus {
            background: rgba(255, 255, 255, 0.9);
            border-color: #10b981;
            outline: none;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.2);
        }
        .dark .glass-input {
            background: rgba(15, 23, 42, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #f8fafc;
        }
        .dark .glass-input:focus {
            background: rgba(15, 23, 42, 0.8);
            border-color: #10b981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.2);
        }

        /* Glass Button */
        .glass-btn {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            border: none;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
            transition: all 0.2s ease;
        }
        .glass-btn:hover {
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
            transform: translateY(-2px);
        }
        .glass-btn:active {
            transform: translateY(1px);
            box-shadow: 0 2px 10px rgba(16, 185, 129, 0.3);
        }

        /* Checkbox */
        .glass-checkbox {
            appearance: none;
            width: 20px;
            height: 20px;
            border-radius: 6px;
            background: rgba(255, 255, 255, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.8);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
        }
        .dark .glass-checkbox {
            background: rgba(15, 23, 42, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .glass-checkbox:checked {
            background: #10b981;
            border-color: #10b981;
        }
        .glass-checkbox:checked::after {
            content: '✓';
            color: white;
            font-size: 14px;
            font-weight: 800;
        }

        /* Text Colors */
        .text-muted { color: #6b7280; }
        .dark .text-muted { color: #94a3b8; }
        .text-main { color: #1f2937; }
        .dark .text-main { color: #f8fafc; }
        
        /* Blobs animation */
        @keyframes blob {
            0% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
            100% { transform: translate(0px, 0px) scale(1); }
        }
        .animate-blob { animation: blob 7s infinite; }
        .animation-delay-2000 { animation-delay: 2s; }
        .animation-delay-4000 { animation-delay: 4s; }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up {
            animation: fadeInUp 0.4s ease-out forwards;
        }
    </style>
</head>
<body class="antialiased min-h-screen flex items-center justify-center p-4 bg-theme selection:bg-emerald-500/30 overflow-hidden relative">

    <!-- Animated Background Blobs -->
    <div class="fixed inset-0 z-0 pointer-events-none flex items-center justify-center overflow-hidden">
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-yellow-400/20 dark:bg-yellow-400/10 rounded-full mix-blend-multiply dark:mix-blend-lighten filter blur-[80px] animate-blob"></div>
        <div class="absolute top-1/4 right-1/4 w-96 h-96 bg-green-500/20 dark:bg-emerald-500/10 rounded-full mix-blend-multiply dark:mix-blend-lighten filter blur-[80px] animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-32 left-1/3 w-96 h-96 bg-blue-300/20 dark:bg-blue-500/10 rounded-full mix-blend-multiply dark:mix-blend-lighten filter blur-[80px] animate-blob animation-delay-4000"></div>
    </div>

    <!-- Card Container -->
    <div class="w-full max-w-md glass-card rounded-[2.5rem] p-8 md:p-10 relative z-10 flex flex-col justify-center animate-fade-in-up">
        
        <!-- Top icon/logo -->
        <div class="flex justify-center mb-8">
            <div class="w-24 h-24 rounded-full glass-card flex items-center justify-center p-4 shadow-sm">
                <img src="{{ asset('images/logo-sijantung.png') }}" onerror="this.src='{{ asset('images/logo.png') }}'" alt="Logo" class="w-full h-full object-contain opacity-90 drop-shadow-sm">
            </div>
        </div>

        <div class="text-center mb-8">
            <h2 class="text-3xl font-extrabold mb-2 tracking-tight text-main">Selamat Datang!</h2>
            <p class="text-sm text-muted font-medium">Masuk ke akun SI-JANTUNG</p>
        </div>

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <!-- Username -->
            <div>
                <div class="relative group">
                    <input id="username" type="text" name="username" value="{{ old('username') }}" required autofocus
                           class="w-full rounded-xl py-4 px-6 text-main placeholder:text-muted text-sm glass-input" 
                           placeholder="Username">
                    <div class="absolute inset-y-0 right-0 pr-6 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-muted group-focus-within:text-emerald-500 transition-colors" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                </div>
                <x-input-error :messages="$errors->get('username')" class="mt-2 ml-4 text-red-500 text-xs" />
            </div>

            <!-- Password -->
            <div>
                <div class="relative group">
                    <input id="password" type="password" name="password" required autocomplete="current-password"
                           class="w-full rounded-xl py-4 px-6 text-main placeholder:text-muted text-sm glass-input" 
                           placeholder="Password">
                    <div class="absolute inset-y-0 right-0 pr-6 flex items-center cursor-pointer">
                        <svg class="h-5 w-5 text-muted hover:text-main group-focus-within:text-emerald-500 transition-colors" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" onclick="const p=document.getElementById('password');if(p.type==='password'){p.type='text';}else{p.type='password';}">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </div>
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2 ml-4 text-red-500 text-xs" />
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="flex items-center justify-between px-2 pt-1">
                <label for="remember_me" class="flex items-center cursor-pointer group">
                    <input id="remember_me" type="checkbox" class="glass-checkbox" name="remember">
                    <span class="ml-3 text-sm text-muted group-hover:text-main font-medium transition-colors">Ingat saya</span>
                </label>

                <button type="button" onclick="document.getElementById('forgotPasswordModal').classList.remove('hidden')" class="text-sm text-muted hover:text-emerald-500 font-medium transition-colors">
                    Lupa Password?
                </button>
            </div>

            <!-- Submit Button -->
            <div class="pt-6">
                <button type="submit" class="w-full rounded-xl py-4 px-6 glass-btn flex justify-center items-center gap-2 group text-sm tracking-wide font-bold">
                    SIGN IN
                    <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7-7m7 7H3"></path></svg>
                </button>
            </div>
            
            <div class="pt-6 flex justify-center border-t border-gray-200 dark:border-gray-700/50 mt-8">
                <a href="/" class="mt-2 text-xs text-muted hover:text-main font-medium transition-colors inline-flex items-center gap-1 group">
                    <svg class="w-3.5 h-3.5 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali ke Halaman Utama
                </a>
            </div>
        </form>
    </div>

    <!-- Modals -->
    <!-- Forgot Password Modal -->
    <div id="forgotPasswordModal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
        <!-- Backdrop -->
        <div class="absolute inset-0 bg-slate-900/40 dark:bg-slate-900/60 backdrop-blur-sm transition-opacity" onclick="document.getElementById('forgotPasswordModal').classList.add('hidden')"></div>
        
        <!-- Modal Card -->
        <div class="relative glass-card rounded-3xl w-full max-w-sm overflow-hidden transform transition-all z-10 animate-fade-in-up">
            <div class="p-8 text-center relative">
                <!-- Close cross -->
                <button type="button" class="absolute top-5 right-5 text-muted hover:text-main transition-colors w-8 h-8 rounded-full glass-card flex items-center justify-center" onclick="document.getElementById('forgotPasswordModal').classList.add('hidden')">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>

                <div class="w-16 h-16 mx-auto rounded-full glass-card flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                </div>
                <h3 class="text-xl font-extrabold mb-3 text-main">Lupa Password?</h3>
                <p class="text-sm text-muted font-medium leading-relaxed mb-8">
                    Silahkan hubungi admin <span class="font-bold text-emerald-500">ADMIN IBNU</span> untuk mengatur ulang kata sandi Anda.
                </p>
                <div>
                    <button type="button" onclick="document.getElementById('forgotPasswordModal').classList.add('hidden')" class="w-full rounded-xl py-3 px-4 glass-btn text-sm tracking-wide">
                        Mengerti, Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Product Stock Manager') }} &bull; Sign In</title>

    <!-- Google Fonts (Plus Jakarta Sans) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN (Ensures immediate styling without local build delays) & Vite -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#eef2ff',
                            100: '#e0e7ff',
                            500: '#6366f1',
                            600: '#4f46e5',
                            700: '#4338ca',
                        }
                    }
                }
            }
        }
    </script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-50 font-sans antialiased text-slate-800 flex">

    <div class="flex min-h-screen w-full">

        <!-- Left Column: Branding Showcase & Visuals (Hidden on small mobile) -->
        <div class="hidden lg:flex lg:w-1/2 relative bg-gradient-to-br from-indigo-700 via-indigo-600 to-blue-600 p-12 flex-col justify-between overflow-hidden text-white">
            
            <!-- Background Decorative Blobs & Circles -->
            <div class="absolute -right-24 -top-24 w-96 h-96 rounded-full bg-white/10 blur-2xl pointer-events-none"></div>
            <div class="absolute -left-20 -bottom-20 w-96 h-96 rounded-full bg-indigo-900/40 blur-3xl pointer-events-none"></div>
            <div class="absolute inset-0 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:24px_24px] opacity-10 pointer-events-none"></div>

            <!-- Top Header in Showcase -->
            <div class="relative z-10 flex items-center gap-3">
                <div class="w-11 h-11 rounded-xl bg-white/15 backdrop-blur-md border border-white/20 flex items-center justify-center shadow-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                </div>
                <span class="text-xl font-bold tracking-tight text-white">Product Stock Manager</span>
            </div>

            <!-- Middle Feature Showcase Card -->
            <div class="relative z-10 my-auto max-w-lg">
                {{-- <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/15 backdrop-blur-md border border-white/20 text-xs font-medium text-indigo-100 mb-6">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    Smart Inventory Control 2.0
                </div>

                <h1 class="text-4xl xl:text-5xl font-extrabold tracking-tight leading-tight text-white mb-6">
                    Master your warehouse & inventory in real-time.
                </h1> --}}
                
                {{-- <p class="text-base text-indigo-100/90 leading-relaxed font-normal mb-8">
                    Gain full visibility over products, stock adjustments, incoming shipments, and automated tracking with zero hassle.
                </p> --}}

                <!-- Mini Floating Analytics Card -->
                <div class="backdrop-blur-md bg-white/10 border border-white/20 p-5 rounded-2xl shadow-xl space-y-3">
                    <div class="flex items-center justify-between text-xs font-semibold text-indigo-100">
                        <span>LIVE STOCK OVERVIEW</span>
                        <span class="text-emerald-300 font-bold">+18.4% today</span>
                    </div>
                    <div class="grid grid-cols-3 gap-3 pt-1">
                        <div class="bg-black/10 rounded-xl p-3 border border-white/10">
                            <div class="text-xs text-indigo-200">Total Listed</div>
                            <div class="text-lg font-bold text-white mt-0.5">10+ items</div>
                        </div>
                        <div class="bg-black/10 rounded-xl p-3 border border-white/10">
                            <div class="text-xs text-indigo-200">Low Stock</div>
                            <div class="text-lg font-bold text-amber-300 mt-0.5">3 items</div>
                        </div>
                        <div class="bg-black/10 rounded-xl p-3 border border-white/10">
                            <div class="text-xs text-indigo-200">Accuracy</div>
                            <div class="text-lg font-bold text-emerald-300 mt-0.5">99.8%</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Showcase Bottom Guarantee -->
            {{-- <div class="relative z-10 flex items-center justify-between text-xs text-indigo-200/80 pt-4 border-t border-white/10">
                <span>&copy; {{ date('Y') }} Inventory System.</span>
                <span>Fast &bull; Secure &bull; Reliable</span>
            </div> --}}
        </div>

        <!-- Right Column: Login Form -->
        <div class="w-full lg:w-1/2 flex flex-col justify-between p-6 sm:p-12 lg:p-16 bg-white overflow-y-auto">
            
            <!-- Mobile Brand Header (shows only on mobile) -->
            <div class="lg:hidden flex items-center gap-2.5 mb-8">
                <div class="w-10 h-10 rounded-xl bg-indigo-600 flex items-center justify-center text-white shadow-md shadow-indigo-600/30">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                </div>
                <span class="text-xl font-bold tracking-tight text-slate-900">Product Stock Manager</span>
            </div>

            <div class="max-w-md w-full mx-auto my-auto">
                
                <div class="mb-8">
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                        Welcome back!
                    </h2>
                    <p class="mt-2 text-sm text-slate-500 font-normal">
                        Please enter your account details to access the dashboard.
                    </p>
                </div>

                <!-- Session Alert -->
                @if (session('status'))
                    <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-medium flex items-center gap-3">
                        <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>{{ session('status') }}</span>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <!-- Email Input -->
                    <div>
                        <label for="email" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-2">
                            Email address
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                </svg>
                            </div>
                            <input id="email" 
                                   name="email" 
                                   type="email" 
                                   value="{{ old('email') }}" 
                                   required 
                                   autofocus 
                                   autocomplete="username" 
                                   placeholder="you@company.com" 
                                   class="w-full pl-11 pr-4 py-3 rounded-xl border @error('email') border-rose-300 bg-rose-50/30 text-rose-900 focus:border-rose-500 focus:ring-rose-500/20 @else border-slate-200 bg-slate-50/50 text-slate-900 focus:border-indigo-600 focus:bg-white focus:ring-4 focus:ring-indigo-600/10 @enderror text-sm font-medium transition duration-200 outline-none">
                        </div>
                        @error('email')
                            <p class="mt-2 text-xs font-semibold text-rose-600 flex items-center gap-1.5">
                                <svg class="w-4 h-4 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                <span>{{ $message }}</span>
                            </p>
                        @enderror
                    </div>

                    <!-- Password Input -->
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <label for="password" class="block text-xs font-bold uppercase tracking-wider text-slate-600">
                                Password
                            </label>
                            @if (Route::has('password.request'))
                                {{-- <a href="{{ route('password.request') }}" class="text-xs font-semibold text-indigo-600 hover:text-indigo-700 transition">
                                    Forgot password?
                                </a> --}}
                            @endif
                        </div>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <input id="password" 
                                   name="password" 
                                   type="password" 
                                   required 
                                   autocomplete="current-password" 
                                   placeholder="Enter your password" 
                                   class="w-full pl-11 pr-11 py-3 rounded-xl border @error('password') border-rose-300 bg-rose-50/30 text-rose-900 focus:border-rose-500 focus:ring-rose-500/20 @else border-slate-200 bg-slate-50/50 text-slate-900 focus:border-indigo-600 focus:bg-white focus:ring-4 focus:ring-indigo-600/10 @enderror text-sm font-medium transition duration-200 outline-none">
                            
                            <!-- Toggle Button -->
                            <button type="button" 
                                    onclick="const el = document.getElementById('password'); el.type = el.type === 'password' ? 'text' : 'password';"
                                    class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600 focus:outline-none">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <p class="mt-2 text-xs font-semibold text-rose-600 flex items-center gap-1.5">
                                <svg class="w-4 h-4 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                <span>{{ $message }}</span>
                            </p>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    {{-- <div class="flex items-center justify-between pt-1">
                        <label for="remember_me" class="inline-flex items-center cursor-pointer select-none">
                            <input id="remember_me" 
                                   name="remember" 
                                   type="checkbox" 
                                   class="w-4 h-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500 cursor-pointer">
                            <span class="ml-2 text-xs font-medium text-slate-600">Keep me logged in</span>
                        </label>
                    </div> --}}

                    <!-- Submit Button -->
                    <div>
                        <button type="submit" 
                                class="w-full inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 active:bg-indigo-800 text-white font-semibold text-sm shadow-lg shadow-indigo-600/30 hover:shadow-indigo-600/40 transition duration-200 focus:outline-none focus:ring-4 focus:ring-indigo-600/20">
                            <span>Sign into Dashboard</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </button>
                    </div>

                </form>

                @if (Route::has('register'))
                    {{-- <div class="mt-8 text-center text-xs text-slate-500">
                        Don't have an account yet? 
                        <a href="{{ route('register') }}" class="font-bold text-indigo-600 hover:text-indigo-700 hover:underline ml-1">
                            Register new account
                        </a>
                    </div> --}}
                @endif

            </div>

            <!-- Bottom Note -->
            {{-- <div class="text-center text-xs text-slate-400 mt-8">
                Protected by MatrixBricks Inventory Security System.
            </div> --}}

        </div>

    </div>

</body>
</html>

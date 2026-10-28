<nav x-data="{ open: false }" class="bg-white/95 backdrop-blur-md border-b border-slate-200/80 sticky top-0 z-40">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center gap-8">
                <!-- Brand Logo -->
                <a href="{{ route('products.index') }}" class="flex items-center gap-2.5 group">
                    <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-indigo-600 to-indigo-500 flex items-center justify-center text-white shadow-md shadow-indigo-600/25 group-hover:scale-105 transition-transform duration-200">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                    <span class="text-lg font-black tracking-tight text-slate-900 group-hover:text-indigo-600 transition-colors">
                        Product Stock Manager
                    </span>
                </a>

                <!-- Navigation Links -->
                <div class="hidden space-x-2 sm:flex items-center">
                    <a href="{{ route('products.index') }}" 
                       class="px-3.5 py-2 rounded-xl text-xs font-bold transition-all {{ request()->routeIs('products.*') ? 'bg-indigo-50 text-indigo-700 font-extrabold shadow-xs' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100' }}">
                        Products
                    </a>
                    <a href="{{ route('categories.index') }}" 
                       class="px-3.5 py-2 rounded-xl text-xs font-bold transition-all {{ request()->routeIs('categories.*') ? 'bg-indigo-50 text-indigo-700 font-extrabold shadow-xs' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100' }}">
                        Categories
                    </a>
                </div>
            </div>

            <!-- Settings / User Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center gap-2.5 px-3 py-1.5 rounded-xl border border-slate-200 bg-white text-xs font-bold text-slate-700 hover:bg-slate-50 focus:outline-none transition shadow-xs">
                            <div class="w-6 h-6 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center text-[11px] font-black uppercase">
                                {{ substr(Auth::user()->name ?? 'U', 0, 1) }}
                            </div>
                            <span>{{ Auth::user()->name }}</span>

                            <svg class="h-3.5 w-3.5 text-slate-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-4 py-2 border-b border-slate-100 text-[11px] text-slate-500 font-medium">
                            Signed in as <span class="font-bold text-slate-800">{{ Auth::user()->email }}</span>
                        </div>

                        <x-dropdown-link :href="route('profile.edit')" class="text-xs font-semibold text-slate-700">
                            {{-- Profile Settings --}}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();"
                                    class="text-xs font-semibold text-rose-600 hover:bg-rose-50">
                                Log Out
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger Button (Mobile) -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-xl text-slate-500 hover:text-slate-700 hover:bg-slate-100 focus:outline-none transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Mobile Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden border-t border-slate-200 bg-white px-4 pt-3 pb-4 space-y-2">
        <a href="{{ route('products.index') }}" 
           class="block px-3 py-2 rounded-xl text-sm font-semibold {{ request()->routeIs('products.*') ? 'bg-indigo-50 text-indigo-700 font-bold' : 'text-slate-700 hover:bg-slate-50' }}">
            Products
        </a>
        <a href="{{ route('categories.index') }}" 
           class="block px-3 py-2 rounded-xl text-sm font-semibold {{ request()->routeIs('categories.*') ? 'bg-indigo-50 text-indigo-700 font-bold' : 'text-slate-700 hover:bg-slate-50' }}">
            Categories
        </a>

        <div class="pt-3 border-t border-slate-100 mt-2">
            <div class="text-xs font-bold text-slate-800">{{ Auth::user()->name }}</div>
            <div class="text-xs text-slate-400 mb-2">{{ Auth::user()->email }}</div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left text-xs font-bold text-rose-600 py-1.5 hover:underline">
                    Log Out
                </button>
            </form>
        </div>
    </div>
</nav>

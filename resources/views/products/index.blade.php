@extends('layouts.app')

@section('content')
<div class="space-y-8 pb-12">

    {{-- Top Hero / Header Section --}}
    <div class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-slate-900 via-indigo-950 to-slate-900 p-6 sm:p-8 text-white shadow-xl">
        <div class="absolute -right-10 -top-10 h-64 w-64 rounded-full bg-indigo-500/10 blur-3xl pointer-events-none"></div>
        <div class="absolute -left-10 -bottom-10 h-64 w-64 rounded-full bg-blue-500/10 blur-3xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 backdrop-blur-sm border border-white/10 text-xs font-semibold text-indigo-200 mb-3">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    Live Inventory Status
                </div>
                <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-white">
                    Products & Stock Catalog
                </h1>
                <p class="mt-1 text-sm text-slate-300 max-w-xl">
                    Track item availability, unit prices, category classification, and quick stock in/out operations.
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-3">
                <a href="{{ route('categories.index') }}"
                   class="inline-flex items-center gap-2 rounded-xl bg-white/10 backdrop-blur-md px-4 py-2.5 text-sm font-semibold text-white border border-white/15 hover:bg-white/20 transition-all duration-200 shadow-sm">
                    <svg class="w-4 h-4 text-indigo-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    <span>Categories</span>
                </a>

                <a href="{{ route('products.create') }}"
                   class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-indigo-500 to-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-indigo-500/25 hover:from-indigo-600 hover:to-indigo-700 hover:shadow-indigo-500/40 transition-all duration-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    <span>Add New Product</span>
                </a>
            </div>
        </div>

        {{-- Quick Stats Banner inside Header --}}
        <div class="relative z-10 mt-6 grid grid-cols-2 gap-4 border-t border-white/10 pt-5 sm:grid-cols-4">
            <div class="bg-white/5 rounded-xl p-3 backdrop-blur-sm border border-white/5">
                <div class="text-xs text-slate-400 font-medium">Total Listed</div>
                <div class="text-xl font-bold text-white mt-0.5">{{ $products->total() }} items</div>
            </div>
            <div class="bg-white/5 rounded-xl p-3 backdrop-blur-sm border border-white/5">
                <div class="text-xs text-slate-400 font-medium">Low Stock Warning</div>
                <div class="text-xl font-bold text-rose-300 mt-0.5">
                    {{ $products->filter(fn($p) => $p->stock < 5)->count() }} items &lt; 5
                </div>
            </div>
            <div class="bg-white/5 rounded-xl p-3 backdrop-blur-sm border border-white/5">
                <div class="text-xs text-slate-400 font-medium">Healthy Inventory</div>
                <div class="text-xl font-bold text-emerald-300 mt-0.5">
                    {{ $products->filter(fn($p) => $p->stock >= 5)->count() }} items
                </div>
            </div>
            <div class="bg-white/5 rounded-xl p-3 backdrop-blur-sm border border-white/5">
                <div class="text-xs text-slate-400 font-medium">Categories</div>
                <div class="text-xl font-bold text-indigo-300 mt-0.5">{{ count($categories) }} active</div>
            </div>
        </div>
    </div>

    {{-- Notification Alerts --}}
    @if (session('success'))
        <div role="status" class="flex items-center justify-between rounded-xl border border-emerald-200 bg-emerald-50/80 px-4 py-3.5 text-sm text-emerald-800 shadow-sm backdrop-blur">
            <div class="flex items-center gap-3">
                <div class="flex h-7 w-7 items-center justify-center rounded-lg bg-emerald-100 text-emerald-600 shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
            <button type="button" onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700 text-lg leading-none font-bold">
                &times;
            </button>
        </div>
    @endif

    @if (session('error'))
        <div role="alert" class="flex items-center justify-between rounded-xl border border-rose-200 bg-rose-50 px-4 py-3.5 text-sm text-rose-800 shadow-sm">
            <div class="flex items-center gap-3">
                <div class="flex h-7 w-7 items-center justify-center rounded-lg bg-rose-100 text-rose-600 shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>
                <span class="font-medium">{{ session('error') }}</span>
            </div>
            <button type="button" onclick="this.parentElement.remove()" class="text-rose-500 hover:text-rose-700 text-lg leading-none font-bold">
                &times;
            </button>
        </div>
    @endif

    @if ($errors->any())
        <div role="alert" class="rounded-xl border border-rose-200 bg-rose-50/90 p-4 text-sm text-rose-800 shadow-sm">
            <p class="font-bold flex items-center gap-2 mb-2">
                <svg class="w-4 h-4 text-rose-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                </svg>
                Please fix the following issues:
            </p>
            <ul class="list-disc list-inside space-y-1 text-xs text-rose-700 ml-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Search & Filter Toolbar --}}
    <div class="rounded-2xl border border-slate-200/80 bg-white p-5 shadow-sm">
        <form method="GET" action="{{ route('products.index') }}" class="grid grid-cols-1 gap-4 lg:grid-cols-12 items-end">
            
            <!-- Search bar -->
            <div class="lg:col-span-5">
                <label for="search" class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-1.5">
                    Search Inventory
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input type="text"
                           id="search"
                           name="search"
                           value="{{ request('search') }}"
                           placeholder="Type product name, SKU or ID..."
                           class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-sm text-slate-800 placeholder-slate-400 focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition outline-none">
                </div>
            </div>

            <!-- Category filter -->
            <div class="lg:col-span-4">
                <label for="category_id" class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-1.5">
                    Filter by Category
                </label>
                <div class="relative">
                    <select id="category_id"
                            name="category_id"
                            class="w-full pl-3.5 pr-8 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-sm text-slate-800 focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition outline-none appearance-none">
                        <option value="">All Categories</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected((string) request('category_id') === (string) $category->id)>
                                {{ $category->category_name }}
                            </option>
                        @endforeach
                    </select>
                    <div class="absolute inset-y-0 right-0 pr-3.5 flex items-center pointer-events-none text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Action buttons -->
            <div class="flex items-center gap-2 lg:col-span-3">
                <button type="submit"
                        class="flex-1 inline-flex items-center justify-center gap-2 rounded-xl bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-slate-800 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                    </svg>
                    <span>Apply</span>
                </button>

                <a href="{{ route('products.index') }}"
                   class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-600 hover:bg-slate-50 transition"
                   title="Reset filter">
                    Reset
                </a>
            </div>
        </form>
    </div>

    {{-- Modern Data Table Card --}}
    <div class="rounded-2xl border border-slate-200/80 bg-white shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-slate-200 bg-slate-50/75 text-[11px] font-bold uppercase tracking-wider text-slate-500">
                        <th class="py-4 pl-6 pr-3">Product Name & ID</th>
                        <th class="py-4 px-4">Category</th>
                        <th class="py-4 px-4">Price</th>
                        <th class="py-4 px-4">Stock Level</th>
                        <th class="py-4 pl-4 pr-6 text-right">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100 text-sm">
                    @forelse ($products as $product)
                        <tr class="hover:bg-indigo-50/30 transition-colors group">
                            
                            {{-- Product Name + ID Tag --}}
                            <td class="py-4 pl-6 pr-3">
                                <div class="flex items-center gap-3">
                                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-gradient-to-tr from-slate-100 to-indigo-50 text-indigo-600 font-bold text-xs border border-indigo-100/80 shadow-xs">
                                        #{{ $product->id }}
                                    </div>
                                    <div>
                                        <a href="{{ route('products.show', $product) }}" class="font-bold text-slate-900 group-hover:text-indigo-600 transition">
                                            {{ $product->name }}
                                        </a>
                                        <p class="text-xs text-slate-400 mt-0.5">
                                            SKU: {{ $product->sku ?? 'PRD-'.str_pad($product->id, 5, '0', STR_PAD_LEFT) }}
                                        </p>
                                    </div>
                                </div>
                            </td>

                            {{-- Category Badge --}}
                            <td class="py-4 px-4">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold bg-slate-100 text-slate-700 border border-slate-200/60">
                                    {{ $product->category?->category_name ?? 'Unassigned' }}
                                </span>
                            </td>

                            {{-- Price --}}
                            <td class="py-4 px-4 font-bold text-slate-900">
                                ₹{{ number_format((float) $product->price, 2) }}
                            </td>

                            {{-- Stock Indicator Pill --}}
                            <td class="py-4 px-4">
                                @if ($product->stock < 1)
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-rose-50 text-rose-700 border border-rose-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-rose-600"></span>
                                        Out of stock
                                    </span>
                                @elseif ($product->stock < 5)
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-rose-50 text-rose-700 border border-rose-200">
                                        <span class="relative flex h-2 w-2">
                                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-rose-400 opacity-75"></span>
                                            <span class="relative inline-flex rounded-full h-2 w-2 bg-rose-600"></span>
                                        </span>
                                        {{ $product->stock }} left - Low Stock
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        {{ $product->stock }} in stock
                                    </span>
                                @endif
                            </td>

                            {{-- Quick Actions --}}
                            <td class="py-4 pl-4 pr-6 text-right">
                                <div class="inline-flex items-center justify-end gap-1.5">
                                    
                                    {{-- View --}}
                                    <a href="{{ route('products.show', $product) }}"
                                       title="View details"
                                       class="p-2 rounded-lg text-slate-500 hover:text-indigo-600 hover:bg-indigo-50 transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </a>

                                    {{-- Edit --}}
                                    <a href="{{ route('products.edit', $product) }}"
                                       title="Edit item"
                                       class="p-2 rounded-lg text-slate-500 hover:text-amber-600 hover:bg-amber-50 transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>

                                    {{-- Stock In Modal Trigger --}}
                                    <div x-data="{ open: false }" class="inline-block">
                                        <button type="button"
                                                @click="open = true"
                                                title="Add incoming stock"
                                                class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-lg text-xs font-semibold bg-emerald-50 text-emerald-700 hover:bg-emerald-100 transition">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                                            </svg>
                                            <span>In</span>
                                        </button>

                                        <template x-teleport="body">
                                            <div x-cloak
                                                 x-show="open"
                                                 @keydown.escape.window="open = false"
                                                 @click.self="open = false"
                                                 class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/60 backdrop-blur-sm p-4">

                                                <div x-show="open"
                                                     x-transition
                                                     class="w-full max-w-md rounded-2xl bg-white shadow-2xl border border-slate-100 overflow-hidden">

                                                    <form action="{{ route('products.stock-in', $product) }}" method="POST">
                                                        @csrf

                                                        <div class="flex items-center justify-between border-b border-slate-100 px-6 py-4 bg-slate-50/50">
                                                            <div class="flex items-center gap-3">
                                                                <div class="w-9 h-9 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center">
                                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                                                    </svg>
                                                                </div>
                                                                <div>
                                                                    <h3 class="text-base font-bold text-slate-900">Stock In Addition</h3>
                                                                    <p class="text-xs text-slate-500">{{ $product->name }}</p>
                                                                </div>
                                                            </div>
                                                            <button type="button" @click="open = false" class="text-slate-400 hover:text-slate-600 text-2xl font-light">&times;</button>
                                                        </div>

                                                        <div class="p-6 space-y-4">
                                                            <div class="flex items-center justify-between p-3 rounded-xl bg-slate-50 border border-slate-100 text-xs">
                                                                <span class="text-slate-500">Current available quantity</span>
                                                                <span class="font-bold text-slate-800 text-sm">{{ $product->stock }} units</span>
                                                            </div>

                                                            <div>
                                                                <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">
                                                                    Quantity to Add
                                                                </label>
                                                                <input type="number"
                                                                       name="qty"
                                                                       min="1"
                                                                       step="1"
                                                                       placeholder="e.g. 50"
                                                                       required
                                                                       class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 text-sm outline-none">
                                                            </div>

                                                            <div>
                                                                <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">
                                                                    Note (Optional)
                                                                </label>
                                                                <textarea name="note"
                                                                          rows="3"
                                                                          placeholder="Supplier name, invoice # or reason..."
                                                                          class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 text-sm outline-none"></textarea>
                                                            </div>
                                                        </div>

                                                        <div class="flex justify-end gap-2 px-6 py-4 border-t border-slate-100 bg-slate-50/50">
                                                            <button type="button" @click="open = false" class="px-4 py-2 rounded-xl text-sm font-semibold text-slate-600 hover:bg-slate-100">
                                                                Cancel
                                                            </button>
                                                            <button type="submit" class="px-5 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-sm shadow-md shadow-emerald-600/20">
                                                                Confirm Stock In
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </template>
                                    </div>

                                    {{-- Stock Out Modal Trigger --}}
                                    <div x-data="{ open: false }" class="inline-block">
                                        <button type="button"
                                                @click="open = true"
                                                @disabled($product->stock < 1)
                                                title="Record items dispatched"
                                                class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-lg text-xs font-semibold bg-amber-50 text-amber-700 hover:bg-amber-100 disabled:opacity-40 disabled:cursor-not-allowed transition">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M20 12H4" />
                                            </svg>
                                            <span>Out</span>
                                        </button>

                                        <template x-teleport="body">
                                            <div x-cloak
                                                 x-show="open"
                                                 @keydown.escape.window="open = false"
                                                 @click.self="open = false"
                                                 class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/60 backdrop-blur-sm p-4">

                                                <div x-show="open"
                                                     x-transition
                                                     class="w-full max-w-md rounded-2xl bg-white shadow-2xl border border-slate-100 overflow-hidden">

                                                    <form action="{{ route('products.stock-out', $product) }}" method="POST">
                                                        @csrf

                                                        <div class="flex items-center justify-between border-b border-slate-100 px-6 py-4 bg-slate-50/50">
                                                            <div class="flex items-center gap-3">
                                                                <div class="w-9 h-9 rounded-xl bg-amber-100 text-amber-600 flex items-center justify-center">
                                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                                                                    </svg>
                                                                </div>
                                                                <div>
                                                                    <h3 class="text-base font-bold text-slate-900">Stock Out Deduction</h3>
                                                                    <p class="text-xs text-slate-500">{{ $product->name }}</p>
                                                                </div>
                                                            </div>
                                                            <button type="button" @click="open = false" class="text-slate-400 hover:text-slate-600 text-2xl font-light">&times;</button>
                                                        </div>

                                                        <div class="p-6 space-y-4">
                                                            <div class="flex items-center justify-between p-3 rounded-xl bg-slate-50 border border-slate-100 text-xs">
                                                                <span class="text-slate-500">Maximum available to deduct</span>
                                                                <span class="font-bold text-amber-600 text-sm">{{ $product->stock }} units</span>
                                                            </div>

                                                            <div>
                                                                <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">
                                                                    Quantity to Remove
                                                                </label>
                                                                <input type="number"
                                                                       name="qty"
                                                                       min="1"
                                                                       max="{{ $product->stock }}"
                                                                       step="1"
                                                                       placeholder="e.g. 10"
                                                                       required
                                                                       class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 text-sm outline-none">
                                                            </div>

                                                            <div>
                                                                <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">
                                                                    Reason / Note (Optional)
                                                                </label>
                                                                <textarea name="note"
                                                                          rows="3"
                                                                          placeholder="Sales order, damaged, returned..."
                                                                          class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 text-sm outline-none"></textarea>
                                                            </div>
                                                        </div>

                                                        <div class="flex justify-end gap-2 px-6 py-4 border-t border-slate-100 bg-slate-50/50">
                                                            <button type="button" @click="open = false" class="px-4 py-2 rounded-xl text-sm font-semibold text-slate-600 hover:bg-slate-100">
                                                                Cancel
                                                            </button>
                                                            <button type="submit" class="px-5 py-2 rounded-xl bg-amber-600 hover:bg-amber-700 text-white font-semibold text-sm shadow-md shadow-amber-600/20">
                                                                Deduct Stock
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </template>
                                    </div>

                                    {{-- Delete Item --}}
                                    <form action="{{ route('products.destroy', $product) }}"
                                          method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete this product?')"
                                          class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                title="Delete"
                                                class="p-2 rounded-lg text-slate-400 hover:text-rose-600 hover:bg-rose-50 transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-16 text-center">
                                <div class="w-16 h-16 rounded-2xl bg-indigo-50 text-indigo-500 flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                    </svg>
                                </div>
                                <h3 class="text-base font-bold text-slate-800">No products match your criteria</h3>
                                <p class="text-sm text-slate-400 mt-1 max-w-sm mx-auto">
                                    Try refining your search keyword or clearing the category filter.
                                </p>
                                <a href="{{ route('products.create') }}"
                                   class="mt-5 inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow hover:bg-indigo-700 transition">
                                    <span>Add First Product</span>
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Modern Pagination --}}
    <div class="pt-2">
        {{ $products->withQueryString()->links() }}
    </div>

</div>
@endsection
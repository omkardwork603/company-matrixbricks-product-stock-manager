@extends('layouts.app')

@section('content')
<div class="space-y-8 pb-12 max-w-6xl mx-auto">

    {{-- Breadcrumb & Navigation --}}
    <div class="flex items-center justify-between">
        <a href="{{ route('products.index') }}"
           class="inline-flex items-center gap-2 text-xs font-bold text-slate-500 hover:text-indigo-600 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            <span>Back to Products</span>
        </a>

        <div class="flex items-center gap-2">
            <a href="{{ route('products.edit', $product) }}"
               class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-amber-500 hover:bg-amber-600 text-white font-semibold text-xs shadow-sm transition">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                <span>Edit Product</span>
            </a>
        </div>
    </div>

    {{-- Hero Product Banner --}}
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-slate-900 via-indigo-950 to-slate-900 p-8 text-white shadow-xl">
        <div class="absolute -right-10 -top-10 h-64 w-64 rounded-full bg-indigo-500/10 blur-3xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div class="flex items-center gap-5">
                <div class="w-20 h-20 rounded-2xl bg-gradient-to-tr from-indigo-500/30 to-violet-500/20 backdrop-blur-md border border-white/20 flex items-center justify-center text-indigo-300 shadow-lg">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                </div>
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 text-xs font-semibold text-indigo-200 mb-2">
                        Product #{{ $product->id }} &bull; {{ $product->category?->category_name ?? 'Uncategorized' }}
                    </div>
                    <h1 class="text-3xl font-black text-white tracking-tight">
                        {{ $product->name }}
                    </h1>
                    <p class="text-xs text-slate-300 mt-1">
                        Listed on {{ $product->created_at?->format('d M Y, h:i A') ?? 'N/A' }}
                    </p>
                </div>
            </div>

            <!-- Price & Stock Highlights -->
            <div class="flex items-center gap-4 bg-white/5 backdrop-blur-md border border-white/10 rounded-2xl p-4">
                <div class="pr-4 border-r border-white/10">
                    <div class="text-[11px] uppercase tracking-wider text-slate-400 font-bold">Unit Price</div>
                    <div class="text-2xl font-black text-white mt-0.5">
                        ₹{{ number_format((float) $product->price, 2) }}
                    </div>
                </div>
                <div>
                    <div class="text-[11px] uppercase tracking-wider text-slate-400 font-bold">Stock Status</div>
                    <div class="mt-1">
                        @if ($product->stock < 1)
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-rose-500/20 text-rose-300 border border-rose-500/30">
                                <span class="w-1.5 h-1.5 rounded-full bg-rose-400"></span>
                                Out of Stock
                            </span>
                        @elseif ($product->stock < 5)
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-rose-500/20 text-rose-300 border border-rose-500/30">
                                <span class="relative flex h-2 w-2">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-rose-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-2 w-2 bg-rose-500"></span>
                                </span>
                                {{ $product->stock }} (Low Stock)
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-500/20 text-emerald-300 border border-emerald-500/30">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                                {{ $product->stock }} in stock
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Details Card --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        
        {{-- Product Specs --}}
        <div class="md:col-span-1 bg-white rounded-2xl border border-slate-200/80 p-6 shadow-sm space-y-4">
            <h2 class="text-sm font-bold uppercase tracking-wider text-slate-900 border-b border-slate-100 pb-3">
                Item Information
            </h2>

            <div>
                <span class="text-xs text-slate-400 font-medium">Category</span>
                <p class="text-sm font-bold text-slate-800 mt-0.5">
                    {{ $product->category?->category_name ?? 'None' }}
                </p>
            </div>

            <div>
                <span class="text-xs text-slate-400 font-medium">Internal SKU</span>
                <p class="text-sm font-bold text-slate-800 mt-0.5">
                    {{ $product->sku ?? 'PRD-'.str_pad($product->id, 5, '0', STR_PAD_LEFT) }}
                </p>
            </div>

            <div>
                <span class="text-xs text-slate-400 font-medium">Unit Price</span>
                <p class="text-sm font-bold text-indigo-600 mt-0.5">
                    ₹{{ number_format((float) $product->price, 2) }}
                </p>
            </div>

            <div>
                <span class="text-xs text-slate-400 font-medium">Last Modified</span>
                <p class="text-xs text-slate-600 mt-0.5">
                    {{ $product->updated_at?->format('d M Y, h:i A') ?? '—' }}
                </p>
            </div>
        </div>

        {{-- Stock Movement History Log --}}
        <div class="md:col-span-2 bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-slate-100 flex items-center justify-between">
                <div>
                    <h2 class="text-base font-bold text-slate-900">Stock Movement Audit Log</h2>
                    <p class="text-xs text-slate-400 mt-0.5">Recent stock additions and deductions</p>
                </div>
                <span class="text-xs font-bold text-slate-500 bg-slate-100 px-3 py-1 rounded-full">
                    {{ $product->stockMovements->count() }} movements
                </span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-slate-200 bg-slate-50/75 text-[11px] font-bold uppercase tracking-wider text-slate-500">
                            <th class="py-3.5 pl-6 pr-3">Timestamp</th>
                            <th class="py-3.5 px-4">Type</th>
                            <th class="py-3.5 px-4">Quantity</th>
                            <th class="py-3.5 pl-4 pr-6">Reason / Note</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-xs">
                        @forelse ($product->stockMovements as $movement)
                            <tr class="hover:bg-slate-50/80 transition-colors">
                                <td class="py-3.5 pl-6 pr-3 text-slate-600 font-medium whitespace-nowrap">
                                    {{ $movement->created_at?->format('d M Y, h:i A') ?? '—' }}
                                </td>
                                <td class="py-3.5 px-4">
                                    @if ($movement->type === 'in')
                                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                            + Stock In
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full font-bold bg-rose-50 text-rose-700 border border-rose-200">
                                            - Stock Out
                                        </span>
                                    @endif
                                </td>
                                <td class="py-3.5 px-4 font-bold text-slate-900">
                                    {{ $movement->quantity }} units
                                </td>
                                <td class="py-3.5 pl-4 pr-6 text-slate-500">
                                    {{ $movement->note ?: 'No note provided' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-12 text-center text-slate-400">
                                    No stock transaction history recorded yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</div>
@endsection
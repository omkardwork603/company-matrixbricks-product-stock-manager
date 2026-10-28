@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-6 sm:py-10 space-y-6">

    {{-- Breadcrumb back link --}}
    <div>
        <a href="{{ route('categories.index') }}"
           class="inline-flex items-center gap-2 text-xs font-bold text-slate-500 hover:text-indigo-600 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            <span>Back to Categories</span>
        </a>
    </div>

    {{-- Detail Banner --}}
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-slate-900 via-indigo-950 to-slate-900 p-8 text-white shadow-xl">
        <div class="absolute -right-10 -top-10 h-64 w-64 rounded-full bg-indigo-500/10 blur-3xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-6">
            <div class="flex items-center gap-5">
                <div class="w-20 h-20 rounded-2xl bg-gradient-to-tr from-white/20 to-white/10 backdrop-blur-md border border-white/20 flex items-center justify-center text-3xl font-black text-white shadow-lg">
                    {{ strtoupper(substr($category->category_name, 0, 1)) }}
                </div>
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 text-xs font-semibold text-indigo-200 mb-2">
                        Category Record #{{ $category->id }}
                    </div>
                    <h1 class="text-3xl font-black text-white tracking-tight">
                        {{ $category->category_name }}
                    </h1>
                    <p class="text-xs text-slate-300 mt-1">
                        Created on {{ $category->created_at?->format('M d, Y') ?? 'N/A' }}
                    </p>
                </div>
            </div>

            <div class="flex items-center gap-2">
                <a href="{{ route('categories.edit', $category) }}"
                   class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-amber-500 hover:bg-amber-600 text-white font-semibold text-sm shadow-md transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    <span>Edit</span>
                </a>
            </div>
        </div>
    </div>

    {{-- Info Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        
        <div class="bg-white rounded-2xl border border-slate-200/80 p-6 shadow-sm">
            <div class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-1">
                Category Status
            </div>
            <div class="flex items-center gap-2 mt-3">
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                    Active in Catalog
                </span>
            </div>
            <p class="text-xs text-slate-500 mt-4 leading-relaxed">
                Products can be categorized under this label across stock reports and inventory records.
            </p>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200/80 p-6 shadow-sm">
            <div class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-1">
                Associated Products
            </div>
            <div class="text-3xl font-black text-slate-900 mt-2">
                {{ $category->products()->count() }}
            </div>
            <p class="text-xs text-slate-500 mt-2 leading-relaxed">
                Total active items assigned to this category group.
            </p>
            <div class="mt-4 pt-3 border-t border-slate-100">
                <a href="{{ route('products.index', ['category_id' => $category->id]) }}" class="text-xs font-bold text-indigo-600 hover:text-indigo-800 transition">
                    Filter and view all assigned items &rarr;
                </a>
            </div>
        </div>

    </div>

</div>
@endsection
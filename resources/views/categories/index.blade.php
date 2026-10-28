@extends('layouts.app')

@section('content')
<div class="space-y-8 pb-12">

    {{-- Top Hero / Header Section --}}
    <div class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-slate-900 via-indigo-950 to-slate-900 p-6 sm:p-8 text-white shadow-xl">
        <div class="absolute -right-10 -top-10 h-64 w-64 rounded-full bg-indigo-500/10 blur-3xl pointer-events-none"></div>
        <div class="absolute -left-10 -bottom-10 h-64 w-64 rounded-full bg-violet-500/10 blur-3xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 backdrop-blur-sm border border-white/10 text-xs font-semibold text-indigo-200 mb-3">
                    <span class="w-2 h-2 rounded-full bg-indigo-400"></span>
                    Catalog Classification
                </div>
                <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-white">
                    Category Management
                </h1>
                <p class="mt-1 text-sm text-slate-300 max-w-xl">
                    Group and organize inventory products systematically for effortless stock tracking and reporting.
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-3">
                <a href="{{ route('products.index') }}"
                   class="inline-flex items-center gap-2 rounded-xl bg-white/10 backdrop-blur-md px-4 py-2.5 text-sm font-semibold text-white border border-white/15 hover:bg-white/20 transition-all duration-200 shadow-sm">
                    <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    <span>Products List</span>
                </a>

                <a href="{{ route('categories.create') }}"
                   class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-indigo-500 to-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-indigo-500/25 hover:from-indigo-600 hover:to-indigo-700 hover:shadow-indigo-500/40 transition-all duration-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    <span>Add Category</span>
                </a>
            </div>
        </div>

        {{-- Stats bar --}}
        <div class="relative z-10 mt-6 grid grid-cols-1 sm:grid-cols-2 gap-4 border-t border-white/10 pt-5">
            <div class="bg-white/5 rounded-xl p-3.5 backdrop-blur-sm border border-white/5 flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-indigo-500/20 border border-indigo-400/30 flex items-center justify-center text-indigo-300 font-bold">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                </div>
                <div>
                    <div class="text-xs text-slate-400 font-medium">Total Registered Categories</div>
                    <div class="text-xl font-bold text-white mt-0.5">{{ $categories->total() }} groups</div>
                </div>
            </div>

            <div class="bg-white/5 rounded-xl p-3.5 backdrop-blur-sm border border-white/5 flex items-center justify-between">
                <div>
                    <div class="text-xs text-slate-400 font-medium">Structure Health</div>
                    <div class="text-sm font-semibold text-emerald-300 mt-1 flex items-center gap-1.5">
                        <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                        Active & synchronized
                    </div>
                </div>
                <a href="{{ route('categories.create') }}" class="text-xs font-bold text-indigo-300 hover:text-white underline">
                    + Quick Add
                </a>
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

    {{-- Categories Table Card --}}
    <div class="rounded-2xl border border-slate-200/80 bg-white shadow-sm overflow-hidden">
        <div class="p-5 border-b border-slate-100 flex items-center justify-between">
            <div>
                <h2 class="text-base font-bold text-slate-900">All Categories</h2>
                <p class="text-xs text-slate-500">View and manage your product categorization hierarchy</p>
            </div>
            <span class="text-xs font-semibold text-slate-500 bg-slate-100 px-3 py-1 rounded-full">
                {{ $categories->total() }} Total
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-slate-200 bg-slate-50/75 text-[11px] font-bold uppercase tracking-wider text-slate-500">
                        <th class="py-4 pl-6 pr-3">Category ID</th>
                        <th class="py-4 px-4">Category Name</th>
                        <th class="py-4 px-4">Status</th>
                        <th class="py-4 pl-4 pr-6 text-right">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100 text-sm">
                    @forelse ($categories as $category)
                        <tr class="hover:bg-indigo-50/30 transition-colors group">
                            
                            {{-- ID Badge --}}
                            <td class="py-4 pl-6 pr-3">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold bg-slate-100 text-slate-600 border border-slate-200/60">
                                    #{{ $category->id }}
                                </span>
                            </td>

                            {{-- Name with initial avatar --}}
                            <td class="py-4 px-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-indigo-100 to-violet-50 text-indigo-700 flex items-center justify-center font-black text-sm border border-indigo-200/60 shadow-xs shrink-0">
                                        {{ strtoupper(substr($category->category_name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <a href="{{ route('categories.show', $category) }}" class="font-bold text-slate-900 group-hover:text-indigo-600 transition">
                                            {{ $category->category_name }}
                                        </a>
                                        <p class="text-xs text-slate-400 mt-0.5">
                                            Inventory Category Group
                                        </p>
                                    </div>
                                </div>
                            </td>

                            {{-- Status Badge --}}
                            <td class="py-4 px-4">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    Active
                                </span>
                            </td>

                            {{-- Actions --}}
                            <td class="py-4 pl-4 pr-6 text-right">
                                <div class="inline-flex items-center justify-end gap-1.5">
                                    
                                    {{-- View --}}
                                    <a href="{{ route('categories.show', $category) }}"
                                       title="View details"
                                       class="p-2 rounded-lg text-slate-500 hover:text-indigo-600 hover:bg-indigo-50 transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </a>

                                    {{-- Edit --}}
                                    <a href="{{ route('categories.edit', $category) }}"
                                       title="Edit category"
                                       class="p-2 rounded-lg text-slate-500 hover:text-amber-600 hover:bg-amber-50 transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>

                                    {{-- Delete --}}
                                    <form action="{{ route('categories.destroy', $category) }}"
                                          method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete this category?')"
                                          class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                title="Delete category"
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
                            <td colspan="4" class="py-16 text-center">
                                <div class="w-16 h-16 rounded-2xl bg-indigo-50 text-indigo-500 flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                    </svg>
                                </div>
                                <h3 class="text-base font-bold text-slate-800">No categories created yet</h3>
                                <p class="text-sm text-slate-400 mt-1 max-w-sm mx-auto">
                                    Start structuring your inventory by adding your first product category.
                                </p>
                                <a href="{{ route('categories.create') }}"
                                   class="mt-5 inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow hover:bg-indigo-700 transition">
                                    <span>Add First Category</span>
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination --}}
    @if ($categories->hasPages())
        <div class="pt-2">
            {{ $categories->links() }}
        </div>
    @endif

</div>
@endsection
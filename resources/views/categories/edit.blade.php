@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-6 sm:py-10">

    {{-- Breadcrumb back link --}}
    <div class="mb-6">
        <a href="{{ route('categories.index') }}"
           class="inline-flex items-center gap-2 text-xs font-bold text-slate-500 hover:text-indigo-600 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            <span>Back to Categories</span>
        </a>
    </div>

    {{-- Form Card --}}
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xl shadow-slate-200/50 overflow-hidden">
        
        {{-- Card Header --}}
        <div class="relative bg-gradient-to-r from-slate-900 to-indigo-950 p-6 sm:p-8 text-white">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-2xl bg-amber-500/20 border border-amber-400/30 flex items-center justify-center text-amber-300 font-bold shadow-sm">
                    <svg class="w-6 h-6 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                </div>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-white/10 border border-white/20 text-indigo-200">
                    Category #{{ $category->id }}
                </span>
            </div>

            <h1 class="text-2xl font-black tracking-tight text-white">
                Edit Category
            </h1>
            <p class="mt-1 text-xs text-slate-300">
                Modify category name details and update product classification.
            </p>
        </div>

        {{-- Form Body --}}
        <div class="p-6 sm:p-8">
            
            {{-- Validation Errors --}}
            @if ($errors->any())
                <div role="alert" class="mb-6 rounded-2xl border border-rose-200 bg-rose-50/80 p-4 text-xs text-rose-800">
                    <p class="font-bold flex items-center gap-2 mb-1.5">
                        <svg class="w-4 h-4 text-rose-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        Please fix the errors below:
                    </p>
                    <ul class="list-disc list-inside space-y-1 ml-1 text-rose-700">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('categories.update', $category) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label for="category_name" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                        Category Name <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="text"
                               id="category_name"
                               name="category_name"
                               value="{{ old('category_name', $category->category_name) }}"
                               maxlength="191"
                               required
                               autofocus
                               class="w-full px-4 py-3 rounded-xl border @error('category_name') border-rose-300 bg-rose-50/30 text-rose-900 @else border-slate-200 bg-slate-50/50 text-slate-900 focus:bg-white focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/10 @enderror text-sm font-medium transition outline-none">
                    </div>
                    @error('category_name')
                        <p class="mt-1.5 text-xs font-semibold text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center gap-3 pt-4 border-t border-slate-100">
                    <button type="submit"
                            class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-sm shadow-lg shadow-indigo-600/25 transition">
                        <span>Update Category</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </button>

                    <a href="{{ route('categories.index') }}"
                       class="px-5 py-3 rounded-xl border border-slate-200 bg-white text-sm font-semibold text-slate-600 hover:bg-slate-50 transition">
                        Cancel
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
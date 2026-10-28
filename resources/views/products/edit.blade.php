@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-6 sm:py-10 space-y-6">

    {{-- Breadcrumb back link --}}
    <div>
        <a href="{{ route('products.index') }}"
           class="inline-flex items-center gap-2 text-xs font-bold text-slate-500 hover:text-indigo-600 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            <span>Back to Products</span>
        </a>
    </div>

    {{-- Edit Card --}}
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xl shadow-slate-200/50 overflow-hidden">
        
        {{-- Header Banner --}}
        <div class="relative bg-gradient-to-r from-slate-900 via-indigo-950 to-slate-900 p-6 sm:p-8 text-white">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-2xl bg-amber-500/20 border border-amber-400/30 flex items-center justify-center text-amber-300 font-bold shadow-sm">
                    <svg class="w-6 h-6 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                </div>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-white/10 border border-white/20 text-indigo-200">
                    Product #{{ $product->id }}
                </span>
            </div>

            <h1 class="text-2xl font-black tracking-tight text-white">
                Edit Product
            </h1>
            <p class="mt-1 text-xs text-slate-300">
                Update category, product name, price, and baseline inventory details.
            </p>
        </div>

        {{-- Form Body --}}
        <div class="p-6 sm:p-8">
            
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

            <form action="{{ route('products.update', $product) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                {{-- Category Selection --}}
                <div>
                    <label for="category_id" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                        Category <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative">
                        <select name="category_id" 
                                id="category_id"
                                required
                                class="w-full px-4 py-3 rounded-xl border @error('category_id') border-rose-300 bg-rose-50/30 text-rose-900 @else border-slate-200 bg-slate-50/50 text-slate-900 focus:bg-white focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/10 @enderror text-sm font-medium transition outline-none appearance-none">
                            <option value="">Select a Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id) == $category->id)>
                                    {{ $category->category_name }}
                                </option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none text-slate-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                    @error('category_id')
                        <p class="mt-1.5 text-xs font-semibold text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Product Name --}}
                <div>
                    <label for="name" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                        Product Name <span class="text-rose-500">*</span>
                    </label>
                    <input type="text"
                           id="name"
                           name="name"
                           value="{{ old('name', $product->name) }}"
                           required
                           class="w-full px-4 py-3 rounded-xl border @error('name') border-rose-300 bg-rose-50/30 text-rose-900 @else border-slate-200 bg-slate-50/50 text-slate-900 focus:bg-white focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/10 @enderror text-sm font-medium transition outline-none">
                    @error('name')
                        <p class="mt-1.5 text-xs font-semibold text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Price & Stock in 2 cols --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    {{-- Price --}}
                    <div>
                        <label for="price" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                            Unit Price (₹) <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400 font-bold text-sm">₹</span>
                            <input type="number"
                                   id="price"
                                   name="price"
                                   step="0.01"
                                   min="0"
                                   value="{{ old('price', $product->price) }}"
                                   required
                                   class="w-full pl-8 pr-4 py-3 rounded-xl border @error('price') border-rose-300 bg-rose-50/30 text-rose-900 @else border-slate-200 bg-slate-50/50 text-slate-900 focus:bg-white focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/10 @enderror text-sm font-medium transition outline-none">
                        </div>
                        @error('price')
                            <p class="mt-1.5 text-xs font-semibold text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Stock --}}
                    <div>
                        <label for="stock" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                            Current Stock Units <span class="text-rose-500">*</span>
                        </label>
                        <input type="number"
                               id="stock"
                               name="stock"
                               min="0"
                               step="1"
                               value="{{ old('stock', $product->stock) }}"
                               required
                               class="w-full px-4 py-3 rounded-xl border @error('stock') border-rose-300 bg-rose-50/30 text-rose-900 @else border-slate-200 bg-slate-50/50 text-slate-900 focus:bg-white focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/10 @enderror text-sm font-medium transition outline-none">
                        @error('stock')
                            <p class="mt-1.5 text-xs font-semibold text-rose-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-[11px] text-slate-400">
                            Tip: For stock tracking, use Stock In/Out on the table.
                        </p>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="flex items-center gap-3 pt-4 border-t border-slate-100">
                    <button type="submit"
                            class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-sm shadow-lg shadow-indigo-600/25 transition">
                        <span>Save Changes</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </button>

                    <a href="{{ route('products.index') }}"
                       class="px-5 py-3 rounded-xl border border-slate-200 bg-white text-sm font-semibold text-slate-600 hover:bg-slate-50 transition">
                        Cancel
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
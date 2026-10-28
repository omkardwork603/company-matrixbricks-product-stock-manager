
@extends('layouts.app')

@section('content')
<div class="space-y-6">

    {{-- Page Header --}}
    <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <nav class="mb-2 flex items-center gap-2 text-sm">
                <a href="{{ route('products.index') }}"
                   class="text-slate-500 transition hover:text-blue-600">
                    Products
                </a>

                <span class="text-slate-300">/</span>

                <span class="font-medium text-slate-700">Add Product</span>
            </nav>

            <h1 class="text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">
                Add Product
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Create a product record and configure its initial inventory.
            </p>
        </div>

        <a href="{{ route('products.index') }}"
           class="inline-flex items-center justify-center gap-2 self-start rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 sm:self-auto">
            <span aria-hidden="true">&larr;</span>
            Back to Products
        </a>
    </div>

    {{-- Validation Errors --}}
    @if ($errors->any())
        <div role="alert"
             class="rounded-xl border border-red-200 bg-red-50 p-4">
            <h2 class="text-sm font-semibold text-red-800">
                Please correct the following errors.
            </h2>

            <ul class="mt-2 list-inside list-disc space-y-1 text-sm text-red-700">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Success Message --}}
    @if (session('success'))
        <div role="status"
             class="rounded-xl border border-green-200 bg-green-50 p-4 text-sm font-medium text-green-800">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 items-start gap-6 lg:grid-cols-3">

        {{-- Main Form --}}
        <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm lg:col-span-2">

            <div class="border-b border-slate-200 px-5 py-5 sm:px-6">
                <h2 class="text-lg font-semibold text-slate-900">
                    Product Information
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Enter the basic details for this product.
                </p>
            </div>

            <form action="{{ route('products.store') }}"
                  method="POST"
                  novalidate>
                @csrf

                <div class="space-y-5 p-5 sm:p-6">

                    {{-- Category --}}
                    <div>
                        <label for="category_id"
                               class="mb-2 block text-sm font-semibold text-slate-700">
                            Category <span class="text-red-500">*</span>
                        </label>

                        <select
                            name="category_id"
                            id="category_id"
                            required
                            @disabled($categories->isEmpty())
                            class="block w-full rounded-lg border bg-white px-3.5 py-2.5 text-sm text-slate-800 shadow-sm outline-none transition focus:ring-2 disabled:cursor-not-allowed disabled:bg-slate-100 @error('category_id') border-red-500 focus:border-red-500 focus:ring-red-100 @else border-slate-300 focus:border-blue-500 focus:ring-blue-100 @enderror"
                        >
                            <option value="">Select a category</option>

                            @foreach ($categories as $category)
                                <option
                                    value="{{ $category->id }}"
                                    @selected((string) old('category_id') === (string) $category->id)
                                >
                                    {{ $category->category_name }}
                                </option>
                            @endforeach
                        </select>

                        @error('category_id')
                            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror

                        @if ($categories->isEmpty())
                            <p class="mt-2 text-sm text-amber-700">
                                No categories found.
                                <a href="{{ route('categories.create') }}"
                                   class="font-semibold underline underline-offset-2 hover:text-amber-900">
                                    Create a category
                                </a>
                                before adding a product.
                            </p>
                        @else
                            <p class="mt-1.5 text-xs text-slate-500">
                                Choose the category this product belongs to.
                            </p>
                        @endif
                    </div>

                    {{-- Product Name --}}
                    <div>
                        <label for="name"
                               class="mb-2 block text-sm font-semibold text-slate-700">
                            Product Name <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="text"
                            name="name"
                            id="name"
                            value="{{ old('name') }}"
                            placeholder="e.g. Wireless Keyboard"
                            maxlength="191"
                            required
                            class="block w-full rounded-lg border px-3.5 py-2.5 text-sm text-slate-800 shadow-sm outline-none transition placeholder:text-slate-400 focus:ring-2 @error('name') border-red-500 focus:border-red-500 focus:ring-red-100 @else border-slate-300 focus:border-blue-500 focus:ring-blue-100 @enderror"
                        >

                        @error('name')
                            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Price and Stock --}}
                    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">

                        {{-- Price --}}
                        <div>
                            <label for="price"
                                   class="mb-2 block text-sm font-semibold text-slate-700">
                                Selling Price (₹) <span class="text-red-500">*</span>
                            </label>

                            <div class="relative">
                                <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-sm text-slate-500">
                                    ₹
                                </span>

                                <input
                                    type="number"
                                    name="price"
                                    id="price"
                                    value="{{ old('price') }}"
                                    placeholder="0.00"
                                    step="0.01"
                                    min="0"
                                    max="99999999.99"
                                    required
                                    class="block w-full rounded-lg border py-2.5 pl-8 pr-3.5 text-sm text-slate-800 shadow-sm outline-none transition placeholder:text-slate-400 focus:ring-2 @error('price') border-red-500 focus:border-red-500 focus:ring-red-100 @else border-slate-300 focus:border-blue-500 focus:ring-blue-100 @enderror"
                                >
                            </div>

                            @error('price')
                                <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                            @enderror

                            <p class="mt-1.5 text-xs text-slate-500">
                                Price per unit.
                            </p>
                        </div>

                        {{-- Initial Stock --}}
                        <div>
                            <label for="stock"
                                   class="mb-2 block text-sm font-semibold text-slate-700">
                                Initial Quantity <span class="text-red-500">*</span>
                            </label>

                            <input
                                type="number"
                                name="stock"
                                id="stock"
                                value="{{ old('stock', 0) }}"
                                placeholder="Enter quantity"
                                min="0"
                                max="4294967295"
                                step="1"
                                required
                                class="block w-full rounded-lg border px-3.5 py-2.5 text-sm text-slate-800 shadow-sm outline-none transition placeholder:text-slate-400 focus:ring-2 @error('stock') border-red-500 focus:border-red-500 focus:ring-red-100 @else border-slate-300 focus:border-blue-500 focus:ring-blue-100 @enderror"
                            >

                            @error('stock')
                                <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                            @enderror

                            <p class="mt-1.5 text-xs text-slate-500">
                                Available units when the product is created.
                            </p>
                        </div>
                    </div>

                </div>

                {{-- Form Actions --}}
                <div class="flex flex-col-reverse justify-end gap-3 border-t border-slate-200 bg-slate-50/70 px-5 py-4 sm:flex-row sm:px-6">

                    <a href="{{ route('products.index') }}"
                       class="inline-flex items-center justify-center rounded-lg border border-slate-300 bg-white px-5 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-slate-300">
                        Cancel
                    </a>

                    <button
                        type="submit"
                        @disabled($categories->isEmpty())
                        class="inline-flex items-center justify-center rounded-lg border border-slate-300 bg-white px-5 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-slate-300"
                    >
                        Save Product
                    </button>
                </div>
            </form>
        </div>

        {{-- Sidebar --}}
        <aside class="space-y-5">

            {{-- Helpful Information --}}
            <div class="rounded-xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-200 px-5 py-4">
                    <h2 class="text-base font-semibold text-slate-900">
                        Before You Save
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        A quick checklist for accurate inventory records.
                    </p>
                </div>

                <div class="space-y-5 p-5">

                    <div class="flex items-start gap-3">
                        <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-blue-50 text-xs font-bold text-blue-700">
                            01
                        </div>

                        <div>
                            <h3 class="text-sm font-semibold text-slate-800">
                                Verify the category
                            </h3>
                            <p class="mt-1 text-sm leading-5 text-slate-500">
                                Select the appropriate category to keep products organized.
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-blue-50 text-xs font-bold text-blue-700">
                            02
                        </div>

                        <div>
                            <h3 class="text-sm font-semibold text-slate-800">
                                Check the price
                            </h3>
                            <p class="mt-1 text-sm leading-5 text-slate-500">
                                Confirm the selling price before saving the product.
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-blue-50 text-xs font-bold text-blue-700">
                            03
                        </div>

                        <div>
                            <h3 class="text-sm font-semibold text-slate-800">
                                Enter the initial stock
                            </h3>
                            <p class="mt-1 text-sm leading-5 text-slate-500">
                                Enter the available quantity. Record later stock changes through Stock In and Stock Out.
                            </p>
                        </div>
                    </div>

                </div>
            </div>

            {{-- Required Fields --}}
            <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-start gap-3">
                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-slate-100 text-slate-600">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             viewBox="0 0 24 24"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="1.8"
                             class="h-5 w-5"
                             aria-hidden="true">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M12 9v3.75m0 3h.008M10.3 3.86 1.82 18.1A1.9 1.9 0 0 0 3.45 21h17.1a1.9 1.9 0 0 0 1.63-2.9L13.7 3.86a1.97 1.97 0 0 0-3.4 0Z"/>
                        </svg>
                    </div>

                    <div>
                        <h2 class="text-sm font-semibold text-slate-900">
                            Required Fields
                        </h2>

                        <p class="mt-1 text-sm leading-5 text-slate-500">
                            Fields marked with
                            <span class="font-semibold text-red-500">*</span>
                            must be completed before you save.
                        </p>
                    </div>
                </div>
            </div>

        </aside>
    </div>
</div>
@endsection
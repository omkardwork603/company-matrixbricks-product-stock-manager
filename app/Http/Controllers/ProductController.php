<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display products with search, category filter and pagination.
     */
    public function index(Request $request)
{
    $products = Product::with('category')
        ->when($request->filled('search'), function ($query) use ($request) {
            $query->where('name', 'like', '%' . $request->search . '%');
        })
        ->when($request->filled('category_id'), function ($query) use ($request) {
            $query->where('category_id', $request->category_id);
        })
        ->latest()
        ->paginate(10)
        ->withQueryString();

    $categories = Category::orderBy('category_name')->get();

    return view('products.index', compact('products', 'categories'));
}

    /**
     * Show the create product form.
     */
    public function create()
    {
        $categories = Category::orderBy('category_name')->get();

        return view('products.create', compact('categories'));
    }

    /**
     * Store a new product.
     */
    // public function store(Request $request)
    // {
    //     $data = $request->validate([
    //         'category_id' => ['required', 'integer', 'exists:categories,id'],
    //         'name' => ['required', 'string', 'max:255'],
    //         'price' => ['required', 'numeric', 'min:0', 'max:99999999.99'],
    //         'stock' => ['required', 'integer', 'min:0', 'max:4294967295'],
    //     ]);

    //     Product::create($data);

    //     return redirect()
    //         ->route('products.index')
    //         ->with('success', 'Product created successfully.');
    // }

    
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'name'        => ['required', 'string', 'max:191'],
            'price'       => ['required', 'numeric', 'min:0', 'max:99999999.99'],
            'stock'       => ['required', 'integer', 'min:0', 'max:4294967295'],
        ]);

        Product::create($validated);

        return redirect()
            ->route('products.index')
            ->with('success', 'Product created successfully.');
    }
    /**
     * Display product details and stock history.
     */
   public function show(Product $product)
    {
        $product->load([
            'category',
            'stockMovements' => function ($query) {
                $query->latest();
            },
        ]);

        return view('products.show', compact('product'));
    }


    /**
     * Show the edit product form.
     */
    public function edit(Product $product)
    {
        $categories = Category::orderBy('category_name')->get();

        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update an existing product.
     */
    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0', 'max:99999999.99'],
            'stock' => ['required', 'integer', 'min:0', 'max:4294967295'],
        ]);

        $product->update($data);

        return redirect()
            ->route('products.index')
            ->with('success', 'Product updated successfully.');
    }

    /**
     * Delete a product.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('success', 'Product deleted successfully.');
    }

   
}
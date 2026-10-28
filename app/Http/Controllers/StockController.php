<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

use App\Models\StockMovement;


class StockController extends Controller
{
    /**
     * Add stock to a product.
     */
   public function stockIn(Request $request, Product $product)
    {
        $validated = $request->validate([
            'qty' => ['required', 'integer', 'min:1'],
            'note' => ['nullable', 'string', 'max:1000'],
        ]);

        DB::transaction(function () use ($product, $validated) {
            $lockedProduct = Product::whereKey($product->id)
                ->lockForUpdate()
                ->firstOrFail();

            $qty = (int) $validated['qty'];

            $lockedProduct->increment('stock', $qty);

            StockMovement::create([
                'product_id' => $lockedProduct->id,
                'type' => 'in',
                'quantity' => $qty,
                'note' => $validated['note'] ?? null,
            ]);
        });

        return back()->with('success', 'Stock added successfully.');
    }

    /**
     * Remove stock from a product.
     */
//    public function stockOut(Request $request, Product $product)
//         {
//             $validated = $request->validate([
//                 'qty' => [
//                     'required',
//                     'integer',
//                     'min:1',
//                 ],
//             ], [
//                 'qty.required' => 'Please enter a quantity.',
//                 'qty.integer' => 'Quantity must be a whole number.',
//                 'qty.min' => 'Invalid quantity! Stock Out quantity must be at least 1.',
//             ]);

//             $qty = (int) $validated['qty'];

//             if ($qty > $product->stock) {
//                 return back()->with(
//                     'error',
//                     "Invalid quantity! Available stock is {$product->stock}. Stock cannot go below zero."
//                 );
//             }

//             $product->decrement('stock', $qty);

//             return back()->with('success', 'Stock Out completed successfully.');
//         }

    

public function stockOut(Request $request, Product $product)
{
    $validated = $request->validate([
        'qty' => ['required', 'integer', 'min:1'],
        'note' => ['nullable', 'string', 'max:1000'],
    ]);

    DB::transaction(function () use ($validated, $product) {
        $lockedProduct = Product::whereKey($product->id)
            ->lockForUpdate()
            ->firstOrFail();

        $qty = (int) $validated['qty'];

        if ($qty > $lockedProduct->stock) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'qty' => 'Insufficient stock. Stock cannot go below zero.',
            ]);
        }

        $lockedProduct->decrement('stock', $qty);

        StockMovement::create([
            'product_id' => $lockedProduct->id,
            'type' => 'out',
            'quantity' => $qty,
            'note' => $validated['note'] ?? null,
        ]);
    });

    return back()->with('success', 'Stock Out completed successfully.');
}
/**
     * Update product stock and save stock movement history.
     */
    private function changeStock(
        Request $request,
        Product $product,
        string $type
    ) {
        // Validate request data.
        $data = $request->validate([
            'qty' => ['required', 'integer', 'min:1'],
            'note' => ['nullable', 'string', 'max:1000'],
        ]);

        // Update stock and history atomically.
        DB::transaction(function () use ($product, $data, $type) {

            // Lock the product row to prevent conflicting updates.
            $lockedProduct = Product::whereKey($product->id)
                ->lockForUpdate()
                ->firstOrFail();

            // Prevent removing more stock than available.
            if (
                $type === 'out' &&
                $data['qty'] > $lockedProduct->stock
            ) {
                throw ValidationException::withMessages([
                    'qty' => 'Insufficient stock. Available stock: '
                        . $lockedProduct->stock . '.',
                ]);
            }

            // Update product quantity.
            if ($type === 'in') {
                $lockedProduct->increment('stock', $data['qty']);
            } else {
                $lockedProduct->decrement('stock', $data['qty']);
            }

            // Record stock movement using the product relationship.
            $lockedProduct->stockHistories()->create([
                'type' => $type,
                'qty' => $data['qty'],
                'note' => $data['note'] ?? null,
            ]);
        });

        // Return to the products page with a success message.
        return redirect()
            ->route('products.index')
            ->with(
                'success',
                $type === 'in'
                    ? 'Stock added successfully.'
                    : 'Stock removed successfully.'
            );
    }
}

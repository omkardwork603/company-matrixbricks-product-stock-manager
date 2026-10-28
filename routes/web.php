
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockController;

// Redirect home page to products
Route::get('/', function () {
    return redirect()->route('products.index');
});

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Authenticated routes
Route::middleware('auth')->group(function () {

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    // Category CRUD
    Route::resource('categories', CategoryController::class);

    // Product CRUD
    Route::resource('products', ProductController::class);

    // Stock management
    Route::post('/products/{product}/stock-in', [StockController::class, 'stockIn'])
        ->name('products.stock-in');

    Route::post('/products/{product}/stock-out', [StockController::class, 'stockOut'])
        ->name('products.stock-out');
});

// Authentication routes
require __DIR__.'/auth.php';

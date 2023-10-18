<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard1', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard1');

Route::get('/dashboard', function () {
    return view('admin-dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // show products api route
    Route::get('/api/products', [ProductController::class, 'showProducts'])->name('product.show');
    Route::get('/api/products/{id}', [ProductController::class, 'getSpecificProduct'])->name('product.get.id');

    // delete product api route
    Route::delete('/api/products/{id}', [ProductController::class, 'deleteProduct'])->name('product.delete');
    
    // display products page
    Route::get('/products', [ProductController::class, 'productList'])->name('product.show.list');
    Route::get('/products/create', [ProductController::class, 'showCreateProduct'])->name('product.create.show');
    Route::post('/products/create', [ProductController::class, 'createProduct'])->name('product.create');
    Route::get('/products/edit/{id}', [ProductController::class, 'showEditProduct'])->name('product.edit.show');
    Route::post('/products/edit/{id}', [ProductController::class, 'editProduct'])->name('product.edit');
});

require __DIR__.'/auth.php';

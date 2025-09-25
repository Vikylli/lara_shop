<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


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


//Route::get('/', '\App\Http\Controllers\ProductController@index')->name('home');


Route::get('/',[UserController::class, 'index'])->name('index');
Route::post('/',[UserController::class, 'store']);
Route::get('/login', [UserController::class, 'loginForm'])->name('login');
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/profile', [UserController::class, 'profile'])
    ->middleware('auth')
    ->name('profile');

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('products.show');
Route::get('/category/{slug}', [CategoryController::class, 'show'])->name('categories.show');



Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart/show', [CartController::class, 'show'])->name('cart.show');
Route::get('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
Route::get('/cart/del_item/{product_id}', [CartController::class, 'delItem'])->name('cart.del_item');
Route::match(['get','post'], '/cart/checkout/', [CartController::class, 'checkout'])->name('cart.checkout');



Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin', [\App\Http\Controllers\Admin\ProductController::class, 'index'])->name('admin.index');
    Route::get('/admin/create', [\App\Http\Controllers\Admin\ProductController::class, 'create'])->name('admin.create');
    Route::post('/admin', [\App\Http\Controllers\Admin\ProductController::class, 'store'])->name('admin.store');
    Route::get('/admin/{product}/edit', [\App\Http\Controllers\Admin\ProductController::class, 'edit'])->name('admin.edit');
    Route::put('/admin/{product}', [\App\Http\Controllers\Admin\ProductController::class, 'update'])->name('admin.update');
    Route::delete('/admin/{product}', [\App\Http\Controllers\Admin\ProductController::class, 'destroy'])->name('admin.destroy');
});






<?php

use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\ShopComponent;
use App\Http\Livewire\CartComponent;
use App\Http\Livewire\CheckoutComponent;
use App\Http\Livewire\DetailsComponent;
use App\Http\Livewire\CategoryComponent;
use App\Http\Livewire\AboutComponent;
use App\Http\Livewire\ContactComponent;
use App\Http\Livewire\SearchComponent;
use App\Http\Livewire\User\UserDashboardComponent;
use App\Http\Livewire\Admin\AdminDashboardComponent;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProveedorController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', HomeComponent::class);
Route::get('/shop', ShopComponent::class);
Route::get('/about', AboutComponent::class);
Route::get('/contact', ContactComponent::class);
Route::get('/cart', CartComponent::class)->name('product.cart');
Route::get('/checkout', CheckoutComponent::class);
Route::get('/product/{slug}', DetailsComponent::class)->name('product.details');
Route::get('/product-category/{category_slug}', CategoryComponent::class)->name('product.category');
Route::get('/search', SearchComponent::class)->name('product.search');

Route::middleware(['auth:sanctum', 'verified'])->group(function(){
    Route::get('/user/dashboard', UserDashboardComponent::class)->name('user.dashboard');
});

Route::middleware(['auth:sanctum', 'verified', 'authAdmin'])->group(function(){

    Route::get('/admin/dashboard', AdminDashboardComponent::class)->name('admin.dashboard');

    Route::get('/admin/producto', [ProductoController::class, "index"])->name('admin.producto');
    Route::get('/admin/producto/ajax/{skip}', [ProductoController::class, "ajax"])->name('producto.ajax');
    Route::post('/admin/producto/store', [ProductoController::class, "store"])->name('producto.store');
    Route::get('/admin/producto/edit/{id}', [ProductoController::class, "edit"])->name('admin.producto.edit');
    Route::get('/admin/producto/destroy/{id}', [ProductoController::class, "destroy"])->name('admin.producto.destroy');
    Route::get('/admin/producto/show/{sdk}', [ProductoController::class, "show"])->name('admin.producto.show');

    Route::get('/admin/categoria', [CategoriaController::class, "index"])->name('admin.categoria');
    Route::post('/admin/categoria/store', [CategoriaController::class, "store"])->name('categoria.store');

    Route::get('/admin/proveedor', [ProveedorController::class, "index"])->name('admin.proveedor');
    Route::get('/admin/proveedor/ajax/{skip}', [ProveedorController::class, "ajax"])->name('admin.proveedor.ajax');
    Route::get('/admin/proveedor/edit/{ruc}', [ProveedorController::class, "edit"])->name('admin.proveedor.edit');
    Route::get('/admin/proveedor/destroy/{ruc}', [ProveedorController::class, "destroy"])->name('admin.proveedor.destroy');
    Route::post('/admin/proveedor/store', [ProveedorController::class, "store"])->name('proveedor.store');

});

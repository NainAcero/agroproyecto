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
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\DiscontController;

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
Route::post('/mensaje', [ContactoController::class, "enviar"])->name('mensaje');
Route::get('/contacto', [ContactoController::class, "index"])->name('admin.contacto');
Route::get('/contacto/enviar/{id}', [ContactoController::class, "show"])->name('admin.enviar');
Route::post('/gmail', [ContactoController::class, "gmail"])->name('admin.gmail');

Route::middleware(['auth:sanctum', 'verified'])->group(function(){
    Route::get('/user/dashboard', UserDashboardComponent::class)->name('user.dashboard');
    Route::get('/paypal/pay', [PaymentController::class, "payWithPayPal"]);
    Route::get('/paypal/status', [PaymentController::class, "payPalStatus"]);

    Route::get('/factura', [FacturaController::class, "index"])->name('factura.index');
    Route::get('/factura/show/{id}', [FacturaController::class, "show"])->name('factura.show');

});

Route::middleware(['auth:sanctum', 'verified', 'authAdmin'])->group(function(){

    Route::get('/admin/dashboard', AdminDashboardComponent::class)->name('admin.dashboard');

    Route::get('/admin/descuento', [DiscontController::class, "index"])->name('admin.descuento.index');
    Route::get('/admin/descuento/create', [DiscontController::class, "create"])->name('admin.descuento.create');
    Route::post('/admin/descuento/store', [DiscontController::class, "store"])->name('admin.descuento.store');
    Route::get('/admin/descuento/edit/{id}', [DiscontController::class, "edit"])->name('admin.descuento.edit');
    Route::post('/admin/descuento/update/{id}', [DiscontController::class, "update"])->name('admin.descuento.update');
    Route::get('/admin/descuento/destroy/{id}', [DiscontController::class, "destroy"])->name('admin.descuento.destroy');

    Route::get('/admin/producto', [ProductoController::class, "index"])->name('admin.producto');
    Route::get('/admin/producto/ajax/{skip}', [ProductoController::class, "ajax"])->name('producto.ajax');
    Route::post('/admin/producto/store', [ProductoController::class, "store"])->name('producto.store');
    Route::get('/admin/producto/edit/{id}', [ProductoController::class, "edit"])->name('admin.producto.edit');
    Route::get('/admin/producto/destroy/{id}', [ProductoController::class, "destroy"])->name('admin.producto.destroy');
    Route::get('/admin/producto/show/{nombre}', [ProductoController::class, "show"])->name('admin.producto.show');
    Route::get('/admin/producto/all/{nombre}', [ProductoController::class, "all"])->name('admin.producto.all');

    Route::get('/admin/categoria', [CategoriaController::class, "index"])->name('admin.categoria');
    Route::get('/admin/categoria/ajax/{skip}', [CategoriaController::class, "ajax"])->name('categoria.ajax');
    Route::post('/admin/categoria/store', [CategoriaController::class, "store"])->name('categoria.store');
    Route::get('/admin/categoria/edit/{id}', [CategoriaController::class, "edit"])->name('admin.categoria.edit');
    Route::get('/admin/categoria/destroy/{id}', [CategoriaController::class, "destroy"])->name('admin.categoria.destroy');
    Route::get('/admin/categoria/show/{nombre}', [CategoriaController::class, "show"])->name('admin.categoria.show');
    Route::get('/admin/categoria/all/{nombre}', [CategoriaController::class, "all"])->name('admin.categoria.all');

    Route::get('/admin/proveedor', [ProveedorController::class, "index"])->name('admin.proveedor');
    Route::get('/admin/proveedor/ajax/{skip}', [ProveedorController::class, "ajax"])->name('admin.proveedor.ajax');
    Route::get('/admin/proveedor/edit/{ruc}', [ProveedorController::class, "edit"])->name('admin.proveedor.edit');
    Route::get('/admin/proveedor/destroy/{ruc}', [ProveedorController::class, "destroy"])->name('admin.proveedor.destroy');
    Route::post('/admin/proveedor/store', [ProveedorController::class, "store"])->name('proveedor.store');
    Route::get('/admin/proveedor/show/{nombre}', [ProveedorController::class, "show"])->name('admin.proveedor.show');
    Route::get('/admin/proveedor/all/{nombre}', [ProveedorController::class, "all"])->name('admin.proveedor.all');

});

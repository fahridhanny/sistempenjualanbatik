<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
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
Auth::routes();

Route::group(['middleware' => 'auth_admin'], function () {
    // dashboard
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/man', [HomeController::class, 'categoriesMan']);
    Route::get('/woman', [HomeController::class, 'categoriesWoman']);
    Route::get('/kids', [HomeController::class, 'categoriesKids']);
    Route::get('/about', [HomeController::class, 'about']); 
});
Route::group(['middleware' => 'customer'], function () {
    // pesanan
    Route::get('/pesanan', [PesananController::class, 'getPesanan']);
    Route::get('/pesanan/detail/{id}', [PesananController::class, 'pesananDetail']);
    Route::post('/pesanan/{id}', [PesananController::class, 'pesanan']);
    Route::get('/pesanan/detail/hapus/{product_id}/{ukuran}', [PesananController::class, 'pesananHapus']);
    Route::get('/pesanan/{id}/{ukuran}', [PesananController::class, 'mengambilDataUkuranById']);
    //checkout
    Route::post('/checkout/product', [PesananController::class, 'checkoutProduct']);
    Route::get('/checkout', [PesananController::class, 'checkout']);
    Route::post('/buatPesanan', [PesananController::class, 'buatPesanan']);
    //profile
    Route::get('/profile', [UserController::class, 'profile']);
    Route::post('/ubahProfile', [UserController::class, 'ubahProfile']);
    Route::get('/edit/password', [UserController::class, 'editPassword']); 
});
Route::group(['middleware' => 'admin'], function () {
    // dashboard
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->middleware('auth');
    Route::get('/product', [ProductController::class, 'product']);
    Route::get('/tambah/product', [ProductController::class, 'tambahProduct']);
    Route::post('/tambah/product/proses', [ProductController::class, 'prosesTambahProduct']);
    Route::get('/edit/product/{nama_product}/{ukuran}', [ProductController::class, 'editProduct']);
    Route::post('/edit/product/proses/{id}/{ukuran}', [ProductController::class, 'prosesEditProduct']);
    Route::get('/hapus/product/{nama_product}/{ukuran}', [ProductController::class, 'hapusProduct']);
    Route::get('/profile/admin', [UserController::class, 'profileAdmin']);
    Route::post('/ubah/profile/admin', [UserController::class, 'ubahProfileAdmin']);
    Route::get('/user', [UserController::class, 'user']);
    Route::get('/user/hapus/{id}', [UserController::class, 'hapusUser']);
});

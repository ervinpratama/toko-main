<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\CustomerDashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\PenjualController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\RejectController;
use App\Http\Controllers\Pengrajin;
use App\Http\Controllers\BahanMentahController;
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

Route::controller(AuthController::class)->group(function () {
	Route::get('register', 'register')->name('register');
	Route::post('register', 'registerSimpan')->name('register.simpan');

	Route::get('login', 'login')->name('login');
	Route::post('login', 'loginAksi')->name('login.aksi');

	Route::get('logout', 'logout')->middleware('auth')->name('logout');
});

Route::get('/', [LandingPageController::class, 'index']);


Route::middleware('auth')->group(function () {

	//Barang
	Route::controller(CartController::class)->prefix('cart')->group(function () {
		Route::get('/', 'index')->name('cart');
		Route::get('/{barang}/add', 'add');
		Route::get('/{barang}/remove', 'remove');
	});


	//Transaction
	Route::controller(TransactionController::class)->prefix('transaction')->group(function () {
		Route::get('/', 'index')->name('transaction');
		Route::get('/checkout', 'checkout');
		Route::post('/proses', 'proses');
		Route::get('/history', 'history')->name('history');

		Route::get('/terima_pesanan/{id}', 'terima_pesanan');
		Route::get('/detail/{id}', 'detail_history');
		Route::get('/batalkan_pesanan/{id}', 'batalkan_pesanan');

		Route::get('/upload_bukti_transfer/{id}', 'upload_bukti_transfer');
		Route::post('/proses_upload', 'proses_upload')->name('upload.bukti');
		
		Route::get('/upload_bukti_refund/{id}', 'upload_bukti_refund');
		Route::post('/proses_upload_bukti_refund/{id}', 'proses_upload_bukti_refund');


		Route::get('/batal_upload/{id}', 'batal_upload');
		Route::post('/proses_batal_upload/{id}', 'proses_batal_upload');
		Route::get('/reject_upload/{id}', 'reject_upload');
		Route::post('/proses_reject_upload/{id}', 'proses_reject_upload');

		Route::get('/reject/{id}', 'reject');
		Route::post('/store_reject', 'store_reject');
		

		Route::get('/accept/{id}', 'accept');
		Route::get('/kirim/{id}', 'kirim');
		Route::post('/export', 'export_pdf')->name('exportPDF');
	});

	//Transaction
	Route::controller(RejectController::class)->prefix('reject')->group(function () {
		Route::get('/', 'index');
		Route::get('/upload_bukti/{id}','upload_bukti');
		Route::post('/proses_upload_bukti/{id}','proses_upload_bukti');
		Route::get('/change_status/{id}/{status}', 'change_status');
	});

	//Customer
	Route::controller(CustomerDashboardController::class)->prefix('customer')->group(function() {
		Route::get('/', 'index')->name('customer');
		Route::get('/detail/{barang}', 'detail');
		Route::get('/category/{kategori:id}', 'category');
	});

	//Pengrajin
	Route::controller(Pengrajin::class)->prefix('pengrajin')->group(function(){
		Route::get('/', 'index')->name('pengrajin');
		Route::get('tambah', 'tambah')->name('pengrajin.tambah');
		Route::post('tambah', 'simpan')->name('pengrajin.tambah.simpan');
		Route::post('edit/{id}', 'update')->name('pengrajin.tambah.update');
		Route::get('edit/{id}', 'edit')->name('pengrajin.edit');
		Route::get('hapus/{id}', 'hapus')->name('pengrajin.hapus');
	});

	//Bahan Mentah
	Route::controller(BahanMentahController::class)->prefix('bahan_mentah')->group(function(){
		Route::get('/', 'index')->name('bahan_mentah');
		Route::get('tambah', 'tambah')->name('bahan_mentah.tambah');
		Route::post('tambah', 'simpan')->name('bahan_mentah.tambah.simpan');
		Route::post('edit/{id}', 'update')->name('bahan_mentah.tambah.update');
		Route::get('edit/{id}', 'edit')->name('bahan_mentah.edit');
		Route::get('hapus/{id}', 'hapus')->name('bahan_mentah.hapus');
	});

	//Penjual
	Route::controller(PenjualController::class)->prefix('penjual')->group(function() {
		Route::get('/', 'index')->name('penjual');
		Route::get('/tambah', 'tambah')->name('penjual.tambah');
		Route::post('/simpan', 'simpan')->name('penjual.simpan');
		Route::get('/edit/{id}', 'edit')->name('penjual.edit');
		Route::post('/update/{id}', 'update')->name('penjual.update');
		Route::get('/hapus/{id}', 'hapus')->name('penjual.hapus');
		Route::get('/aktif/{id}', 'aktif')->name('penjual.aktif');
		Route::get('/nonaktif/{id}', 'nonaktif')->name('penjual.nonaktif');
	});

	Route::controller(SuperAdminController::class)->prefix('superadmin')->group(function() {
		Route::get('/', 'index')->name('superadmin');
		Route::get('/tambah', 'tambah')->name('superadmin.tambah');
		Route::post('/simpan', 'simpan')->name('superadmin.simpan');
		Route::get('/edit/{id}', 'edit')->name('superadmin.edit');
		Route::post('/update/{id}', 'update')->name('superadmin.update');
		Route::get('/hapus/{id}', 'hapus')->name('superadmin.hapus');
	});

	Route::get('dashboard', function () {
		return view('dashboard');
	})->name('dashboard');

	Route::controller(BarangController::class)->prefix('barang')->group(function () {
		Route::get('', 'index')->name('barang');
		Route::get('tambah', 'tambah')->name('barang.tambah');
		Route::post('tambah', 'simpan')->name('barang.tambah.simpan');
		Route::get('edit/{id}', 'edit')->name('barang.edit');
		Route::post('edit/{id}', 'update')->name('barang.tambah.update');
		Route::get('hapus/{id}', 'hapus')->name('barang.hapus');
		Route::get('category/{category}','getByCategory')->name('barang.category');
	});

	Route::controller(KategoriController::class)->prefix('kategori')->group(function () {
		Route::get('', 'index')->name('kategori');
		Route::get('tambah', 'tambah')->name('kategori.tambah');
		Route::post('tambah', 'simpan')->name('kategori.tambah.simpan');
		Route::get('edit/{id}', 'edit')->name('kategori.edit');
		Route::post('edit/{id}', 'update')->name('kategori.tambah.update');
		Route::get('hapus/{id}', 'hapus')->name('kategori.hapus');
	});
});

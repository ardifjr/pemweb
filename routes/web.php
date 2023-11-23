<?php

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

Route::get('/', function () {
    return view('index');
});
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\DaftarController;

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/daftar', [DaftarController::class, 'index'])->name('daftar');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');


use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/daftar', [AuthController::class, 'showRegistrationForm'])->name('daftar');
Route::post('/daftar', [AuthController::class, 'register'])->name('daftar.submit');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/daftar', [AuthController::class, 'showRegistrationForm'])->name('daftar');
Route::post('/daftar', [AuthController::class, 'register'])->name('daftar.submit');
Route::get('/pegawai', [AuthController::class, 'index'])->name('pegawai.index');
Route::delete('/pegawai/{id_user}', [AuthController::class, 'destroy'])->name('pegawai.destroy');
Route::get('/pegawai/{id_user}/edit', [AuthController::class, 'edit'])->name('pegawai.edit');
Route::put('/pegawai/{id_user}', [AuthController::class, 'update'])->name('pegawai.update');
Route::get('/sesi', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login')->name('login.submit');


use App\Http\Controllers\SessionController;
Route::get('/sesi',[SessionController::class, 'index'])->name('loginpage');
Route::post('/sesi/login',[SessionController::class, 'login']);
Route::get('/sesi', [SessionController::class, 'index'])->name('service');
Route::get('/sesi/logout', [SessionController::class, 'logout']);
Route::get('/adminhome', function () {
    return view('adminhome'); // Sesuaikan dengan nama tampilan yang baru
});
Route::get('/index', function () {
    return view('index');
})->name('index');
use App\Http\Controllers\KategoriController;
Route::get('/adminhome', function () {
    return view('adminhome');
})->name('adminhome');

Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');
Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
Route::put('/kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update');







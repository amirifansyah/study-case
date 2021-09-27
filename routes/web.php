<?php

use App\Http\Controllers\PinjamController;
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

Route::get('/', function () {
    return view('welcome');
});


Route::get('login', 'BlogController@index')->name('login.index');
Route::post('login', 'BlogController@store')->name('login.store');


Route::prefix('daftar-buku')->group(function () {
    Route::get('/', 'PerpusController@index')->name('perpus.index');;
    Route::get('/create-buku', 'PerpusController@create')->name('perpus.create');
    Route::post('/create-buku', 'PerpusController@store')->name('perpus.store');
    Route::get('/edit', 'PerpusController@edit')->name('perpus.edit');
    Route::delete('/{delete}', 'PerpusController@destroy')->name('perpus.destroy');
    Route::get('/edit/{id}', 'PerpusController@edit')->name('perpus.edit');
    Route::patch('/{id}', 'PerpusController@update')->name('perpus.update');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('/user')->group(function (){
    Route::get('/{id}', 'HomeController@show')->name('user.show');
    Route::get('/pengajuan/{id}', 'PinjamController@pengajuan')->name('user.create');
    Route::post('/pinjam', 'PinjamController@history')->name('user.history');
    Route::get('/book', 'PinjamController@baru')->name('coba');
});


Route::get('/history', 'PinjamController@pinjamBuku')->name('user.pinjambuku');
Route::get('/approve', 'StatusController@approveBuku')->name('status.approve');
Route::patch('/approve/{id}', 'StatusController@updateStatus')->name('status.update');
Route::get('dikembalikan', 'StatusController@returnBuku')->name('status.dikemabalikan');
Route::get('/history-buku-kembali', 'StatusController@historyBuku')->name('status.bukukembali');
// Route::get('/nyoba', 'HomeController@bismillah')->name('nyoba');

Route::prefix('pustaka')->group(function (){
    Route::get('/', 'PustakaController@daftarBuku')->name('index.pustaka');
    Route::get('/new/{id?}', 'PustakaController@newBook')->name('create.pustaka');
    Route::post('/store/{id?}', 'PustakaController@pustakaStore')->name('store.pustaka');
    Route::delete('/delete/{id?}', 'PustakaController@destroyBuku')->name('destroyBuku.pustaka');
});

// Route::get('/pustaka', 'PustakaController@daftarBuku')->name('index.pustaka');
// Route::g
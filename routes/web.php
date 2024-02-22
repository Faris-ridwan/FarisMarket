<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('barang', 'barangController@index')->name('barang.index');
Route::get('barang/create', 'barangController@create')->name('barang.create');
Route::post('barang', 'barangController@store')->name('barang.store');
Route::get('barang/{id}/edit', 'barangController@edit')->name('barang.edit');
Route::put('barang/{id}', 'barangController@update')->name('barang.update');
Route::delete('barang/{id}', 'barangController@destroy')->name('barang.destroy');

Route::get('pesan/{id}', 'pesanController@index');
Route::post('pesan/{id}', 'pesanController@pesan');
Route::get('check-out', 'pesanController@check_out');
Route::delete('check-out/{id}', 'pesanController@delete');

Route::get('konfirmasi-check-out', 'pesanController@konfirmasi');

Route::get('profile', 'profileController@index');

Route::get('history', 'historyController@index');
Route::get('history/{id}', 'historyController@detail');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



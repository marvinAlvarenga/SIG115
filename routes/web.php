<?php

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
    return view('index');
})->middleware('auth');

Auth::routes();
Route::middleware(['auth'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/equipoportipo', 'GerencialController@equipoPorTipo')->name('gerenciales.equipoportipo');
    Route::get('/info40', 'GerencialController@verInfo40')->name('gerenciales.info40');
    Route::get('/pdfinfo40', 'GerencialController@pdfInfo40')->name('gerenciales.pdfinfo40');
   
   
});
 






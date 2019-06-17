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
    Route::redirect('/home', '/');
    Route::get('/equipoportipo', 'GerencialController@equipoPorTipo')->name('gerenciales.equipoportipo');
    Route::get('/info40', 'GerencialController@verInfo40')->name('gerenciales.info40');
    Route::get('/pdfinfo40', 'GerencialController@pdfInfo40')->name('gerenciales.pdfinfo40');

    Route::get('/reportes/mantsxuser', 'GerencialController@getMantsXUser')->name('MantsXUser');
    Route::get('/reportes/equipoDescargado', 'TacticoController@getEquipoDescargado')->name('EquipoDescargado');
    Route::post('/reportes/mantsxuser', 'GerencialController@postMantsXUser')->name('PostMantUsrs');
    Route::post('/reportes/equipoDescargado', 'TacticoController@postEquipoDescargado')->name('PostEquipoDescargado');

    Route::get('/usuarios', 'UserController@index')->name('usuarios.index');
    Route::get('/usuarios/{usuario}/editar', 'UserController@edit')->name('usuarios.edit');
    Route::post('/usuarios/{usuario}/actualizar', 'UserController@update')->name('usuarios.update');

    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->name('logs');

});

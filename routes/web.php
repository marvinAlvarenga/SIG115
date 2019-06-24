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

    //RUTAS CH15013
    Route::get('/equipoportipo', 'GerencialController@equipoPorTipo')->name('gerenciales.equipoportipo');
    Route::post('/equipoportipo/pdf/{fecha_inicial}/{fecha_final}/{tipo}', 'GerencialController@equipoPorTipoPdf')->name('gerenciales.equipoportipoPdf');
    Route::get('/equipoportipo/pdf/{fecha_inicial}/{fecha_final}/{tipo}', 'GerencialController@equipoPorTipoPdf')->name('gerenciales.equipoportipoImprimir');
    Route::get('/equipoportipo/Excel/{fecha_inicial}/{fecha_final}/{tipo}', 'GerencialController@equipoPorTipoExcel')->name('gerenciales.equipoportipoExcel');
    
    Route::get('/repuestosCambiados','GerencialController@repuestosCambiados')->name('gerenciales.repuestosCambiados');
    Route::post('/repuestosCambiados/pdf/{fecha_inicial}/{fecha_final}/{tipo}', 'GerencialController@repuestosCambiadosPdf')->name('gerenciales.repuestosCambiadosPdf');
    Route::get('/repuestosCambiados/pdf/{fecha_inicial}/{fecha_final}/{tipo}', 'GerencialController@repuestosCambiadosPdf')->name('gerenciales.repuestosCambiadosImprimir');
    Route::get('/repuestosCambiados/excel/{fecha_inicial}/{fecha_final}/{tipo}', 'GerencialController@repuestosCambiadosExcel')->name('gerenciales.repuestosCambiadosExcel');

    Route::get('/mantenimientos','GerencialController@mantenimientosRealizados')->name('gerenciales.mantenimientosRealizados');
    Route::post('/mantenimientos/pdf/{fecha_inicial}/{fecha_final}/{tipo}', 'GerencialController@mantenimientosRealizadosPdf')->name('gerenciales.mantenimientosRealizadosPdf');
    Route::get('/mantenimientos/pdf/{fecha_inicial}/{fecha_final}/{tipo}', 'GerencialController@mantenimientosRealizadosPdf')->name('gerenciales.mantenimientosRealizadosImprimir');
    Route::get('/mantenimientos/excel/{fecha_inicial}/{fecha_final}/{tipo}', 'GerencialController@mantenimientosRealizadosExcel')->name('gerenciales.mantenimientosRealizadosExcel');


    Route::get('/licencias','TacticoController@licenciasPorVencer')->name('tacticos.licenciasPorVencer');
    Route::post('/licencias/pdf/{vencida}/{tipo}', 'TacticoController@licenciasPorVencerPdf')->name('tacticos.licenciasPorVencerPdf');
    Route::get('/licencias/pdf/{vencida}/{tipo}', 'TacticoController@licenciasPorVencerPdf')->name('tacticos.licenciasPorVencerImprimir');
    Route::get('/licencias/excel/{vencida}/{tipo}', 'TacticoController@licenciasPorVencerExcel')->name('tacticos.licenciasPorVencerExcel');




    //RUTAS GONZALO
    Route::post('/info40', 'GerencialController@verInfo40')->name('info40');
    Route::post('/pdfinfo40/{tipo}', 'GerencialController@pdfInfo40')->name('pdfinfo40');
    Route::get('/impinfo40/{tipo}', 'GerencialController@pdfInfo40')->name('impinfo40');
    Route::get('/soliInf40', 'GerencialController@getEqui')->name('soli40');
    Route::get('/excellinfo40/{tipo}', 'GerencialController@excellInfo40')->name('excellinfo40');
    Route::get('/deptmante', 'GerencialController@ManDep')->name('depmant');
    Route::get('/soliInfdepma', 'GerencialController@soliDepMant')->name('solidepmant');
    Route::post('/pdfmanDeto/{fecha_inicial}/{fecha_final}/{tipo}', 'GerencialController@pdfMandep')->name('pdfmanDeto');
    Route::get('/impmanDeto/{fecha_inicial}/{fecha_final}/{tipo}', 'GerencialController@pdfMandep')->name('impmanDeto');
    Route::get('/excelmanDeto/{fecha_inicial}/{fecha_final}/{tipo}', 'GerencialController@ExcelMandep')->name('excelmanDeto');
    Route::get('/solimantempl', 'TacticoController@SoliMantEmple')->name('solimantempl');
    Route::get('/premantempl', 'TacticoController@PrevMantEmple')->name('premantempl');
    Route::post('/pdfmantempl/{fecha_inicial}/{fecha_final}', 'TacticoController@PdfMantEmple')->name('pdfmantempl'); 
    Route::get('/impmantempl/{fecha_inicial}/{fecha_final}', 'TacticoController@PdfMantEmple')->name('impmantempl');
    Route::get('/excelmantempl/{fecha_inicial}/{fecha_final}', 'TacticoController@ExcelMantEmple')->name('excelmantempl');
    Route::get('/soligaranven', 'TacticoController@SoliGaraVen')->name('soligaranven');
    Route::get('/pregaranven', 'TacticoController@PrevGaraVen')->name('pregaranven');
    Route::post('/pdfgaranve/{tipo}', 'TacticoController@pdfGaraVen')->name('pdfgaranve');
    Route::get('/impgaranve/{tipo}', 'TacticoController@pdfGaraVen')->name('impgaranve');
    Route::get('/excelgaranve/{tipo}', 'TacticoController@ExcelGaraVen')->name('excelgaranve');
    

    //RUTAS EDWIN
    Route::get('/reportes/mantsxuser', 'GerencialController@getMantsXUser')->name('MantsXUser');
    Route::get('/reportes/equipoDescargado', 'TacticoController@getEquipoDescargado')->name('EquipoDescargado');
    Route::post('/reportes/mantsxuser', 'GerencialController@postMantsXUser')->name('PostMantUsrs');
    Route::post('/reportes/equipoDescargado', 'TacticoController@postEquipoDescargado')->name('PostEquipoDescargado');
    Route::get('/etl',function() { return view('gerenciales.etl'); })->name('etlManual');
    Route::post('/etl','GerencialController@generateETL');



    //RUTAS MARVIN
    Route::get('/usuarios', 'UserController@index')->name('usuarios.index');
    Route::get('/usuarios/{usuario}/editar', 'UserController@edit')->name('usuarios.edit');
    Route::post('/usuarios/{usuario}/actualizar', 'UserController@update')->name('usuarios.update');

    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->name('logs');

    Route::get('/reportes/equipoAntiguo', 'TacticoController@equipoAntiguoIndex')->name('tacticos.equipoAntiguoIndex');
    Route::post('/reportes/equipoAntiguo', 'TacticoController@equipoAntiguoGenerate')->name('tacticos.equipoAntiguoGenerate');
    Route::get('/reportes/equipoAntiguo/imprimir', 'TacticoController@equipoAntiguoImprimir')->name('tacticos.equipoAntiguoImprimirGet');
    Route::post('/reportes/equipoAntiguo/imprimir', 'TacticoController@equipoAntiguoImprimir')->name('tacticos.equipoAntiguoImprimirPost');
    Route::get('/reportes/equipoAntiguo/pdf/{compu?}/{impre?}', 'TacticoController@equipoAntiguoPdf')->name('tacticos.equipoAntiguoPdf');
    Route::get('/reportes/equipoAntiguo/excel/{compu?}/{impre?}', 'TacticoController@equipoAntiguoExcel')->name('tacticos.equipoAntiguoExcel');

});

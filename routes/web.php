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
    Route::get('/equipoportipo', 'GerencialController@equipoPorTipo')->name('gerenciales.equipoportipo')->middleware('can:report.equipoAgregado');
    Route::post('/equipoportipo/pdf/{fecha_inicial}/{fecha_final}/{tipo}', 'GerencialController@equipoPorTipoPdf')->name('gerenciales.equipoportipoPdf')->middleware('can:report.equipoAgregado');
    Route::get('/equipoportipo/pdf/{fecha_inicial}/{fecha_final}/{tipo}', 'GerencialController@equipoPorTipoPdf')->name('gerenciales.equipoportipoImprimir')->middleware('can:report.equipoAgregado');
    Route::get('/equipoportipo/Excel/{fecha_inicial}/{fecha_final}/{tipo}', 'GerencialController@equipoPorTipoExcel')->name('gerenciales.equipoportipoExcel')->middleware('can:report.equipoAgregado');
    
    Route::get('/repuestosCambiados','GerencialController@repuestosCambiados')->name('gerenciales.repuestosCambiados')->middleware('can:report.repuestosCambiados');
    Route::post('/repuestosCambiados/pdf/{fecha_inicial}/{fecha_final}/{tipo}', 'GerencialController@repuestosCambiadosPdf')->name('gerenciales.repuestosCambiadosPdf')->middleware('can:report.repuestosCambiados');
    Route::get('/repuestosCambiados/pdf/{fecha_inicial}/{fecha_final}/{tipo}', 'GerencialController@repuestosCambiadosPdf')->name('gerenciales.repuestosCambiadosImprimir')->middleware('can:report.repuestosCambiados');
    Route::get('/repuestosCambiados/excel/{fecha_inicial}/{fecha_final}/{tipo}', 'GerencialController@repuestosCambiadosExcel')->name('gerenciales.repuestosCambiadosExcel')->middleware('can:report.repuestosCambiados');

    Route::get('/mantenimientos','GerencialController@mantenimientosRealizados')->name('gerenciales.mantenimientosRealizados')->middleware('can:report.mantenimientosRealizados');
    Route::post('/mantenimientos/pdf/{fecha_inicial}/{fecha_final}/{tipo}', 'GerencialController@mantenimientosRealizadosPdf')->name('gerenciales.mantenimientosRealizadosPdf')->middleware('can:report.mantenimientosRealizados');
    Route::get('/mantenimientos/pdf/{fecha_inicial}/{fecha_final}/{tipo}', 'GerencialController@mantenimientosRealizadosPdf')->name('gerenciales.mantenimientosRealizadosImprimir')->middleware('can:report.mantenimientosRealizados');
    Route::get('/mantenimientos/excel/{fecha_inicial}/{fecha_final}/{tipo}', 'GerencialController@mantenimientosRealizadosExcel')->name('gerenciales.mantenimientosRealizadosExcel')->middleware('can:report.mantenimientosRealizados');


    Route::get('/licencias','TacticoController@licenciasPorVencer')->name('tacticos.licenciasPorVencer')->middleware('can:report.licencias');
    Route::post('/licencias/pdf/{vencida}/{tipo}', 'TacticoController@licenciasPorVencerPdf')->name('tacticos.licenciasPorVencerPdf')->middleware('can:report.licencias');
    Route::get('/licencias/pdf/{vencida}/{tipo}', 'TacticoController@licenciasPorVencerPdf')->name('tacticos.licenciasPorVencerImprimir')->middleware('can:report.licencias');
    Route::get('/licencias/excel/{vencida}/{tipo}', 'TacticoController@licenciasPorVencerExcel')->name('tacticos.licenciasPorVencerExcel')->middleware('can:report.licencias');




    //RUTAS GONZALO
    Route::post('/info40', 'GerencialController@verInfo40')->name('info40')->middleware('can:report.mayor40Adqui');
    Route::post('/pdfinfo40/{tipo}', 'GerencialController@pdfInfo40')->name('pdfinfo40')->middleware('can:report.mayor40Adqui');
    Route::get('/impinfo40/{tipo}', 'GerencialController@pdfInfo40')->name('impinfo40')->middleware('can:report.mayor40Adqui');
    Route::get('/soliInf40', 'GerencialController@getEqui')->name('soli40')->middleware('can:report.mayor40Adqui');
    Route::get('/excellinfo40/{tipo}', 'GerencialController@excellInfo40')->name('excellinfo40')->middleware('can:report.mayor40Adqui');
    Route::get('/deptmante', 'GerencialController@ManDep')->name('depmant')->middleware('can:report.cantidadManteniDepto');
    Route::get('/soliInfdepma', 'GerencialController@soliDepMant')->name('solidepmant')->middleware('can:report.cantidadManteniDepto');
    Route::post('/pdfmanDeto/{fecha_inicial}/{fecha_final}/{tipo}', 'GerencialController@pdfMandep')->name('pdfmanDeto')->middleware('can:report.cantidadManteniDepto');
    Route::get('/impmanDeto/{fecha_inicial}/{fecha_final}/{tipo}', 'GerencialController@pdfMandep')->name('impmanDeto')->middleware('can:report.cantidadManteniDepto');
    Route::get('/excelmanDeto/{fecha_inicial}/{fecha_final}/{tipo}', 'GerencialController@ExcelMandep')->name('excelmanDeto')->middleware('can:report.cantidadManteniDepto');
    Route::get('/solimantempl', 'TacticoController@SoliMantEmple')->name('solimantempl')->middleware('can:report.cantidadManteniSolicitados');
    Route::get('/premantempl', 'TacticoController@PrevMantEmple')->name('premantempl')->middleware('can:report.cantidadManteniSolicitados');
    Route::post('/pdfmantempl/{fecha_inicial}/{fecha_final}', 'TacticoController@PdfMantEmple')->name('pdfmantempl')->middleware('can:report.cantidadManteniSolicitados'); 
    Route::get('/impmantempl/{fecha_inicial}/{fecha_final}', 'TacticoController@PdfMantEmple')->name('impmantempl')->middleware('can:report.cantidadManteniSolicitados');
    Route::get('/excelmantempl/{fecha_inicial}/{fecha_final}', 'TacticoController@ExcelMantEmple')->name('excelmantempl')->middleware('can:report.cantidadManteniSolicitados');
    Route::get('/soligaranven', 'TacticoController@SoliGaraVen')->name('soligaranven')->middleware('can:report.garantiasVencidas');
    Route::get('/pregaranven', 'TacticoController@PrevGaraVen')->name('pregaranven')->middleware('can:report.garantiasVencidas');
    Route::post('/pdfgaranve/{tipo}', 'TacticoController@pdfGaraVen')->name('pdfgaranve')->middleware('can:report.garantiasVencidas');
    Route::get('/impgaranve/{tipo}', 'TacticoController@pdfGaraVen')->name('impgaranve')->middleware('can:report.garantiasVencidas');
    Route::get('/excelgaranve/{tipo}', 'TacticoController@ExcelGaraVen')->name('excelgaranve')->middleware('can:report.garantiasVencidas');
    

    //RUTAS EDWIN
    Route::get('/reportes/mantsxuser', 'GerencialController@getMantsXUser')->name('MantsXUser')->middleware('can:report.clientesYMantenimientos');
    Route::get('/reportes/equipoDescargado', 'TacticoController@getEquipoDescargado')->name('EquipoDescargado')->middleware('can:report.equipoDescargado');
    Route::post('/reportes/mantsxuser', 'GerencialController@postMantsXUser')->name('PostMantUsrs')->middleware('can:report.clientesYMantenimientos');
    Route::post('/reportes/equipoDescargado', 'TacticoController@postEquipoDescargado')->name('PostEquipoDescargado')->middleware('can:report.equipoDescargado');
    Route::get('/etl',function() { return view('gerenciales.etl'); })->name('etlManual')->middleware('can:etl');
    Route::post('/etl','GerencialController@generateETL')->middleware('can:etl');



    //RUTAS MARVIN
    Route::get('/usuarios', 'UserController@index')->name('usuarios.index')->middleware('can:users.index');
    Route::get('/usuarios/{usuario}/editar', 'UserController@edit')->name('usuarios.edit')->middleware('can:users.edit');
    Route::post('/usuarios/{usuario}/actualizar', 'UserController@update')->name('usuarios.update')->middleware('can:users.edit');
    Route::get('/usuarios/reporte', 'UserController@reporte')->name('usuarios.reporte')->middleware('can:users.report');

    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->name('logs')->middleware('can:bitacora');

    Route::get('/reportes/equipoAntiguo', 'TacticoController@equipoAntiguoIndex')->name('tacticos.equipoAntiguoIndex')->middleware('can:report.equipoAntiguo');
    Route::post('/reportes/equipoAntiguo', 'TacticoController@equipoAntiguoGenerate')->name('tacticos.equipoAntiguoGenerate')->middleware('can:report.equipoAntiguo');
    Route::get('/reportes/equipoAntiguo/imprimir', 'TacticoController@equipoAntiguoImprimir')->name('tacticos.equipoAntiguoImprimirGet')->middleware('can:report.equipoAntiguo');
    Route::post('/reportes/equipoAntiguo/imprimir', 'TacticoController@equipoAntiguoImprimir')->name('tacticos.equipoAntiguoImprimirPost')->middleware('can:report.equipoAntiguo');
    Route::get('/reportes/equipoAntiguo/pdf/{compu?}/{impre?}', 'TacticoController@equipoAntiguoPdf')->name('tacticos.equipoAntiguoPdf')->middleware('can:report.equipoAntiguo');
    Route::get('/reportes/equipoAntiguo/excel/{compu?}/{impre?}', 'TacticoController@equipoAntiguoExcel')->name('tacticos.equipoAntiguoExcel')->middleware('can:report.equipoAntiguo');

});

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use DateTime;
use Auth;
use PDF;
use Excel;
use App\Upkeep;
use App\Product;
use App\User;
use App\Exports\EquipoViejoExport;
use App\Exports\ManEmplExport;
use App\Exports\GaranVenExport;
use App\Exports\LicenciasPorVencerExport;
use App\Exports\EqDescargadoExport;
use Carbon\Carbon;

class TacticoController extends Controller
{

/////////////////////////REPORTE EQUIPOS DESCARGADOS//////////////////////////
  public function getEquipoDescargado(){
    Log::info("El usuarios: '".Auth::user()->name."' ha ingresado a la pantalla de equipo descargado.");
    return view('tacticos.formEquipoDescargado', ['errores' => '']);
  }

  public function postEquipoDescargado(Request $request){
    Log::info("El usuarios: '".Auth::user()->name."' ha solicitado un reporte de equipos descargados.");
    $tipo = $request->input('tipo_arr', [200]);
    $fecha_inicial = $request->input('fecha_inicial');
    $fecha_final = $request->input('fecha_final');

    if($this->validarArrayTipo($tipo) && $this->validarFechas($fecha_inicial, $fecha_final)){
      $productos = $this-> getProductosDescargados($tipo, $fecha_inicial, $fecha_final);
      $retVals = ['productos' => $productos,
      'tipo'=>$tipo,
      'fecha_inicial'=> $fecha_inicial,
      'fecha_final'=> $fecha_final];
      return view('tacticos.repEquipoDescargado', $retVals);
    }

    $errores = "Error en los datos ingresados";
    return view('tacticos.formEquipoDescargado', ['errores' => $errores]);
  }

public function pdfEquipoDescargado(Request $request,$tipo, $fecha_inicial,$fecha_final, $valor){
  $imprimir = 1;
  $tipos = explode(',', $tipo);

  $date = Carbon::now();
  if( $this->validarFechas($fecha_inicial, $fecha_final)){
    $productos = $this-> getProductosDescargados($tipos, $fecha_inicial, $fecha_final);
    switch($valor){
      case "pdf":
      Log::info("El usuarios: '".Auth::user()->name."' ha exportado a PDF el reporte de equipo descargado");
      $pdf = PDF::loadView('pdf.pdfEquiposDescargados', compact('productos','fecha_inicial','fecha_final', 'date'))->setPaper(array(0,0,612.00,792.00));
      return $pdf->stream('reportEquipoDescargado.pdf',array("Attachment" => 0));
     break;
    case "print":
    Log::info("El usuarios: '".Auth::user()->name."' ha mandado a imprimir el reporte de equipo descargado");
    return view('pdf.pdfEquiposDescargados',compact('productos','fecha_inicial','fecha_final','imprimir', 'date'));
    case "excel":
    Log::info("El usuarios: '".Auth::user()->name."' ha exportado en Excel el reporte de equipo descargado");
    return Excel::download(new EqDescargadoExport($productos), 'EquipoDescargado_'.Carbon::now()->format('d-m-y').'.xlsx');
    break;
    }
  }
  $errores = "Error en los datos ingresados";
  return view('tacticos.formEquipoDescargado', ['errores' => $errores]);


}

  //Valida qe cada elemento del array sea un entero.
  private function validarArrayTipo($tipo_arr){
    $valido = true;
    foreach($tipo_arr as $tipo){
      if(!$this->validarInt($tipo)){$valido = false; break;}
    }
    return $valido;
  }

  //Valida que $entero sea un entero positivo de hasta 4 digits. 0-9999
  private function validarInt($entero){
    return (int)@preg_match('(^[0-9]{1,4}$)', $entero) && $entero > 0;
  }

  //Valida que fecha no sea un string vacio y tenga el formato correcto
  private function validarFechas($fecha_inicial, $fecha_final){
    if ($fecha_final =="" && $fecha_inicial ==""){
      return false;
    }

    $fecha1_arr = explode('-', $fecha_inicial);
    $fecha2_arr = explode('-', $fecha_final);

    return ($fecha_final >= $fecha_inicial &&
      //checkdate exige formato mm-dd-yyyy
      //Las fechas tienen formato yyyy-mm-dd
      checkdate($fecha1_arr[1], $fecha1_arr[2], $fecha1_arr[0]) &&
      checkdate($fecha2_arr[1], $fecha2_arr[2], $fecha2_arr[0]));
  }

  //1>PCs, 2>Impresora, 3>Todo
  private function getProductosDescargados($tipo_arr=[-1], $fecha_inicial, $fecha_final){

    $inicial = new DateTime($fecha_inicial);
    $final = new DateTime($fecha_final);

    $releases = DB::table('products')
      ->join('product_release', 'products.id', 'product_release.product_id')
      ->join('releases', 'releases.id', 'product_release.release_id')
      ->select('products.numSe', 'products.numInv', 'products.marca', 'products.modelo', 'releases.codigo')
      ->groupBy('products.numSe', 'products.numInv', 'products.marca', 'products.modelo', 'releases.codigo')
      ->whereDate('releases.created_at', '>=', $inicial)
      ->whereDate('releases.created_at', '<=', $final)
      ->whereIn('products.tipo', $tipo_arr)
      ->get();

      return $releases;
    }
    //////////////////////// FIN DE REPORTE ////////////////////////////////////////


    //////////////////////// REPORTE EQUIPO ANTIGUO////////////////////////////////

    public function equipoAntiguoIndex()
    {
      Log::info("El usuario: '".Auth::user()->name."' seleccionó que desea configurar el reporte: Ver empleados con equipo antiguo");
      return view('tacticos.reporteEquipoAntiguoIndex');
    }

    public function equipoAntiguoGenerate(Request $request)
    {

      if($request['tipo'] == null) return redirect('reportes/equipoAntiguo')->with('status', 'Debe seleccionar al menos un tipo de equipo de la lista');

      $computadoras = null;
      $impresoras = null;
      foreach($request['tipo'] as $tipo) {
        if($tipo == Product::$COMPUTADORA) {
          $computadoras = Product::where('tipo', $tipo)->where('fechaAdqui', '<=', Carbon::now()->subyears(3))->get();
        } elseif($tipo == Product::$IMPRESORA) {
          $impresoras = Product::where('tipo', $tipo)->where('fechaAdqui', '<=', Carbon::now()->subyears(3))->get();
        }
      }

      Log::info("El usuario: '".Auth::user()->name."' está viendo el reporte: Ver empleados con equipo antiguo");

      return view('tacticos.reporteEquipoAntiguoIndex')->with('computadoras', $computadoras)->with('impresoras', $impresoras);
    }

    public function equipoAntiguoImprimir(Request $request)
    {
      switch($request->method()) {
        case "POST":
          Log::info("El usuario: '".Auth::user()->name."' indicó IMPRIMIR reporte de empleados con equipo informático viejo > 3 años");
          $computadoras = null;
          $impresoras = null;
          foreach($request['tipo'] as $tipo) {
            if($tipo == Product::$COMPUTADORA) {
              $computadoras = Product::where('tipo', $tipo)->where('fechaAdqui', '<=', Carbon::now()->subyears(3))->get();
            } elseif($tipo == Product::$IMPRESORA) {
              $impresoras = Product::where('tipo', $tipo)->where('fechaAdqui', '<=', Carbon::now()->subyears(3))->get();
            }
          }
          return redirect()->route('tacticos.equipoAntiguoImprimirGet')->with('computadoras', $computadoras)->with('impresoras', $impresoras);
        break;
        case "GET":
        Log::info("El usuario: '".Auth::user()->name."' Ya está en la vista de impresión del reporte empleados con equipo informático viejo > 3 años");
          return view('pdf.equipoAntiguoImprimir');
        break;
      }
    }

    public function equipoAntiguoPdf($compu=null, $impre=null)
    {
      $computadoras = null;
      $impresoras = null;
      if($compu == Product::$COMPUTADORA) {
        $computadoras = Product::where('tipo', $compu)->where('fechaAdqui', '<=', Carbon::now()->subyears(3))->get();
      }
      if($impre == Product::$IMPRESORA) {
        $impresoras = Product::where('tipo', $impre)->where('fechaAdqui', '<=', Carbon::now()->subyears(3))->get();
      }
      $pdf = PDF::loadView('pdf.equipoAntiguoPdf', ["computadoras" => $computadoras, "impresoras" => $impresoras]);
      Log::info("El usuarios: '".Auth::user()->name."' ha exportado a PDF el reporte de Empleados con equipo viejo > 3 años");
      return $pdf->stream('empleadosEquipoViejo_'.Carbon::now()->format('d-m-y').'.pdf');
    }

    public function equipoAntiguoExcel($compu=null, $impre=null)
    {
      $computadoras = null;
      $impresoras = null;
      if($compu == Product::$COMPUTADORA) {
        $computadoras = Product::where('tipo', $compu)->where('fechaAdqui', '<=', Carbon::now()->subyears(3))->get();
      }
      if($impre == Product::$IMPRESORA) {
        $impresoras = Product::where('tipo', $impre)->where('fechaAdqui', '<=', Carbon::now()->subyears(3))->get();
      }
      Log::info("El usuarios: '".Auth::user()->name."' ha exportado a EXCEL el reporte de Empleados con equipo viejo > 3 años");
      return Excel::download(new EquipoViejoExport($computadoras, $impresoras), 'empleadosEquipoViejo_'.Carbon::now()->format('d-m-y').'.xlsx');

    }

    ////////////////////////////////FIN DEL REPORTE DE EQUIPO ANTIGUO////////////////////////////////////77


    /////REPORTE DE LICENCIAS POR VENCER////////
    public function licenciasPorVencer(Request $request){
      $date=Carbon::now();
      $date=$date->toDateString();
      $vencida=$request->get('vencida');
      $tipo=3;
      $tipos=$tipo; //para usar en el where dentro del when
      if(isset($tipo)){
      if($vencida==1){
      $products=DB::table('products as p')
      ->join('product_licence as pl','p.id','=','pl.product_id')
      ->join('licences as l','pl.licence_id','=','l.id')
      ->select('p.numSe','p.numInv','p.tipo','p.valorAdqui as descripcion','l.nombre','l.fechaVencimiento')
      ->when($tipo!=3, function ($products, $tipo) use($tipos) {//si tipo no es 3 ( es 1 o 2) agrega un where para filtar por pc o impresora
              return $products->where('p.tipo',$tipos);
      })->WhereDate('l.fechaVencimiento','<=',Carbon::now())->orderBy('p.id')->paginate();
      }else if($vencida==2){
        $products=DB::table('products as p')
      ->join('product_licence as pl','p.id','=','pl.product_id')
      ->join('licences as l','pl.licence_id','=','l.id')
      ->select('p.numSe','p.numInv','p.tipo','p.valorAdqui as descripcion','l.nombre','l.fechaVencimiento')
      ->when($tipo!=3, function ($products, $tipo) use($tipos) {
        return $products->where('p.tipo',$tipos);
      })->WhereDate('l.fechaVencimiento','>=',Carbon::now())
      ->Where( DB::raw('DATEDIFF(l.fechaVencimiento,NOW()) <= 90'),1)->orderBy('p.id')->paginate();
      }
      //consulta para ambas
      // $products=DB::table('products as p')
      // ->join('product_licence as pl','p.id','=','pl.product_id')
      // ->join('licences as l','pl.licence_id','=','l.id')
      // ->select('p.numSe','p.numInv','p.tipo','p.valorAdqui as descripcion','l.nombre','l.fechaVencimiento')
      // ->orWhereDate('l.fechaVencimiento','<=',Carbon::now())->orWhere( DB::raw('DATEDIFF(l.fechaVencimiento,NOW()) <= 90'),1)->orderBy('p.id')->paginate();
      Log::info("El usuarios: '".Auth::user()->name."' ha ingresado al reporte de licencias por vencer");
      return view('tacticos.reporteLicenciasPorVencer',compact('products','tipo','vencida'));
  }else{

    return view ('tacticos.reporteLicenciasPorVencer');
  }
    }

    public function licenciasPorVencerPDF(Request $request,$vencida,$tipo)
    {
      $products=array();
      $imprimir=1;
      $date=Carbon::now();
      $date=$date->toDateString();
      $tipos=$tipo; //para usar en el where dentro del when
      if($vencida==1){
      $products=DB::table('products as p')
      ->join('product_licence as pl','p.id','=','pl.product_id')
      ->join('licences as l','pl.licence_id','=','l.id')
      ->select('p.numSe','p.numInv','p.tipo','p.valorAdqui as descripcion','l.nombre','l.fechaVencimiento')
      ->when($tipo!=3, function ($products, $tipo) use($tipos) {//si tipo no es 3 ( es 1 o 2) agrega un where para filtar por pc o impresora
              return $products->where('p.tipo',$tipos);
      })->WhereDate('l.fechaVencimiento','<=',Carbon::now())->orderBy('p.id')->paginate();
      }else if($vencida==2){
        $products=DB::table('products as p')
      ->join('product_licence as pl','p.id','=','pl.product_id')
      ->join('licences as l','pl.licence_id','=','l.id')
      ->select('p.numSe','p.numInv','p.tipo','p.valorAdqui as descripcion','l.nombre','l.fechaVencimiento')
      ->when($tipo!=3, function ($products, $tipo) use($tipos) {
        return $products->where('p.tipo',$tipos);
      })->WhereDate('l.fechaVencimiento','>=',Carbon::now())
      ->Where( DB::raw('DATEDIFF(l.fechaVencimiento,NOW()) <= 90'),1)->orderBy('p.id')->paginate();
      }
       Log::info("El usuario: '".Auth::user()->name." Vió el reporte de equipos agregados a inventario");
       $date = Carbon::now();
       $date = $date->format('d-m-Y');
       switch($request->method()){
        case "POST":
        Log::info("El usuarios: '".Auth::user()->name."' ha exportado a EXCEL el reporte de licencias por vencer");
       $pdf = PDF::loadView('pdf.licenciasPorVencerPdf', compact('products','date'))->setPaper(array(0,0,612.00,792.00));
       return $pdf->stream('EquipoPorTipo_'.$date.'pdf',array("Attachment" => 0));
       break;
    case "GET":
    Log::info("El usuarios: '".Auth::user()->name."' ha indicado imprimir el reporte de licencias por vencer");
    return view('pdf.licenciasPorVencerPdf',compact('products','fecha_inicial','fecha_final','tipo','imprimir','date'));
    }
  }

  public function licenciasPorVencerExcel($vencida,$tipo)
  {
    $date=Carbon::now();
      $date=$date->toDateString();
      $tipos=$tipo; //para usar en el where dentro del when
      if($vencida==1){
      $products=DB::table('products as p')
      ->join('product_licence as pl','p.id','=','pl.product_id')
      ->join('licences as l','pl.licence_id','=','l.id')
      ->select('p.numSe','p.numInv','p.tipo','p.valorAdqui as descripcion','l.nombre','l.fechaVencimiento')
      ->when($tipo!=3, function ($products, $tipo) use($tipos) {//si tipo no es 3 ( es 1 o 2) agrega un where para filtar por pc o impresora
              return $products->where('p.tipo',$tipos);
      })->WhereDate('l.fechaVencimiento','<=',Carbon::now())->orderBy('p.id')->paginate();
      }else if($vencida==2){
        $products=DB::table('products as p')
      ->join('product_licence as pl','p.id','=','pl.product_id')
      ->join('licences as l','pl.licence_id','=','l.id')
      ->select('p.numSe','p.numInv','p.tipo','p.valorAdqui as descripcion','l.nombre','l.fechaVencimiento')
      ->when($tipo!=3, function ($products, $tipo) use($tipos) {
        return $products->where('p.tipo',$tipos);
      })->WhereDate('l.fechaVencimiento','>=',Carbon::now())
      ->Where( DB::raw('DATEDIFF(l.fechaVencimiento,NOW()) <= 90'),1)->orderBy('p.id')->paginate();
      }
    Log::info("El usuarios: '".Auth::user()->name."' ha exportado a EXCEL el reporte de equipo con licencias vencidas/por vencer");
    return Excel::download(new LicenciasPorVencerExport($products), 'equipoLicenciasPorVencer'.Carbon::now()->format('d-m-y').'.xlsx');

  }
        ////////////////////////////////FIN DEL REPORTE LICENCIAS POR VENCER////////////////////////////////////

/////REPORTE DE MANTENIMIENTOS SOLICITADOS EN RANGO DE TIEMPO////////


 public function SoliMantEmple(){
  Log::info("El usuarios: '".Auth::user()->name."' ha ingresado a la pantalla de entrada para el reporte cant de soli mante por empleado");
  return view('tacticos.soliEmplMante');
  }

  public function PrevMantEmple(Request $request)
  {

  $fecha_inicial=$request->get('desde');
  $fecha_final=$request->get('hasta');

 if($this->validarFechas($fecha_inicial,$fecha_final)){
  $empleManto=DB::select("select users.name as nombre  ,products.numSe,products.numInv,products.marca,products.modelo,products.tipo, COUNT(upkeeps.product_id) as Cantidad
  from users JOIN products on users.id = products.employee_id
  JOIN upkeeps on products.id = upkeeps.product_id
  WHERE upkeeps.created_at > ? AND upkeeps.created_at< ?
  GROUP BY  users.id",[$fecha_inicial,$fecha_final]);
    $date = Carbon::now();
    $date = $date->format('d-m-Y');
    Log::info("El usuarios: '".Auth::user()->name."' ha solicitado la vista previa al reporte cant de soli mante por empleado");
   return view('tacticos.prevRepoEmplMante',compact('empleManto','date','fecha_inicial','fecha_final'));

}
  return view('tacticos.soliEmplMante')->withErrors('Error en las fechas ingresadas');

}

  public function PdfMantEmple(Request $request,$fecha_inicial,$fecha_final){
    $imprimir=1;
    $empleManto=DB::select("select users.name as nombre  ,products.numSe,products.numInv,products.marca,products.modelo,products.tipo, COUNT(upkeeps.product_id) as Cantidad
    from users JOIN products on users.id = products.employee_id
    JOIN upkeeps on products.id = upkeeps.product_id
    WHERE upkeeps.created_at > ? AND upkeeps.created_at< ?
    GROUP BY  users.id",[$fecha_inicial,$fecha_final]);


  $date= Carbon::now();
  $date = $date->format('d-m-Y');
  $fechaInicial = Carbon::parse( $fecha_inicial );
  $fechaInicial = $fechaInicial->format('d-m-Y');
  $fechaFinal = Carbon::parse( $fecha_final );
  $fechaFinal = $fechaFinal->format('d-m-Y');
switch($request->method()){
  case "POST":
  Log::info("El usuarios: '".Auth::user()->name."' ha exportado a PDF el reporte de Cantidad de mantenimientos por empleado");
  $pdf = PDF::loadView('pdf.EmpleadoMantenimiento', compact('empleManto','date','fechaInicial','fechaFinal'))->setPaper(array(0,0,612.00,792.00));
  return $pdf->stream('repoManSoli.pdf',array("Attachment" => 0));
 break;
case "GET":
Log::info("El usuarios: '".Auth::user()->name."' ha solicitado IMPRIMIR el reporte de Cantidad de mantenimientos por empleado");
return view('pdf.EmpleadoMantenimiento',compact('empleManto','date','imprimir'));
}
  }

  public function ExcelMantEmple($fecha_inicial,$fecha_final){
    $empleManto=DB::select("select users.name as nombre  ,products.numSe,products.numInv,products.marca,products.modelo,products.tipo, COUNT(upkeeps.product_id) as Cantidad
    from users JOIN products on users.id = products.employee_id
    JOIN upkeeps on products.id = upkeeps.product_id
    WHERE upkeeps.created_at > ? AND upkeeps.created_at< ?
    GROUP BY  users.id",[$fecha_inicial,$fecha_final]);
    $fechaInicial = Carbon::parse( $fecha_inicial );
    $fechaInicial = $fechaInicial->format('d-m-Y');
    $fechaFinal = Carbon::parse( $fecha_final );
    $fechaFinal = $fechaFinal->format('d-m-Y');
    Log::info("El usuarios: '".Auth::user()->name."' ha exportado a EXCEL el reporte de Cantidad de mantenimientos por empleado");
    return Excel::download(new ManEmplExport($empleManto,$fechaInicial,$fechaFinal), 'MantenimientosPorEmpleado_'.Carbon::now()->format('d-m-y').'.xlsx');
  }

/////Fin del reporte////

///Reporte de Garantias por vencer o vencidas//////

  public function SoliGaraVen(){
    Log::info("El usuarios: '".Auth::user()->name."' ha Ingresado a la pantalla de solicitud de reporte de garantias por vencer");
  return view('tacticos.SoliGarantiasPorVencer');
  }

  public function PrevGaraVen(Request $request){
    $fechafinal= Carbon::now();

    $products=DB::table('products')
    ->get();
    $i=0;
    $tipo=$request->tipo;
    $existeRegis=0;
   if($tipo==3){

    foreach ($products as $product) {
     $date=Carbon::parse($product->fechaAdqui);
    $fechaVenciminto=$date->addYear($product->garantia);

     $fechaActual = Carbon::parse( $fechafinal );  /// da formato Y-m-d
      if( $fechaActual > $fechaVenciminto){
       $empleManto[$i]=$product;
       $tiempoFaltante[$i]=0;
       $existeRegis=1;
      } else {
     $mesesDiferencia =$fechaVenciminto->diffInMonths($fechaActual);// compara las fechas para saber cuanto es la diferencia de meses

      if($mesesDiferencia <=3 ){
       $empleManto[$i]=$product;
       $tiempoFaltante[$i]=$mesesDiferencia;
       $existeRegis=1;
      }
    }

     $i=$i+1;
    }
    $date= Carbon::now();
    $date = $date->format('d-m-Y');


   // return view('tacticos.prevGarantiasPorVencer', compact('productVen','date','fecha_inicial','fecha_final'));

  }
  else{
    if($tipo==2){
      foreach ($products as $product) {
        $date=Carbon::parse($product->fechaAdqui);
       $fechaVenciminto=$date->addYear($product->garantia);

        $fechaActual = Carbon::parse( $fechafinal );  /// da formato Y-m-d
         if( $fechaActual > $fechaVenciminto){
          $empleManto[$i]=$product;
          $tiempoFaltante[$i]=0;
          $existeRegis=1;
         }
        $i=$i+1;
       }

      }else{
        if($tipo==1){

    foreach ($products as $product) {
      $date=Carbon::parse($product->fechaAdqui);
     $fechaVenciminto=$date->addYear($product->garantia);

      $fechaActual = Carbon::parse( $fechafinal );  /// da formato Y-m-d
       if( $fechaActual < $fechaVenciminto){
        $mesesDiferencia =$fechaVenciminto->diffInMonths($fechaActual);// compara las fechas para saber cuanto es la diferencia de meses

       if($mesesDiferencia <=3 ){
        $empleManto[$i]=$product;
        $tiempoFaltante[$i]=$mesesDiferencia;
        $existeRegis=1;
       }
       }

      $i=$i+1;
     }


    }
      }
  }
  if ($existeRegis==1) {
    $date= Carbon::now();
    $date = $date->format('d-m-Y');
    Log::info("El usuarios: '".Auth::user()->name."' ha ingresado a la vista previa del reporte de garantias por vencer");
      return view('tacticos.prevGarantiasPorVencer',compact('empleManto','date','tiempoFaltante','tipo'));
  }
  else {

  return view('tacticos.SoliGarantiasPorVencer')->withErrors('No hay ningun registro que cumpla con los parametros');

  }
 }

 public function pdfGaraVen(Request $request,$tipo)
 {

  $fechafinal= Carbon::now();
  $imprimir=1;
  $products=DB::table('products')
  ->get();
  $i=0;


 if($tipo==3){

  foreach ($products as $product) {
   $date=Carbon::parse($product->fechaAdqui);
  $fechaVenciminto=$date->addYear($product->garantia);

   $fechaActual = Carbon::parse( $fechafinal );  /// da formato Y-m-d
    if( $fechaActual > $fechaVenciminto){
     $empleManto[$i]=$product;
     $tiempoFaltante[$i]=0;
    } else {
   $mesesDiferencia =$fechaVenciminto->diffInMonths($fechaActual);// compara las fechas para saber cuanto es la diferencia de meses

    if($mesesDiferencia <=3 ){
     $empleManto[$i]=$product;
     $tiempoFaltante[$i]=$mesesDiferencia;
    }
  }

   $i=$i+1;
  }


 // return view('tacticos.prevGarantiasPorVencer', compact('productVen','date','fecha_inicial','fecha_final'));

}
else{
  if($tipo==2){
    foreach ($products as $product) {
      $date=Carbon::parse($product->fechaAdqui);
     $fechaVenciminto=$date->addYear($product->garantia);

      $fechaActual = Carbon::parse( $fechafinal );  /// da formato Y-m-d
       if( $fechaActual > $fechaVenciminto){
        $empleManto[$i]=$product;
        $tiempoFaltante[$i]=0;
       }
      $i=$i+1;
     }

    }else{
      if($tipo==1){

  foreach ($products as $product) {
    $date=Carbon::parse($product->fechaAdqui);
   $fechaVenciminto=$date->addYear($product->garantia);

    $fechaActual = Carbon::parse( $fechafinal );  /// da formato Y-m-d
     if( $fechaActual < $fechaVenciminto){
      $mesesDiferencia =$fechaVenciminto->diffInMonths($fechaActual);// compara las fechas para saber cuanto es la diferencia de meses

     if($mesesDiferencia <=3 ){
      $empleManto[$i]=$product;
      $tiempoFaltante[$i]=$mesesDiferencia;
     }
     }

    $i=$i+1;
   }

  }
    }
}
$date= Carbon::now();
  $date = $date->format('d-m-Y');
switch($request->method()){
  case "POST":
  Log::info("El usuarios: '".Auth::user()->name."' exportado a PDF el reporte de garantias por vencer");
 $pdf = PDF::loadView('pdf.equipoGarantivaVencida',compact('empleManto','date','tiempoFaltante','tipo'))->setPaper(array(0,0,612.00,792.00));
return $pdf->stream('GaranVeci.pdf',array("Attachment" => 0));
 break;
case "GET":
Log::info("El usuarios: '".Auth::user()->name."' ha mandado a imprimir el reporte de garantias por vencer");
return view('pdf.equipoGarantivaVencida',compact('empleManto','date','tiempoFaltante','tipo','imprimir'));
}
 }

 public function ExcelGaraVen($tipo)
 {

  $fechafinal= Carbon::now();

  $products=DB::table('products')
  ->get();
  $i=0;


 if($tipo==3){

  foreach ($products as $product) {
   $date=Carbon::parse($product->fechaAdqui);
  $fechaVenciminto=$date->addYear($product->garantia);

   $fechaActual = Carbon::parse( $fechafinal );  /// da formato Y-m-d
    if( $fechaActual > $fechaVenciminto){
     $empleManto[$i]=$product;
     $tiempoFaltante[$i]=0;
    } else {
   $mesesDiferencia =$fechaVenciminto->diffInMonths($fechaActual);// compara las fechas para saber cuanto es la diferencia de meses

    if($mesesDiferencia <=3 ){
     $empleManto[$i]=$product;
     $tiempoFaltante[$i]=$mesesDiferencia;
    }
  }

   $i=$i+1;
  }
  Log::info("El usuarios: '".Auth::user()->name."' ha exportado a EXCEL el reporte de Garantias por vencer o vencidas");
     return Excel::download(new GaranVenExport($empleManto,$tiempoFaltante), 'Garantias_por_vencer_o_vencidas_'.Carbon::now()->format('d-m-y').'.xlsx');

 // return view('tacticos.prevGarantiasPorVencer', compact('productVen','date','fecha_inicial','fecha_final'));

}
else{
  if($tipo==2){
    foreach ($products as $product) {
      $date=Carbon::parse($product->fechaAdqui);
     $fechaVenciminto=$date->addYear($product->garantia);

      $fechaActual = Carbon::parse( $fechafinal );  /// da formato Y-m-d
       if( $fechaActual > $fechaVenciminto){
        $empleManto[$i]=$product;
        $tiempoFaltante[$i]=0;
       }
      $i=$i+1;
     }
     Log::info("El usuarios: '".Auth::user()->name."' ha exportado a EXCEL el reporte de Garantias por vencer o vencidas");
     return Excel::download(new GaranVenExport($empleManto,$tiempoFaltante), 'Garantias_por_vencer_o_vencidas_'.Carbon::now()->format('d-m-y').'.xlsx');
    }else{
      if($tipo==1){

  foreach ($products as $product) {
    $date=Carbon::parse($product->fechaAdqui);
   $fechaVenciminto=$date->addYear($product->garantia);

    $fechaActual = Carbon::parse( $fechafinal );  /// da formato Y-m-d
     if( $fechaActual < $fechaVenciminto){
      $mesesDiferencia =$fechaVenciminto->diffInMonths($fechaActual);// compara las fechas para saber cuanto es la diferencia de meses

     if($mesesDiferencia <=3 ){
      $empleManto[$i]=$product;
      $tiempoFaltante[$i]=$mesesDiferencia;
     }
     }

    $i=$i+1;
   }
   Log::info("El usuarios: '".Auth::user()->name."' ha exportado a EXCEL el reporte de Cantidad de Garantias por vencer o vencidas");
   return Excel::download(new GaranVenExport($empleManto,$tiempoFaltante), 'Garantias_por_vencer_o_vencidas_'.Carbon::now()->format('d-m-y').'.xlsx');
  }
    }
}
 }


}

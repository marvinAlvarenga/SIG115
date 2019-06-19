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
use Carbon\Carbon;

class TacticoController extends Controller
{

/////////////////////////REPORTE EQUIPOS DESCARGADOS//////////////////////////
  public function getEquipoDescargado(){
    return view('tacticos.formEquipoDescargado', ['errores' => '']);
  }

  public function postEquipoDescargado(Request $request){
    $tipo = $request->input('tipo_arr', [200]);
    $fecha_inicial = $request->input('fecha_inicial');
    $fecha_final = $request->input('fecha_final');

    if($this->validarArrayTipo($tipo) && $this->validarFechas($fecha_inicial, $fecha_final)){
      $productos = $this-> getProductosDescargados($tipo, $fecha_inicial, $fecha_final);
      return view('tacticos.repEquipoDescargado', ['productos' => $productos]);
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

    public function mantenimientosRealizados(Request $request){
      $users=User::orderby('id','DESC')->paginate();
      return view('tacticos.reporteMantenimientos',compact('users'));
    }
  
    public function licenciasPorVencer(Request $request){
      $products=DB::table('products as p')->join('product_licence as pl','p.id','=','pl.product_id')->join('licences as l','pl.licence_id','=','l.id')->select('p.numSe','p.numInv','p.tipo','p.valorAdqui as descripcion','l.nombre','l.fechaVencimiento')->orderBy('p.id')->paginate();
      return view('tacticos.reportelicenciasPorVencer',compact('products'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DateTime;

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
}

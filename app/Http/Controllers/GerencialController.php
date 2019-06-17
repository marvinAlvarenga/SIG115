<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Spare;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Dompdf\Dompdf;
use DateTime;
use Barryvdh\DomPDF\Facade as PDF;
class GerencialController extends Controller
{


    public function equipoPorTipo(Request $request)
    {
      $products=array();
      $fecha_inicial=$request->get('desde');
      $fecha_final=$request->get('hasta');
      $tipo=$request->get('tipo');
      if(isset($tipo)){
     if($this->validarFechas($fecha_inicial,$fecha_final)){
       if($tipo==3){
        $products=Product::whereDate('created_at','>=',$fecha_inicial)->whereDate('created_at','<=',$fecha_final)->orderby('id','DESC')->paginate();
       }else{
        $products=Product::whereDate('created_at','>=',$fecha_inicial)->whereDate('created_at','<=',$fecha_final)->where('tipo',$tipo)->orderby('id','DESC')->paginate();
       }
      return view('gerenciales.equipoPorTipo',compact('products'));
    }else{
      return view('gerenciales.equipoPorTipo')->withErrors('Error en las fechas ingresadas');
    }}
    else{
      return view('gerenciales.equipoPorTipo');
    }
    }

    public function repuestosCambiados(Request $request){

      $spares=Spare::orderby('id','DESC')->paginate();
      return view('gerenciales.repuestosCambiados',compact('spares'));
    }

public function verInfo40()
    {
      $produc40=DB::select("select * from (select products.id, products.valorAdqui,products.marca,products.modelo,
      products.numInv,products.numSe,products.estado,sum(spares.valorAdqui) as costoSpares from products
      join upkeeps on products.id = upkeeps.product_id
      join upkeep_spare on upkeep_spare.upkeep_id = upkeeps.id
      join spares on spares.id = upkeep_spare.spare_id
      group by products.id) as prods
      where prods.costoSpares >= prods.ValorAdqui*0.4;");
      $date = Carbon::now();
      $date = $date->format('d-m-Y');

        return view('gerenciales.sobre4ad',compact('produc40','date'));
    }
public function pdfInfo40()
    {
      $produc40=DB::select("select * from (select products.id, products.valorAdqui,products.marca,products.modelo,
      products.numInv,products.numSe,products.estado,sum(spares.valorAdqui) as costoSpares from products
      join upkeeps on products.id = upkeeps.product_id
      join upkeep_spare on upkeep_spare.upkeep_id = upkeeps.id
      join spares on spares.id = upkeep_spare.spare_id
      group by products.id) as prods
      where prods.costoSpares >= prods.ValorAdqui*0.4;");
      $date = Carbon::now();
      $date = $date->format('d-m-Y');
      $pdf = PDF::loadView('pdf.info40', compact('produc40','date'))->setPaper(array(0,0,612.00,792.00));
      return $pdf->stream('repo40.pdf',array("Attachment" => 0));
    }


////////////REPORTE DE USRS QUE MAS MMTOS. SOLICITAN ////////////////////////////
    //Muestra el formulario
    //Pantalla por default al clickear en reportes > Clientes y mantenimientos
    public function getMantsXUser(){
        return view('gerenciales.formMantsXUsers', ['errores' => '']);
    }

    //Gestiona el formulario.
    //El user escoge mostrar a los N users que mas solicitaron mants en el intervalo.
    public function postMantsXUser(Request $request){
      $count = $request->input('count', '10');
      $fecha_inicial = $request->input('fecha_inicial');
      $fecha_final = $request->input('fecha_final');
      if ($this->validarFechas($fecha_inicial, $fecha_final) && $this->validarInt($count)) {
        $usuarios = $this->getUsersWithUpksRequestsBG($count, $fecha_inicial, $fecha_final);
        return view('gerenciales.resulMantsXUsers', ['usuarios' => $usuarios, 'errores' => '']);
      }
      $errores = 'Error en los datos ingresados';
      return view('gerenciales.formMantsXUsers', ['errores' => $errores]);
    }

    //arroja los N empleados que han solicitado mas mants
    //Entre las fechas inicial y final (recibe string > 'yyyy-mm-dd')
    //convierte a DateTime para comparar
    private function getUsersWithUpksRequestsBG($count=10, $fecha_inicial, $fecha_final){

      $inicial = new DateTime($fecha_inicial);
      $final = new DateTime($fecha_final);

      $usuarios = DB::table('upkeeps')
        ->join('products', 'products.id', 'upkeeps.product_id')
        ->rightJoin('employees', 'employees.id', 'products.employee_id')
        ->select('employees.id', 'employees.nombre', 'employees.ubicacion', DB::raw('count(upkeeps.id) as count'))
        ->groupBy('employees.id', 'employees.nombre', 'employees.ubicacion')
        ->take($count)
        ->whereDate('upkeeps.created_at', '>=', $inicial)
        ->whereDate('upkeeps.created_at', '<=', $final)
        ->get();


      return $usuarios;
    }

    //Valida que $entero sea un entero positivo de hasta 4 digits. 0-9999
    private function validarInt($entero){
      return (int)@preg_match('(^[0-9]{1,4}$)', $entero) && $entero > 0;
    }

    //Valida que fecha no sea un string vacio y tenga el formato correcto
    private function validarFechas($fecha_inicial, $fecha_final){
      if ($fecha_final =="" || $fecha_inicial ==""){
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
/////////////////////////////////FIN REPORTE //////////////////////////////

}

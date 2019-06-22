<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Product;
use App\Spare;
use Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Dompdf\Dompdf;
use DateTime;
use Barryvdh\DomPDF\Facade as PDF;
use App\Exports\EquipSobre40Export;
use App\Exports\ManDepExport;
use App\Exports\EquipoPorTipoExport;
use App\Exports\MantenimientosRealizadosExport;
use Excel;
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
       Log::info("El usuario: '".Auth::user()->name." Vió el reporte de equipos agregados a inventario");
      return view('gerenciales.equipoPorTipo',compact('products','fecha_inicial','fecha_final','tipo'));
    }else{
      return view('gerenciales.equipoPorTipo')->withErrors('Error en las fechas ingresadas');
    }}
    else{
      return view('gerenciales.equipoPorTipo');
    }
    }
    public function equipoPorTipoPdf(Request $request,$fecha_inicial,$fecha_final,$tipo)
    {
      $date = Carbon::now();
      $imprimir=1;
      $products=array();
     if($this->validarFechas($fecha_inicial,$fecha_final)){
       if($tipo==3){
        $products=Product::whereDate('created_at','>=',$fecha_inicial)->whereDate('created_at','<=',$fecha_final)->orderby('id','DESC')->get();
       }else{
        $products=Product::whereDate('created_at','>=',$fecha_inicial)->whereDate('created_at','<=',$fecha_final)->where('tipo',$tipo)->orderby('id','DESC')->get();
       }
      }else{
        return view('gerenciales.equipoPorTipo')->withErrors('Error en las fechas ingresadas');
      }
       Log::info("El usuario: '".Auth::user()->name." Vió el reporte de equipos agregados a inventario");
       $date = Carbon::now();
       $date = $date->format('d-m-Y');
       switch($request->method()){
        case "POST":
       $pdf = PDF::loadView('pdf.equipoPorTipoPdf', compact('products','date','tipo'))->setPaper(array(0,0,612.00,792.00));
       return $pdf->stream('EquipoPorTipo_'.$date.'pdf',array("Attachment" => 0));
       break;
    case "GET":
    return view('pdf.equipoPorTipoPdf',compact('products','fecha_inicial','fecha_final','tipo','imprimir','date'));
    }
  }

  public function equipoPorTipoExcel($fecha_inicial,$fecha_final,$tipo)
  {
      if($this->validarFechas($fecha_inicial,$fecha_final)){
        if($tipo==3){
         $products=Product::whereDate('created_at','>=',$fecha_inicial)->whereDate('created_at','<=',$fecha_final)->orderby('id','DESC')->paginate();
        }else{
         $products=Product::whereDate('created_at','>=',$fecha_inicial)->whereDate('created_at','<=',$fecha_final)->where('tipo',$tipo)->orderby('id','DESC')->paginate();
        }
       
     }else{
       
     }
    Log::info("El usuarios: '".Auth::user()->name."' ha exportado a EXCEL el reporte de Equipo agregado al inventario");
    return Excel::download(new EquipoPorTipoExport($products), 'EquipoAgregado'.Carbon::now()->format('d-m-y').'.xlsx');

  }

  /////REPORTE DE MANTENIMIENTOS REALIZADOS POR EMPLEADOS Y PRACTICANTES////////

  public function mantenimientosRealizados(Request $request){

    $fecha_inicial=$request->get('desde');
    $fecha_final=$request->get('hasta');
    $tipo=$request->get('tipo');
    $tipos=$tipo;
    if(isset($tipo)){
    if($this->validarFechas($fecha_inicial,$fecha_final)){
    $users=User::join('upkeeps','users.id','=','upkeeps.user_id')
    ->select('users.name','users.email','users.tipo','users.estado',DB::raw('count(upkeeps.user_id) as total'))
    ->when($tipo!=3, function ($users, $tipo) use($tipos) {//si tipo no es 3 ( es 1 o 2) agrega un where para filtar por pc o impresora
      return $users->where('users.tipo',$tipos);
    })
    ->whereDate('upkeeps.created_at','>=',$fecha_inicial)->whereDate('upkeeps.created_at','<=',$fecha_final)->groupBy('users.id')->orderby('users.id','DESC')->paginate();
    return view('gerenciales.reporteMantenimientos',compact('users','tipo','fecha_inicial','fecha_final'));
    }
    else{ return view ('gerenciales.reporteMantenimientos')->withErrors('Error en las fechas ingresadas');}
  }else {return view ('gerenciales.reporteMantenimientos');}
  }

  
  public function mantenimientosRealizadosPdf(Request $request,$fecha_inicial,$fecha_final,$tipo){

    $tipos=$tipo;
    if($this->validarFechas($fecha_inicial,$fecha_final)){
    $users=User::join('upkeeps','users.id','=','upkeeps.user_id')
    ->select('users.name','users.email','users.tipo','users.estado',DB::raw('count(upkeeps.user_id) as total'))
    ->when($tipo!=3, function ($users, $tipo) use($tipos) {//si tipo no es 3 ( es 1 o 2) agrega un where para filtar por pc o impresora
      return $users->where('users.tipo',$tipos);
    })
    ->whereDate('upkeeps.created_at','>=',$fecha_inicial)->whereDate('upkeeps.created_at','<=',$fecha_final)->groupBy('users.id')->orderby('users.id','DESC')->paginate();
    }
    else{}

      $date = Carbon::now();
      $date = $date->format('d-m-Y');
      switch($request->method()){
       case "POST":
      $pdf = PDF::loadView('pdf.mantenimientosRealizadosPdf', compact('users','date'))->setPaper(array(0,0,612.00,792.00));
      return $pdf->stream('EquipoPorTipo_'.$date.'pdf',array("Attachment" => 0));
      break;
   case "GET":
   return view('pdf.mantenimientosRealizadosPdf',compact('users','fecha_inicial','fecha_final','tipo','imprimir','date'));
   }
  }

  public function mantenimientosRealizadosExcel($fecha_inicial,$fecha_final,$tipo)
  {
    $tipos=$tipo;
    if(isset($tipo)){
    if($this->validarFechas($fecha_inicial,$fecha_final)){
    $users=User::join('upkeeps','users.id','=','upkeeps.user_id')
    ->select('users.name','users.email','users.tipo','users.estado',DB::raw('count(upkeeps.user_id) as total'))
    ->when($tipo!=3, function ($users, $tipo) use($tipos) {//si tipo no es 3 ( es 1 o 2) agrega un where para filtar por pc o impresora
      return $users->where('users.tipo',$tipos);
    })
    ->whereDate('upkeeps.created_at','>=',$fecha_inicial)->whereDate('upkeeps.created_at','<=',$fecha_final)->groupBy('users.id')->orderby('users.id','DESC')->paginate();

    Log::info("El usuarios: '".Auth::user()->name."' ha exportado a EXCEL el reporte de mantenimientos realizados por encargados");
    return Excel::download(new MantenimientosRealizadosExport($users), 'mttoPorEncargado'.Carbon::now()->format('d-m-y').'.xlsx');
  }
 }
}


  ////////////////////////////////FIN DEL REPORTE DE MANTENIMIENTO POR EMPLEADOS/PRACTICANTES///////////////}/////////////////////77



  /////REPORTE DE CANTIDAD DE REPUESTOS CAMBIADOS DE CADA TIPO////////
    public function repuestosCambiados(Request $request){

      $depto=DB::select('select * from departments');
      $fecha_inicial=$request->get('desde');
      $fecha_final=$request->get('hasta');
      $tipo=$request->get('tipo');
      if(isset($fecha_inicial)){
      if($this->validarFechas($fecha_inicial,$fecha_final)){
      $spares=DB::table('spares as s')
      ->join('upkeep_spare as us','s.id','=','us.spare_id')
      ->join('upkeeps as u','us.upkeep_id','u.id')
      ->select('s.nombre','s.tipo','s.marca','s.valorAdqui',DB::raw('count(us.spare_id) as count'))
      ->whereDate('u.created_at','>=',$fecha_inicial)
      ->whereDate('u.created_at','<=',$fecha_final)
      ->groupBy('s.id')
      ->orderBy('s.id')
      ->paginate();
      return view('gerenciales.repuestosCambiados',compact('spares','depto'));
      }else
      { 
        return view ('gerenciales.repuestosCambiados')->withErrors('Error en las fechas ingresadas');
      }
    }else{
      return view ('gerenciales.repuestosCambiados',compact('depto'));
      }
    }

//reporte que sobrepasen en 40% del valor de adquisicion respecto al costo de mantenimientos    
public function getEqui(){
  $errores = ' ';
  return view('gerenciales.soliSobre4', ['errores' => $errores]);
}
public function verInfo40(Request $request)
{
  $tipo=$request->tipo;
  $count=$request->count;
  if ($this->validarInt($count)) {
    if ($request->tipo==0) {
      $produc40=DB::select("select * from (select products.id, products.valorAdqui,products.marca,products.modelo,
      products.numInv,products.numSe,products.estado,sum(spares.valorAdqui) as costoSpares from products
      join upkeeps on products.id = upkeeps.product_id
      join upkeep_spare on upkeep_spare.upkeep_id = upkeeps.id
      join spares on spares.id = upkeep_spare.spare_id
      group by products.id) as prods
      where prods.costoSpares >= prods.ValorAdqui*0.4;");
      $date = Carbon::now();
      $date = $date->format('d-m-Y');
    }
    if ($request->tipo==1) {
      $produc40=DB::select("select * from (select products.id, products.valorAdqui,products.marca,products.modelo,
      products.numInv,products.numSe,products.estado,products.tipo,sum(spares.valorAdqui) as costoSpares from products
      join upkeeps on products.id = upkeeps.product_id
      join upkeep_spare on upkeep_spare.upkeep_id = upkeeps.id
      join spares on spares.id = upkeep_spare.spare_id
      group by products.id) as prods
      where prods.costoSpares >= prods.ValorAdqui*0.4 AND prods.tipo = 1;");
      $date = Carbon::now();
      $date = $date->format('d-m-Y');
    }
    if ($request->tipo==2) {
      $produc40=DB::select("select * from (select products.id, products.valorAdqui,products.marca,products.modelo,
      products.numInv,products.numSe,products.estado,products.tipo,sum(spares.valorAdqui) as costoSpares from products
      join upkeeps on products.id = upkeeps.product_id
      join upkeep_spare on upkeep_spare.upkeep_id = upkeeps.id
      join spares on spares.id = upkeep_spare.spare_id
      group by products.id) as prods
      where prods.costoSpares >= prods.ValorAdqui*0.4  AND prods.tipo = 2;");
      $date = Carbon::now();
      $date = $date->format('d-m-Y');
    }

return view('gerenciales.sobre4ad',compact('produc40','date','tipo'));
    
  }
  $errores = 'Error en los datos ingresados';
  return view('gerenciales.soliSobre4', ['errores' => $errores]);      
}

///genera el pdf del reporte    
public function pdfInfo40($tipo)
{
  if($tipo!=0){
        $produc40=DB::select("select * from (select products.id, products.valorAdqui,products.marca,products.modelo,
        products.numInv,products.numSe,products.estado,products.tipo,sum(spares.valorAdqui) as costoSpares from products
        join upkeeps on products.id = upkeeps.product_id
        join upkeep_spare on upkeep_spare.upkeep_id = upkeeps.id
        join spares on spares.id = upkeep_spare.spare_id
        group by products.id) as prods
        where prods.costoSpares >= prods.ValorAdqui*0.4  AND prods.tipo =  ?;",[$tipo]);
$date = Carbon::now();
$date = $date->format('d-m-Y');
$pdf = PDF::loadView('pdf.info40', compact('produc40','date'))->setPaper(array(0,0,612.00,792.00));
return $pdf->stream('repo40.pdf',array("Attachment" => 0));
}
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
//generar excell
public function excellInfo40($tipo)
    {
      if($tipo!=0){
        $produc40=DB::select("select * from (select products.id, products.valorAdqui,products.marca,products.modelo,
        products.numInv,products.numSe,products.estado,products.tipo,sum(spares.valorAdqui) as costoSpares from products
        join upkeeps on products.id = upkeeps.product_id
        join upkeep_spare on upkeep_spare.upkeep_id = upkeeps.id
        join spares on spares.id = upkeep_spare.spare_id
        group by products.id) as prods
        where prods.costoSpares >= prods.ValorAdqui*0.4  AND prods.tipo =  ?;",[$tipo]);
$date = Carbon::now();
$date = $date->format('d-m-Y');
Log::info("El usuarios: '".Auth::user()->name."' ha exportado a EXCEL el reporte de Equipo con valor de mantenimiento mayor a 40% valor adqui");
return Excel::download(new EquipSobre40Export($produc40), 'EquipoSobreAdqui_'.Carbon::now()->format('d-m-y').'.xlsx');
}
$produc40=DB::select("select * from (select products.id, products.valorAdqui,products.marca,products.modelo,
products.numInv,products.numSe,products.estado,sum(spares.valorAdqui) as costoSpares from products
join upkeeps on products.id = upkeeps.product_id
join upkeep_spare on upkeep_spare.upkeep_id = upkeeps.id
join spares on spares.id = upkeep_spare.spare_id
group by products.id) as prods
where prods.costoSpares >= prods.ValorAdqui*0.4;");
$date = Carbon::now();
$date = $date->format('d-m-Y');
Log::info("El usuarios: '".Auth::user()->name."' ha exportado a EXCEL el reporte de Equipo con valor de mantenimiento mayor a 40% valor adqui");
return Excel::download(new EquipSobre40Export($produc40), 'EquipoSobreAdqui_'.Carbon::now()->format('d-m-y').'.xlsx');

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
///Reporte de cantidad de mantenimientos solicitados por departamento////////
public function soliDepMant()
{
  
  $depto=DB::select('select * from departments');
  return view('gerenciales.EntraMantporDepto',compact('depto'));
}
 
public function ManDep(Request $request){
 
  $fecha_inicial=$request->get('desde');
  $fecha_final=$request->get('hasta');
  $tipo=$request->get('tipo');
  $depto=DB::select('select * from departments');
  if(isset($tipo)){
 if($this->validarFechas($fecha_inicial,$fecha_final)){
   if($tipo==0){
    $manDeto=DB::select("select departments.nombre as Departamento ,departments.id  ,COUNT(upkeeps.product_id) as Cantidad ,upkeeps.created_at
    from departments JOIN employees on departments.id = employees.department_id JOIN products on employees.id = products.employee_id JOIN upkeeps 
    on products.id = upkeeps.product_id 
    WHERE upkeeps.created_at > ? AND upkeeps.created_at< ?
    GROUP BY departments.nombre",[$fecha_inicial,$fecha_final]);
    $date = Carbon::now();
    $date = $date->format('d-m-Y');
   
   return view('gerenciales.previDeptManto',compact('manDeto','date','fecha_inicial','fecha_final','tipo'));
   }else{
    $manDeto=DB::select("select departments.nombre as Departamento ,  COUNT(upkeeps.product_id) as Cantidad ,upkeeps.created_at
    from departments JOIN employees on departments.id = employees.department_id JOIN products on employees.id = products.employee_id JOIN upkeeps 
    on products.id = upkeeps.product_id 
    WHERE upkeeps.created_at > ? AND upkeeps.created_at< ? AND departments.id= ?
    GROUP BY departments.nombre",[$fecha_inicial,$fecha_final,$tipo]);
    $date = Carbon::now();
    $date = $date->format('d-m-Y');   
    return view('gerenciales.previDeptManto',compact('manDeto','date','fecha_inicial','fecha_final','tipo'));
   }  
}
  return view('gerenciales.EntraMantporDepto',compact('depto'))->withErrors('Error en las fechas ingresadas');
}
else{
  return view('gerenciales.EntraMantporDepto',compact('depto'));
}
   
  }

 public function pdfMandep($fecha_inicial,$fecha_final,$tipo){
 
  if($tipo==0){
    $manDeto=DB::select("select departments.nombre as Departamento ,departments.id  ,COUNT(upkeeps.product_id) as Cantidad ,upkeeps.created_at
    from departments JOIN employees on departments.id = employees.department_id JOIN products on employees.id = products.employee_id JOIN upkeeps 
    on products.id = upkeeps.product_id 
    WHERE upkeeps.created_at > ? AND upkeeps.created_at< ?
    GROUP BY departments.nombre",[$fecha_inicial,$fecha_final]);
    $date = Carbon::now();
    $date = $date->format('d-m-Y');   
  
   }else{
    $manDeto=DB::select("select departments.nombre as Departamento ,  COUNT(upkeeps.product_id) as Cantidad ,upkeeps.created_at
    from departments JOIN employees on departments.id = employees.department_id JOIN products on employees.id = products.employee_id JOIN upkeeps 
    on products.id = upkeeps.product_id 
    WHERE upkeeps.created_at > ? AND upkeeps.created_at< ? AND departments.id= ?
    GROUP BY departments.nombre",[$fecha_inicial,$fecha_final,$tipo]);
    $date = Carbon::now();
    $date = $date->format('d-m-Y');      
   }  
  
  $pdf = PDF::loadView('pdf.ManDepto', compact('manDeto','date'))->setPaper(array(0,0,612.00,792.00));  
  return $pdf->stream('repoManDepto.pdf',array("Attachment" => 0));
 } 
///termina el reporte//////

public function ExcelMandep($fecha_inicial,$fecha_final,$tipo){
 
  if($tipo==0){
    $manDeto=DB::select("select departments.nombre as Departamento ,departments.id  ,COUNT(upkeeps.product_id) as Cantidad ,upkeeps.created_at
    from departments JOIN employees on departments.id = employees.department_id JOIN products on employees.id = products.employee_id JOIN upkeeps 
    on products.id = upkeeps.product_id 
    WHERE upkeeps.created_at > ? AND upkeeps.created_at< ?
    GROUP BY departments.nombre",[$fecha_inicial,$fecha_final]);
   
  
   }else{
    $manDeto=DB::select("select departments.nombre as Departamento ,  COUNT(upkeeps.product_id) as Cantidad ,upkeeps.created_at
    from departments JOIN employees on departments.id = employees.department_id JOIN products on employees.id = products.employee_id JOIN upkeeps 
    on products.id = upkeeps.product_id 
    WHERE upkeeps.created_at > ? AND upkeeps.created_at< ? AND departments.id= ?
    GROUP BY departments.nombre",[$fecha_inicial,$fecha_final,$tipo]);
       
   }  
  
   Log::info("El usuarios: '".Auth::user()->name."' ha exportado a EXCEL el reporte de Cantidad de mantenimientos por");
  return Excel::download(new ManDepExport($manDeto), 'MantenimientosPorDepto_'.Carbon::now()->format('d-m-y').'.xlsx');
 } 


}

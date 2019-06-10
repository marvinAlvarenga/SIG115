<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Barryvdh\DomPDF\Facade as PDF;
class GerencialController extends Controller
{
    public function equipoPorTipo()
    {
        $products=Product::orderby('id','DESC')->paginate();
        return view('gerenciales.equipoPorTipo',compact('products'));
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
}

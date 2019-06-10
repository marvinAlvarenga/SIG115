<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\DB;

class GerencialController extends Controller
{
    public function equipoPorTipo()
    {
        $products=Product::orderby('id','DESC')->paginate();
        return view('gerenciales.equipoPorTipo',compact('products'));
    }
    public function verInfo40()
    {
        $upkeep = DB::table('upkeep_spare')
            ->join('upkeeps', 'upkeep_spare.upkeep_id', '=', 'upkeeps.id')
            ->join('spares', 'upkeep_spare.spare_id', '=', 'spares.id')
            ->join('products','upkeeps.product_id','=','products.id')
            ->select('products.id' , DB::raw('SUM(spares.valorAdqui) as total'))
            ->groupBy('products.id')
            ->get();
    foreach ($upkeep as $upkeeps) {
       $monto=$upkeeps->total;
         $i = 0;
        $upkeepr[$i] = DB::table('upkeep_spare')
            ->join('upkeeps', 'upkeep_spare.upkeep_id', '=', 'upkeeps.id')
            ->join('spares', 'upkeep_spare.spare_id', '=', 'spares.id')
            ->join('products','upkeeps.product_id','=','products.id')
            ->select('products.*')
            ->orWhere(function($query)
            {
                $query->where('products.valorAdqui','>=','$upkeeps->total');
            })            
            ->get();
            dd($upkeepr[$i]);
            $i++;
    }
            
     
       
    
        return view('gerenciales.sobre4ad');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class GerencialController extends Controller
{
    public function equipoPorTipo()
    {
        $products=Product::orderby('id','DESC')->paginate();
        return view('gerenciales.equipoPorTipo',compact('products'));
    }
}

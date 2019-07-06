<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class EquipSobre40Export  implements FromView
{
    
    private $produc40;
   
    
    public function __construct($products)
    {
        $this->produc40 = $products;
       
    }

    public function view(): View
    {
        return view('pdf.equipSobre40Excel', [
            'produc40' => $this->produc40,
            
                    ]);
    }
}

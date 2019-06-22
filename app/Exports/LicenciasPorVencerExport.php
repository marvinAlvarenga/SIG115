<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class LicenciasPorVencerExport implements FromView
{

    private $products;

    public function __construct($products)
    {
        $this->products = $products;
    
    }

    public function view(): View
    {
        return view('pdf.licenciasPorVencerExcel', [
            'products' => $this->products,
        ]);
    }
}

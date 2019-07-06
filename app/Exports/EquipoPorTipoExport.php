<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class EquipoPorTipoExport implements FromView
{

    private $products;
    private $fechaInicial;
    private $fechaFinal;

    public function __construct($products,$fechaIn,$FechaFi)
    {
        $this->products = $products;
        $this->fechaInicial=$FechaFi;
        $this->fechaFinal=$FechaFi;

    }

    public function view(): View
    {
        return view('pdf.equipoPorTipoExcel', [
            'products' => $this->products,
            'fechaInicial' => $this->fechaInicial,
            'fechaFinal' => $this->fechaFinal,
        ]);
    }
}

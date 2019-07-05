<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class EqDescargadoExport implements FromView
{

    private $productos;

    public function __construct($productos)
    {
        $this->productos = $productos;

    }

    public function view(): View
    {
        return view('pdf.equipoDescargadoExcel', [
            'productos' => $this->productos,
        ]);
    }
}

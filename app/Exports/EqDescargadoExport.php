<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class EqDescargadoExport implements FromView
{

    private $productos;
    private $inicial;
    private $final;
    public function __construct($productos, $inicial, $final)
    {
        $this->productos = $productos;
        $this->inicial = $inicial;
        $this->final = $final;
    }

    public function view(): View
    {
        return view('pdf.equipoDescargadoExcel', [
            'productos' => $this->productos,
            'fecha_inicial' => $this->inicial,
            'fecha_final' => $this->final,
        ]);
    }
}

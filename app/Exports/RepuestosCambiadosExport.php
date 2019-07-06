<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class RepuestosCambiadosExport implements FromView
{

    private $spares;
    private $fechaInicial;
    private $fechaFinal;

    public function __construct($spares,$fechaIn,$FechaFi)
    {
        $this->spares = $spares;
        $this->fechaInicial=$FechaFi;
        $this->fechaFinal=$FechaFi;

    }

    public function view(): View
    {
        return view('pdf.repuestosCambiadosExcel', [
            'spares' => $this->spares,
            'fechaInicial' => $this->fechaInicial,
            'fechaFinal' => $this->fechaFinal,
        ]);
    }
}

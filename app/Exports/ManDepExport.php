<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ManDepExport implements FromView
{
    
    private $manDeto;
    private $fechaInicial;
    private $fechaFinal;
    public function __construct($manDetos,$fechaIn,$FechaFi)
    {
        $this->manDeto = $manDetos;
        $this->fechaInicial=$FechaFi;
        $this->fechaFinal=$FechaFi;
       
    }
    public function view(): View
    {
        return view('pdf.ManteDeptoExcel', [
            'manDeto' => $this->manDeto,
            'fechaInicial' => $this->fechaInicial,
            'fechaFinal' => $this->fechaFinal,
            
        ]);
    }
}

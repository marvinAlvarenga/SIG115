<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ManEmplExport implements FromView
{
    
    private $empleMantos;
    private $fechaInicial;
    private $fechaFinal;
    public function __construct($empleManto,$fechaIn,$FechaFi)
    {
        $this->empleMantos = $empleManto;
        $this->fechaInicial=$FechaFi;
        $this->fechaFinal=$FechaFi;
    
    }
    public function view(): View
    {
        return view('pdf.ManteEmpleExcel', [
            'empleMantos' => $this->empleMantos,
            'fechaInicial' => $this->fechaInicial,
            'fechaFinal' => $this->fechaFinal,
            
        ]);
    }
}
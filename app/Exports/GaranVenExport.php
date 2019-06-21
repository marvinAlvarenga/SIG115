<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class GaranVenExport implements FromView
{
    
    private $empleManto;
    private $tiempoFaltante;
    public function __construct($empleMantos,$tiempoFalt)
    {
        $this->empleManto = $empleMantos;
        $this->tiempoFaltante = $tiempoFalt;
    }
    public function view(): View
    {
        return view('pdf.GaranPorVencer', [
            'empleManto' => $this->empleManto,
            'tiempoFaltante' => $this->tiempoFaltante,
            
        ]);
    }
}
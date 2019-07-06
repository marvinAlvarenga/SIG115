<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class MantenimientosRealizadosExport implements FromView
{

    private $users;
    private $fechaInicial;
    private $fechaFinal;
    public function __construct($users,$fechaIn,$FechaFi)
    {
        $this->users = $users;
        $this->fechaInicial=$FechaFi;
        $this->fechaFinal=$FechaFi;
    }

    public function view(): View
    {
        return view('pdf.mantenimientosRealizadosExcel', [
            'users' => $this->users,
            'fechaInicial' => $this->fechaInicial,
            'fechaFinal' => $this->fechaFinal,
        ]);
    }
}

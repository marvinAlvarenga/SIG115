<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class EquipoViejoExport implements FromView
{

    private $computadoras;
    private $impresoras;

    public function __construct($compu, $impre)
    {
        $this->computadoras = $compu;
        $this->impresoras = $impre;
    }

    public function view(): View
    {
        return view('pdf.equipoAntiguoExcel', [
            'computadoras' => $this->computadoras,
            'impresoras' => $this->impresoras,
        ]);
    }
}

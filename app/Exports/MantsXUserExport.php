<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class MantsXUserExport implements FromView
{

    private $usuarios;
    private $inicial;
    private $final;

    public function __construct($usuarios, $fecha_final, $fecha_inicial)
    {
        $this->usuarios = $usuarios;
        $this->inicial = $fecha_inicial;
        $this->final = $fecha_final;

    }

    public function view(): View
    {
        return view('pdf.mantsXUserExcel', [
            'usuarios' => $this->usuarios,
            'fecha_inicial' => $this->inicial,
            'fecha_final' => $this->final,
        ]);
    }
}

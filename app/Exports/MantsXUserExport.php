<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class MantsXUserExport implements FromView
{

    private $usuarios;

    public function __construct($usuarios)
    {
        $this->usuarios = $usuarios;

    }

    public function view(): View
    {
        return view('pdf.mantsXUserExcel', [
            'usuarios' => $this->usuarios,
        ]);
    }
}

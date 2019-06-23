<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class RepuestosCambiadosExport implements FromView
{

    private $spares;

    public function __construct($spares)
    {
        $this->spares = $spares;

    }

    public function view(): View
    {
        return view('pdf.repuestosCambiadosExcel', [
            'spares' => $this->spares,
        ]);
    }
}

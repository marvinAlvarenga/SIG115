<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class MantenimientosRealizadosExport implements FromView
{

    private $users;

    public function __construct($users)
    {
        $this->users = $users;

    }

    public function view(): View
    {
        return view('pdf.mantenimientosRealizadosExcel', [
            'users' => $this->users,
        ]);
    }
}

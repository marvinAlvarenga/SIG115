<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ManEmplExport implements FromView
{
    
    private $empleMantos;
    private $computadoras;
    private $impresoras;
    public function __construct($empleManto)
    {
        $this->empleMantos = $empleManto;
    
    }
    public function view(): View
    {
        return view('pdf.ManteEmpleExcel', [
            'empleMantos' => $this->empleMantos,
            
        ]);
    }
}
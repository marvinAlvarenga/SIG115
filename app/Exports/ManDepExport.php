<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ManDepExport implements FromView
{
    
    private $manDeto;
   
    public function __construct($manDetos)
    {
        $this->manDeto = $manDetos;
      
       
    }
    public function view(): View
    {
        return view('pdf.ManteDeptoExcel', [
            'manDeto' => $this->manDeto,
            
        ]);
    }
}

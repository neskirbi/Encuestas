<?php

namespace App\Exports\Random;


use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB;

class ReporteValorObras implements FromView
{


    function __construct($obras){
        $this->obras=$obras;
    }

    public function view(): View{

       

        
        return view('formatos.reportes.random.reportevalorobras', [
           'obras' => $this->obras
       ]);
   }
}

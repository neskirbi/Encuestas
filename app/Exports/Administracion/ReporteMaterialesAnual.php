<?php

namespace App\Exports\Administracion;


use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB;

use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ReporteMaterialesAnual implements FromView,WithStyles
{
    
    private $materiales;
    public function  __construct($materiales){
    
        $this->materiales=$materiales;
    }

    public function view(): View{

        
         return view('formatos.reportes.administradores.reportematerialesanual', [
            'materiales' => $this->materiales
        ]);
    }

    public function styles(Worksheet $sheet)
    {

        $mes=1;
        $ini=2;
        $fin=2;
        $cantidadt=0;
        foreach($this->materiales as $material){
            
            if($material->mes!=$mes){
                $mes=$material->mes;
                $sheet->mergeCells("A".($ini).":A".($fin-1));
                $sheet->setCellValue('D'.($ini), number_format($cantidadt,2));
                $sheet->mergeCells("D".($ini).":D".($fin-1));
                
                $cantidadt=0;
                $ini=$fin;
            }
            $cantidadt=$cantidadt + intval(str_replace(",","",$material->cantidad));
            $fin++;


        }
         
    }

}
    

<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Illuminate\Support\Facades\DB;
use App\Models\Cita;

class ReporteCitasAdministracionFotos implements FromView,WithDrawings{
    private $citas;
    public function  __construct($obra,$ini,$fin,$id_planta){
        set_time_limit(0);
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 0); 
        ini_set('post_max_size', '30G');


        $this->citas=DB::table('citas')
        ->join('obras','obras.id','=','citas.id_obra')
        ->where('id_obra','like','%'.(strlen($obra)!=32 ? '' : $obra).'%')
        ->where('fechacita','>=',$ini)
        ->where('fechacita','<=',$fin)
        ->where('obras.id_planta','=',$id_planta)
        ->where('confirmacion','=',1)
        ->select('citas.obra','citas.id','citas.folio','citas.fechacita','citas.regsct','citas.razonsocial',
        'citas.calleynumerofis','citas.coloniafis','citas.municipiofis','citas.cpfis',
        'citas.calleynumeroobr','citas.coloniaobr','citas.municipioobr','citas.cpobr',
        'citas.unidades','citas.cantidad','citas.iva','citas.precio','citas.precio','citas.cantidad',
        'citas.vehiculo','citas.marcaymodelo','citas.matricula','citas.ramir',
        'citas.condicionesmaterial','citas.condicionesmaterial','citas.nombrecompleto',
        'citas.recibio','citas.cargo',DB::raw("(select concat(categoriamaterial,': ',material) as observacion from materialesobra where id=citas.id_materialobra) as observacion"))
        ->orderby('folio','asc')
        ->get();

    }
    public function view(): View
    {       
        for($i=0;$i<count($this->citas);$i++){            
            $this->citas[$i]->fechacita=FechaFormateada($this->citas[$i]->fechacita);
        }

        return view('formatos.reportes.administradores.reportecitas', [
            'citas' => $this->citas
        ]);
    }

    function ImagenTemporal($id,$carpeta){
        
        $path="images/citas/".$carpeta;
        $ruta=public_path('/'.$path);
        

        $nombrepng= '/'.$id.'.png';
        $nombrejpg= '/'.$id.'.jpg';

        
        if(file_exists($ruta.$nombrepng)){
            return $ruta.$nombrepng;
        }else if(file_exists($ruta.$nombrejpg)){
            return $ruta.$nombrejpg;
        }else{
            return'';
        }
           

       
    }


    public function drawings()
    {
        
        $count=2;
        $drawings=Array();
        foreach($this->citas as $index=>$cita){           
           

            $path0=$this->ImagenTemporal($cita->id,'foto0');
            if($path0!='' && is_readable($path0)){
                $drawing = new Drawing();
                $drawing->setName('Foto');
                $drawing->setDescription('Foto');
                $drawing->setPath($path0);
                $drawing->setWidth(150);
                $drawing->setCoordinates('W'.$count);
                $drawings[]=$drawing;
            }

           
            $path1=$this->ImagenTemporal($cita->id,'foto1');
            if($path1!='' && is_readable($path1)){
                $drawing = new Drawing();
                $drawing->setName('Foto');
                $drawing->setDescription('Foto');
                $drawing->setPath($path1);
                $drawing->setWidth(150);
                $drawing->setCoordinates('X'.$count);
                $drawings[]=$drawing;
            }

            

            $count++;
        } 

        


        return $drawings;
    }
    
}

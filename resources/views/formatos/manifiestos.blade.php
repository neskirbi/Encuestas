<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manifiesto</title>
    <style>
    .bordes{
        border: 2px solid #000;
    }
    
    .probable100{
        width:100%;
    }

    td{
        font-size:9px;
    }
    </style>
</head>
<body>
    @foreach($citas as $cita)
<center>
    <table style="border-collapse: collapse; width:100%;">
        <tr>
            <td class="bordes"><center><img style="width:15px; padding:10px;" src="{{public_path('images/formatos/manifiesto/generador.png')}}" alt="Generador"></center></td>
            <td class="bordes">
                <p><b>Folio: {{$cita->folio}}</b></p>
                1.-NÚM. DE REGISTRO <br>(Resolutivo de Impacto Ambiental, número de registro){{$cita->nautorizacion}}
                <img style=" float:right;" src="{{public_path('images/qr/manifiesto/'.$cita->qr)}}" width="90px" alt="">
                <br>
                <b>{{$cita->nautorizacion}}</b>
                <br>
                <br><br><br><br>
                
               
                <table class="probable100">
                    <tr>
                        <td>2.-RAZÓN SOCIAL DE LA PERSONA</td>
                        <td><b>{{$cita->razonsocial}}</b></td>
                    </tr>

                    <tr>
                        <td>FÍSICA Ó MORAL GENERADORA:</td>
                        <td><b>{{$cita->fisicaomoral}}</b></td>
                    </tr>
                </table>
                3.-DOMICILIO FISCAL
                <table class="probable100">
                    <tr>
                        <td>CALLE:</td>
                        <td>&nbsp;&nbsp;<b>{{$cita->calle}}</b></td>
                        <td>COLONIA:</td>
                        <td>&nbsp;&nbsp;<b>{{$cita->colonia}}</b></td>
                    </tr>

                    <tr>
                        <td>ALCALDÍA:</td>
                        <td>&nbsp;&nbsp;<b>{{$cita->municipio}}</b></td>
                        <td>C.P:</td>
                        <td>&nbsp;&nbsp;<b>{{$cita->cp}}</b></td>
                    </tr>

                    
                </table>
                4.-DOMICILIO DEL PREDIO DONDE SE REALIZA LA OBRA
                <table class="probable100">
                    <tr>
                        <td>CALLE:</td>
                        <td>&nbsp;&nbsp;<b>{{$cita->obrcalle}}</b></td>
                        <td>COLONIA:</td>
                        <td>&nbsp;&nbsp;<b>{{$cita->obrcolonia}}</b></td>
                    </tr>

                    <tr>
                        <td>ALCALDÍA:</td>
                        <td>&nbsp;&nbsp;<b>{{$cita->obrmunicipio}}</b></td>
                        <td>C.P:</td>
                        <td>&nbsp;&nbsp;<b>{{$cita->obrcp}}</b></td>
                    </tr>

                    <tr>
                        <td>TEL: <b>{{$cita->obrtelefono}}</b></td>
                    </tr>

                    
                </table>
                <br>
                <table border="1" style="border-collapse: collapse;" class="probable100">                   

                    <tr>
                        <td colspan="2">GÉNERO DEL EDIFICIO:</td>
                        <td colspan="2">SUPERFICIE DE CONSTRUCCIÓN Ó SUPERFICIE A INTERVENIR:</td>
                    </tr>
                                     

                    <tr>
                        <td colspan="2">&nbsp;</td>
                        <td colspan="2"><b>{{$cita->superficie." ".$cita->unidades}}</b> </td>
                    </tr>

                    
                </table>

                <table border="1" style="border-collapse: collapse;" class="probable100">                   

                    <tr>
                        <td colspan="2"> TIPO DE OBRA:</td>
                        
                    </tr>
                                     

                    <tr>
                        <td colspan="2"><b>{{$cita->tipoobra}}</b></td>
                    </tr>

                    
                </table>
                <br> 5.-DESCRIPCIÓN (Nombre del residuo, Conforme a la Tabla 1 de la presente Norma Ambiental )
                <table border="1" style="border-collapse: collapse;" class="probable100">                   

                    <tr>
                        <td>Residuo</td>
                        <td>CANTIDAD TOTAL DE RESIDUO GENERADO</td>
                        <td>FECHA DE GENERACIÓN</td>
                        
                    </tr>
                              
                    <tr>
                        <td><b>{{$cita->material}}</b></td>
                        <td><b>{{$cita->cantidad.' '.$cita->unidades}}</b></td>
                        <td><b>{{FechaFormateada($cita->fechacita)}}</b></td>
                        
                    </tr>
                    
                    
                </table>

                <table>
                    <tr>
                        <td>
                            INDIQUE EL NOMBRE DEL PRESTADOR DE SERVICIO DE TRANSPORTE AL QUE ENTREGO SUS RESIDUOS: 
                            <br><br>
                            
                        </td>
                        
                    </tr>
                </table>
                <hr>
                6.-DECLARACIÓN DEL GENERADOR:<br>
                DECLARO QUE EL CONTENIDO DE ESTE MANIFIESTO ESTA TOTAL Y CORRECTAMENTE DESCRITO MEDIANTE EL NOMBRE DEL RESIDUO, 
                BIEN CLASIFICADO, Y MARCADO, Y QUE SE HAN PREVISTO LAS CONDICIONES DE SEGURIDAD PARA SU TRANSPORTE POR VIA TERRESTRE DE ACUERDO A LA LEGISLACIÓN VIGENTE.<br>
                
                <table width="100%" style="pull:;">
                <tr><td>NOMBRE Y FIRMA DEL RESPONSABLE:</td></tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td><img src="{{$cita->firmares}}" width="70px" alt=""><br>{{$cita->nombreres}}</td>
                    </tr>
                </table>
               
                
               
                <br>
            </td>
        </tr>
        <tr>
            <td class="bordes"><center><img style="width:15px; padding:10px;" src="{{public_path('images/formatos/manifiesto/transporte.png')}}" alt="Transporte"></center></td>
            <td class="bordes">
                7.-RAZÓNSOCIAL DE LA PERSONA FÍSICA O MORAL TRANSPORTISTA:
                <br><b>{{$cita->razonvehiculo}}</b>
                <table style="border-collapse: collapse;" class="probable100">
                    <tr>
                        <td>
                            DOMICILIO FISCAL:
                            <br><b>{{$cita->direccionvehiculo}}</b>
                        </td>
                        <td>
                            TELÉFONO:
                            <br><b>{{$cita->telefonovehiculo}}</b>
                        </td>
                    </tr>
                   
                </table>
                <table style="border-collapse: collapse;" class="probable100">
                    <tr>
                        <td>
                            AUTORIZACIÓN RAMIR: <b>{{$cita->ramir}}</b>
                            <br>Folio Fiscal de la factura asociada al transporte de RCM
                        </td>
                        <td>
                            NO. DE REGISTRO S.C.T. <b>{{$cita->regsct}}</b>
                        </td>
                    </tr>
                   
                </table>
                <br>
                <hr>
                8.- RECIBÍ LOS RESIDUOS DESCRITOS EN EL MANIFIESTO PARA SU TRANSPORTE.
                <table style="border-collapse: collapse;" class="probable100">
                    <tr>
                        <td>NOMBRE:</td>
                        <td><b>{{$cita->nombrecompleto}}</b></td>
                        <td>FIRMA: <img src="{{$cita->firmachof}}" width="70px" alt=""></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>CARGO:</td>
                        <td></td>
                        <td>FECHA DE EMBARQUE:</td>
                        <td><b>{{FechaFormateada($cita->fechacita)}}</b></td>
                    </tr>
                </table>
                <hr>
                9.- DISTANCIA RECORRIDA DESDE LA EMPRESA GENERADORA HASTA SU ENTREGA (Km).
                <br>
                <hr>
                <table style="border-collapse: collapse;" class="probable100">
                    <tr>
                        <td>10.-TIPO DE VEHÍCULO</td>
                        <td><b>{{$cita->vehiculo}}</b></td>
                        <td>MARCA Y MODELO</td>
                        <td><b>{{$cita->marcaymodelo}}</b></td>
                        <td>No. DE MATRÍCULA:</td>
                        <td><b>{{$cita->matricula}}</b></td>
                    </tr>
                   
                </table>
                <hr>
               
                <table style="border-collapse: collapse;" class="probable100">
                    <tr>
                        <td>11.-TIPO DE COMBUSTIBLE</td>
                        <td>{{$cita->combustible}}</td>
                        
                    </tr>
                   
                </table>
                <hr>
                <table style="border-collapse: collapse;" class="probable100">          

                    <tr>
                        <td>12.- DESCRIPCIÓN DEL RESIDUO RECIBIDO (Nombre del residuo, Conforme a la Tabla 1 de la presente Norma Ambiental)</td>
                        <td>CANTIDAD TOTAL DE RESIDUO TRANSPORTADO</td>
                        
                    </tr>
                              
                    <tr>
                        <td><b>{{$cita->material}}</b></td>
                        <td><b>{{$cita->cantidad.' '.$cita->unidades}}</b></td>
                        
                    </tr>
                    
                    
                </table>
                <hr>

                <table  style="border-collapse: collapse;" class="probable100">          

                    <tr>
                        <td>13.- ESPECIFIQUE LAS CONDICIONES<br> CONFORME A LAS CUALES TRANSPORTA<br> LOS RESIDUOS (Marque con una X)</td>
                        <td style="text-align:center;">GRANEL:<br
                        >@if($cita->condicionesmaterial=='Granel')
                        <b>x</b>
                        @else&nbsp;
                        @endif</td>
                        <td style="text-align:center;">ENCOSTALADO:<br>
                        @if($cita->condicionesmaterial=='Encostalado')
                        <b>x</b>
                        @else&nbsp;
                        @endif</td>
                        
                    </tr>
                              
                   
                    
                    
                </table>
                <hr>
                14.- INDIQUE EL NOMBRE Y DOMICILIO DEL SITIO DE DISPOSICIÓN (CENTRO DE ACOPIO, TRANSFERENCIA, PLANTA DE RECICLAJE O SITIO
                <br>
                <b>{{$cita->planta.'   '.$cita->direccionplanta}}</b>
                <hr>
                15.- DECLARACIÓN DEL PRESTADOR DE SERVICIO DE TRANSPORTE: DECLARO QUE EL CONTENIDO DE ESTE MANIFIESTO ESTA TOTAL Y CORRECTAMENTE DESCRITO MEDIANTE EL NOMBRE DEL RESIDUO, BIEN CLASIFICADO, Y MARCADO, Y QUE SE HAN PREVISTO LAS CONDICIONES DE SEGURIDAD PARA SU TRANSPORTE POR VÍA TERRESTRE DE ACUERDO A LA LEGISLACIÓN VIGENTE.
                NOMBRE Y FIRMA DEL RESPONSABLE.
                <br>
                <br>
                <br>
            </td>
        </tr>
        <tr>
            <td class="bordes"><center><img style="width:15px; padding:20px;" src="{{public_path('images/formatos/manifiesto/destino.png')}}" alt="Destino"></center></td>
            <td class="bordes">
                <table border="1" style="border-collapse: collapse;" class="probable100">
                    <tr>
                        <td>17.- RAZÓN SOCIAL DE LA PERSONA FÍSICA O MORAL DESTINATARIA <br>(CENTRO DE ACOPIO, CENTRO DE TRANSFERENCIA, <br>PLANTA DE RECICLAJE O SITIO DE DISPOSICIÓN FINAL):</td>
                        <td><b>{{$cita->planta}}</b></td>
                        
                    </tr>
                </table>
                <table border="1" style="border-collapse: collapse;" class="probable100">
                    <tr>
                        <td>18.- NÚMERO DE AUTORIZACIÓN <br>(Centro de Acopio)</td>
                        <td><b>{{$cita->plantaauto}}</b></td>                        
                    </tr>
                </table>
                <table border="1" style="border-collapse: collapse;" class="probable100">
                    <tr>
                        <td>DOMICILIO DEL ESTABLECIMIENTO:</td>
                    <td><b>{{$cita->direccionplanta}}</b></td>   
                    </tr>           
                    <tr>
                        <td><b>TELÉFONO</b></td>          
                        <td><b>55-7599-8226</b></td>
                    </tr>
                </table>
                
                <table border="1" style="border-collapse: collapse;" class="probable100">
                    <tr>
                        <td>RECIBÍ LOS RESIDUOS DESCRITOS EN EL MANIFIESTO</td>
                        <td>SI</td>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$cita->confirmacion==1 ? 'x' : ''}}</td>
                        <td>NO</td>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$cita->confirmacion==2 ? 'x' : ''}}</td>
                    </tr>
                </table>
                <table border="1" style="border-collapse: collapse;" class="probable100">
                    <tr>
                        <td colspan="2">NOMBRE: {{$cita->recibio}}</td>
                    </tr>
                    <tr>
                        <td>CARGO:{{$cita->cargo}}</td>
                        <td>FIRMA  <img src="{{$cita->firmarecibio}}" width="70px" alt=""></td>
                    </tr>
                    
                </table>
                
                OBSERVACIONES: <br>
                <b>{{$cita->observacion}}</b>

                <table border="1" style="border-collapse: collapse;" class="probable100">
                    <tr>
                        <td>Folio Fiscal de la factura asociada al acopio de RCD <br><br></td>
                        <td>DÍa</td>
                        <td>MES</td>
                        <td>AÑO</td>
                    </tr>

                    <tr>
                        <td>FECHA DE RECEPCIÓN DEL EMBARQUE AL CENTRO DE ACOPIO</td>
                        <?php $fecha=explode("/",MesesEspanol(date('d/m/Y',strtotime($cita->fechacita))));?>
                        <td><b>{{$fecha[0]}}</b></td>
                        <td><b>{{$fecha[1]}}</b></td>
                        <td><b>{{$fecha[2]}}</b></td>
                    </tr>

                    <tr>
                        <td>FECHA DE SALIDA DEL CENTRO DE ACOPIO</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>

                    <tr>
                        <td>Folio Fiscal de la factura asociada a la disposición final  RCD <br><br></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
            </td>

            
        </tr>      

    </table>
</center>
@endforeach
    
</body> 
</script> 
</html>
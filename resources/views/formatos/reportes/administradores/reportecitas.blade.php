<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
</head>
<body>
    <table>
        <thead>
        <tr>
            <th style="width:30px; text-align:center;">FOLIO</th>
            <th style="width:30px; text-align:center;">FECHA</th>
            <th style="width:30px; text-align:center;">NO. DE REGISTRO</th>
            <th style="width:30px; text-align:center;">RAZÓN SOCIAL</th>
            <th style="width:30px; text-align:center;">OBRA</th>
            <th style="width:30px; text-align:center;">DIRECCIÓN FISCAL</th>
            <th style="width:30px; text-align:center;">DIRECCIÓN DEL ORIGEN DE LOS RESIDUOS</th>
            <th style="width:30px; text-align:center;">UNIDAD</th>
            <th style="width:30px; text-align:center;">CANTIDAD</th>
            <th style="width:30px; text-align:center;">PRECIO UNITARIO</th>
            <th style="width:30px; text-align:center;">SUBTOTAL</th>
            <th style="width:30px; text-align:center;">TOTAL</th>
            <th style="width:30px; text-align:center;">TIPO DE VEHÍCULO</th>
            <th style="width:30px; text-align:center;">MARCA Y MODELO</th>
            <th style="width:30px; text-align:center;">NO. DE MATRÍCULA</th>
            <th style="width:30px; text-align:center;">TARJETÓN RAMIR</th>
            <th style="width:30px; text-align:center;">GRANEL</th>
            <th style="width:30px; text-align:center;">ENCOSTALADO</th>
            <th style="width:30px; text-align:center;">ENTREGÓ</th>
            <th style="width:30px; text-align:center;">RECIBIÓ</th>
            <th style="width:30px; text-align:center;">CARGO</th>
            <th style="width:30px; text-align:center;">CONCEPTO</th>
            <th colspan="2" style="width:30px; text-align:center;">FOTOS</th>
        </tr>
        </thead>
        <tbody>
            <?php $tcantidad=0; $tconsto=0; ?>
            @foreach($citas as $cita)
            <tr>
                <td style="width:30px; text-align:center; word-wrap:break-word;">{{$cita->folio}}</td>
                <td style="width:30px; text-align:center; word-wrap:break-word;">{{$cita->fechacita}}</td>
                <td style="width:30px; text-align:center; word-wrap:break-word;">{{$cita->regsct}}</td>
                <td style="width:30px; text-align:center; word-wrap:break-word;">{{$cita->razonsocial}}</td>
                <td style="width:30px; text-align:center; word-wrap:break-word;">{{$cita->obra}}</td>
                <td style="width:30px; text-align:center; word-wrap:break-word;">{{$cita->calleynumerofis.' '.$cita->coloniafis.' '.$cita->municipiofis.' '.$cita->cpfis}}</td>
                <td style="width:30px; text-align:center; word-wrap:break-word;">{{$cita->calleynumeroobr.' '.$cita->coloniaobr.' '.$cita->municipioobr.' '.$cita->cpobr}}</td>
                <td style="width:30px; text-align:center; word-wrap:break-word;">{{$cita->unidades}}</td>
                <td style="width:30px; text-align:center; word-wrap:break-word;">{{$cita->cantidad}}</td>
                <td style="width:30px; text-align:center; word-wrap:break-word;">$ {{$cita->precio}}</td>
                <td style="width:30px; text-align:center; word-wrap:break-word;">$ {{number_format($cita->precio*$cita->cantidad,2)}}</td>
                <td style="width:30px; text-align:center; word-wrap:break-word;">$ {{number_format(($cita->precio*$cita->cantidad)+(($cita->iva/100)*$cita->precio*$cita->cantidad),2)}}</td>
                <td style="width:30px; text-align:center; word-wrap:break-word;">{{$cita->vehiculo}}</td>
                <td style="width:30px; text-align:center; word-wrap:break-word;">{{$cita->marcaymodelo}}</td>
                <td style="width:30px; text-align:center; word-wrap:break-word;">{{$cita->matricula}}</td>
                <td style="width:30px; text-align:center; word-wrap:break-word;">{{$cita->ramir}}</td>
                <td style="width:30px; text-align:center; word-wrap:break-word;">@if($cita->condicionesmaterial=='Granel') Sí @else No @endif</td>
                <td style="width:30px; text-align:center; word-wrap:break-word;">@if($cita->condicionesmaterial=='Encostalado') Sí @else No @endif</td>
                <td style="width:30px; text-align:center; word-wrap:break-word;">{{$cita->nombrecompleto}}</td>
                <td style="width:30px; text-align:center; word-wrap:break-word;">{{$cita->recibio}}</td>
                <td style="width:30px; text-align:center; word-wrap:break-word;">{{$cita->cargo}}</td>
                <td style="width:30px; text-align:center; word-wrap:break-word;">{{$cita->observacion}}</td>
                
            </tr>
            <?php 
                $tcantidad+=$cita->cantidad;
                $tconsto+=$cita->precio*$cita->cantidad;
            ?>
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td style="text-align:center;">{{$tcantidad}} {{$cita->unidades}}</td>
                <td></td>
                <td style="text-align:center;">$ {{number_format($tconsto,2)}}</td>
            </tr>
        </tbody>
        
    </table>
</body>
</html>

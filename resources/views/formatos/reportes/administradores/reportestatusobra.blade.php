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
            <th style="width:30px; text-align:center;">Empresa</th>
            <th style="width:30px; text-align:center;">Obra</th>
            <th style="width:30px; text-align:center;">Fecha Registro</th>
            <th style="width:30px; text-align:center;">Inicio de Obra</th>
            <th style="width:30px; text-align:center;">Fin de Obra</th>   
            <th style="width:30px; text-align:center;">Pospago</th>       
            <th style="width:30px; text-align:center;">Contrato</th>            
            <th style="width:30px; text-align:center;">$ Monto</th>            
            <th style="width:30px; text-align:center;">Descuento</th>            
            <th style="width:30px; text-align:center;">$ Monto Total</th>
            <th style="width:30px; text-align:center;">$ Pagos</th>
            <th style="width:30px; text-align:center;">$ Reciclaje</th>
            <th style="width:30px; text-align:center;">$ Pedidos</th>
            <th style="width:30px; text-align:center;">$ Saldo</th>
            <th style="width:30px; text-align:center;">$ Saldo por Cobrar</th>
            <th style="width:30px; text-align:center;">Por Iniciar</th>
            <th style="width:30px; text-align:center;">Iniciada</th>
            <th style="width:30px; text-align:center;">Terminada</th>
            <th style="width:30px; text-align:center;">Activa</th>
            <th style="width:30px; text-align:center;">Suspendida</th>
            <th style="width:30px; text-align:center;">Volumen Declarado</th>
            <th style="width:30px; text-align:center;">Volumen Entregado</th>
            <th style="width:30px; text-align:center;">Primera Entrega</th>
            <th style="width:30px; text-align:center;">Ultima Entrega</th>
        </tr>
        </thead>
        <tbody>
            @foreach($obrass as $obras)
            @foreach($obras as $obra)
            <tr>
                <th  style="width:30px; text-align:center;">{{$obra->razonsocial}}</th>
                <td  style="width:30px; text-align:center;">{{$obra->obra}}</td>
                <td  style="width:30px; text-align:center;">{{$obra->created_at}}</td>
                <td  style="width:30px; text-align:center;">{{$obra->fechainicio}}</td>
                <td  style="width:30px; text-align:center;">{{$obra->fechafin}}</td>
                <td  style="width:30px; text-align:center;">{{$obra->puedepospago == 1 ? 'X' : ''}}</td>
                <td  style="width:30px; text-align:center;">{{$obra->contrato == 1 ? 'X' : ''}}</td>
                <td  style="width:30px; text-align:center;">{{number_format($obra->monto,2)}}</td>                
                <td  style="width:30px; text-align:center;">{{$obra->descuento}}%</td>                
                <td  style="width:30px; text-align:center;">{{number_format($obra->montototal,2)}}</td>                
                <td  style="width:30px; text-align:center;">{{number_format($obra->pagos,2)}}</td>            
                <td  style="width:30px; text-align:center;">{{number_format($obra->reciclaje,2)}}</td>        
                <td  style="width:30px; text-align:center;">{{number_format($obra->pedidos,2)}}</td>       
                <td  style="width:30px; text-align:center;">{{number_format($obra->pagos-($obra->reciclaje+$obra->pedidos),2)}}</td>                                
                <td style="width:30px; text-align:center;">{{number_format($obra->montototal-$obra->pagos,2)}}</td>
                <td  style="width:30px; text-align:center;">
                    @if(intval($obra->iniciada)>0  &&  intval($obra->terminada)!=1)
                    {{'X'}}
                    @else
                    {{''}}
                    @endif

                </td>
                <td style="width:30px; text-align:center;">
                    @if(intval($obra->iniciada)<0)
                    {{'X'}}
                    @else
                    {{''}}
                    @endif

                </td>
                <td style="width:30px; text-align:center;">
                    @if(intval($obra->terminada)==1)
                    {{'X'}}
                    @else
                    {{''}}
                    @endif

                </td>
                <td style="width:30px; text-align:center;">
                    @if($obra->activa >= (-30))
                    {{'X'}}
                    @else
                    {{''}}
                    @endif

                </td>
                <td style="width:30px; text-align:center;">
                    @if(intval($obra->deshabilitada)==1)
                    {{'X'}}
                    @else
                    {{''}}
                    @endif

                </td>
                <td style="width:30px; text-align:center;">{{$obra->superficie}} {{$obra->superunidades}}</td>                
                <td style="width:30px; text-align:center;">{{$obra->entregado*1}} {{$obra->superunidades}}</td>
                <td style="width:30px; text-align:center;">{{($obra->reciclaje*1)>0 ? FechaFormateada($obra->primera) : ''}}</td>
                <td style="width:30px; text-align:center;">{{($obra->reciclaje*1)>0 ? FechaFormateada($obra->ultima) : ''}}</td>
            </tr>
            @endforeach
            @endforeach
           
        </tbody>
        
    </table>
</body>
</html>

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
            <th style="width:25px;">fecha de reporte</th>
            <th style="width:100px;">planta</th>
            <th style="width:150px;">Dirección</th>
            <th style="">codigo cliente igual al de SAP</th>
            <th style="">estatus</th>
            <th style="">activo</th>
            <th style="">referencia</th>
            <th style="width:40px;">cliente</th>
            <th style="">vendedor</th>
            <th style="width:500px;">razon social</th>
            <th style="width:500px;">domcilio fiscal</th>
            <th style="width:500px;">Nombre de la obra</th>
            <th style="">fecha inicio</th>
            <th style="">fecha fin</th>
            <th style="width:500px;">domicilio obra</th>
            <th style="">contacto</th>
            <th style="width:25px;">teléfono</th>
            <th style="width:25px;">contacto</th>
            <th style="width:25px;">correo electronico</th>
            <th style="">firmado Si No</th>
            <th style="">Contraprestacion o importe contratado</th>
            <th style="">Descripcion tipo de agregado</th>
            <th style="width:25px;">metros cubicos contratados</th>
            <th style="width:25px;">metros cubicos recibidos</th>
            <th style="width:25px;">remanente metros cubicos</th>
            <th style="width:25px;">anticipo</th>
            <th style="width:25px;">credito</th>
            <th style="width:25px;">consumo</th>
            <th style="width:25px;">ramanente</th>
            <th style="width:25px;">transporte del cliente</th>
            <th style="width:25px;">transporte de CSMX</th>
            <th style="width:25px;">costo estimado</th>
            <th style="width:25px;">Folio de manifiesto</th>
            <th style="width:25px;">Transporte</th>
            <th style="width:25px;">pagare</th>
            <th style="width:25px;">fecha</th>
            <th style="width:25px;">Factura</th>
            <th style="width:25px;">fecha factura</th>
            <th style="width:25px;">dias de credito</th>
            <th style="width:25px;">Subtotal</th>
            <th style="width:25px;">IVA</th>
            <th style="width:25px;">Total</th>
            <th style="width:25px;">documentacion legal completa</th>
            <th style="width:25px;">lista de precios por tipo de residuo a recibir</th>
        </tr>
        </thead>
        <tbody>
            @foreach($obras as $obra)
            <tr>
                <td>{{date('Y-m-d')}}</td>
                <td>{{$obra->planta}}</td>
                <td>{{$obra->dirplanta}}</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>{{$obra->cliente}}</td>
                <td></td>
                <td>{{$obra->razonsocial}}</td>
                <td>{{$obra->domiciliogen}}</td>
                <td>{{$obra->obra}}</td>
                <td>{{$obra->fechainicio}}</td>
                <td>{{$obra->fechafin}}</td>
                <td>{{$obra->domicilioobr}}</td>
                <td></td>
                <td>{{$obra->celular}}</td>
                <td>{{$obra->correo}}</td>
                <td>{{$obra->correo2}}</td>
                <td>
                    @if($obra->contrato == 1)
                        Si
                        @else
                        No
                    @endif
                </td>
                <td>
                    @if($obra->transporte == 1)
                        ${{$obra->capacidad<= 0 ? 0 : number_format($obra->preciomat+ceil( $obra->cantidadobra/$obra->capacidad)*($obra->preciotrans),2)}}
                        @else
                        ${{number_format($obra->preciomat,2)}}
                    @endif
                </td>
                <td></td>
                <td>{{number_format($obra->cantidadobra,2)}}{{$obra->superunidades}}</td>                
                <td>{{number_format($obra->entregado,2)}}{{$obra->superunidades}}</td>
                <td>{{number_format($obra->cantidadobra-$obra->entregado,2)}}{{$obra->superunidades}}</td>                
                <td>${{number_format($obra->monto,2)}}</td>
                <td>{{$obra->puedepospago == 1 ? 'X' : ''}}</td>
                <td>${{number_format($obra->consumo,2)}}</td>
                <td>${{number_format($obra->monto-$obra->consumo,2)}}</td>
                
                <td>{{$obra->transporte == 1 ? '' : 'X'}}</td>
                <td>{{$obra->transporte == 1 ? 'X' : ''}}</td>
                <td></td>
                <td></td>
                <td>
                    @if($obra->transporte == 1)
                        ${{$obra->capacidad<= 0 ? 0 : number_format(ceil( $obra->cantidadobra/$obra->capacidad)*($obra->preciotrans),2)}}
                        @else
                        ${{0}}
                    @endif
                </td>
                <td>

                    @if($obra->transporte == 1)
                        ${{$obra->capacidad<= 0 ? 0 : number_format($obra->preciomat+ceil( $obra->cantidadobra/$obra->capacidad)*($obra->preciotrans),2)}}
                        @else
                        ${{number_format($obra->preciomat,2)}}
                    @endif
                    
                </td>
              
            </tr>
            @endforeach
           
        </tbody>
        
    </table>
</body>
</html>

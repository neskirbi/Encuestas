<!DOCTYPE html>
<html lang="en">
<head>
  @include('cliente.header')
  
  <title>{{$data->siglas}} | Remisiones</title>

</head>
<style>
   
</style>
<body>
    <br><br>
    <div>
        <table style="width:100%;">
            <tr>
                <td>
                    <img src="{{asset($data->logo)}}" height="100px" style="float: left;">
                </td>
                <td>
                    <div style="width:100%;">
                        <center><i class="fa fa-map-marker" aria-hidden="true"></i> {{$data->direccion}}</center>                
                    </div>
                    <div style="width:100%;">
                
                    </div>
                </td>
                <td>
                    <table> 
                        <tr>
                            <td colspan="2"><b>CONTÁCTANOS EN:</b></td>
                          
                        </tr>
                        <tr>
                            <td><i class="fa fa-phone" aria-hidden="true"></i> </td>
                            <td> {{$data->telefono}}</td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-envelope" aria-hidden="true"> </i></td>
                            <td> {{$data->mail}}</td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-globe" aria-hidden="true"> </i></td>
                            <td> {{$data->web}}</td>
                        </tr>
                    </table>
                </td>
            </tr>   
        </table>
        
       
       
    </div>
    <br>
    <div>
        <span class="">Remisión: {{$remision->orden}}</span><span class="float-right"> {{FechaFormateada($remision->created_at)}}</span>
    </div>
    <hr>
    <div>
        <b>AGENTE DE VENTA:</b>
        
        {{$vendedor->vendedor}}
    </div>
    <hr>
    <div>
        <b><center>{{$data->obra}}</center></b>
    </div>
    <div>
       <center>{{$remision->obra_domicilio}}</center> 
    </div><hr>
    <div>
        <table border="1px" style="width:100%; text-align:center;">
        <tr>
            <th>Producto</th>
            <th></th>
        </tr>
        <tr>
            <td>ID: {{$detalle->sku}}</td>
            <td></td>
        </tr>
        <tr>
            <td>
                <div>
                    <b><center>{{$detalle->producto}}</center></b>
                </div>
                <div>
                    <center>{{$detalle->descripcion}}</center> 
                </div>
            </td>
            <td>
                <table border="1px" style="width:100%; text-align:center;">
                    <tr>
                        <th>Pedidos</th>
                        <th>Entregados</th>
                        <th>Restantes</th>
                    </tr>
                    <tr>
                        <td>{{$remision->pedidos}}m<sup>3</sup></td>
                        <td>{{$remision->entregados}}m<sup>3</sup></td>
                        <td>{{$remision->restantes}}m<sup>3</sup></td>
                    </tr>
                </table>
            </td>
        </tr>
        </table>
    </div> 
    <hr>
    <table border="1px" style="width:100%; text-align:center;">
        <tr>
            <th>Salida Planta</th>
            <th>Llegada Obra</th>
            <th>Descarga</th>
            <th>Salida Obra</th>
            <th>Llegada Planta</th>
        </tr>
        <!--<tr>
            <td>{{TiempoFormateado($remision->planta_salida)}}</td>
            <td>{{TiempoFormateado($remision->obra_entrada)==TiempoFormateado($remision->planta_salida) ? '00:00:00' : TiempoFormateado($remision->obra_entrada)}}</td>
            <td>{{TiempoFormateado($remision->obra_descarga)==TiempoFormateado($remision->planta_salida) ? '00:00:00' : TiempoFormateado($remision->obra_descarga) }}</td>
            <td>{{TiempoFormateado($remision->obra_salida)==TiempoFormateado($remision->planta_salida) ? '00:00:00' : TiempoFormateado($remision->obra_salida) }}</td>
            <td>{{TiempoFormateado($remision->planta_entrada)==TiempoFormateado($remision->planta_salida) ? '00:00:00' : TiempoFormateado($remision->planta_entrada) }}</td>
        </tr>-->

        <tr>
            <td>{{TiempoFormateado($remision->planta_salida)}}</td>
            <td>{{TiempoFormateado($remision->obra_entrada)==TiempoFormateado($remision->planta_salida) ? '00:00:00' : TiempoFormateado($remision->obra_entrada)}}</td>
            <td>{{TiempoFormateado($remision->obra_descarga)==TiempoFormateado($remision->planta_salida) ? '00:00:00' : TiempoFormateado($remision->obra_descarga) }}</td>
            <td>{{TiempoFormateado($remision->obra_salida)==TiempoFormateado($remision->planta_salida) ? '00:00:00' : TiempoFormateado($remision->obra_salida) }}</td>
            <td>{{TiempoFormateado($remision->planta_entrada)==TiempoFormateado($remision->planta_salida) ? '00:00:00' : TiempoFormateado($remision->planta_entrada) }}</td>
        </tr>
    </table>

    <hr>
    <center><b>Contacto</b> </center>
    <div>
        <table style="width:100%; text-align:center;">
            <tr>
                <td>
                    <b>Residente</b>
                </td>
                <td>
                    <b>Teléfono</b>
                </td>
            </tr>

            <tr>
                <td>
                    {!!$remision->residente!!}
                </td>
                <td>
                    {!!$remision->residente_telefono!!}
                </td>
            </tr>
        </table>
    </div>
    <hr>
    <div>
        <table style="width:100%; text-align:; " border="1px">
            <tr>
                <th style="width:405px;"><b>Recibió:</b>
                <div>{{$remision->nombrerecibio}}</div>
                </th>
                
                <th>Observaciones:</th>
            </tr>
            <tr>
                <td>                    
                    <img src="{{$remision->firmares}}" style="width:200px;" alt="">
                </td>
                
                <td>
                    <div>
                        {{$remision->observacion}}
                    </div>
                </td>
            </tr>
        </table>
    </div>

    
  
</body>

<script>
$(document).ready(function(){
  window.setTimeout(function(){
    //window.print();
  }, 1000);
  
}).delay( 1000 );

</script>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
  @include('cliente.header')
  
  <title>{{$planta->siglas}} | Cotización</title>

</head>
<style>
    .cabeza{
        
        width:100%;
        background-color:#3A3838;
        color:#fff;
        padding: 10px;
    }
    
    .tcliente{
    
        width:100%;
    }

    .tcliente tr td{
        border:dotted 1px #000 ;        
        border-collapse: collapse;
    }

    .cabeza2{
        
        width:100%;
        background-color:{{$planta->color_primario}};
        color:#fff;
        padding: 10px;
    }
    .tobra{
        
        width:100%;
    }
    .tobra tr td{
        border:dotted 1px #000 ;        
        border-collapse: collapse;
    }


    
    .tmate{
        width:100%;
    }
    .tmate th{
        background-color:#808080;
        text-align:center;
    }
    .tmate tr td{
        border:dotted 1px #000 ;        
        border-collapse: collapse;
    }
    .tmate td{
        
        background-color:#fff;
    }
    .datos{
        width:100%;
        text-align:center;
    }
</style>
<body>
    <br><br>
    <div>
        
        <img src="{{asset($planta->logo)}}" height="50px" style="float: left;">
        <div style="float: right;">
            <table> 
                <tr>
                    <td><i class="fa fa-phone" aria-hidden="true"></i></td>
                    <td> {{$planta->telefono}}</td>
                </tr>
                <tr>
                    <td><i class="fa fa-envelope" aria-hidden="true"></i></td>
                    <td> {{$planta->mail}}</td>
                </tr>
                <tr>
                    <td><i class="fa fa-globe" aria-hidden="true"></i></td>
                    <td> {{$planta->web}}</td>
                </tr>
            </table>
        </div>
       
    </div>

    
    <br><br><br><br><br>
    <div>
        <span style="float: left;">Folio: {{($datos->folio)}}</span>
        <span style="float: right;">{{FechaFormateada($datos->fecha_cotizacion)}}</span>
    </div>
    <br><br>
    <div class="cabeza">
        <center>FORMATO DE COTIZACIÓN</center>
    </div>
    <table class="tcliente">
        <tr>
            <td>Cliente</td>
            <td>{{$datos->razonsocial}}</td>
        </tr>
        <tr>
            <td>Representante</td>
            <td>{{$datos->nombresrepre.' '.$datos->apellidosrepre.$datos->nombresfisica.' '.$datos->apellidosfisica}}</td>
        </tr>
        <tr>
            <td>Dirección Fiscal</td>
            <td>{{$datos->domicilio}}</td>
        </tr>
        <tr>
            <td>RFC</td>
            <td>{{$datos->rfc}}</td>
        </tr>
    </table>
    <br>
    <br>

    <div class="cabeza2">
        <center>DATOS DEL PROYECTO</center>
    </div>
    <table class="tobra">
        <tr>
            <td>Proyecto</td>
            <td>Dirección</td>
        </tr>
        <tr>
            <td>{{$datos->obra}}</td>
            <td>{{$datos->domicilioobra}}</td>
        </tr>
        
    </table>
    <br>
    <br>

    <div class="cabeza2">
        <center>PRODUCTOS Y SERVICIOS</center>
    </div>
    <table class="tmate">
        <tr>
            <th>ID. PRODUCTO</th>
            <th>Fecha Entrega</th>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Precio Unitario</th>
            <th>Importe</th>
        </tr>
        @foreach($productos as $producto)
        <tr>
            <td>{{$producto->skup.$producto->skut}}</td>
            <td>{{FechaFormateada($producto->fechaentrega)}}</td>
            <td>{{$producto->producto.' '.$producto->descripcion}}</td>
            <td>{{number_format($producto->cantidad,2)}} {{$producto->unidades}}</td>
            <td>$ {{number_format($producto->precio,2)}}</td>
            <td>$ {{number_format($producto->importe,2)}}</td>

        </tr>

        @endforeach

        <tr>
            <td style="border:solid #000 0px;"></td>
            <td style="border:solid #000 0px;"></td>
            <td style="border:solid #000 0px;"></td>
            <td style="border:solid #000 0px;"></td>
            <td style="background-color:#AEAAAA;">Subtotal</td>
            <td>$ {{number_format($producto->subtotal,2)}}</td>

        </tr>
        <tr>
            <td style="border:solid #000 0px;"></td>
            <td style="border:solid #000 0px;"></td>
            <td style="border:solid #000 0px;"></td>
            <td style="border:solid #000 0px;"></td>
            <td style="background-color:#AEAAAA;">IVA</td>
            <td>$ {{number_format($producto->iva,2)}}</td>

        </tr>
        <tr>
            <td style="border:solid #000 0px;"></td>
            <td style="border:solid #000 0px;"></td>
            <td style="border:solid #000 0px;"></td>
            <td style="border:solid #000 0px;"></td>
            <td style="background-color:#AEAAAA;">Total</td>
            <td>$ {{number_format($producto->total,2)}}</td>

        </tr>
        
    </table>
    <br>
    <br>
    <div class="datos"><b>{{$planta->razonsocial}}</b></div>
    <div class="datos">{{$planta->direccion}}</div>

    <br><br>
    <div class="datos">
    Estos precios son en MXN.
    </div>
    <div class="datos">
    Cotización vigente hasta 15 dias posterior a la fecha de este documento.
    </div>

    <br><br>
    <div class="datos">
    Precios sujetos a cambios, sin previo aviso.
    </div>
    <div class="datos">
    Esta cotización anula a las anteriores y es válida en formato electrónico.
    </div>
    <div class="datos">
    Nuestros concretos se encuentran regulados bajo la Norma Mexicana NMX C-155.
    </div>

    <br><br>
    <div class="datos">
    El pago es de riguroso contado, antes de la entrega. El cliente podrá acceder a un plazo de 30 días de crédito, contados a partir de la fecha de facturación, si cumple con los requisitos correspondientes. Ponemos a su disposición las opciones de
    pago con cheque, tarjeta de crédito y débito, vía transferencia bancaria o depósitos en las cuentas señaladas a continuación. Le notificamos que si su opción de pago es en efectivo, deberá realizarlo directamente en la ventanilla de las entidades
    bancarias correspondientes ya que el personal de <b>{{$planta->razonsocial}}</b> no está autorizado para recibir pagos en efectivo.
    </div>
  
</body>

<script>
$(document).ready(function(){
  window.setTimeout(function(){
    window.print();
  }, 1000);
  
}).delay( 1000 );

</script>
</html>

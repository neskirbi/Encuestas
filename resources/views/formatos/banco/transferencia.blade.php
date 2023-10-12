<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <center>
        <div>
        <!--<img src="{{asset('images/logo.jpg')}}" height="100px">-->
        </div>
        <h2>{{$pago->referencia}}</h2>
        <h2>$ {{number_format($pago->monto,2)}}</h2>
        <h3>{{$configuracion->razonsocial}}</h3>
        <h4>Favor de proporcionar la referencia del pago.</h4>
    </center>
    <br><br>
   
    <table border="1px" style=" width:100%; border-collapse: collapse;" cellpadding="20px">
      
       
        <tr>
            <td>Banco</td>
            <td style="text-align:right;"><b>{{$configuracion->banco}}</b></td>
        </tr>
        <tr>
            <td>Cuenta</td>
            <td style="text-align:right;"><b> {{$configuracion->cuenta}}</b></td>
        </tr>
        <tr>
            <td>CLABE</td>
            <td style="text-align:right;"><b> {{$configuracion->clabe}}</b></td>
        </tr>
        <tr>
            <td>Referencia</td>
            <td style="text-align:right;"><b>{{$pago->referencia}}</b></td>
        </tr>
    </table>    
</body>
</html>
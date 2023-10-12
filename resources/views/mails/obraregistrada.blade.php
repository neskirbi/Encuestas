<!DOCTYPE html>
<html lang="en">
<head>
    @include('header')
    <title>Obra</title>    
</head>
<body>
<br><br><br>
    <center>
        <img src="{{asset('images/logo.png')}}" alt="" width="200px">
        <h2>Su registro fue guardado con éxito, los datos se estan validando, en breve se le hará llegar su contrato.</h2>
        <h3>Gracias por elegir Reci-track.</h3>
        <div class="d-inline p-2"><a href="{{url('obras')}}" class="btn btn-default  btn-outline-secondary">Regresar</a></div>
    </center>
    
</body>
</html>
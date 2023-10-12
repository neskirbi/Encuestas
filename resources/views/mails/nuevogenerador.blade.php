<!DOCTYPE html>
<html lang="en">
<head>
    @include('header')
    <title>Confirmación</title>
</head>
<body>
<br><br><br>
    <center>
        <img src="{{asset('images/logo.png')}}" alt="" width="200px">
        <h2>Nuevo Generador Registrado.</h2>
        <h5>Se ha registrado la información del generador {{$generador->razonsocial}} para la validación de los datos.</h5>
        <a href="http://reci-track.mx/acceso" class="btn btn-default  btn-outline-secondary">Ir a Reci-track</a>
    </center>
    
</body>
</html>
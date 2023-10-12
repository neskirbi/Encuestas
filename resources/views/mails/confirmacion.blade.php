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
        <h2>Verificar su dirección de correo para finalizar su registro.</h2>
        <h3>Gracias por elegir Reci-track.</h3>
        <h5>Por favor confirme que {{$mail}} es su correo dando click en el siguiente enlace.</h5>
        <a href="http://reci-track.mx/confirmacion/{{$id}}" class="btn btn-default  btn-outline-secondary">Confirmar Correo</a>
    </center>
    
</body>
</html>
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
        <div class="d-inline p-2"><a href="home" class="btn btn-default  btn-outline-secondary">Página Principal</a></div>
        <div class="d-inline p-2"><button class="btn btn-default  btn-outline-secondary" onclick="CorreoConfirmApi('{{$cliente->id}}');BloquearTiempo(this)">Reenviar Correo</button></div>
    </center>
    
</body>
<script>
    CorreoConfirmApi('{{$cliente->id}}');
</script>
</html>
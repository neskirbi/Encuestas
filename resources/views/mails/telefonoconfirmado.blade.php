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
        <h2>Gracias por confirmar su numero.</h2>
        <div class="d-inline p-2"><a href="{{url('home')}}" class="btn btn-default  btn-outline-secondary">Página Principal</a></div>        
    </center>
    
</body>
</html>
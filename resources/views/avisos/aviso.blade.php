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
        <h2>{{$titulo}}</h2>
        <h4>{{$mensaje}}</h4>   
        <button class="btn btn-default  btn-outline-secondary" onclick="Regresar();">Regresar</button>     
    </center>
    
</body>

<script>
    function Regresar(){
        history.go(-1);
    }
    
</script>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    @include('soporte.header')
    <title>{{GetSiglas(0)}} | Login</title>

    <style>
         body{
        }    
        .login-card{
            border:solid #ccc 1px;
            border-radius:5px;
            padding:10px;
            position: absolute;
            top: 50%;
            left: 50%;
            margin: -160px 0 0 -160px;
            width:320px;
            height:320px;
            text-align:center;
        }

        .image-login{
            width:1rem;
        }
        
    </style>
</head>
<body>    
    @include('toast.toasts')  
    <div class="login-card">
        <form action="loginsoporte" method="post">
            @csrf
        <div>
            <img src="{{asset('images/logo.jpg')}}" height="100px">
        </div>
        <br><br>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
            </div>
            <input type="text" class="form-control" placeholder="Correo" name="mail" id="mail">
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-key"></i></span>
            </div>
            <input type="password" class="form-control" placeholder="Contraseña" name="pass" id="pass">
        </div>
        <div class="input-group mb-3">
            <button type="submit" class="btn btn-block btn-outline-primary ">Entrar</button>
        </div>
        </form>

    </div>
    
</body>
</html>
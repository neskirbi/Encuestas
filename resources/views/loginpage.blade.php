<!DOCTYPE html>
<html lang="en">
<head>
    @include('header')
    <title>{{GetSiglas(0)}} | Citas y Folios</title>
</head>
<style>
    .fondo {

        position: fixed;
        margin-right:1px;
        width:100%;
        margin: 0;
    }
    .item-color{
        color:#fff;
    }

    .medio{
        
    }
    @media only screen and (max-width: 550px ) {
        .medio{
            width:90%;
            margin-right:5%;
            margin-left:5%;
        }
    }
    @media only screen and (min-width: 551px ) {
        .medio{
            width:350px;
            margin-right:auto;
            margin-left:auto;
        }
    }
</style>
<body>
    @include('navbar')
    @include('toast.toasts')

    <img src="{{asset('images/portada.jpg')}}" alt="" class="fondo">
    

    <br>
   

    <div class="medio">
        <div class="card card-default card-login">
            <div class="card-header">
                <h3 class="card-title">Ingresar</h3>
            </div>
            <form method="post" action="{{url('Login')}}">
            @csrf
            <div class="card-body">
                
                <div class="form-group">
                    <label for="mail">Correo</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fa fa-envelope" aria-hidden="true"></i></div>
                        </div>                        
                        <input required type="email" class="form-control" id="mail" name="mail" placeholder="Correo">                     
                    </div>
                </div>

                <div class="form-group">
                    <label for="pass">Contraseña</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fa fa-key" aria-hidden="true"></i></div>
                        </div>
                        <input required type="password" class="form-control" id="pass" name="pass" placeholder="Contraseña">
                    </div>
                </div>

              
                
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Enviar</button>
            </div>
            </form>
        </div>
    </div>
        



    </body>
        
    
    


</html>
<!DOCTYPE html>
<html lang="en">
<head>
    @include('header')
    <title>Restaurar</title>
</head>
<body>
<div class="row">
        &nbsp;
    </div>
    <div class="row">
        &nbsp;
    </div>
    <div class="row">
        &nbsp;
    </div>
    <div class="row">
        <!-- left column -->
        <div class="col-md-3">
        </div>
        <div class="col-md-6">
            <!-- jquery validation -->
            <div class="card card-primary">
                <div class="card-header">
                <h3 class="card-title">Recuperar Contraseña</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{url('RecuperarAdmin')}}" method="post">
                    @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="mail">Correo</label>
                        <input type="email" name="mail" class="form-control" id="mail" placeholder="Correo" onkeyup="CorreoExisteAdmin(this);">                        
                        <span class="help-block" id="helpertext" style="opacity:.7;"></span>
                    </div>
                   
                   
                </div>
                <!-- /.card-body -->
                <div class="card-footer" id="enviar" style="display:none;">
                    <button type="submit" class="btn btn-primary" >Enviar</button>
                </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
        <div class="col-md-3">
        </div>
    </div>
    
</body>
</html>
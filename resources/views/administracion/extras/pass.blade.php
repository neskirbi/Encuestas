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
                <form action="{{url('GuardarPassAdmin').'/'.$id}}" method="post">
                    @csrf
                <div class="card-body">
                   
                    <div class="form-group">
                        <label for="pass">Contraseña</label>
                        <input required autocomplete="false" onkeyup="ValidarPassRegistro();" type="password" class="form-control" id="pass" name="pass" minlength="4" maxlength="10" placeholder="Contraseña" value="">
                    </div>

                    <div class="form-group">
                        <label for="passconfirm">Confirmar Contraseña</label>
                        <input required autocomplete="false" onkeyup="ValidarPassRegistro();" type="password" class="form-control" id="pass2" name="pass2" minlength="4" maxlength="10" placeholder="Confirmar Contraseña" value="">
                    </div>
                   
                   
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary" >Guardar</button>
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
<!DOCTYPE html>
<html lang="en">
<head>
  @include('transportistas.header')
  <title>{{GetSiglas(0)}} | Vehículos</title>

  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
  @include('toast.toasts')  
  <div class="row" >
    <div class="col-md-12">
      <div class="card card-default">
        <div class="card-header">
          <h3 class="card-title"><i class="nav-icon fa fa-user" aria-hidden="true"></i> Datos</h3>
        </div>
        <form action="{{url('RegistroChofer')}}" method="POST" id="RegistroChofer" enctype="multipart/form-data">
          @csrf 
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">                                        
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                        <label for="nombres">Nombre(s)</label>
                        <input required type="text" name="nombres" class="form-control" id="nombres" placeholder="Nombre(s)" aria-invalid="false"maxlength="150" value="{{ old('nombres') }}" >
                    </div>                     
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                        <label for="ramir">Apellidos</label>
                        <input required type="text" name="apellidos" class="form-control" id="apellidos" placeholder="Apellidos" aria-invalid="false" maxlength="150" >
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="ine">INE (Frente)</label>
                      <div class="input-group">
                      <div class="custom-file">
                      <input required type="file" class="custom-file-input" id="inefrente" name="inefrente">
                      <label class="custom-file-label" for="ine">INE (Frente)</label>
                      </div>
                      
                      </div>
                    </div>
                  </div>

                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="ine">INE (Reverso)</label>
                      <div class="input-group">
                      <div class="custom-file">
                      <input required type="file" class="custom-file-input" id="inereverso" name="inereverso">
                      <label class="custom-file-label" for="ine">INE (Reverso)</label>
                      </div>
                      
                      </div>
                    </div>
                  </div>

                </div>
                <div class="row">

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="licencia">Licencia</label>
                            
                            <select required class="form-control" id="licencia" name="licencia" aria-invalid="false" maxlength="100">
                                <option value="">--Licencia--</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                                <option value="E">E</option>
                                <option value="F">F</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="telefono">Teléfono(Se enviará un código de verificación al teléfono)</label>
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text">+52</span>
                        </div>
                        <input required type="number" name="telefono" class="form-control" id="telefono" placeholder="Teléfono" aria-invalid="false" maxlength="50" >                        
                        <span class="input-group-append">
                          <button type="button" class="btn btn-info btn-flat" onclick="EnviarCodigo(this);">Validar</button>
                        </span>
                      </div>
                    </div>
                  </div>                       
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                        <label for="codigo">Código Verificación</label>
                        <input required type="text" autocomplete="off" name="codigo" class="form-control" id="codigo" placeholder="Código" aria-invalid="false" maxlength="150" >
                    </div>
                  </div>
                </div>
                
                <div class="row">                          
                  <div class="col-md-12">
                    <div class="form-group">
                        <label for="pass">Contraseña</label>
                        <input required type="password" onkeyup="ValidarPass();" name="pass" class="form-control" id="pass" placeholder="Contraseña" aria-invalid="false" maxlength="255" >
                    </div>
                  </div>
                </div>
                
                <div class="row">     
                  <div class="col-md-12">
                    <div class="form-group">
                        <label for="pass">Confirmar Contraseña</label>
                        <input required type="password" onkeyup="ValidarPass();" name="pass2" class="form-control" id="pass2" placeholder="Contraseña" aria-invalid="false" maxlength="255" >
                    </div>
                  </div>
                </div>
                <div class="form-group">
                    <label for="passconfirm">¿Acepta Términos y Condiciones?</label>
                    <br>
                    <a href="TCRecitrackTrasporte" target="_blank">Términos y Condiciones</a>
                    <input required autocomplete="false" type="checkbox" class="form-control" style="width:20px;" id="accept" name="accept">
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Guardar</button>
          </div>
        </form>
        </div>
      </div>
    </div>
  </div>
</body>
<script>
$(function () {
  bsCustomFileInput.init();
});

var conteo=0;
var _this;
function BloquearT(_este){
  
    _this = _este;
    $(_this).prop( "disabled", true );
    conteo=0;
    tiempo = setInterval(Ti, 1000);
    
    // Enable #x
    $( "#x" ).prop( "disabled", false );
}

function Ti(){
    if(conteo<61){
        $(_this).html( 'Esperar ('+conteo+')' );
        conteo++;
    }else{
        $(_this).prop( "disabled", false );
        $(_this).html( 'Enviar' );
        clearInterval(tiempo);
    }    
    

}
</script>
</html>

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
        <form action="{{url('UpdateChofer')}}/{{$chofer->id}}" method="POST" id="RegistroChofer" enctype="multipart/form-data">
          @csrf          
          <input name="_method" type="hidden" value="PUT">
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">                                        
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                          <label for="nombres">Nombre(s)</label>
                          <input type="text" name="nombres" class="form-control" id="nombres" placeholder="Nombre(s)" aria-invalid="false"maxlength="150" value="{{ $chofer->nombres }}" >
                      </div>                     
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                          <label for="ramir">Apellidos</label>
                          <input type="text" name="apellidos" class="form-control" id="apellidos" placeholder="Apellidos" aria-invalid="false" maxlength="150" value="{{ $chofer->apellidos }}">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="ine">INE (Frente)</label>
                        <div class="input-group">
                        <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inefrente" name="inefrente">
                        <label class="custom-file-label" for="ine">INE (Frente)</label>
                        </div>
                        
                        </div>
                      </div>
                    </div>

                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      @if(!file_exists(public_path('documentos/choferes/ine/frente').'/'.$chofer->id.'.jpg'))
                      <img src="{{url('documentos/choferes/ine').'/noine.jpg'}}" class="card-img-top" style=" aspect-ratio: 5/3;">
                      @else
                      <img src="{{url('documentos/choferes/ine/frente').'/'.$chofer->id.'.jpg'}}"  style=" aspect-ratio: 5/3;" class="card-img-top">
                      @endif
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="ine">INE (Reverso)</label>
                        <div class="input-group">
                        <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inereverso" name="inereverso">
                        <label class="custom-file-label" for="ine">INE (Reverso)</label>
                        </div>
                        
                        </div>
                      </div>
                    </div>

                  </div>

                  <div class="row">
                    <div class="col-md-12">
                      @if(!file_exists(public_path('documentos/choferes/ine/reverso').'/'.$chofer->id.'.jpg'))
                      <img src="{{url('documentos/choferes/ine').'/noinereverso.jpg'}}" class="card-img-top" style=" aspect-ratio: 5/3;">
                      @else
                      <img src="{{url('documentos/choferes/ine/reverso').'/'.$chofer->id.'.jpg'}}"  style=" aspect-ratio: 5/3;" class="card-img-top">
                      @endif
                    </div>
                  </div>
                  <div class="row">

                      <div class="col-md-12">
                          <div class="form-group">
                              <label for="licencia">Licencia</label>
                              
                              <select class="form-control" id="licencia" name="licencia" aria-invalid="false" maxlength="100">
                                  <option value="{{$chofer->licencia}}">{{$chofer->licencia}}</option>
                                  <optgroup></optgroup>
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
                        <label for="telefono">Teléfono</label>
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text">+52</span>
                          </div>
                          <input type="number" name="telefono" class="form-control" id="telefono" placeholder="Teléfono" aria-invalid="false" maxlength="50" value="{{$chofer->telefono}}">
                        </div>
                      </div>
                    </div>
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
</script>
</html>

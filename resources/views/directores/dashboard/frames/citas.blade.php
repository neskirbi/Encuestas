<!DOCTYPE html>
<html lang="en">
<head>
  @include('directores.header')
  <title>{{GetSiglas(0)}} | Obras</title>  
</head>
<body>
    <div class="btn-group float-right">
        <button type="button" class="btn btn-default btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Filtros <i class="fa fa-sliders" aria-hidden="true"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-right" style="width:300px;">
            <form class="px-4 py-3" action="{{url('citasdirector')}}" method="GET">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                <span class="input-group-text"><i class="far fa-building"></i></span>
                </div>
                <input type="text" class="form-control" name="obra" id="obra" placeholder="Obra" @if(isset($filtros->obra)) value="{{$filtros->obra}}" @endif >
            </div>

            <div class="dropdown-divider"></div>
            <a href="{{url('citasdirector')}}" class="btn btn-default btn-sm">Limpiar</a>
            <button type="submit" class="btn btn-info btn-sm float-right">Aplicar</button>
            
            </form>
            
        </div>
    </div> 
    <br><br>
    @if(count($citas))
    <table class="table table-hover text-nowrap">
        <thead>
        <tr>
        <th>Obra</th>
        <th>Material</th>
        <th>Matrícula</th>
        <th>Fecha y hora</th>
        <th>Horario</th>         
        <th>Estatus</th>
        <th colspan="3">Opciones</th>
        </tr>
        </thead>
        <tbody>
        
        @foreach($citas as $cita)
            <tr>
            <td title="{{$cita->obra}}">{{strlen($cita->obra)<31 ? $cita->obra : mb_substr($cita->obra,0,30,"UTF-8").'...'}}</td>
            <td title="{{$cita->material}}">{{strlen($cita->material)<21 ? $cita->material : mb_substr($cita->material,0,20,"UTF-8").'...'}}</td>
            <td>{{$cita->matricula}}</td>
            <td>{{FechaFormateada($cita->fechacita)}}  </td>
            <td>{{date('H:i:s',strtotime($cita->fechacita))}}</td>
            <td>
            @if($cita->confirmacion==0)
            <small class="badge badge-info"><i class="fa fa-exclamation" aria-hidden="true"></i> En sitio</small>
            @elseif($cita->confirmacion==1)
            <small class="badge badge-success"><i class="fa fa-check" aria-hidden="true"></i>  Confirmado</small>
            @elseif($cita->confirmacion==2)
            <small class="badge badge-danger"><i class="fa fa-check" aria-hidden="true"></i>  Falta</small>
            @elseif($cita->confirmacion==3)
            <small class="badge badge-warning"><i class="fa fa-check" aria-hidden="true"></i>  En Transito</small>
            @endif
        </td>
            <td>
                @if($cita->confirmacion==1)
                <a href="boleta/{{$cita->id}}" target="_blank" class="btn btn-info btn-sm " title="Descargar boleta"><i class="fa fa-download" aria-hidden="true"></i> Boleta</a>
                @endif
            </td>
            <td>
                @if($cita->tipo=='Reciclaje')
                <a href="manifiestodescarga/{{$cita->id}}" target="_blank" class="btn btn-info btn-sm" title="Descargar manifiesto"><i class="fa fa-download" aria-hidden="true"></i> Manifiesto</a>
                @endif
            </td>
            
            
            </td>
        
        </tr>
        @endforeach

        </tbody>
    </table>
    @endif
    
    {{ $citas->appends($_GET)->links('pagination::bootstrap-4') }}
</body>
<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App, funcion de sidebar -->
<script src="{{asset('dist/js/adminlte.js')}}"></script>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
  @include('recepcion.header')
  <title>{{GetSiglas(0)}} | Recepciones</title>  
</head>
<body>
    <div class="row">
        
        <div class="col-12">
            @if(count($recepciones))
            <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                <th>Destino</th>
                <th>Material</th>
                <th>Cantidad</th>
                <th>Estatus</th>
                <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
            
                @foreach($recepciones as $recepcion)
                <tr>
                <td title="{{$recepcion->destino}}">{{strlen($recepcion->destino)<30 ? $recepcion->destino : mb_substr($recepcion->destino,0,29,"UTF-8").' ...'}}</td>
                <td>{{$recepcion->material}}</td>
                <td>{{$recepcion->cantidad_envio}}{{$recepcion->unidades}}</td>
                <td>{!!GetEstatusCitas($recepcion->confirmacion)!!}</td>
                <td><a href="{{url('transferencias/'.$recepcion->id)}}" class="btn btn-info"><i class="fa fa-eye"></i> Revisar</a></td>
                
            
                </tr>
                @endforeach
        
            </tbody>
            </table>
            @endif
        </div>
    </div>
    
    {{ $recepciones->appends($_GET)->links('pagination::bootstrap-4') }}




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
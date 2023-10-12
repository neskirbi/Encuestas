<!DOCTYPE html>
<html lang="en">
<head>
  @include('directores.header')
  <title>{{GetSiglas(0)}} | Saldos</title>  
</head>
<body>
    
    <br><br>
    @if(count($clientegastos))
                  
    <table class="table table-hover text-nowrap">
    <thead>
        <tr>
        <th>Cliente</th>
        <th>Pagos</th>
        <th>Reciclaje</th>
        <th>Pedidos</th>
        <th>Saldo</th>
        </tr>
    </thead>
    <tbody>
        @foreach($clientegastos as $clientegasto)
        
        <tr>
        <td title="{{$clientegasto->nombre}}">{{strlen($clientegasto->nombre)>30 ? mb_substr($clientegasto->nombre,0,30,"UTF-8") : $clientegasto->nombre}}</td>
        <td>$ {{number_format($clientegasto->pagos,2)}}</td>
        <td>$ {{number_format($clientegasto->reciclaje,2)}}</td>
        <td>$ {{number_format($clientegasto->pedidos,2)}}</td>
        <td title="{{$clientegasto->nombre}}">
        @if($clientegasto->pagos-($clientegasto->reciclaje+$clientegasto->pedidos)<0)
        <small class="badge badge-danger float-right"><i class="fa fa-dollar"></i> {{number_format($clientegasto->pagos-($clientegasto->reciclaje+$clientegasto->pedidos),2)}}</small>
        @else                        
        <small class="badge badge-info float-right"><i class="fa fa-dollar" ></i> {{number_format($clientegasto->pagos-($clientegasto->reciclaje+$clientegasto->pedidos),2)}}</small>
        @endif
        </td>
        </tr>
        @endforeach
        
    </tbody>
    </table>
    @endif
    {{ $clientegastos->appends($_GET)->links('pagination::bootstrap-4') }}
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
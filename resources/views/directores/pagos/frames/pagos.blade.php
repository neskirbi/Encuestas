<!DOCTYPE html>
<html lang="en">
<head>
  @include('directores.header')
  <title>{{GetSiglas(0)}} | Pagos</title>  
</head>
<body>
    
    <br><br>
    @if(count($pagos))
    <table class="table table-hover text-nowrap">
        <thead>
        <tr>
        <th>Cliente</th>
        <th>Monto</th>
        <th>Revis&oacute;</th>
        <th>Fecha</th>
        <th>Estatus</th>
        </thead>
        <tbody>
    
        @foreach($pagos as $pago)
        <tr>
            <td title="{{$pago->nombres.''.$pago->apellidos}}"> {{strlen($pago->nombres.''.$pago->apellidos)>30 ? mb_substr($pago->nombres.''.$pago->apellidos,0,30,"UTF-8") : $pago->nombres.''.$pago->apellidos}}</td>
            <td>$ {{number_format($pago->monto,2)}}</td>
            <td>{{$pago->administrador}}</td>
            <td>{{FechaFormateada($pago->created_at)}}</td>
            <td>
            @if($pago->status==0)
                <small style="cursor:pointer;" onclick="alert('Detalle: {{$pago->detalle}}');" title="{{$pago->detalle}}" class="badge badge-danger"><i class="fa fa-times" aria-hidden="true"></i> Cancelado</small>
            @elseif($pago->status==1)
                <small class="badge badge-warning"><i class="fa fa-check" aria-hidden="true"></i> Pendiente</small>
            @elseif($pago->status==2)
                <small class="badge badge-success"><i class="fa fa-check" aria-hidden="true"></i> Verificado</small>
            @endif
            </td>
            
                    

        </tr>
        @endforeach
        
        </tbody>
    </table>
    @endif
    {{ $pagos->appends($_GET)->links('pagination::bootstrap-4') }}
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
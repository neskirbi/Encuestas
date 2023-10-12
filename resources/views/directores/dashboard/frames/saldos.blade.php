<!DOCTYPE html>
<html lang="en">
<head>
  @include('directores.header')
  <title>{{GetSiglas(0)}} | Saldos</title>  
</head>
<body>
<div class="card-tools float-right">
                  <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Filtros <i class="fa fa-sliders" aria-hidden="true"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" style="width:300px;">
                      <form class="px-4 py-3" action="{{url('saldosdirector')}}" method="GET">
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-building"></i></span>
                          </div>
                          <input type="text" class="form-control" name="generador" id="generador" placeholder="Generador" @if(isset($filtros->generador)) value="{{$filtros->generador}}" @endif >
                        </div>

                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="correcto" {{boolval($filtros->correcto)?'checked': ''}}>
                          <label class="form-check-label"><small class="badge badge-info float-right">Correctos</small></label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="atrasado" {{boolval($filtros->atrasado)?'checked': ''}}>
                          <label class="form-check-label"><small class="badge badge-danger float-right">Retrasado</small></label>
                        </div>
                        
                      

                        <div class="dropdown-divider"></div>
                        <a href="saldosdirector" class="btn btn-default btn-sm">Limpiar</a>
                        <button type="submit" class="btn btn-info btn-sm float-right">Aplicar</button>
                        
                      </form>
                      
                    </div>
                  </div>                 
                </div>
    <br><br>
    @if(count($clientegastos))
                  
    <table class="table table-hover text-nowrap">
    <thead>
        <tr>
        <th>RazonSocial</th>
        <th>Pagos</th>
        <th>Reciclaje</th>
        <th>Pedidos</th>
        <th>Condonado</th>
        <th>Saldo</th>
        </tr>
    </thead>
    <tbody>
        @foreach($clientegastos as $clientegasto)
        
        <tr>
          <td title="{{$clientegasto->razonsocial}}"><a href="generadoresfi/{{$clientegasto->id}}">{{strlen($clientegasto->razonsocial)<30 ? $clientegasto->razonsocial : mb_substr($clientegasto->razonsocial,0,29,"UTF-8").' ...'}}</a></td>
          <td class="bg-success" title="Pagos: $ {{number_format($clientegasto->pagos==null?0:$clientegasto->pagos,2)}}">$ {{number_format($clientegasto->pagos==null?0:$clientegasto->pagos,2)}}</td>
          <td class="bg-warning" title="Entregas: $ {{number_format($clientegasto->reciclaje==null?0:$clientegasto->reciclaje,2)}}">$ {{number_format($clientegasto->reciclaje==null?0:$clientegasto->reciclaje,2)}}</td>
          <td class="bg-warning" title="Pedidos: $ {{number_format($clientegasto->pedidos==null?0:$clientegasto->pedidos,2)}}">$ {{number_format($clientegasto->pedidos==null? 0 :$clientegasto->pedidos,2)}}</td>
          <td class="bg-danger" title="Condonado: $ {{number_format($clientegasto->condonado==null?0:$clientegasto->condonado,2)}}">$ {{number_format($clientegasto->condonado==null?0:$clientegasto->condonado,2)}}</td>
          @if(($clientegasto->pagos+$clientegasto->condonado)-($clientegasto->reciclaje+$clientegasto->pedidos)<0)
          <td title="Saldo: ${{number_format(($clientegasto->pagos+$clientegasto->condonado)-($clientegasto->reciclaje+$clientegasto->pedidos),2)}}"><small class="badge badge-danger float-right"><i class="fa fa-dollar"></i> {{number_format(($clientegasto->pagos+$clientegasto->condonado)-($clientegasto->reciclaje+$clientegasto->pedidos),2)}}</small></td>
          @else                        
          <td title="Saldo: ${{number_format(($clientegasto->pagos+$clientegasto->condonado)-($clientegasto->reciclaje+$clientegasto->pedidos),2)}}"><small class="badge badge-info float-right"><i class="fa fa-dollar"></i> {{number_format(($clientegasto->pagos+$clientegasto->condonado)-($clientegasto->reciclaje+$clientegasto->pedidos),2)}}</small></td>
          @endif
          
          

        </tr>
        @endforeach
        
    </tbody>
    </table>
    @endif
    {{ $links->appends($_GET)->links('pagination::bootstrap-4') }}
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
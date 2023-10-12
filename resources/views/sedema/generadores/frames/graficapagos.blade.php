<!DOCTYPE html>
<html lang="en">
<head>
  @include('cliente.header')
  <title>{{GetSiglas(0)}} | Citas</title>  
</head>
<body>
    
<form action="{{url('GraficasPagosClienteSedema')}}/{{$con}}/{{$id}}" id="GraficasPagosClienteSedema">
    <div class="row">                              
        <div class="col-md-6">
        </div>
        <div class="col-md-4">
            
            </select>
        </div>
        <div class="col-md-2">
            <div class="input-group mb-3">
                <input name="year" id="year" class="form-control" type="number" step="1" min="2021" value="{{isset($filtros->year) ? $filtros->year : date('Y')}}" onchange="Submite();">                                    
                <div class="input-group-append">
                    <span class="input-group-text"><i class="fa fa-calendar-o" aria-hidden="true"></i></span>
                </div>
            </div>
        </div>
        
        
    </div>
    <div class="row">                                
        <div class="col-md-12">
            <div class="pagos"></div> 
        </div>
    </div>
    
    </form>
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
<!-- ChartJS -->
<script src="{{asset('plugins/chart.js/Chart.min.js')}}"></script>

<script>
      
      function Submite(){
        $('#GraficasPagosClienteSedema').submit();
    }
    GraficarDepositosGastos(HtmltoJson('{{$pagos}}'),HtmltoJson('{{$gastos}}'),HtmltoJson('{{$pedidos}}'));
</script>
</html>
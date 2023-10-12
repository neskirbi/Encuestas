<!DOCTYPE html>
<html lang="en">
<head>
  @include('cliente.header')
  <title>{{GetSiglas(0)}} | Saldos Plantas</title>  
</head>
<body>
    
<form action="{{url('GraficasSaldoCliente')}}" id="GraficasSaldoPlanta">
    <div class="row">                              
        <div class="col-md-6">
        </div>
        <div class="col-md-4">
            
            </select>
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
    $('#GraficasSaldoPlanta').submit();
  }
  GraficarSaldosPlantas(HtmltoJson('{{$pagos}}'));
</script>
</html>
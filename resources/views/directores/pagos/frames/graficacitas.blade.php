<!DOCTYPE html>
<html lang="en">
<head>
  @include('directores.header')
  <title>{{GetSiglas(0)}} | Pagos</title>  
</head>
<body>
    
<form action="{{url('GraficasCitasDirector')}}" id="GraficasCitasDirector">
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
        <div class="citas"></div>
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
        $('#GraficasCitasDirector').submit();
    }
    GraficaCitasDirector(HtmltoJson('{{$citasmes}}'),HtmltoJson('{{$citasmesconfi}}'),HtmltoJson('{{$faltasmes}}'));
</script>
</html>
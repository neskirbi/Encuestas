<!DOCTYPE html>
<html lang="en">
<head>
  @include('directores.header')
  <title>CSMX | Pagos</title>  
</head>
<body>
    
<form action="{{url('GraficasMaterialMesVendedor')}}" id="GraficaPagosVendedor">
    <div class="row">                              
        <div class="col-md-6">
        </div>
        <div class="col-md-2">
            <select name="month" id="month" class="form-control" onchange="Submite();">
                <option value="{{isset($filtros->month) ? $filtros->month : date('m')}}">{{MesEspanol(isset($filtros->month) ? $filtros->month : date('m'))}}</option>
                <optgroup></optgroup>
                <option value="1">Enero</option>
                <option value="2">Febrero</option>
                <option value="3">Marzo</option>
                <option value="4">Abril</option>
                <option value="5">Mayo</option>
                <option value="6">Junio</option>
                <option value="7">Julio</option>
                <option value="8">Agosto</option>
                <option value="9">Septiembre</option>
                <option value="10">Octubre</option>
                <option value="11">Noviembre</option>
                <option value="12">Diciembre</option>
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
        
        <div class="col-md-2">
            <a href="#" class="btn btn-info" onclick="ReporteMaterialMensual();">Descargar <i class="fa fa-download" aria-hidden="true"></i></a>
        </div>
        
        
    </div>
    <div class="row">                                
        <div class="col-md-12">
            
        <div id="citmaterialemes" width="400" height="400"></div> 
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
        $('#GraficaPagosVendedor').submit();
    }
    GraficasMaterialMes(HtmltoJson('{{$materialmes}}'));
    
    function ReporteMaterialMensual(){
        var month=$('#month').val();
        var year=$('#year').val();
        window.open('ReporteMensualvendedor/'+month+'/'+year);
    }
</script>

<script>


</script>
</html>
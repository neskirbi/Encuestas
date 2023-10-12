<!DOCTYPE html>
<html lang="en">
<head>
  @include('directores.header')
  <title>{{GetSiglas(0)}} | Pagos</title>  
</head>
<body>
    <div class="row">
        <div class="col-md-12">
        <!-- small box -->
        
        <div class="small-box bg-info">
        
            <div class="inner">
            <h3>{{number_format($total,2)}} m<sup>3</sup></h3>
            <p>Mensual</p>
            </div>
            <div class="icon">
            <i class="fas fa-recycle"></i>
            </div>
            <a href="#" class="small-box-footer"><!--Detalle <i class="fas fa-arrow-circle-right">-->&nbsp;</a>
        </div>
        </div>
        
        <!-- ./col -->
        
    </div>
<form action="{{url('GraficasMaterialMesSEDEMA')}}" id="GraficasMaterialMesSEDEMA">
    <div class="row">                              
        <div class="col-md-6">
        </div>
        <div class="col-md-2">
            
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
                <input type="hidden" name="id_planta" value="{{$id_planta}}">                                  
                <div class="input-group-append">
                    <span class="input-group-text"><i class="fa fa-calendar-o" aria-hidden="true"></i></span>
                </div>
            </div>
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
        $('#GraficasMaterialMesSEDEMA').submit();
    }
    GraficasMaterialMesSEDEMA(HtmltoJson('{{$materialmes}}'));
</script>

<script>


</script>
</html>
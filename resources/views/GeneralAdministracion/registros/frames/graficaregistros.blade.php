<!DOCTYPE html>
<html lang="en">
<head>
  @include('cliente.header')
  <title>{{GetSiglas(0)}} | Citas</title>  
</head>
<body>
    
    <form action="{{url('GraficasRegistrosObras')}}" id="GraficasRegistrosObras">
    <div class="row">
        
        <div class="col-md-4">
           
        </div>
      
        <div class="col-md-2">
            <div class="input-group ">
                <input name="year" id="year" class="form-control" type="number" step="1" min="2021" value="{{isset($filtros->year) ? $filtros->year : date('Y')}}" >                                    
                <div class="input-group-append">
                    <span class="input-group-text">Año</span>
                </div>
            </div>
        </div>

        <div class="col-md-2">
            <div class="input-group ">
                <input name="ini" id="ini" class="form-control" type="number" step="1" min="1" max="12" value="{{isset($filtros->ini) ? $filtros->ini : 1}}" >                                    
                <div class="input-group-append">
                    <span class="input-group-text">Inicio</span>
                </div>
            </div>
        </div>

        <div class="col-md-2">
            <div class="input-group ">
                <input name="fin" id="fin" class="form-control" type="number" step="1" min="1" max="12" value="{{isset($filtros->fin) ? $filtros->fin : 12}}" >                                    
                <div class="input-group-append">
                    <span class="input-group-text">Fin</span>
                </div>
            </div>
        </div>

        
        <div class="col-md-2">
            <button class="btn btn-info btn-block"> Consultar</button>
        </div>
        
        
    </div>
    </form>
    <div class="row">                                
        <div class="col-md-12">
            <div class="registros"></div> 
        </div>
    </div>

    <div class="row">                                
        <div class="col-md-12">
            <table class="table table-hover " style=" margin-left:25px; width:98%;">
                <tr class="table-info">
                    <td>Registradas: {{$datos[0]}}</td>
                </tr>
                <tr class="table-warning">
                    <td>Inician: {{$datos[1]}}</td>
                </tr>
                <tr class="table-success">
                    <td>Comenzadas: {{$datos[2]}}</td>
                </tr>
            </table>
        </div>
    </div>
    
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
        //$('#GraficasRegistrosObras').submit();
    }
    GraficasRegistrosObras(HtmltoJson('{{$registros}}'),HtmltoJson('{{$iniciar}}'),HtmltoJson('{{$iniciadas}}'));
</script>
</html>
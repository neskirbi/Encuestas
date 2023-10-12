<!DOCTYPE html>
<html lang="en">
<head>
  @include('cliente.header')
  <title>{{GetSiglas(0)}} | Reporte</title>
  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
  <div>
      <img src="{{asset('images/logo.png')}}" height="50px" style="float: left;">
      <img src="{{asset('images/logosedema.jpg')}}" height="50px" style="float: right;">
  </div>
  <br><br><br><br>
<div class="wrapper">  

  

  <div class="row">
    <div class="col-md-6">
      <div class="card card-default">
        <div class="card-header">
          <h3 class="card-title">Obra</h3>
        </div>
        <div class="card-body">
          @foreach($obras as $obra)
          <div class="row">
              <div class="col-md-12">
                  <h4><i class="far fa-building"></i> {{$obra->obra}}</h4>
              </div>
          </div>
          <div class="row">                    
              <div class="col-md-12">
                  <b>{{$obra->nautorizacion}}</b>
              </div> 
          </div>
          <div class="row">                    
              <div class="col-md-12">
                  {{$obra->superficie}} {{$obra->superunidades}}
              </div> 
          </div>
          <b>Dirección</b>
          <div class="row">                    
              <div class="col-md-12">
                  {{$obra->calle}} {{$obra->numeroext}} {{$obra->numeroint}}
              </div> 
          </div>

          <div class="row">                    
              <div class="col-md-12">
                  {{$obra->colonia}}
              </div> 
          </div>

          <div class="row">                    
              <div class="col-md-12">
                  {{$obra->municipio}}, {{$obra->entidad}}
              </div> 
          </div>
          <div class="row">                    
              <div class="col-md-12">
                  Inicio: {{FechaFormateada($obra->fechainicio)}}
              </div> 
          </div>
          <div class="row">                    
              <div class="col-md-12">
                  Fin: {{FechaFormateada($obra->fechafin)}}
              </div> 
          </div>

          <div class="row">                    
              <div class="col-md-12">
                <center><b>Felicidades evitaste {{number_format($total)}} Kg de CO<sub>2</sub> en la atmósfera</b></center>
              </div> 
          </div>
          
          <script>
            /**
             * Aqui por que agarro el id de la obra en el foreach
             */
              $(document).ready(function(){
                  AvanceEntregas('{{$obra->id}}');
              });
              
          </script>
              
          @endforeach
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card card-default">
        <div class="card-header">Avance general</h3>
        </div>
        <div class="card-body">
          <div class="avancematerial" style="height:350px;">
            
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <!-- BAR CHART -->
      <div class="card card-default">
        <div class="card-header">
          <h3 class="card-title">Avance diario</h3>
         
        </div>
        <div class="card-body">
          <div class="avance">
          </div>
        </div>
        <!-- /.card-body -->
      </div>

    </div>
    <!-- /.col (RIGHT) -->
  </div>

  <div class="row">
          <div class="col-12">
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title">Detalle Materiales</h3>     
                <div class="card-tools">
                  {{FechaFormateada(date('Y-m-d'))}}
                </div>                          
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                
                @if(count($acumulados))
                <table class="table table-hover text-nowrap" id="obras">
                  <thead>
                    <tr>
                    <th>Material</th>                    
                    <th>Volumen declarado</th>
                    <th>Entregado a sitio de reciclaje</th>
                    <th># Entregas</th>
                    </tr>
                  </thead>
                  <tbody>
                  
                    @foreach($acumulados as $acumulado)
                    <tr>
                      
                      <td>
                        {{$acumulado->material}}
                      </td>  
                      <td>
                        {{$acumulado->volumen}} {{$acumulado->unidades}}
                      </td>
                      <td>
                        {{$acumulado->cantidad}} {{$acumulado->unidades}}
                      </td>
                      <td>
                        {{$acumulado->nentregas}}
                      </td>  
                      
                    
                    </tr>
                    @endforeach
                    
                  </tbody>
                </table>
                @endif
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>


  <div class="row">
    <div class="col-12">
      <div class="card card-default">
        <div class="card-header">
          <h3 class="card-title">Desglose</h3> 
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          
          @if(count($obras))
          <table class="table table-hover text-nowrap" id="obras">
            <thead>
              <tr>
              <th>Material</th>
              <th>Volumen declarado</th>
              <th>Entregado a sitio de reciclaje y otros</th>
              <th>Fecha entrega</th>
              </tr>
            </thead>
            <tbody>
            
              @foreach($materialesobra as $materialobra)
              <tr>
                <td>
                  {{$materialobra->material}}
                </td>                    
                
                <td>
                  {{$materialobra->volumen}} {{$materialobra->unidades}}
                </td>
                <td>
                  {{$materialobra->cantidad}} {{$materialobra->unidades}}
                </td>

                <td>
                  {{FechaFormateada($materialobra->fechacita)}}
                </td>
                
              
              </tr>
              @endforeach

              
            </tbody>
          </table>
          @endif
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>


<!-- ChartJS -->
<script src="{{asset('plugins/chart.js/Chart.min.js')}}"></script>
<script>
$(document).ready(function(){
  window.setTimeout(function(){
    window.print();
  }, 1000);
  
}).delay( 1000 );

</script>




</body>
</html>

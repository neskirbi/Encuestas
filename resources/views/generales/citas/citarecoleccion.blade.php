<!DOCTYPE html>
<html lang="en">
<head>
  @include('cliente.header')
  <title>{{GetSiglas(0)}} | Citas</title>

  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
@include('toast.toasts')  
<link rel="stylesheet" href="calendario/css/styles.css">
<div class="wrapper">

  <!-- Navbar -->
  @if(Auth::guard('clientes')->check())
    @include('cliente.navigations.navigation')  
  @endif

  @if(Auth::guard('residentes')->check())
    @include('residentes.navigations.navigation')  
  @endif
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @if(Auth::guard('clientes')->check())
    @include('cliente.sidebars.sidebar') 
  @endif

  @if(Auth::guard('residentes')->check())
    @include('residentes.sidebars.sidebar') 
  @endif

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
     
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3" style="cursor:pointer;" onclick="VistasCitas('reciclaje');">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fa fa-recycle" aria-hidden="true"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Reciclaje</span>
                <span class="info-box-number">Reservar Citas</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>

          <div class="col-12 col-sm-6 col-md-1"></div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-truck"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Recolección</span>
                <span class="info-box-number">Reservar Citas</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>

          <div class="col-12 col-sm-6 col-md-1"></div>
          <div class="col-12 col-sm-6 col-md-3" style="cursor:pointer; display:none;" onclick="VistasCitas('concreto');">
            <div class="info-box">
              <span class="info-box-icon bg-default elevation-1"><i class="fas fa-bus"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Concreto</span>
                <span class="info-box-number">Reservar Citas</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
        </div>
        
        <div class="row">          
          <div class="col-md-12">
            <form method="post" action="citarecoleccion">
            @csrf
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title" id="titulo"> 
                  <i class="fa fa-truck"></i>
                   Recolección
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                        <label for="obra">Obra</label>
                        <select required type="text" name="obra" class="form-control" id="obra" aria-invalid="false">
                        <option value="">--Seleccionar obra--</option>
                        @foreach($obras as $obra)
                        <option value="{{$obra->id}}">{{$obra->obra}}</option>
                        @endforeach
                        </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="planta">Planta</label>
                      <select required type="text" name="planta" class="form-control" id="planta" aria-invalid="false" @if(count($plantas)==1) readonly @endif >
                      @if(count($plantas)>1)                        
                      <option value="">--Seleccionar planta--</option>
                      @endif
                      @foreach($plantas as $planta)
                      <option value="{{$planta->id}}">{{$planta->planta}}</option>
                      @endforeach
                      </select>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                        <label for="bmatricula">Buscar Vehículo (Placa)</label>
                        <input required autocomplete="off" onkeyup="BuscarPlaca(this);" type="text" class="form-control" id="bmatricula" placeholder="Buscar Matricula" aria-invalid="false" >
                        <div class="dropdown">
                        
                            <div class="dropdown-menu" id="menu" aria-labelledby="dropdownMenuButton">
                                
                            </div>
                        </div>
                        <input type="text" style="display:none;" name="vehiculo" class="form-control" id="vehiculo" aria-invalid="false" >
                    </div>
                  </div>
                </div>

                

                <div class="row">
                                

                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="card card-info">
                      <div class="card-header">
                          <h3 class="card-title">Pedido</h3>                                
                      </div>
                      <div class="card-body">
                        <div class="float-right">                          
                          <button type="button" class="btn bg-info btn-sm" onclick="AgregarPedido({{$agregados}});">
                              <i class="fas fa-plus"></i>
                          </button>
                        </div>
                        <br><br>

                        <div class="row">
                          <div class="col-md-3">
                            <div class="form-group">
                                <label for="categoria">Categoría</label>
                                <select class="form-control" name="agregado[]" id="agregado0" onchange="CalculaCosto(0);">
                                  <option value="">--Agregados--</option>
                                  @foreach($agregados as $agregado)
                                    <option value="{{$agregado->id}}"  data-precio="{{$agregado->precio}}">{{$agregado->agregado}}</option>
                                  @endforeach
                                </select>
                            </div>
                          </div>
                          <div class="col-md-2">
                            <div class="form-group">
                              <label for="cantidad">Cantidad</label>
                              <input required type="number" min=".01" step=".01" name="cantidad[]" class="form-control" id="cantidad0" placeholder="Catidad" aria-invalid="false" onchange="CalculaCosto(0);">
                            </div>
                          </div>

                          <div class="col-md-3">
                            <div class="form-group">
                              <label for="costo">Costo</label>
                              <input  type="number" min=".01" step=".01" name="costo" class="form-control" id="costo0" placeholder="Costo" aria-invalid="false" readonly >
                            </div>
                          </div>  
                         
                      </div>
                      <div id="pedido"></div>
                      
                        
                               
                      </div>
                    </div>
                  </div>
                </div>
                
                
          

                <div class="row">
                  <div class="col-md-7">
                    <div class="calendar">
                      <div class="calendar__info">
                        <div class="btn btn-block btn-outline-primary calendar__prev" id="prev-month"><i class="fas fa-arrow-left"></i></div>
                        <div class="calendar__month" id="month"></div>
                        <div class="calendar__year" id="year"></div>
                        <div class="btn btn-block btn-outline-primary calendar__next" id="next-month"><i class="fas fa-arrow-right"></i></div>
                      </div>

                      <div class="calendar__week">
                        <div class="calendar__day">Lunes</div>
                        <div class="calendar__day">Martes</div>
                        <div class="calendar__day">Miercoles</div>
                        <div class="calendar__day">Jueves</div>
                        <div class="calendar__day">Viernes</div>
                        <div class="calendar__day">Sabado</div>
                        <div class="calendar__day">Domingo</div>
                      </div>

                      <div class="calendar__dates" id="dates"></div>
                    </div>
                    
                  </div>
                  <div class="col-md-5">
                    <div class="form-group">
                        <label>Horarios</label>
                        <select required multiple style="height:300px;" class="form-control" name="horacita" class="form-control" id="horacita"  aria-invalid="false"></select>
                    </div>
                  </div>
                 
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <input required type="text" style="display:none;" name="fechacita" class="form-control" id="fechacita"  aria-invalid="false" >

                  </div>
                 
                </div>
                
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Guardar</button>
              </div>
              </form>                
            </div>            
          </div>
        </div>

        
        
      
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.1.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

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
<script src="dist/js/adminlte.js"></script>

<script src="calendario/js/scripts.js"></script>
@include('generales.citas.modals.modalvehiculo')
@include('footer')

</body>
</html>

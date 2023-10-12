<!DOCTYPE html>
<html lang="en">
<head>
  @include('transportistas.header')
  <title>{{GetSiglas(0)}} | Empresas</title>

  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
@include('toast.toasts')  
<div class="wrapper">

  <!-- Navbar -->
 
  @include('transportistas.navigations.navigation')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('transportistas.sidebars.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
     
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row" >
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Registro de Empresa</h3>
              </div>
              
              <form method="POST" action="{{url('empresas')}}" id="formempresas" enctype="multipart/form-data">
                @csrf
              
                  <div class="card-body">
                    <div class="form-group">
                      <label for="razonsocial">Razón social</label>
                      <input required type="text" name="razonsocial" class="form-control" id="razonsocial" placeholder="Razón Social" maxlength="250" aria-invalid="false">
                    </div>


                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="razonsocial">Ramir</label>
                          <input required type="text" name="ramir" class="form-control" id="ramir" placeholder="Ramir" maxlength="100" aria-invalid="false">
                        </div>                      
                      </div>


                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="giro">Giro</label>
                          <input required type="text" name="giro" class="form-control" id="giro" placeholder="Giro" maxlength="250" aria-invalid="false">
                        </div>
                      </div>
                    
                    
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="regsct">Registro SCT</label>
                          <input required type="text" name="regsct" class="form-control" id="regsct" placeholder="Registro SCT" maxlength="100" aria-invalid="false">
                        </div>
                      </div>

                    </div>  

          
                                            
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="calle">Calle</label>
                          <input required type="text" name="calle" class="form-control" id="calle" placeholder="Calle" maxlength="500" aria-invalid="false">
                        </div>
                      </div>
                    

                    
                      <div class="col-md-3">                                    
                        <div class="form-group">
                          <label for="numeroext">Número ext.</label>
                          <input required type="text" name="numeroext" class="form-control" id="numeroext" placeholder="Número ext." maxlength="20" aria-invalid="false">
                        </div>
                      </div>
                      
                          
                                 
                      <div class="col-md-3"> 
                        <div class="form-group">
                          <label for="numeroint">Número int.</label>
                          <input required type="text" name="numeroint" class="form-control" id="numeroint" placeholder="Número int." maxlength="20" aria-invalid="false">
                        </div>
                      </div>
                    </div>                        
                          

                    <div class="form-group">
                        <label for="colonia">Colonia</label>
                        <input required type="text" name="colonia" class="form-control" id="colonia" placeholder="Colonia" maxlength="50" aria-invalid="false">
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="entidad">Entidad federativa</label>
                          <!--<input  type="text" name="entidad" class="form-control" id="entidad" placeholder="Entidad federativa" aria-invalid="false" >-->
                          <select name="entidad" class="form-control" id="entidad">
                            <option value="">--Entidad Federativa--</option>
                            <option value="Aguascalientes">Aguascalientes</option>
                            <option value="Baja California">Baja California</option>
                            <option value="Baja California Sur">Baja California Sur</option>
                            <option value="Campeche">Campeche</option>
                            <option value="Chiapas">Chiapas</option>
                            <option value="Chihuahua">Chihuahua</option>
                            <option value="CDMX">Ciudad de México</option>
                            <option value="Coahuila">Coahuila</option>
                            <option value="Colima">Colima</option>
                            <option value="Durango">Durango</option>
                            <option value="Estado de México">Estado de México</option>
                            <option value="Guanajuato">Guanajuato</option>
                            <option value="Guerrero">Guerrero</option>
                            <option value="Hidalgo">Hidalgo</option>
                            <option value="Jalisco">Jalisco</option>
                            <option value="Michoacán">Michoacán</option>
                            <option value="Morelos">Morelos</option>
                            <option value="Nayarit">Nayarit</option>
                            <option value="Nuevo León">Nuevo León</option>
                            <option value="Oaxaca">Oaxaca</option>
                            <option value="Puebla">Puebla</option>
                            <option value="Querétaro">Querétaro</option>
                            <option value="Quintana Roo">Quintana Roo</option>
                            <option value="San Luis Potosí">San Luis Potosí</option>
                            <option value="Sinaloa">Sinaloa</option>
                            <option value="Sonora">Sonora</option>
                            <option value="Tabasco">Tabasco</option>
                            <option value="Tamaulipas">Tamaulipas</option>
                            <option value="Tlaxcala">Tlaxcala</option>
                            <option value="Veracruz">Veracruz</option>
                            <option value="Yucatán">Yucatán</option>
                            <option value="Zacatecas">Zacatecas</option>
                          </select>
                        </div>
                      </div>
                    

                    
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="municipio">Municipio/Alcaldía</label>
                          <input required type="text" name="municipio" class="form-control" id="municipio" placeholder="Municipio" maxlength="50" aria-invalid="false">
                        </div>  
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="cp">C.P.</label>
                          <input required type="text" name="cp" class="form-control" id="cp" placeholder="CP" maxlength="20"  aria-invalid="false">
                        </div>
                      </div>
                    </div>

                              
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="telefono">Teléfono</label>
                          <input required type="text" name="telefono" class="form-control" id="telefono" placeholder="Teléfono" maxlength="50" aria-invalid="false">
                        </div>
                      </div>
                      
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="mail">Correo</label>
                          <input required type="text" name="mail" class="form-control" id="mail" placeholder="Correo" maxlength="50" aria-invalid="false">
                        </div>    
                      </div>
                    </div>

                  
            
                    
                  </div>
                
                <div class="modal-footer"> 
                
                </div> 
                
                <button type="submit" class="btn  btn-outline-info float-right">Guardar</button> 
                        
              </form>
            
              
            </div>
          </div>
        </div>       
      </div>
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
<script src="{{asset('dist/js/adminlte.js')}}"></script>

<!-- ChartJS -->
<script src="{{asset('plugins/chart.js/Chart.min.js')}}"></script>

<script>
  
</script>
@include('transportistas.footer')
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
  @include('administracion.header')
  <title>CSMX | Generadores</title>

  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
@include('toast.toasts')  
<div class="wrapper">

  <!-- Navbar -->
 
  @include('administracion.navigations.navigation')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('administracion.sidebars.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
     
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
        
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Registro de Generador</h3>            
                </div>
                <!-- /.card-header -->
                <form method="POST" action="{{url('generador')}}" id="formgenerador" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="card-body">                  

                        <div class="card card-primary" id="fiscales">
                            <div class="card-header">
                                <h3 class="card-title">Datos fiscales</h3>            
                            </div>

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="razonsocial">Denominación/Razon social</label>
                                    <input  type="text" name="razonsocial" class="form-control" id="razonsocial" placeholder="Denominación/Razon social" maxlength="250" aria-invalid="false" >
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fisicaomoral">Persona</label>
                                            <select  name="fisicaomoral" class="form-control" id="fisicaomoral" aria-invalid="false" maxlength="50">
                                                <option value="">Persona</option>
                                                <optgroup>
                                                <option value="Moral">Moral</option>
                                                <option value="Física">Física</option>
                                                </optgroup>
                                                
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="rfc">RFC </label>
                                            <input  type="text" name="rfc" class="form-control" id="rfc" placeholder="RFC" maxlength="50" aria-invalid="false" >
                                            <label for="rfc">Constancia de situación fiscal actualizada</label>
                                            <div class="input-group">
                                                <div class="custom-file">                                    
                                                    <input  type="file" class="custom-file-input" id="rfcpdf" name="rfcpdf">
                                                    <label class="custom-file-label" for="rfcpdf">Cargar Constancia en pdf</label>                                    
                                                </div>                      
                                            </div>
                                        </div>
                                    </div>                       
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="domicilioempresapdf">Comprobante de domicilio fiscal</label>                                            
                                            <div class="input-group">
                                                <div class="custom-file">                                    
                                                    <input  type="file" class="custom-file-input" id="domicilioempresapdf" name="domicilioempresapdf">
                                                    <label class="custom-file-label" for="rfcpdf">Cargar comprobante en pdf</label>                                    
                                                </div>                      
                                            </div>
                                        </div>
                                    </div> 
                                </div>

                            
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="calle">Calle</label>
                                            <input  type="text" name="calle" class="form-control" id="calle" placeholder="Calle"  maxlength="500" aria-invalid="false" >
                                        </div>
                                    </div>

                                    <div class="col-md-3">                                    
                                        <div class="form-group">
                                            <label for="numeroext">Número ext.</label>
                                            <input  type="text" name="numeroext" class="form-control" id="numeroext" placeholder="Número ext."  maxlength="20" aria-invalid="false" >
                                        </div>
                            
                                    </div>
                                    <div class="col-md-3"> 
                                        <div class="form-group">
                                            <label for="numeroint">Número int.</label>
                                            <input  type="text" name="numeroint" class="form-control" id="numeroint" placeholder="Número int."  maxlength="20" aria-invalid="false" >
                                        </div>
                            
                                    </div>
                                </div>                            
                            

                                <div class="form-group">
                                    <label for="colonia">Colonia</label>
                                    <input  type="text" name="colonia" class="form-control" id="colonia" placeholder="Colonia" aria-invalid="false" maxlength="250" >
                                </div>

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="entidad">Entidad federativa</label>
                                            <!--<input  type="text" name="entidad" class="form-control" id="entidad" placeholder="Entidad federativa" aria-invalid="false" >-->
                                            <select  name="entidad" class="form-control" id="entidad">
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
                                            <input  type="text" name="municipio" class="form-control" id="municipio" placeholder="Municipio" aria-invalid="false" maxlength="150" >
                                        </div>
                                    </div>

                                
                                </div>

                            


                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="cp">CP</label>
                                            <input  type="text" name="cp" class="form-control" id="cp" placeholder="CP" aria-invalid="false" maxlength="20" >
                                        </div>
                                    </div>
                                </div>

                               
                            

                            

                            <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="telefono">Teléfono</label>
                                            <input  type="text" name="telefono" class="form-control" id="telefono" placeholder="Teléfono" aria-invalid="false" maxlength="50" >
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="estado">Celular</label>
                                            <input  type="text" name="celular" class="form-control" id="celular" placeholder="Celular" aria-invalid="false" maxlength="50" >
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="mail">Correo</label>
                                            <input  type="mail" name="mail" class="form-control" id="mail" placeholder="Correo" aria-invalid="false" maxlength="150" >
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="mail">Correo</label>
                                            <input  type="mail" name="mail2" class="form-control" id="mail2" placeholder="Correo" aria-invalid="false" maxlength="150" >
                                        </div>
                                    </div>
                                </div>
                
                            </div>
                        </div>

                        
                        <!--Datos del representante legal en caso de ser persona moral-->

                        <div class="card card-primary" style="display:none;" id="representante">
                            <div class="card-header">
                                <h3 class="card-title">Representante legal</h3>            
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nombresrepre">Nombre(s)</label>
                                            <input  type="text" name="nombresrepre" class="form-control" id="nombresrepre" placeholder="Nombre(s)" aria-invalid="false" maxlength="150" >
                                        </div>
                                        
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="apellidosrepre">Apellidos</label>
                                            <input  type="text" name="apellidosrepre" class="form-control" id="apellidosrepre" placeholder="Apellidos" aria-invalid="false" maxlength="150" >
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nacionalidadrepre">Nacionalidad</label>
                                            <input  type="text" name="nacionalidadrepre" class="form-control" id="nacionalidadrepre" placeholder="Nacionalidad" aria-invalid="false" maxlength="100" >
                                        </div>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="identificacionrepre">Identificación</label>
                                            <!--<input  type="text" name="identificacionrepre" class="form-control" id="identificacionrepre" placeholder="Identificación" aria-invalid="false" >-->
                                            <select class="form-control" name="identificacionrepre" id="identificacionrepre"  aria-invalid="false">
                                                <option value="">--Identificación--</option>
                                                <optgroup>
                                                <option value="INE">INE</option>
                                                <option value="Pasaporte">Pasaporte</option>
                                                <option value="Cédula Profesional">Cédula Profesional</option>
                                                </optgroup>
                                            </select>
                                            <div class="input-group">
                                                <div class="custom-file">                                    
                                                    <input  type="file" class="custom-file-input" id="identificacionreprepdf" name="identificacionreprepdf">
                                                    <label class="custom-file-label" for="identificacionreprepdf">Cargar identificación en pdf</label>                                    
                                                </div>                      
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="rfcrepre">RFC</label>
                                            <input  type="text" name="rfcrepre" class="form-control" id="rfcrepre" placeholder="RFC" aria-invalid="false" >
                                            <div class="input-group">
                                                <div class="custom-file">                                    
                                                    <input  type="file" class="custom-file-input" id="rfcreprepdf" name="rfcreprepdf">
                                                    <label class="custom-file-label" for="rfcreprepdf">Cargar RFC en pdf</label>                                    
                                                </div>                      
                                            </div>
                                        </div>
                                    </div>

                                    
                                </div>
                            </div>
                        </div>


                        


                        <!--Datos de la empresa en cas ode ser persona moral-->

                        <div class="card card-primary" style="display:none;"  id="empresa">
                            <div class="card-header">
                                <h3 class="card-title">Empresa</h3>            
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fechaconst">Fecha Constitución</label>
                                            <input  type="date" name="fechaconst" class="form-control" id="fechaconst" aria-invalid="false" maxlength="50" >
                                        </div>
                                        
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="numeroactacont">Número de acta constitutiva</label>
                                            <input  type="text" name="numeroactacont" class="form-control" id="numeroactacont" placeholder="Número de acta constitutiva" aria-invalid="false" maxlength="100" >
                                            <div class="input-group">
                                                <div class="custom-file">                                    
                                                    <input  type="file" class="custom-file-input" id="numeroactacontpdf" name="numeroactacontpdf">
                                                    <label class="custom-file-label" for="numeroactacontpdf">Cargar acta en pdf</label>                                    
                                                </div>                      
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>    
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="numeroactacont">Poder Notarial<br>("Si el poder notarial esta en el acta constitutiva por favor vuelve a cargar")</label>
                                            <div class="input-group">
                                                <div class="custom-file">                                    
                                                    <input  type="file" class="custom-file-input" id="podernotarial" name="podernotarial">
                                                    <label class="custom-file-label" for="podernotarial">Cargar poder notarial pdf</label>                                    
                                                </div>                      
                                            </div>
                                        </div>
                                    </div>
                                </div>                            

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="notario">Nombre del notario o corredor público</label>
                                            <input  type="text" name="notario" class="form-control" id="notario" placeholder="Nombre del notario o corredor público" aria-invalid="false" maxlength="250" >
                                        </div>
                                    </div>
                                
                                    <!--<div class="col-md-6">
                                        <div class="form-group">
                                            <label for="numeronotario">Número de notario o corredor</label>
                                            <input  type="text" name="numeronotario" class="form-control" id="numeronotario" placeholder="Número de notario o corredor" aria-invalid="false" >
                                        </div>
                                    </div>-->

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="numeronotaria">Número de notaría o correduría</label>
                                            <input  type="text" name="numeronotaria" class="form-control" id="numeronotaria" placeholder="Número de notaría o correduría" aria-invalid="false" maxlength="150" >
                                        </div>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="entidadnotaria">Entidad Federativa</label>
                                            <!--<input  type="text" name="entidad" class="form-control" id="entidad" placeholder="Entidad federativa" aria-invalid="false" >-->
                                            <select  name="entidadnotaria" class="form-control" id="entidadnotaria" aria-invalid="false" >
                                                <option value="">--Entidad Federativa--</option>
                                                @foreach($entidades as $entidad)
                                                <option value="{{$entidad->entidad}}">{{$entidad->entidad}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                            

                        <!--En caso de ser persona fisica-->
                        <div class="card card-primary"  style="display:none;"  id="fisica">
                            <div class="card-header">
                                <h3 class="card-title">Datos Personales</h3>            
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nombresfisica">Nombre(s)</label>
                                            <input  type="text" name="nombresfisica" class="form-control" id="nombresfisica" placeholder="Nombre(s)" aria-invalid="false" maxlength="150" >
                                        </div>
                                        
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="apellidosfisica">Apellidos</label>
                                            <input  type="text" name="apellidosfisica" class="form-control" id="apellidosfisica" placeholder="Apellidos" aria-invalid="false" maxlength="150" >
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nacionalidadfisica">Nacionalidad</label>
                                            <input  type="text" name="nacionalidadfisica" class="form-control" id="nacionalidadfisica" placeholder="Nacionalidad" aria-invalid="false" maxlength="100" >
                                        </div>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="identificacionfisica">Identificación</label>
                                            <!--<input  type="text" name="identificacionfisica" class="form-control" id="identificacionfisica" placeholder="Identificación" aria-invalid="false" >-->
                                            <select class="form-control" name="identificacionfisica" id="identificacionfisica"  aria-invalid="false">
                                                <option value="">--Identificación--</option>
                                                <optgroup>
                                                <option value="INE">INE</option>
                                                <option value="Pasaporte">Pasaporte</option>
                                                <option value="Cédula Profesional">Cédula Profesional</option>
                                                </optgroup>
                                            </select>
                                            <div class="input-group">
                                                <div class="custom-file">                                    
                                                    <input  type="file" class="custom-file-input" id="identificacionfisicapdf" name="identificacionfisicapdf">
                                                    <label class="custom-file-label" for="identificacionfisicapdf">Cargar identificación en pdf</label>                                    
                                                </div>                      
                                            </div>
                                        </div>
                                    </div>


                                    
                                </div>       
                            </div>
                        </div>

                        <!--Para registrar como cliente tambien-->
                        <div class="card card-primary"  style="display:none;"  id="cliente">
                            <div class="card-header">
                                <h3 class="card-title">Datos para la cuenta del Cliente</h3>            
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nombres">Nombre(s)</label>
                                            <input  type="text" name="nombres" class="form-control" id="nombres" placeholder="Nombre(s)" aria-invalid="false" maxlength="150" >
                                        </div>
                                        
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="apellidos">Apellidos</label>
                                            <input  type="text" name="apellidos" class="form-control" id="apellidos" placeholder="Apellidos" aria-invalid="false" maxlength="150" >
                                        </div>
                                    </div>
                                    
                                </div>

                             

                                <div class="row">

                                <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="correo">Correo</label>
                                            <input  type="mail" name="correo" class="form-control" id="correo" placeholder="Correo" aria-invalid="false" maxlength="150" >
                                        </div>
                                    </div>


                                    
                                </div>       
                            </div>
                        </div>


                    </div><!--End body-->
                    <div class="modal-footer" >
                        
                    </div>
                </form>
                <div>
                    <button onclick="RecorreFormularioAtras2();" class="btn  btn-outline-info float-left" style="display:none;" id="anterior"><i class="fa fa-chevron-left" ></i> Anterior</button>
                    <button onclick="RecorreFormularioAdelante2();" class="btn  btn-outline-info float-right" id="siguiente">Siguiente <i class="fa fa-chevron-right" ></i></button>
                    <button type="submit" style="display:none;" id="guardar" class="btn  btn-outline-info float-right" onclick="GuardarGenerador();">Guardar</button>
                </div>
            </div>
            
          
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
<script src="{{asset('dist/js/adminlte.js')}}"></script>
<!-- Summernote -->
<script src="{{asset('plugins/summernote/summernote-bs4.min.js');}}"></script>
<script>
$(function () {
  bsCustomFileInput.init();
});
</script>
</body>
</html>

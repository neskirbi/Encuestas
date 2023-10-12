<!DOCTYPE html>
<html lang="en">
<head>
  @include('cliente.header')
  <title>CSMX | Generadores</title>

  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
@include('toast.toasts')  
<div class="wrapper">

  <!-- Navbar -->
 
  @include('cliente.navigations.navigation')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('cliente.sidebars.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
     
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
        
            @if($generador->verificado==0)
            <div class="card card-default">
            @else
            <div class="card card-success">
            @endif
                <div class="card-header">
                    <h3 class="card-title">Generador</h3>      
                </div>
                <!-- /.card-header -->
                
                    
                    <div class="card-body">                  

                        <div class="card card-primary" id="fiscales">
                            <div class="card-header">
                                <h3 class="card-title">Datos fiscales</h3>            
                            </div>

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="razonsocial">Denominación/Razon social</label>
                                    <input  type="text" name="razonsocial" class="form-control" id="razonsocial" placeholder="Denominación/Razon social" aria-invalid="false" maxlength="250" value="{{$generador->razonsocial}}" readonly>
                                </div>

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="rfc">Persona</label>
                                            <input  type="text" class="form-control"  aria-invalid="false" maxlength="50" value="{{$generador->fisicaomoral}}" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="rfc">RFC</label>
                                            <input  type="text" name="rfc" class="form-control" id="rfc" placeholder="RFC" aria-invalid="false" maxlength="50" value="{{$generador->rfc}}" readonly>
                                            <iframe id="inlineFrameExample"
                                                title="identificación"
                                                width="100%"
                                                height="200"
                                                src="{{asset('documentos/generadores/rfc/empresa').'/'.$generador->rfcpdf}}">
                                            </iframe>                      
                                            <a target="_blank" class="btn btn-default" href="{{asset('documentos/generadores/rfc/empresa').'/'.$generador->rfcpdf}}">Ver</a>
                                        </div>
                                    </div>                       
                                </div>

                            
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="calle">Calle</label>
                                            <input  type="text" name="calle" class="form-control" id="calle" placeholder="Calle" aria-invalid="false" maxlength="500" value="{{$generador->calle}}" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-3">                                    
                                        <div class="form-group">
                                            <label for="numeroext">Número ext.</label>
                                            <input  type="text" name="numeroext" class="form-control" id="numeroext" placeholder="Número ext." aria-invalid="false" maxlength="20" value="{{$generador->numeroext}}" readonly>
                                        </div>
                            
                                    </div>
                                    <div class="col-md-3"> 
                                        <div class="form-group">
                                            <label for="numeroint">Número int.</label>
                                            <input  type="text" name="numeroint" class="form-control" id="numeroint" placeholder="Número ext." aria-invalid="false" maxlength="20" value="{{$generador->numeroint}}" readonly>
                                        </div>
                            
                                    </div>
                                </div>
                            
                            

                            <div class="form-group">
                                <label for="colonia">Colonia</label>
                                <input  type="text" name="colonia" class="form-control" id="colonia" placeholder="Colonia" aria-invalid="false" maxlength="250" value="{{$generador->colonia}}" readonly>
                            </div>

                            <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="entidad">Entidad federativa</label>
                                            <input  type="text" class="form-control"  aria-invalid="false" maxlength="100" value="{{$generador->entidad}}" readonly>
                                            
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="municipio">Municipio</label>
                                            <input  type="text" name="municipio" class="form-control" id="municipio" placeholder="Municipio" aria-invalid="false" maxlength="150" value="{{$generador->municipio}}" readonly>
                                        </div>
                                    </div>

                                
                                </div>

                            


                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="cp">CP</label>
                                            <input  type="text" name="cp" class="form-control" id="cp" placeholder="CP" aria-invalid="false" maxlength="20" value="{{$generador->cp}}" readonly>
                                        </div>
                                    </div>
                                </div>
                            

                            

                            <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="telefono">Teléfono</label>
                                            <input  type="text" name="telefono" class="form-control" id="telefono" placeholder="Teléfono" aria-invalid="false" maxlength="50" value="{{$generador->telefono}}" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="estado">Celular</label>
                                            <input  type="text" name="celular" class="form-control" id="celular" placeholder="Celular" aria-invalid="false" maxlength="50" value="{{$generador->celular}}" readonly>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="mail">Correo</label>
                                            <input  type="text" name="mail" class="form-control" id="mail" placeholder="Correo" aria-invalid="false" maxlength="150" value="{{$generador->mail}}" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="mail">Correo</label>
                                            <input  type="text" name="mail2" class="form-control" id="mail2" placeholder="Correo" aria-invalid="false" maxlength="150" value="{{$generador->mail2}}" readonly>
                                        </div>
                                    </div>
                                </div>
                
                            </div>
                        </div>

                        @if($generador->fisicaomoral=='Moral')
                        <!--Datos del representante legal en caso de ser persona moral-->

                        <div class="card card-primary"  id="representante">
                            <div class="card-header">
                                <h3 class="card-title">Representante legal</h3>            
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nombresrepre">Nombre(s)</label>
                                            <input  type="text" name="nombresrepre" class="form-control" id="nombresrepre" placeholder="Nombre(s)" aria-invalid="false" maxlength="150" value="{{$generador->nombresrepre}}" readonly>
                                        </div>
                                        
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="apellidosrepre">Apellidos</label>
                                            <input  type="text" name="apellidosrepre" class="form-control" id="apellidosrepre" placeholder="Apellidos" aria-invalid="false" maxlength="150" value="{{$generador->apellidosrepre}}" readonly>
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nacionalidadrepre">Nacionalidad</label>
                                            <input  type="text" name="nacionalidadrepre" class="form-control" id="nacionalidadrepre" placeholder="Nacionalidad" aria-invalid="false" maxlength="100" value="{{$generador->nacionalidadrepre}}" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="identificacionrepre">Identificación</label>
                                            <input  type="text" class="form-control"  aria-invalid="false" value="{{$generador->identificacionrepre}}" readonly>                                            
                                            <iframe id="inlineFrameExample"
                                                title="identificación"
                                                width="100%"
                                                height="200"
                                                src="{{asset('documentos/generadores/identificaciones/representante').'/'.$generador->identificacionreprepdf}}">
                                            </iframe>                      
                                            <a target="_blank" class="btn btn-default" href="{{asset('documentos/generadores/identificaciones/representante').'/'.$generador->identificacionreprepdf}}">Ver</a>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="rfcrepre">RFC</label>
                                            <input  type="text" name="rfcrepre" class="form-control" id="rfcrepre" placeholder="RFC" aria-invalid="false" maxlength="50" value="{{$generador->rfcrepre}}" readonly>
                                            <iframe id="inlineFrameExample"
                                                title="identificación"
                                                width="100%"
                                                height="200"
                                                src="{{asset('documentos/generadores/rfc/representante').'/'.$generador->rfcreprepdf}}">
                                            </iframe>                      
                                            <a target="_blank" class="btn btn-default" href="{{asset('documentos/generadores/rfc/representante').'/'.$generador->rfcreprepdf}}">Ver</a>
                                        </div>
                                    </div>

                                    
                                </div>
                            </div>
                        </div>


                        


                        <!--Datos de la empresa en caso de ser persona moral-->

                        <div class="card card-primary"   id="empresa">
                            <div class="card-header">
                                <h3 class="card-title">Empresa</h3>            
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fechaconst">Fecha Constitución</label>
                                            <input  type="date" name="fechaconst" class="form-control" id="fechaconst" aria-invalid="false" maxlength="50" value="{{$generador->fechaconst}}" readonly>
                                        </div>
                                        
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="numeroactacont">Número de acta constitutiva</label>
                                            <input  type="text" name="numeroactacont" class="form-control" id="numeroactacont" placeholder="Número de acta constitutiva" aria-invalid="false" maxlength="100" value="{{$generador->numeroactacont}}" readonly>
                                            <iframe id="inlineFrameExample"
                                                title="identificación"
                                                width="100%"
                                                height="200"
                                                src="{{asset('documentos/generadores/actas/empresa').'/'.$generador->numeroactacontpdf}}">
                                            </iframe>                      
                                            <a target="_blank" class="btn btn-default" href="{{asset('documentos/generadores/actas/empresa').'/'.$generador->numeroactacontpdf}}">Ver</a>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="podernotarial">Poder Notarial</label> 
                                            <iframe id="inlineFrameExample"
                                                title="identificación"
                                                width="100%"
                                                height="200"
                                                src="{{asset('documentos/generadores/actas/poder').'/'.$generador->id.'.pdf'}}">
                                            </iframe>                      
                                            <a target="_blank" class="btn btn-default" href="{{asset('documentos/generadores/actas/poder').'/'.$generador->id.'.pdf'}}">Ver</a>
                                        </div>
                                    </div> 
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="domicilioempresapdf">Comprobante de domicilio fiscal</label>                                            
                                            <iframe id="inlineFrameExample"
                                                title="identificación"
                                                width="100%"
                                                height="200"
                                                src="{{asset('documentos/generadores/comprobantedomicilio/empresa').'/'.$generador->numeroactacontpdf}}">
                                            </iframe>                      
                                            <a target="_blank" class="btn btn-default" href="{{asset('documentos/generadores/comprobantedomicilio/empresa').'/'.$generador->numeroactacontpdf}}">Ver</a>
                                        </div>
                                    </div> 
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="notario">Nombre del notario o corredor público</label>
                                            <input  type="text" name="notario" class="form-control" id="notario" placeholder="Nombre del notario o corredor público" aria-invalid="false" maxlength="250" value="{{$generador->notario}}" readonly>
                                        </div>
                                    </div>
                               
                                    <!--<div class="col-md-6">
                                        <div class="form-group">
                                            <label for="numeronotario">Número de notario o corredor</label>
                                            <input  type="text" name="numeronotario" class="form-control" id="numeronotario" placeholder="Número de notario o corredor" aria-invalid="false" value="{{$generador->numeronotario}}" readonly>
                                        </div>
                                    </div>-->

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="numeronotaria">Número de notaría o correduría</label>
                                            <input  type="text" name="numeronotaria" class="form-control" id="numeronotaria" placeholder="Número de notaría o correduría" aria-invalid="false" maxlength="150" value="{{$generador->numeronotaria}}" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="entidadnotaria">Entidad de la notaría</label>
                                            <input  type="text" name="entidadnotaria" class="form-control" id="entidadnotaria" placeholder="Entidad de la notaría" aria-invalid="false" maxlength="100" value="{{$generador->entidadnotaria}}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif


                            

                        @if($generador->fisicaomoral=='Física')
                        <!--En caso de ser persona fisica-->
                        <div class="card card-primary"    id="fisica">
                            <div class="card-header">
                                <h3 class="card-title">Personales</h3>            
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nombresfisica">Nombre(s)</label>
                                            <input  type="text" name="nombresfisica" class="form-control" id="nombresfisica" placeholder="Nombre(s)" aria-invalid="false" maxlength="150" value="{{$generador->nombresfisica}}" readonly>
                                        </div>
                                        
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="apellidosfisica">Apellidos</label>
                                            <input  type="text" name="apellidosfisica" class="form-control" id="apellidosfisica" placeholder="Apellidos" aria-invalid="false" maxlength="150" value="{{$generador->apellidosfisica}}" readonly>
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nacionalidadfisica">Nacionalidad</label>
                                            <input  type="text" name="nacionalidadfisica" class="form-control" id="nacionalidadfisica" placeholder="Nacionalidad" aria-invalid="false" maxlength="100" value="{{$generador->nacionalidadfisica}}" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="identificacionfisica">Identificación</label>
                                            <input  type="text" class="form-control"  aria-invalid="false" value="{{$generador->identificacionfisica}}" readonly>                                                                                        
                                            <iframe id="inlineFrameExample"
                                                title="identificación"
                                                width="100%"
                                                height="200"
                                                src="{{asset('documentos/generadores/identificaciones/personafisica').'/'.$generador->identificacionfisicapdf}}">
                                            </iframe>
                                            <a target="_blank" class="btn btn-default" href="{{asset('documentos/generadores/identificaciones/personafisica').'/'.$generador->identificacionfisicapdf}}">Ver</a>
                                        </div>
                                    </div>


                                    
                                </div>       
                            </div>
                        </div>
                        @endif


                    </div><!--End body-->
              
                
            </div>
            
          
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a target="_blank" href="https://adminlte.io">AdminLTE.io</a>.</strong>
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
</script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
  @include('finanzas.header')
  <title>{{GetSiglas(0)}}| Generadores</title>

  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
@include('toast.toasts')  
<div class="wrapper">

  <!-- Navbar -->
 
  @include('finanzas.navigations.navigation')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('finanzas.sidebars.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
     
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
        
          
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

                        
            <div class="card card-primary" id="fiscales">
                <div class="card-header">
                    <h3 class="card-title">Obras</h3>            
                </div>

                <div class="card-body">
                @if(count($obras))
                    <table class="table table-hover text-nowrap">
                      <thead>
                        <tr>
                        <th>Obra</th>
                        <th>Residuos Declarados</th>
                        <th>Residuos Entregados</th>
                        <th>Residuos Pendientes</th>
                        <th>Contrato</th>
                        </tr>
                      </thead>
                      <tbody>
                    
                        @foreach($obras as $obra)
                        <tr>
                          <td title="{{$obra->obra}}"><a href="{{url('obrasfi')}}/{{$obra->id}}">{{strlen($obra->obra)<30 ? $obra->obra : mb_substr($obra->obra,0,29,"UTF-8").' ...'}}</a></td>
                          <td title="Declarados:{{number_format($obra->cantidadobra,2)}} {{$obra->superunidades}}">{{number_format($obra->cantidadobra,2)}} {{$obra->superunidades}}</td>
                          <td title="Entregados:{{number_format($obra->entregado,2)}} {{$obra->superunidades}}">{{number_format($obra->entregado,2)}} {{$obra->superunidades}}</td>                          
                          <td title="Pendientes:{{number_format($obra->cantidadobra-$obra->entregado,2)}} {{$obra->superunidades}}">{{number_format($obra->cantidadobra-$obra->entregado,2)}} {{$obra->superunidades}}</td>
                          <td>
                            @if($obra->transporte == 1)
                                ${{$obra->capacidad<= 0 ? 0 : number_format($obra->preciomat+ceil( $obra->cantidadobra/$obra->capacidad)*($obra->preciotrans),2)}}
                                @else
                                ${{number_format($obra->preciomat,2)}}
                            @endif
                        </td>
                          
                        </tr>
                        @endforeach
                        
                      </tbody>
                    </table>
                    @endif
                </div>
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

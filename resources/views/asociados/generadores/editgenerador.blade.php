<!DOCTYPE html>
<html lang="en">
<head>
  @include('cliente.header')
  <title>{{GetSiglas(0)}} | Generadores</title>

  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
@include('toast.toasts')  
<div class="wrapper">

  <!-- Navbar -->
 
  @include('asociados.navigations.navigation')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('asociados.sidebars.sidebar')

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
                    @if($generador->verificado==0)
                    <div class="card-tools">
                        <form action="{{url('confirmargenerador').'/'.$generador->id}}" method="GET">
                        @csrf
                        <button style="display:visible;" type="submite" class="confirmarclick btn btn-success btn-sm" data-texto="¿Los datos son correctos?"><i class="fa fa-check" aria-hidden="true"><span>Confirmar</span></i></button>
                        </form>
                    </div>
                    @endif            
                </div>
                <!-- /.card-header -->
                <form method="POST" action="{{url('generadorasoc')}}/{{$generador->id}}" id="formgenerador" enctype="multipart/form-data">
                    @csrf
                    <input required name="_method" type="hidden" value="PUT">                    
                    <div class="card-body">                  

                        <div class="card card-primary" id="fiscales">
                            <div class="card-header">
                                <h3 class="card-title">Datos fiscales</h3>            
                            </div>

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="razonsocial">Denominación/Razon social</label>
                                    <input required type="text" value="{{$generador->razonsocial}}" name="razonsocial" class="form-control" id="razonsocial" placeholder="Denominación/Razon social" aria-invalid="false" >
                                </div>

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fisicaomoral">Persona</label>
                                            <select required name="fisicaomoral" class="form-control" id="fisicaomoral" aria-invalid="false" disabled>
                                                <option value="{{$generador->fisicaomoral}}">{{$generador->fisicaomoral}}</option>
                                                <optgroup>
                                                <option value="Moral">Moral</option>
                                                <option value="Física">Física</option>
                                                </optgroup>
                                                
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="rfc">RFC</label>
                                            <input required  type="text" value="{{$generador->rfc}}" name="rfc" class="form-control" id="rfc" placeholder="RFC" aria-invalid="false" >
                                            <label for="rfc">Constancia de situación fiscal actualizada</label>
                                            <div class="input-group">
                                                <div class="custom-file">                                    
                                                    <input type="file" class="custom-file-input" id="rfcpdf" value="{{$generador->rfcpdf}}" name="rfcpdf">
                                                    <label class="custom-file-label" for="rfcpdf">Cambiar Constancia en pdf</label>                                    
                                                </div>
                                            </div>
                                            <font color="red">No cambia hasta guardar.</font>
                                            <iframe id="inlineFrameExample"
                                                title="identificación"
                                                width="100%"
                                                height="200"
                                                src="{{asset('documentos/generadores/rfc/empresa').'/'.$generador->rfcpdf.'?ver='.rand(0,10000)}}">
                                            </iframe>                      
                                            <a target="_blank" class="btn btn-default" href="{{asset('documentos/generadores/rfc/empresa').'/'.$generador->rfcpdf}}">Ver</a>
                                        </div>
                                    </div>                       
                                </div>

                            
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="calle">Calle</label>
                                            <input required  type="text" value="{{$generador->calle}}" name="calle" class="form-control" id="calle" placeholder="Calle" aria-invalid="false" >
                                        </div>
                                    </div>

                                    <div class="col-md-3">                                    
                                        <div class="form-group">
                                            <label for="numeroext">Número ext.</label>
                                            <input required  type="text" value="{{$generador->numeroext}}" name="numeroext" class="form-control" id="numeroext" placeholder="Número ext." aria-invalid="false" >
                                        </div>
                            
                                    </div>
                                    <div class="col-md-3"> 
                                        <div class="form-group">
                                            <label for="numeroint">Número int.</label>
                                            <input required  type="text" value="{{$generador->numeroint}}" name="numeroint" class="form-control" id="numeroint" placeholder="Número ext." aria-invalid="false" >
                                        </div>
                            
                                    </div>
                                </div>                            
                            

                                <div class="form-group">
                                    <label for="colonia">Colonia</label>
                                    <input required  type="text" value="{{$generador->colonia}}" name="colonia" class="form-control" id="colonia" placeholder="Colonia" aria-invalid="false" >
                                </div>

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="entidad">Entidad federativa</label>
                                            <select required name="entidad" class="form-control" id="entidad">
                                                <option value="{{$generador->entidad}}">{{$generador->entidad}}</option>
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
                                            <input required  type="text" value="{{$generador->municipio}}" name="municipio" class="form-control" id="municipio" placeholder="Municipio" aria-invalid="false" >
                                        </div>
                                    </div>

                                
                                </div>

                            


                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="cp">CP</label>
                                            <input required  type="text" value="{{$generador->cp}}" name="cp" class="form-control" id="cp" placeholder="CP" aria-invalid="false" >
                                        </div>
                                    </div>
                                </div>
                            

                            

                            <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="telefono">Teléfono</label>
                                            <input required  type="text" value="{{$generador->telefono}}" name="telefono" class="form-control" id="telefono" placeholder="Teléfono" aria-invalid="false" >
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="estado">Celular</label>
                                            <input required  type="text" value="{{$generador->celular}}" name="celular" class="form-control" id="celular" placeholder="Celular" aria-invalid="false" >
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="mail">Correo</label>
                                            <input required  type="text" value="{{$generador->mail}}" name="mail" class="form-control" id="mail" placeholder="Correo" aria-invalid="false" >
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="mail">Correo</label>
                                            <input required  type="text" value="{{$generador->mail2}}" name="mail2" class="form-control" id="mail2" placeholder="Correo" aria-invalid="false" >
                                        </div>
                                    </div>
                                </div>
                
                            </div>
                        </div>

                        @if($generador->fisicaomoral=='Moral')
                        <!--Datos del representante legal en caso de ser persona moral-->

                        <div class="card card-primary" id="representante">
                            <div class="card-header">
                                <h3 class="card-title">Representante legal</h3>            
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nombresrepre">Nombre(s)</label>
                                            <input required  type="text" value="{{$generador->nombresrepre}}" name="nombresrepre" class="form-control" id="nombresrepre" placeholder="Nombre(s)" aria-invalid="false" >
                                        </div>
                                        
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="apellidosrepre">Apellidos</label>
                                            <input required  type="text" value="{{$generador->apellidosrepre}}" name="apellidosrepre" class="form-control" id="apellidosrepre" placeholder="Apellidos" aria-invalid="false" >
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nacionalidadrepre">Nacionalidad</label>
                                            <input required  type="text" value="{{$generador->nacionalidadrepre}}" name="nacionalidadrepre" class="form-control" id="nacionalidadrepre" placeholder="Nacionalidad" aria-invalid="false" >
                                        </div>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="identificacionrepre">Identificación</label>
                                            <select required class="form-control" name="identificacionrepre" id="identificacionrepre"  aria-invalid="false">
                                                <option value="{{$generador->identificacionrepre}}">{{$generador->identificacionrepre}}</option>
                                                <optgroup>
                                                <option value="INE">INE</option>
                                                <option value="Pasaporte">Pasaporte</option>
                                                <option value="Cédula Profesional">Cédula Profesional</option>
                                                </optgroup>
                                            </select>
                                            <div class="input-group">
                                                <div class="custom-file">                                    
                                                    <input type="file" class="custom-file-input" id="identificacionreprepdf" value="{{$generador->identificacionreprepdf}}" name="identificacionreprepdf">
                                                    <label class="custom-file-label" for="identificacionreprepdf">Cambiar identificación en pdf</label>                                    
                                                </div>
                                            </div>
                                            <font color="red">No cambia hasta guardar.</font>
                                            <iframe id="inlineFrameExample"
                                                title="identificación"
                                                width="100%"
                                                height="200"
                                                src="{{asset('documentos/generadores/identificaciones/representante').'/'.$generador->identificacionreprepdf.'?ver='.rand(0,10000)}}">
                                            </iframe>                      
                                            <a target="_blank" class="btn btn-default" href="{{asset('documentos/generadores/identificaciones/representante').'/'.$generador->identificacionreprepdf}}">Ver</a>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="rfcrepre">RFC</label>
                                            <input required  type="text" value="{{$generador->rfcrepre}}" name="rfcrepre" class="form-control" id="rfcrepre" placeholder="RFC" aria-invalid="false" >
                                            <div class="input-group">
                                                <div class="custom-file">                                    
                                                    <input type="file" class="custom-file-input" id="rfcreprepdf" value="{{$generador->rfcreprepdf}}" name="rfcreprepdf">
                                                    <label class="custom-file-label" for="rfcreprepdf">Cambiar RFC en pdf</label>                                    
                                                </div>
                                            </div>
                                            <font color="red">No cambia hasta guardar.</font>
                                            <iframe id="inlineFrameExample"
                                                title="identificación"
                                                width="100%"
                                                height="200"
                                                src="{{asset('documentos/generadores/rfc/representante').'/'.$generador->rfcreprepdf.'?ver='.rand(0,10000)}}">
                                            </iframe>                      
                                            <a target="_blank" class="btn btn-default" href="{{asset('documentos/generadores/rfc/representante').'/'.$generador->rfcreprepdf}}">Ver</a>
                                        </div>
                                    </div>

                                    
                                </div>
                            </div>
                        </div>
                        <!--Datos de la empresa en caso de ser persona moral-->

                        <div class="card card-primary"  id="empresa">
                            <div class="card-header">
                                <h3 class="card-title">Empresa</h3>            
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fechaconst">Fecha Constitución</label>
                                            <input required  type="date" value="{{$generador->fechaconst}}" name="fechaconst" class="form-control" id="fechaconst" aria-invalid="false" >
                                        </div>
                                        
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="numeroactacont">Número de acta constitutiva</label>
                                            <input required  type="text" value="{{$generador->numeroactacont}}" name="numeroactacont" class="form-control" id="numeroactacont" placeholder="Número de acta constitutiva" aria-invalid="false" >
                                            <div class="input-group">
                                                <div class="custom-file">                                    
                                                    <input type="file" class="custom-file-input" id="numeroactacontpdf" value="{{$generador->numeroactacontpdf}}" name="numeroactacontpdf">
                                                    <label class="custom-file-label" for="numeroactacontpdf">Cambiar acta en pdf</label>                                    
                                                </div>
                                            </div>
                                            <font color="red">No cambia hasta guardar.</font>
                                            <iframe id="inlineFrameExample"
                                                title="identificación"
                                                width="100%"
                                                height="200"
                                                src="{{asset('documentos/generadores/actas/empresa').'/'.$generador->numeroactacontpdf.'?ver='.rand(0,10000)}}">
                                            </iframe>                      
                                            <a target="_blank" class="btn btn-default" href="{{asset('documentos/generadores/actas/empresa').'/'.$generador->numeroactacontpdf}}">Ver</a>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="podernotarial">Poder Notarial</label>                                            
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="podernotarial" value="" name="podernotarial">
                                                    <label class="custom-file-label" for="podernotarial">Cambiar comprobante en pdf</label>                                    
                                                </div>
                                            </div>
                                                <font color="red">No cambia hasta guardar.</font>
                                                <iframe id="inlineFrameExample"
                                                    title="identificación"
                                                    width="100%"
                                                    height="200"
                                                    src="{{asset('documentos/generadores/actas/poder').'/'.$generador->id.'.pdf'.'?ver='.rand(0,10000)}}">
                                                </iframe>                      
                                                <a target="_blank" class="btn btn-default" href="{{asset('documentos/generadores/actas/poder').'/'.$generador->id.'.pdf'}}">Ver</a>
                                        </div>
                                    </div> 

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="domicilioempresapdf">Comprobante de domicilio fiscal</label>                                            
                                            <div class="input-group">
                                                <div class="custom-file">                                    
                                                    <input type="file" class="custom-file-input" id="domicilioempresapdf" value="{{$generador->domicilioempresapdf}}" name="domicilioempresapdf">
                                                    <label class="custom-file-label" for="rfcpdf">Cambiar comprobante en pdf</label>                                    
                                                </div>
                                            </div>
                                                <font color="red">No cambia hasta guardar.</font>
                                                <iframe id="inlineFrameExample"
                                                    title="identificación"
                                                    width="100%"
                                                    height="200"
                                                    src="{{asset('documentos/generadores/comprobantedomicilio/empresa').'/'.$generador->numeroactacontpdf.'?ver='.rand(0,10000)}}">
                                                </iframe>                      
                                                <a target="_blank" class="btn btn-default" href="{{asset('documentos/generadores/comprobantedomicilio/empresa').'/'.$generador->numeroactacontpdf}}">Ver</a>
                                        </div>
                                    </div> 
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="notario">Nombre del notario o corredor público</label>
                                            <input required  type="text" value="{{$generador->notario}}" name="notario" class="form-control" id="notario" placeholder="Nombre del notario o corredor público" aria-invalid="false" >
                                        </div>
                                    </div>
                                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="numeronotaria">Número de notaría o correduría</label>
                                            <input required  type="text" value="{{$generador->numeronotaria}}" name="numeronotaria" class="form-control" id="numeronotaria" placeholder="Número de notaría o correduría" aria-invalid="false" >
                                        </div>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="entidadnotaria">Entidad de la notaría</label>
                                            <select required name="entidadnotaria" class="form-control" id="entidadnotaria">
                                                <option value="{{$generador->entidadnotaria}}">{{$generador->entidadnotaria}}</option>
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
                                </div>
                            </div>
                        </div>
                        @endif


                        @if($generador->fisicaomoral=='Física')
                        <!--En caso de ser persona fisica-->
                        <div class="card card-primary"   id="fisica">
                            <div class="card-header">
                                <h3 class="card-title">Personales</h3>            
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nombresfisica">Nombre(s)</label>
                                            <input required  type="text" value="{{$generador->nombresfisica}}" name="nombresfisica" class="form-control" id="nombresfisica" placeholder="Nombre(s)" aria-invalid="false" >
                                        </div>
                                        
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="apellidosfisica">Apellidos</label>
                                            <input required  type="text" value="{{$generador->apellidosfisica}}" name="apellidosfisica" class="form-control" id="apellidosfisica" placeholder="Apellidos" aria-invalid="false" >
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nacionalidadfisica">Nacionalidad</label>
                                            <input required  type="text" value="{{$generador->nacionalidadfisica}}" name="nacionalidadfisica" class="form-control" id="nacionalidadfisica" placeholder="Nacionalidad" aria-invalid="false" >
                                        </div>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="identificacionfisica">Identificación</label>
                                            <select required class="form-control" name="identificacionfisica" id="identificacionfisica"  aria-invalid="false">
                                                <option value="{{$generador->identificacionfisica}}">{{$generador->identificacionfisica}}</option>
                                                <optgroup>
                                                <option value="INE">INE</option>
                                                <option value="Pasaporte">Pasaporte</option>
                                                <option value="Cédula Profesional">Cédula Profesional</option>
                                                </optgroup>
                                            </select>
                                            <div class="input-group">
                                                <div class="custom-file">                                    
                                                    <input type="file" class="custom-file-input" id="identificacionfisicapdf" value="{{$generador->identificacionfisicapdf}}" name="identificacionfisicapdf">
                                                    <label class="custom-file-label" for="identificacionfisicapdf">Cambiar identificación en pdf</label>                                    
                                                </div>
                                            </div>
                                            <font color="red">No cambia hasta guardar.</font><iframe id="inlineFrameExample"
                                                title="identificación"
                                                width="100%"
                                                height="200"
                                                src="{{asset('documentos/generadores/identificaciones/personafisica').'/'.$generador->identificacionfisicapdf.'?ver='.rand(0,10000)}}">
                                            </iframe>
                                            <a target="_blank" class="btn btn-default" href="{{asset('documentos/generadores/identificaciones/personafisica').'/'.$generador->identificacionfisicapdf}}">Ver</a>
                                        </div>
                                    </div>


                                    
                                </div>       
                            </div>
                        </div>
                        @endif


                    </div><!--End body-->
                    <div class="modal-footer" >
                        <button type="submit" id="guardar" class="btn  btn-info float-right">Guardar</button>
                    </div>
                </form>
                <div>
                    
                   
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
  $.widget.bridge('uibutton', $.ui.button);

 
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('plugins/sparklines/sparkline.js')}}"></script>
<!-- JQVMap -->
<script src="{{asset('plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{asset('plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App, funcion de sidebar -->
<script src="{{asset('dist/js/adminlte.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('dist/js/demo.js')}}"></script>
<script>
$(function () {
  bsCustomFileInput.init();
});
</script>
@include('asociados.footer')
</body>
</html>

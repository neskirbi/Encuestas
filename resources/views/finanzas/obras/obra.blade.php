<!DOCTYPE html>
<html lang="en">
<head>
  @include('finanzas.header')
  <title>{{GetSiglas(0)}} | Obra</title>
  <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
  
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
        
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Obra</h3>
                </div>
                <!-- /.card-header -->
                <form method="POST" action="{{url('obra').'/'.$obra->id}}" id="formobra" enctype="multipart/form-data">
                    @csrf
                    <input required name="_method" type="hidden" value="PUT"> 
                    
                    <div class="card-body">  

                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Datos de la obra</h3>
                            </div>
                            <div class="card-body">
                                

                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="obra">Nombre de la obra</label>
                                            <input required type="text" name="obra" class="form-control" id="obra" placeholder="Nombre de la obra" aria-invalid="false" value="{{$obra->obra}}" >
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nautorizacion">Numero de autorización</label>
                                            <input data-invalido="true" type="text" name="nautorizacion" id="nautorizacion"  class="form-control" value="{{$obra->nautorizacion}}" aria-invalid="false" >
                                        </div>
                                    </div>
                                    
                                </div>

                                

                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="tipoobra">Tipo de obra</label>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="tipoobra">Subtipo de obra</label>
                                    </div>
                                </div>
                                @foreach($tipoobras as $i=>$tipoobra)
                                <div class="row">

                                    <div class="col-md-6"> 
                                        <div class="form-group">
                                            <input type="checkbox" id="tc{{$i}}" data-id="{{$i}}" value="tipoobra" data-tipo="{{$tipoobra->tipoobra}}" onclick="CargarTipo(this)" class="checkgrande tipo" style="width:20px;">
                                            <label for="tc{{$i}}">{{$tipoobra->tipoobra}}</label>
                                            <input data-invalido="true" type="text"  id="si{{$i}}" name="tipoobra[]" style="display:none;">
                                        </div>   
                                        

                                        <div class="form-group">
                                            <div class="input-group">
                                                <input disabled class="form-control volumen" data-invalido="true" type="number" step="0.01" min="0" id="v{{$i}}" data-id="{{$i}}" onkeyup="CargarTipo(this); VolumenTotal();" placeholder="Superficie">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">m<sup>2</sup></span>
                                                </div>
                                            </div>
                                        </div>  
                                        
                                        
                                    </div>
                                    

                                    <div class="col-md-6"> 
                                        <div class="form-group">

                                                @foreach(explode(';;',$tipoobra->subtipoobra) as $index=>$subtipoobra)
                                                <div class="row">
                                                    <div class="col-md-12">

                                                        <?php $temp=explode('::',$subtipoobra); ?>
                                                        <input type="checkbox" id="sc{{$index}}" data-id="{{$i}}{{$index}}" data-subtipo="{{$temp[1]}}" onclick="CargarSubtipo(this);" class="checkgrande subtipo" style="width:20px;">
                                                        <label for="sc{{$index}}">{{$temp[1]}}</label>
                                                        <input data-invalido="true" type="text" value="" id="s{{$i}}{{$index}}" name="subtipoobra[]" style="display:none;">
                                                
                                                    </div>
                                                </div>

                                                @endforeach
                                            </select>
                                        </div>                                   
                                        
                                    </div>


                                </div>
                                <!--Guardando la cantidad de checks para calcular el volumen total-->

                                @endforeach


                                <div class="row" style="display:none;">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="obra" id="tag">Total</label>
                                            <div class="input-group">
                                                <input disabled type="text" name="cantidadobra" class="form-control" id="cantidadobra"  aria-invalid="false" step="0.01" min="0" value="{{number_format($obra->cantidadobra,2)}}">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">m<sup>2</sup></span>
                                                </div>
                                            </div>
                                            
                                            
                                        </div>
                                    </div>
                                </div>




                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="calle">Calle</label>
                                            <input required type="text" name="calle" class="form-control" id="calle" placeholder="Calle" aria-invalid="false" value="{{$obra->calle}}">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="numeroext">Número Ext.</label>
                                            <input required type="text" name="numeroext" class="form-control" id="numeroext" placeholder="Número Ext." aria-invalid="false" value="{{$obra->numeroext}}">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="numeroint">Número Int.</label>
                                            <input required type="text" name="numeroint" class="form-control" id="numeroint" placeholder="Número Int." aria-invalid="false" value="{{$obra->numeroint}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="colonia">Colonia</label>
                                            <input required type="text" name="colonia" class="form-control" id="colonia" placeholder="Colonia" aria-invalid="false" value="{{$obra->colonia}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="municipio">Alcaldía/Municipio</label>
                                            <input required type="text" name="municipio" class="form-control" id="municipio" placeholder="Alcaldía/Municipio" aria-invalid="false" value="{{$obra->municipio}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="entidad">Entidad federativa</label>
                                            <select  name="entidad" class="form-control" id="entidad" aria-invalid="false"">
                                                <option value="{{$obra->entidad}}">{{$obra->entidad}}</option>
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
                                            <label for="cp">C.P.</label>
                                            <input required type="text" name="cp" class="form-control" id="cp" placeholder="C.P." aria-invalid="false" value="{{$obra->cp}}">
                                        </div>
                                    </div>
                                </div>
                                <div calss="row">
                                    <div class="col-md-8">
                                        <div id="map" style=" height: 350px; width:100%;"></div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-1">                                    
                                        <img src="{{asset('images/iconos/mapa.png')}}" height="55px" alt="" style="cursor:pointer;" onclick="AbrirModal('modalmapa');">
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="latitud">Latitud</label>
                                            <input required type="text" name="latitud" class="form-control" id="latitud" onclick="AbrirModal('modalmapa');" placeholder="Latitud" aria-invalid="false" value="{{$obra->latitud}}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="longitud">Longitud</label>                                           
                                            <input required type="text" name="longitud" class="form-control" id="longitud" onclick="AbrirModal('modalmapa');" placeholder="Longitud" aria-invalid="false" value="{{$obra->longitud}}" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fechainicio">Inicio</label>                                           
                                            <input required type="date" name="fechainicio" class="form-control" id="fechainicio" aria-invalid="false" value="{{$obra->fechainicio}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fechafin">Fin</label>                                           
                                            <input required type="date" name="fechafin" class="form-control" id="fechafin" aria-invalid="false" value="{{$obra->fechafin}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        

                       

                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Material</h3>                                
                            </div>
                            <div class="card-body">
                                <div class="float-right">
                                    <button type="button" class="btn bg-danger btn-sm" onclick="MenosMateriales();">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn bg-info btn-sm" onclick="MasMateriales();" id="mas">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="superficie">Volumen</label>
                                        <input required type="number" min=".01" step=".01" name="superficie" class="form-control" id="superficie" placeholder="Volumen" aria-invalid="false" readonly>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="superunidades">Unidades</label>
                                        <select class="form-control" name="superunidades" id="superunidades" aria-invalid="false" >
                                            <option value="{{$obra->superunidades}}">{{$obra->superunidades}}</option> 
                                            <option value="m&sup3;">m&sup3;</option>
                                        </select>
                                    </div>
                                </div>  
                                <div class="col-md-6 pull-right">
                                    
                                </div>
                               
                            </div>
                                @foreach($materiales as $key=>$material)
                                <div style="border:solid #cccccc 1px; border-radius:5px; margin-top:10px;">
                                    <div class="float-right">
                                        <button type="button" class="btn btn-outline-danger btn-sm" onclick="QuitarFila(this);" id="quitar" name="quitar">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="categoria">Categoría</label>
                                                <select class="form-control" name="categoria[]" id="categoria{{($key*1)+100}}" onchange="GetMateriales({{($key*1)+100}});"  aria-invalid="false" >
                                                    <option value="{{$material->categoriamaterial}}">{{$material->categoriamaterial}}</option>
                                                    <optgroup></optgroup>
                                                    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="material">Material</label>
                                                <select class="form-control" name="material[]" id="material{{($key*1)+100}}" onkeyup="CalcularCosto({{($key*1)+100}});" onchange="CalcularCostoPorMaterialObra({{($key*1)+100}}); PonerPrecio({{($key*1)+100}})" aria-invalid="false" >
                                                <option value="{{$material->id_material}}" data-precio="{{$material->precio}}">{{$material->material}}</option>                                               
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="cantidad">Volumen</label>
                                                <div class="input-group">
                                                <input required type="number" min=".01" step=".01" name="cantidad[],cantidadm" class="form-control" id="cantidad{{($key*1)+100}}" placeholder="Volumen" aria-invalid="false" onchange="CalcularCostoPorMaterialObra({{($key*1)+100}});" value="{{$material->cantidad}}">
                                                <script>CalcularCosto({{($key*1)+100}}); CalcularCostoPorMaterialObra({{($key*1)+100}});</script>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">m<sup>3</sup></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>    
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="precio0">Precio unitario</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">$</span>
                                                    </div>
                                                    <input required type="number" min="1" name="precio[]" id="precio{{($key*1)+100}}" class="form-control" id="precio{{($key*1)+100}}" placeholder="Precio" aria-invalid="false" onchange="CalcularCostoPorMaterialObra({{($key*1)+100}});" value="{{$material->precio}}" >
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="costo">Importe</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">$</span>
                                                    </div>
                                                    <input  type="number" min="1" name="costo" class="form-control" id="costo{{($key*1)+100}}" placeholder="Costo" aria-invalid="false" readonly value="{{$material->cantidad*$material->precio}}">
                                                </div>
                                                
                                            </div>
                                        </div>
                                        
                                                                    
                                    </div>
                                </div>
                                @endforeach
                                <div id="contenedor"></div>

                                <div class="row">
                                    <div class="col-md-3">
                                    </div>
                                    <div class="col-md-3">
                                    </div>
                                    <div class="col-md-3">
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="descuento">Descuento</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">%</span>
                                                </div>
                                                <input  type="number" min="0" max="100" step="0.01" name="descuento" class="form-control" id="descuento" aria-invalid="false" value="{{$obra->descuento}}" onchange="SacarTotalObra();">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                    </div>
                                    <div class="col-md-3">
                                    </div>
                                    <div class="col-md-3">
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="iva">IVA</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">%</span>
                                                </div>
                                                <input  type="text" min="1" name="iva" class="form-control" id="iva" aria-invalid="false" readonly value="16">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    
                                <div class="row">
                                    <div class="col-md-3">
                                    </div>
                                    <div class="col-md-3">
                                    </div>
                                    <div class="col-md-3">
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="subtotal">Subtotal</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">$</span>
                                                </div>
                                                <input  type="text" min="1" name="subtotal" class="form-control" id="subtotal" aria-invalid="false" readonly value="0">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                    </div>
                                    <div class="col-md-3">
                                    </div>
                                    <div class="col-md-3">
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="total">Total</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">$</span>
                                                </div>
                                                <input  type="text" min="1" name="total" class="form-control" id="total" aria-invalid="false" readonly value="0">
                                            </div>
                                            <script> CalcularCostoPorMaterialObra(0);</script>
                                        </div>
                                    </div>
                                </div>
                                
                               
                            </div>
                        </div>
                        
                        

                        


                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Datos del contacto</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="telefono">Teléfono</label>
                                            <input required type="text" name="telefono" class="form-control" id="telefono" placeholder="Teléfono" aria-invalid="false" value="{{$obra->telefono}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="celular">Celular</label>
                                            <input required type="text" name="celular" class="form-control" id="celular" placeholder="Celular" aria-invalid="false" value="{{$obra->celular}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="correo">Correo</label>
                                            <input required type="text" name="correo" class="form-control" id="correo" placeholder="Correo" aria-invalid="false" value="{{$obra->correo}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="correo2">Correo 2</label>
                                            <input required type="text" name="correo2" class="form-control" id="correo2" placeholder="Correo" aria-invalid="false" value="{{$obra->correo2}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                                                  
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="aplicaplan">¿Aplica Plan de Manejo?</label><br>
                                            @if($obra->aplicaplan)
                                            <input type="checkbox" class="checkgrande" name="aplicaplan"  id="aplicaplan" aria-invalid="false" checked>
                                            @else
                                            <input type="checkbox" class="checkgrande" name="aplicaplan"  id="aplicaplan" aria-invalid="false" >
                                            @endif
                                        </div>
                                        
                                    </div>

                                 
                                </div>
                                
                            </div>
                        </div>    
                        

                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">CIF</h3>
                                
                            </div>
                            <div class="card-body">
                                <div class="col-md-12">
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
                        </div>
                       

                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Contrato</h3>
                                
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                        @if($obra->contrato)
                                        <iframe id="inlineFrameExample"
                                            title="identificación"
                                            width="100%"
                                            height="200"
                                            src="{{asset('documentos/clientes/contratos').'/'.$obra->id.'.pdf?ver='.rand(0,10000)}}">
                                        </iframe>
                                        <a target="_blank" class="btn btn-default" href="{{asset('documentos/clientes/contratos').'/'.$obra->id.'.pdf?ver='.rand(0,10000)}}">Ver</a>
                                        @endif
                                        @if(!$obra->contrato)
                                        <h3 title="{{asset('documentos/clientes/contratos').'/'.$obra->id.'.pdf'}}">Sin contrato</h3>
                                        
                                        @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Limite</h3>
                                <div class="card-tools">
                                    
                                </div>
                                
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-14">
                                        <div class="form-group">
                                            <label for="limite">Limite mensual(0 sin limite)</label>
                                            <div class="input-group mb-3">
                                                <input type="number" step="0.01" min="0" class="form-control" name="limite" value="{{$obra->limite}}">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">m<sup>3</sup></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Manifiesto finalización</h3>
                                <div class="card-tools">
                                    
                                </div>
                                
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="finalizacion">Documento de Finalización</label>
                                            
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                        @if(file_exists(public_path(('documentos/clientes/finalizacion').'/'.$obra->id.'.pdf')))
                                        <iframe id="inlineFrameExample"
                                            title="identificación"
                                            width="100%"
                                            height="200"
                                            src="{{asset('documentos/clientes/finalizacion').'/'.$obra->id.'.pdf?ver='.rand(0,10000)}}">
                                        </iframe>
                                        <a target="_blank" class="btn btn-default" href="{{asset('documentos/clientes/finalizacion').'/'.$obra->id.'.pdf?ver='.rand(0,10000)}}">Ver</a>
                                        @endif
                                        @if(!file_exists(public_path(('documentos/clientes/finalizacion').'/'.$obra->id.'.pdf')))
                                        <h3 title="{{asset('documentos/clientes/finalizacion').'/'.$obra->id.'.pdf'}}">Sin documento</h3>
                                        
                                        @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        


                    </div><!--End body-->
                    
                </form>
                    <div class="card-footer" >
                       
                    </div>

                    
               
            </div>
            <br>

          
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
<script>
$(function () {
  bsCustomFileInput.init();
});
</script>
<script>
    var markers = [];
    
      function initMap() {
        const myLatlng = { lat:  $('#latitud').val()*1, lng: $('#longitud').val()*1 };
        const map = new google.maps.Map(document.getElementById("map"), {
          zoom: 19,
          center: myLatlng,
        });
        const marker = new google.maps.Marker({
            position: myLatlng,
            map,
            title:$('#obra').val()
        });
        
        // Create the initial InfoWindow.
        let infoWindow = new google.maps.InfoWindow({
          content: $('#obra').val(),
          position: myLatlng,
        });
        infoWindow.open(map,marker);
        // Configure the click listener.
         
        map.addListener("click", (mapsMouseEvent) => {
            // Close the current InfoWindow.
            infoWindow.close();
            DeleteMarkers();
            // Create a new InfoWindow.
            infoWindow = new google.maps.InfoWindow({
              position: mapsMouseEvent.latLng,
            });
            var coordenadas=mapsMouseEvent.latLng.toJSON();
            $('#latitud').val(coordenadas.lat);
            $('#longitud').val(coordenadas.lng);
            const coorobra = { lat:  coordenadas.lat*1, lng: coordenadas.lng*1 };
            const marker = new google.maps.Marker({
            position: coorobra,
            map,
            title:$('#obra').val()
            });
             //Add marker to the array.
            markers.push(marker);
            infoWindow.setContent('La obra se localiza:<br>Latitud:'+coordenadas.lat+'<br>Longitud:'+coordenadas.lng);
          
            infoWindow.open(map,marker);
          
        });
      }
      
      function editar(_this){
          $(_this).attr("readonly", false); 
      }
</script>

@if(gettype($obra->tipoobra)!='NULL' && gettype($obra->subtipoobra)!='NULL')
@foreach($obra->tipoobra as $to)
    <script>
        LlenarTipoObra(HtmltoJson('{{($to)}}'));
    </script>
    @endforeach

    @foreach($obra->subtipoobra as $st)
    
    @if(gettype($st)=='string')
    <script>
        LlenarSubtipoObra(HtmltoJson('{{($st)}}'));
    </script>
    @endif
@endforeach
@endif


@include('MapsApi')

@include('finanzas.footer')
</body>
</html>

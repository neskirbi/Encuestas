<!DOCTYPE html>
<html lang="en">
<head>
  @include('administracion.header')
  <title>CSMX | Obra</title>
  <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
  
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
                                    <div class="col-md-6"> 
                                        <div class="form-group">
                                            <label for="generador">Generador</label>
                                            <select class="form-control" name="generador" id="generador" aria-invalid="false" disabled >
                                                <option value="{{$obra->razonsocial}}">{{$obra->razonsocial}}</option>
                                               
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="generador">Planta</label>
                                            <select name="planta" id="planta" class="form-control" disabled>
                                                <option value="{{$planta->id}}">{{$planta->planta}}</option>
                                                <optgroup></optgroup>
                                                @foreach($plantas as $planta)
                                                <option value="{{$planta->id}}">{{$planta->planta}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="obra">Nombre de la obra</label>
                                            <input required type="text" name="obra" class="form-control" id="obra" placeholder="Nombre de la obra" aria-invalid="false" value="{{$obra->obra}}" >
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="distancia">Distancia a la planta</label>
                                            <div class="input-group">
                                                <input data-invalido="true" type="number" step="0.1" min="0" name="distancia" id="distancia"  class="form-control" aria-invalid="false" value="{{$obra->distancia}}">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">Km</span>
                                                </div>
                                                
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nautorizacion">Numero de autorización</label>
                                            <input data-invalido="true" type="text" name="nautorizacion" id="nautorizacion"  class="form-control" value="{{$obra->nautorizacion}}" aria-invalid="false" >
                                        </div>
                                    </div>                                    
                                </div>

                                
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="nautorizacion">Publica/Privada</label>
                                        <div class="form-group">
                                            <div class="form-check">
                                            <input class="form-check-input" value="1" type="radio" name="pp" {{$obra->publica==1 ? 'checked' : '' }}>
                                            <label class="form-check-label">Publica</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" value="0" type="radio" name="pp" {{$obra->publica==0 ? 'checked' : '' }}>
                                            <label class="form-check-label">Privada</label>
                                            </div>                                        
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="ncontrato">Numero de contrato</label>
                                            <input data-invalido="true" type="text" name="ncontrato" id="ncontrato"  class="form-control" aria-invalid="false" value="{{$obra->ncontrato}}">
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
                                                <input type="text" name="cantidadobra" class="form-control" id="cantidadobra"  aria-invalid="false"  value="{{$obra->cantidadobra}}">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">m<sup>2</sup></span>
                                                </div>
                                            </div>
                                            
                                            
                                        </div>
                                    </div>
                                </div>

                         
                               <br>

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
                                            <label for="cp">C.P.</label>
                                            <input required type="text" name="cp" class="form-control" id="cp" placeholder="C.P." aria-invalid="false" value="{{$obra->cp}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="entidad">Entidad federativa</label>
                                            <!--<input  type="text" name="entidad" class="form-control" id="entidad" placeholder="Entidad federativa" aria-invalid="false" >-->
                                            <select  name="entidad" class="form-control" id="entidad" aria-invalid="false" onchange="MunicipiosApi(this,1);">
                                                <option value="{{$obra->entidad}}">{{$obra->entidad}}</option>
                                                @foreach($entidades as $entidad)
                                                <option value="{{$entidad->entidad}}">{{$entidad->entidad}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="municipio">Alcaldía/Municipio</label>
                                            <select  name="municipio" class="form-control" id="municipio" aria-invalid="false" data-mun="municipio" >
                                                <option value="{{$obra->municipio}}">{{$obra->municipio}}</option>                                               
                                            </select>
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
                                            <input required type="text" name="latitud" class="form-control" id="latitud" onclick="AbrirModal('modalmapa');" placeholder="Latitud" aria-invalid="false" value="{{$obra->latitud}}">
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="longitud">Longitud</label>                                           
                                            <input required type="text" name="longitud" class="form-control" id="longitud" onclick="AbrirModal('modalmapa');" placeholder="Longitud" aria-invalid="false" value="{{$obra->longitud}}">
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
                                <div class="card-tools">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="customSwitch1" onchange="TodosMateriale(this);">
                                        <label class="custom-control-label" for="customSwitch1">Todos los materiales</label>
                                    </div>

                                </div>                               
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
                                        <input data-invalido="true" type="number" min=".01" step=".01" name="superficie" class="form-control" id="superficie" placeholder="Volumen" aria-invalid="false">
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
                                <div class="mat" data-cantidad="{{$material->cantidad}}" style="border:solid #cccccc 1px; border-radius:5px; margin-top:10px; {{$material->cantidad>0 ? '' : 'display:none;'}}">
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
                                                    @foreach($categorias as $categoria)
                                                    
                                                    <option value="{{$categoria->categoria}}">{{$categoria->categoria}}</option>
                                                    @endforeach
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
                                                    <input  type="number" min="1" name="costo" class="form-control" id="costo{{($key*1)+100}}" placeholder="Costo" aria-invalid="false" value="{{$material->cantidad*$material->precio}}">
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
                                                <input  type="text" min="1" name="iva" class="form-control" id="iva" aria-invalid="false" value="16">
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
                                                <input  type="text" min="1" name="subtotal" class="form-control" id="subtotal" aria-invalid="false" value="0">
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
                                                <input  type="text" min="1" name="total" class="form-control" id="total" aria-invalid="false" value="0">
                                            </div>
                                            <script> CalcularCostoPorMaterialObra(0);</script>
                                        </div>
                                    </div>
                                </div>
                                
                               
                            </div>
                        </div>
                        
                        @if(count($poductosobra))
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Tienda</h3>
                            </div>
                            <div class="card-body">
                                <?php $categoria=''; ?>
                                @foreach($poductosobra as $producto)
                                @if($categoria!=$producto->categoria)
                                <div class="callout callout-info">
                                    <h5>{{$categoria=$producto->categoria}}</h5>
                                </div>
                                
                                @endif
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <center><img src="{{$producto->portada=='' ? 'https://cdn.pixabay.com/photo/2017/01/25/17/35/picture-2008484_960_720.png' : $producto->portada}}" style="max-height:90px; border-radius:5px;" alt=""></center>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <h5 class="card-title">{{$producto->producto}}</h5>

                                                        <p class="card-text">
                                                        {{$producto->descripcion}}
                                                        </p>
                                                        <table>
                                                            <tr>
                                                                <td>
                                                                <input type="text" name="productos[]" class="form-control" value="{{$producto->id_producto}}" style="display:none;">
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">
                                                                        <i class="fas fa-dollar-sign"></i>
                                                                        </span>
                                                                    </div>                                                                        
                                                                    <input type="number" step="0.01" min="0" name="preciop[]" class="form-control" value="{{$producto->precio}}">
                                                                    <div class="input-group-append">
                                                                        <span class="input-group-text">{{$producto->unidades}}</span>
                                                                    </div>
                                                                </div>
                                                                
                                                            </tr>
                                                        </table>  
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                @endforeach
                                
                            </div>
                        </div> 
                        @endif

                        @if(count($poductosobra))
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Transportes</h3>
                            </div>
                            <div class="card-body">
                                <?php $categoria=''; ?>
                                @foreach($transportesobra as $transporteobra)                               
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <center><img src="{{$transporteobra->portada=='' ? 'https://cdn.pixabay.com/photo/2017/01/25/17/35/picture-2008484_960_720.png' : $transporteobra->portada}}" style="max-height:90px; border-radius:5px;" alt=""></center>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <h5 class="card-title">{{$transporteobra->transporte}}</h5>
                                                                <p class="card-text">
                                                                    {{$transporteobra->descripcion}}
                                                                </p>
                                                                <input type="text" name="transportes[]" class="form-control" value="{{$transporteobra->id_transporte}}" style="display:none;">
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">
                                                                        <i class="fas fa-dollar-sign"></i>
                                                                        </span>
                                                                    </div>                                                                        
                                                                    <input type="number" step="0.01" min="0" name="preciot[]" class="form-control" value="{{$transporteobra->precio}}">
                                                                    <div class="input-group-append">
                                                                        <span class="input-group-text">Viaje&nbsp;<i class="fa fa-truck"></i> </span>
                                                                    </div>
                                                                </div>
                                                                <p style="color:#3c3c3c; font-size:13px;">Manejar el precio por viaje a la obra.</p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="cantidadt">Cantidad Viajes</label>
                                                                    <input required type="number" min="0" step="1" name="cantidadt[]" class="form-control" id="cantidadt" placeholder="Cantidad" aria-invalid="false" value="{{$transporteobra->cantidad}}">
                                                                </div>
                                                            </div>
                                                        </div>                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                @endforeach
                                
                            </div>
                        </div> 
                        @endif


                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Datos del contacto</h3>
                            </div>
                            <div class="card-body">

                            <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="contacto">Nombre del Contacto</label>
                                            <input required type="text" name="contacto" class="form-control" id="contacto" placeholder="Nombre del Contacto"  minlength="1" maxlength="100" aria-invalid="false"  value="{{$obra->contacto}}">
                                        </div>
                                    </div>
                                </div>
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
                                

                                
                            </div>
                        </div>     



                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Adicionales</h3>
                            </div>
                            <div class="card-body">

                                
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

                                <div class="row">
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="contraramir">¿Requiere contrato RAMIR?</label><br>
                                            @if($obra->contraramir)
                                            <input type="checkbox" class="checkgrande" name="contraramir"  id="contraramir" aria-invalid="false" checked>
                                            @else
                                            <input type="checkbox" class="checkgrande" name="contraramir"  id="contraramir" aria-invalid="false" >
                                            @endif
                                        </div>
                                        
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="contrasindicato">¿Requiere contrato de transporte con sindicato?</label><br>
                                            @if($obra->contrasindicato)
                                            <input type="checkbox" class="checkgrande" name="contrasindicato"  id="contrasindicato" aria-invalid="false" checked>
                                            @else
                                            <input type="checkbox" class="checkgrande" name="contrasindicato"  id="contrasindicato" aria-invalid="false" >
                                            @endif
                                        </div>
                                        
                                    </div>
                                </div>

                               
                                
                            </div>
                        </div> 

                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Póliza RC</h3>
                            </div>
                            <div class="card-body">
                                
                            <div class="row">
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="polizarc">¿Quiere Poliza de RC?</label><br>
                                        @if($obra->polizarc)
                                        <input type="checkbox" class="checkgrande" name="polizarc"  id="polizarc" aria-invalid="false"  checked>
                                        @else
                                        <input type="checkbox" class="checkgrande" name="polizarc"  id="polizarc" aria-invalid="false" >
                                        @endif
                                        
                                        
                                    </div>
                                    
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="valorobra">¿Cual es el valor de la obra?</label><br>
                                        <input data-invalido="true" type="number" class="form-control" name="valorobra"  id="valorobra" aria-invalid="false" min="0" value="{{$obra->valorobra}}" >
                                    </div>
                                    
                                </div>
                            </div>

                            

                            @if($obra->verificado==1 && $obra->polizarc)
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="ec">¿Enviar correo de Poliza de RC?</label><br>
                                        <a  class="btn btn-success" onclick="EnviarCorreoPRC('{{$obra->id}}');">Enviar Correo</a>
                                    </div>
                                    
                                </div>
                            </div>
                            @endif
                            </div>
                        </div> 


                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Unidad de Inspección Ambiental</h3>
                            </div>
                            <div class="card-body">

                                
                                
                                <div class="row">
                                    <div class="col-md-6"> 
                                        <div class="form-group">
                                            <label for="uia">Unidad de Inspección Ambiental</label>
                                            <input disabled data-invalido="true" type="text" class="form-control" aria-invalid="false" value="{{(isset($uia->uia) ? $uia->uia : '')}}">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div> 

                       
                        
                        <div class="card card-danger">
                            <div class="card-header"> Pospago </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="transporte">¿Puede Pospago?</label><br>
                                            @if($obra->puedepospago)
                                            <input type="checkbox" class="checkgrande" name="puedepospago"  id="puedepospago" aria-invalid="false" checked >
                                            @else
                                            <input type="checkbox" class="checkgrande" name="puedepospago"  id="puedepospago" aria-invalid="false" >
                                            @endif
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Contrato</h3>
                                <div class="card-tools">
                                    @if($obra->verificado)  
                                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#cargar">
                                        <i class="fa fa-upload" aria-hidden="true"></i> Cargar Contrato
                                    </button>
                                    @endif 
                                </div>
                                
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
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input data-invalido="true" type="file" class="custom-file-input" id="finalizacion" name="finalizacion">
                                                    <label class="custom-file-label" for="finalizacion">Seleccionar</label>
                                                </div>
                                               
                                            </div>
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

                        @if($obra->deshabilitada==1)
                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">Habilitar</h3>
                                
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <center>
                                        <img src="{{asset('images/botones/bv.png')}}" alt="" width="200px" onclick="HabilitarDeshabilitar('{{$obra->id}}',0);">
                                        </center>
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                        @else

                        <div class="card card-danger">
                            <div class="card-header">
                                <h3 class="card-title">Deshabilitar</h3>                               
                                
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <center>
                                        <img src="{{asset('images/botones/br.png')}}" alt="" width="200px" onclick="HabilitarDeshabilitar('{{$obra->id}}',1);">
                                        </center>
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        

                        


                    </div><!--End body-->
                    
                </form>
                    <div class="card-footer" >
                        @if($obra->verificado==0)
                        <div class="row">
                            <div class="col-md-10"></div>
                            <div class="col-md-2">
                                <form action="{{url('ValidarObra').'/'.$obra->id}}" method="GET">
                                    @csrf
                                    <div class="form-group">
                                        <button type="submit" id="guardar" class="btn btn-success confirmarclick" data-texto="Se confirmara la obra<br>¿Desea continuar?"> <i class="fa fa-check" aria-hidden="true"></i> Confirmar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @endif

                        <div class="row">
                            <div class="col-md-10"></div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <button id="guardar" class="btn btn-info" data-texto="Se guardaran los datos. <br>¿Desea continuar?" onclick="GuardarEditarObra(this);"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
                                    </div>
                            </div>
                        </div>
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

@include('administracion.obras.modals.modalconfirmar')
@include('administracion.obras.modals.modalcargarcontrato')
@include('administracion.footer')
</body>
</html>

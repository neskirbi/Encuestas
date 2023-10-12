<!DOCTYPE html>
<html lang="en">
<head>
    @include('header')
    <title>{{GetSiglas(0)}} | Citas y Folios</title>
</head>
<style>
    body {
    background-image: url("{{asset('images/portada.jfif')}}");
    background-size: cover;
    background-repeat: no-repeat;
    margin: 0;
    }
    .item-color{f
        color:#fff;
    }
</style>
<body>

   
    
    

    @include('navbar')
    @include('toast.toasts')
    


   
    <br><br>

    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Cita</h3>
                </div>
                <form method="POST" action="{{url('microgeneradores')}}" id="formmgeneradores" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <form action="{{url('microgeneradores')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label for="nombre">Nombre Completo</label>
                                    <input required type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" maxlength="40">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="nombre">Teléfono</label>
                                    <input required type="text" class="form-control" id="telefono" name="telefono" placeholder="Teléfono" maxlength="100">
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="correo">Correo</label>
                                    <input required type="email" class="form-control" id="correo" name="correo" placeholder="Correo" maxlength="100">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                <label for="calle">Calle</label>
                                <input required type="text" name="calle" class="form-control" id="calle" placeholder="Calle" aria-invalid="false" maxlength="200">
                                </div>
                            </div>
                            

                        
                            <div class="col-md-3">                                    
                                <div class="form-group">
                                <label for="numeroext">Número ext.</label>
                                <input required type="text" name="numeroext" class="form-control" id="numeroext" placeholder="Número ext." aria-invalid="false" maxlength="50">
                                </div>
                            </div>
                        
                            
                                    
                            <div class="col-md-3"> 
                                <div class="form-group">
                                    <label for="numeroint">Número int.</label>
                                    <input required type="text" name="numeroint" class="form-control" id="numeroint" placeholder="Número int." aria-invalid="false" maxlength="50">
                                </div>
                            </div>
                                                
                            
                            <div class="col-md-3"> 
                                <div class="form-group">
                                    <label for="colonia">Colonia</label>
                                    <input required type="text" name="colonia" class="form-control" id="colonia" placeholder="Colonia" aria-invalid="false" maxlength="50">
                                </div>
                            </div>
                                

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="municipio">Municipio/Alcaldía</label>
                                    <input required type="text" name="municipio" class="form-control" id="municipio" placeholder="Municipio" aria-invalid="false" maxlength="50">
                                </div>  
                            </div>
                        

                        
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="cp">C.P.</label>
                                    <input required type="text" name="cp" class="form-control" id="cp" placeholder="CP" aria-invalid="false" maxlength="20">
                                </div>
                            </div>
                        </div>
                            
                        
                        <div class="row">
                        <div class="col-md-7">
                                <div class="form-group">
                                    <label for="transporte">Residuo</label><br>
                                    <select required class="form-control" name="material" id="material" aria-invalid="false" maxlength="150" >
                                        <option value="">--- Residuo ---</option>
                                        <?php $categoria='';?>
                                        @foreach($materiales as $material)
                                            @if($categoria!=$material->categoria)
                                            <optgroup label="{{$material->categoria}}"></optgroup>
                                            <?php $categoria=$material->categoria; ?>
                                            @endif
                                            <option value="{{$material->id}}">{{$material->material}}</option>
                                        @endforeach
                                    </select>                                                                                
                                </div>
                            </div>
                            <div class="col-md-4">                   
                                <div class="form-group">
                                    <label for="condicionmaterial">Medida</label>
                                    <select required type="text" name="condicionmaterial" class="form-control" id="condicionmaterial" aria-invalid="false" maxlength="100" onchange="CambiaCondicion(); ">
                                        <option value="">--Seleccionar--</option>
                                        <optgroup></optgroup>
                                        <option value="1">m<sup>3</sup></option>
                                        <option value="30">Costales</sup></option>
                                    </select>
                                </div>
                            </div>

                        </div>
                        
                        <div class="row">



                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="nombres">Cantidad <span id="condicion">m<sup>3</sup></span></label>
                                    <div class="input-group mb-3">
                                        <input required type="number" min="1" step="1" name="cantidad" class="form-control" id="cantidad" placeholder="Catidad" aria-invalid="false" onchange="Precio();">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fa fa-cubes" aria-hidden="true"></i></span>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>


                        </div>
                        
                        <div class="row">
                           
                            <div class="col-md-4">                   
                                <div class="form-group">
                                    <label for="fechayhora">Seleccionar Fecha y Hora</label>
                                    <input required type="datetime-local" class="form-control" aria-invalid="false" maxlength="50" name='fechayhora' id="fechayhora" > 
                                </div>
                            </div>
                        </div>
                        
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </div>
                    </form>
                </div>
               
                
            </div>
        </div>
    </div>

<!--<div style="height:100px; background-color:#1E1E1E; position:absolute; width:100%; bottom:0px;">
    <p><font color="#fff">Contacto</font></p>
</div>-->
</body>
<script>
    
</script>
        

@include('modals.modalregistro')
    @include('modals.modalloginresidentes')
    @include('modals.modallogin')
    @include('modals.modalloginadmin')    
    @include('modals.modalsedemalogin')
    @include('modals.modallogintransportistas')
    @include('modals.modalregistrotransportistas')


</html>
<!-- ModalRegistro -->
<div class="modal fade" id="modalplanta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content "> 
            <div class="modal-header">
                <h4 class="modal-title">Nueva Planta</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                
                <form action="plantareg" method="post" id="plantareg">
                    @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">Datos de la Planta</h3>                            
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-7">
                                        <div class='form-group'>
                                            <label for="planta">Planta</label>
                                            <input type="text" class="form-control" id="planta" name="planta" maxlength="150">
                                        </div>
                                    </div>
                                    <div class="col-sm-1">
                                </div>
                                <div class="row">
                                    </div>
                                    <div class="col-sm-4">
                                        <div class='form-group'>
                                            <label for="siglas">Siglas</label>
                                            <input type="text" class="form-control" id="plantaauto" name="siglas" maxlength="20">
                                        </div>
                                    </div>
                                </div>
                                <div class="row"> 
                                    <div class="col-sm-4">
                                        <div class='form-group'>
                                            <label for="plantaauto">Autorización</label>
                                            <input type="text" class="form-control" id="plantaauto" name="plantaauto" >
                                        </div>
                                    </div>   
                                </div>
                                <div class="row">     

                                    <div class="col-sm-10">
                                        <div class='form-group'>
                                            <label for="direccion">Dirección</label>
                                            <input type="text" class="form-control" id="direccion" name="direccion" maxlength="500">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class='form-group'>
                                            <label for="codigo">C&oacute;digo</label>
                                            <input type="text" class="form-control" id="codigo" name="codigo" >
                                        </div>
                                    </div> 
                                </div> 
                                <div class='row'>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                        <label for="tadmin">Tipo</label>
                                            <select required class="form-control" name="tipo" id="tipo">
                                                <option value="">--Seleccione Opción--</option>
                                                <option value="1">Residuos de la Construcción</option>
                                                <option value="2">Residuaos Sólidos Urbanos</option>
                                            </select>
                                        </div> 
                                    </div>
                                </div>                                                        
                            </div>                          
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Administrador</h3>                            
                            </div>                  
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-7">
                                        <div class='form-group'>
                                            <label for="administrador">Administrador</label>
                                            <input type="text" class="form-control" id="administrador" name="administrador" >
                                        </div>
                                    </div>
                                </div>
                                <div class="row">                            
                                    <div class="col-sm-4">
                                        <div class='form-group'>
                                            <label for="cargo">Cargo</label>
                                            <input type="text" class="form-control" id="cargo" name="cargo" >
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class='form-group'>
                                            <label for="mail">Correo</label>
                                            <input type="text" class="form-control" id="mail" name="mail" >
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class='form-group'>
                                            <label for="pass">Contraseña</label>
                                            <input type="text" class="form-control" id="pass" name="pass" >
                                        </div>
                                    </div>
                                </div>
                            </div>    
                        </div>
                        
                    </div>
                </div>
                </form>        
            </div>
            <div class="modal-footer">
                <button type="button" class='btn btn-info float-right'  onclick="Submite('plantareg',this);" data-texto="¿Todos los datos son correctos?">Guardar</button>  
            </div>       
        </div>
    </div>
</div>
<!-- ModalRegistro -->
<div class="modal fade bd-example-modal-lg" id="modalvehiculo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Vehículo</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="formvehiculo">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="razonsocial">Razón Social</label>
                                <input required="" autocomplete="off" onkeyup="BuscarRazon(this);" type="text" class="form-control" id="buscarrazon" placeholder="Buscar Razón Social" aria-invalid="false">
                                <input required type="text" name="razonsocial" class="form-control" id="razonsocial" placeholder="Razón Social" aria-invalid="false" readonly style="display:none;">
                                <div class="dropdown">
                                
                                    <div class="dropdown-menu" id="menurazon" aria-labelledby="dropdownMenuButton">
                                        <!--<a onclick="AbrirModal('modalvehiculo');" class="dropdown-item" href="#"><i class="fa fa-truck" aria-hidden="true"></i>&nbsp;&nbsp;Agregar Vehículo</a>-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                   
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="vehiculo">Vehículo</label>
                                <input required type="text" name="vehiculo" class="form-control" id="vehiculo" placeholder="Vehículo" aria-invalid="false" >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="marca">Marca</label>
                                <input required type="text" name="marca" class="form-control" id="marca" placeholder="Marca" aria-invalid="false" >
                            </div>

                        </div>
                  

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="modelo">Modelo</label>
                                <input required type="text" name="modelo" class="form-control" id="modelo" placeholder="Modelo" aria-invalid="false" >
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="matricula">Matrícula</label>
                                <input required type="text" name="matricula" class="form-control" id="matricula" placeholder="Matrícula" aria-invalid="false" >
                            </div>

                        </div>
                   
                   
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="combustible">Combustible</label>
                                <select required type="text" name="combustible" class="form-control" id="combustible" aria-invalid="false" >
                                <option value="">--Seleccionar combustible--</option>                        
                                <option value="Gasolina">Gasolina</option>
                                <option value="Diesel">Diésel</option>
                                <option value="Gas LP">Gas LP</option>
                                </select>
                            </div>

                        </div>
                    </div>
                    
                   
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="ramir">Descripción</label>
                                <input required type="text" name="detalle" class="form-control" id="detalle" placeholder="Descripción" aria-invalid="false" >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
            
        </div>
        <!--<div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
        </div>-->
        </div>
    </div>
</div>
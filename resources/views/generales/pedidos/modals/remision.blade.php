<!-- Modal -->
<div class="modal fade" id="remisiones" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Generar Remisión</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class=row>
          <div class="col-md-10">
            <span class="" id="nombre"><b>{{GetNombre()}}</b></span>
          </div>
          <div class="col-md-2">
            <span class="float-right" id="orden"></span>
          </div>
        </div>
        <hr>
        <div class=row>
          <div class="col-md-12">
            <span class="" id="obra"><b>{{$obra->obra}}</b></span>
          </div>          
        </div>
        <hr>
        <div class=row>
          <div class="col-md-12">
            <span class="" id="producto"></span>
          </div>          
        </div>
        <div class=row>
          <div class="col-md-12">
            <span class="" id="descripcion"></span>
          </div>          
        </div>

        <form action="" method="post" id="remisionform"> 
            @csrf
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="cantidad">Cantidad</label>
                        <div class="input-group">
                          <input type="number" step="0.1" min="0" class="form-control" name="cantidad" id="cantidad" placeholder="Cantidad" value="0" onchange="CalcularDisponible(this)" onkeyup="CalcularDisponible(this)">
                          <div class="input-group-append">
                              <span class="input-group-text" id="unidades"></span>
                          </div>
                        </div>                        
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="disponible">Disponible</label>
                        <div class="input-group">
                          <input disabled type="text" class="form-control" id="disponible">
                          <div class="input-group-append">
                              <span class="input-group-text" id="unidades2"></span>
                          </div>
                        </div>
                    </div>
                </div>
            </div>

            <hr>

            

            <div class="row">
              


              <div class="col-md-6">
                <div class="form-group">
                    <label for="bmatricula">Buscar Vehículo (Placa)</label>
                    <input required autocomplete="off" onkeyup="BuscarPlaca(this);" type="text" class="form-control" id="bmatricula" placeholder="Buscar Matrícula" aria-invalid="false" >
                    <div id="ramir" style="font-size:14px; color:#ff0000;"></div>
                    
                    <div class="dropdown">
                        <div class="dropdown-menu" id="menu" aria-labelledby="dropdownMenuButton">                                
                        </div>
                    </div>
                    <input type="text" style="display:none;" name="vehiculo" class="form-control" id="vehiculo" aria-invalid="false" onchange="GetVehiculoInfo(this)">
                </div>
              </div>
            </div>  


      
              
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="vehiculo">Vehículo</label>
                        <input disabled type="text" name="vehi" class="form-control" id="vehi" placeholder="Vehículo" aria-invalid="false" maxlength="100" value="" >
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="marca">Marca</label>
                        <input disabled type="text" name="marca" class="form-control" id="marca" placeholder="Marca" aria-invalid="false" maxlength="100" value="" >
                    </div>

                </div>
          

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="modelo">Modelo</label>
                        <input disabled type="text" name="modelo" class="form-control" id="modelo" placeholder="Modelo" aria-invalid="false" maxlength="100" value="" >
                    </div>

                </div>
            </div>
            <div class="row">
               
          
          
                <div class="col-md-6">
                  <div class="form-group">
                      <label for="combustible">Combustible</label>
                      <select disabled type="text" name="combustible" class="form-control" id="combustible" aria-invalid="false" maxlength="50"  >
                      <option value=""></option>                        
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
                        <textarea disabled type="text" rows="5" name="detalle" class="form-control" id="detalle" placeholder="Descripción" aria-invalid="false" maxlength="100" >  </textarea>
                    </div>
                </div>
            </div>

            
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger cancelar" data-dismiss="modal"> <i class="fa fa-times"></i> Cancelar</button>
        <button disabled type="button" class="btn btn-success aceptar" data-texto="¿Desea generar una remisión para este producto?" onclick="Submite('remisionform',this)"><i class="fa fa-check"></i> Generar</button>
      </div>
    </div>
  </div>
</div>
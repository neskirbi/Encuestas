<!-- ModalRegistro -->
<div class="modal fade" id="modalpago" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="pagos" method="POST">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-money" aria-hidden="true"></i> Agregar pago</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                    @csrf
                    <div class="form-group">
                        <label for="nombre">Cliente</label>
                        <input required type="text"class="form-control" id="nombre" name="nombre" placeholder="Nombre" onkeyup="GetClientes(this);" autocomplete="off">
                        <input required type="text" class="form-control" id="cliente" name="cliente" style="display:none;">
                         <div class="dropdown">                        
                            <div class="dropdown-menu" id="menu" aria-labelledby="dropdownMenuButton">
                                
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="monto">Monto</label>
                        <input required type="number" min="0.01" step="0.01" class="form-control" id="monto" name="monto" placeholder="$ 0.0">
                    </div>

                    <div class="form-group">
                        <label for="referencia">Referencia</label>
                        <input type="text" class="form-control" id="referencia" name="referencia" placeholder="Referencia">
                    </div>

                    
                    <div class="form-group">
                        <label for="descripcion">Forma de Pago</label>
                        <select required type="number" class="form-control" id="descripcion" name="descripcion" >
                        <option value="">--Forma de Pago--</option>
                        <option value="Efectivo">Efectivo</option>
                        <option value="Deposito">Depósito</option>
                        <option value="Transferencia">Transferencia</option>
                        <option value="Pay Pal">Pay Pal</option>
                        </select>
                    </div>
                        
                    
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
            </form>  
        </div>
    </div>
</div>
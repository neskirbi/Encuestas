<!-- ModalRegistro -->
<div class="modal fade" id="modalcancelarpago" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content ">
        <form action="" method="POST" id="formcancelar">
            @csrf
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Cancelar pago</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="card-body">
                <div class="form-group">
                    <label for="nombrec">¿Desea cancelar el pago?</label>
                    <input required type="text" class="form-control" id="id" name="id" style="display:none;" >
                     
                </div>

                <div class="form-group">
                    <label  id="nombrec" name="nombrec" ></label>
                     
                </div>

                <div class="form-group">
                    <label for="montoc">Monto:&nbsp;</label><label  id="montoc" name="montoc" ></label>
                     
                </div>

                <div class="form-group">
                    <label>Detalle</label>
                    <textarea required class="form-control" name="detalle" id="detalle" rows="5" placeholder="Detalle"></textarea>
                </div>
                
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-danger float-right">Confirmar</button>
              </div>
              <!-- /.card-body -->
            </div>
        </form>  
           
        </div>
    </div>
</div>
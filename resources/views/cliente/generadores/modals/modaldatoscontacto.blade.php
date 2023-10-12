<!-- ModalRegistro -->
<div class="modal fade" id="modaldatoscontacto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Dirección</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form method="POST" action="generadores/{{$generador->id}}" enctype="multipart/form-data">
                @csrf
                <input name="_method" type="hidden" value="PUT">
                <div class="card-body">
                  
                  <div class="form-group">
                    <label for="telefono">Teléfono</label>
                    <input required type="text" name="telefono" class="form-control" id="telefono" placeholder="Teléfono" aria-invalid="false" value="{{$generador->telefono}}">
                  </div>

                  <div class="form-group">
                    <label for="estado">Celular</label>
                    <input required type="text" name="celular" class="form-control" id="celular" placeholder="Celular" aria-invalid="false" value="{{$generador->celular}}">
                  </div>

                  <div class="form-group">
                    <label for="mail">Correo</label>
                    <input required type="text" name="mail" class="form-control" id="mail" placeholder="mail" aria-invalid="false" value="{{$generador->mail}}" readonly>
                  </div>

                  <div class="form-group">
                    <label for="mail">Correo</label>
                    <input required type="text" name="mail2" class="form-control" id="mail2" placeholder="Correo" aria-invalid="false" value="{{$generador->mail2}}">
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
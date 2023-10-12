<!-- ModalRegistro -->
<div class="modal fade" id="modaldatosfiscales" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                      <label for="rfc">RFC</label>
                      <input required type="text" name="rfc" class="form-control" id="rfc" placeholder="RFC" aria-invalid="false" value="{{$generador->rfc}}">
                  </div>

                  <div class="form-group">
                      <label for="rfc">Persona</label>
                      <select required name="fisicaomoral" class="form-control" id="fisicaomoral" aria-invalid="false">
                        <option value="{{$generador->fisicaomoral}}">{{$generador->fisicaomoral}}</option>
                        <optgroup>
                          <option value="Moral">Moral</option>
                          <option value="Física">Física</option>
                        </optgroup>
                        
                      </select>
                  </div>

                  <div class="form-group">
                      <label for="razonsocial">Denominación/Razon social</label>
                      <input required type="text" name="razonsocial" class="form-control" id="razonsocial" placeholder="Denominación/Razon social" aria-invalid="false" value="{{$generador->razonsocial}}">
                  </div>

                  <div class="form-group">
                    <label for="calle">Calle</label>
                    <input required type="text" name="calle" class="form-control" id="calle" placeholder="Calle" aria-invalid="false" value="{{$generador->calle}}">
                  </div>
                  
                  <div class="form-group">
                    <label for="numeroext">Número ext.</label>
                    <input required type="text" name="numeroext" class="form-control" id="numeroext" placeholder="Número ext." aria-invalid="false" value="{{$generador->numeroext}}">
                  </div>
                  
                  <div class="form-group">
                    <label for="numeroint">Número int.</label>
                    <input required type="text" name="numeroint" class="form-control" id="numeroint" placeholder="Número ext." aria-invalid="false" value="{{$generador->numeroint}}">
                  </div>

                  <div class="form-group">
                    <label for="colonia">Colonia</label>
                    <input required type="text" name="colonia" class="form-control" id="colonia" placeholder="Colonia" aria-invalid="false" value="{{$generador->colonia}}">
                  </div>

                  <div class="form-group">
                    <label for="municipio">Municipio</label>
                    <input required type="text" name="municipio" class="form-control" id="municipio" placeholder="Municipio" aria-invalid="false" value="{{$generador->municipio}}">
                  </div>


                  <div class="form-group">
                    <label for="entidad">Entidad federativa</label>
                    <input required type="text" name="entidad" class="form-control" id="entidad" placeholder="Entidad federativa" aria-invalid="false" value="{{$generador->entidad}}">
                  </div>

                  <div class="form-group">
                      <label for="cp">CP</label>
                      <input required type="text" name="cp" class="form-control" id="cp" placeholder="CP" aria-invalid="false" value="{{$generador->cp}}">
                  </div>


                  <div class="form-group">
                    <label for="cif">Cargar CIF en pdf</label>
                    <div class="input-group">
                      <div class="custom-file">
                        
                        @if(isset($generador->cif))
                          <input type="file" class="custom-file-input" id="cif" name="cif">                                            
                          <label class="custom-file-label" for="cif">CIF</label>
                        @else
                          <input required type="file" class="custom-file-input" id="cif" name="cif">
                          <label class="custom-file-label" for="cif">Cargar archivo</label>
                        @endif
                        
                        
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

<script>
$(function () {
  bsCustomFileInput.init();
});
</script>
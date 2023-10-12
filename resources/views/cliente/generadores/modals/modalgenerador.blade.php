<!-- ModalRegistro -->
<div class="modal fade" id="modalgenerador" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Dirección</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form method="POST" action="generadores" enctype="multipart/form-data">
                @csrf
                
                <div class="card-body">

                <div class="form-group">
                    <label for="name">Nombre(s)</label>
                    <input required type="text" class="form-control" id="nombres" name="nombres"  placeholder="Nombre(s)">
                </div>

                <div class="form-group">
                    <label for="name">Apellidos</label>
                    <input required type="text" class="form-control" id="apellidos" name="apellidos"  placeholder="Apellidos">
                </div>
                

                <div class="form-group">
                    <label for="telefono">Teléfono</label>
                    <input required type="text" name="telefono" class="form-control" id="telefono" placeholder="Teléfono" aria-invalid="false" >
                  </div>

                  <div class="form-group">
                    <label for="estado">Celular</label>
                    <input required type="text" name="celular" class="form-control" id="celular" placeholder="Celular" aria-invalid="false" >
                  </div>

                  <div class="form-group">
                    <label for="mail">Correo</label>
                    <input required type="text" name="mail" class="form-control" id="mail" placeholder="Correo" aria-invalid="false" >
                  </div>

                  <div class="form-group">
                    <label for="mail">Correo</label>
                    <input required type="text" name="mail2" class="form-control" id="mail2" placeholder="Correo" aria-invalid="false" >
                  </div>


                  <div class="form-group">
                      <label for="rfc">RFC</label>
                      <input required type="text" name="rfc" class="form-control" id="rfc" placeholder="RFC" aria-invalid="false" >
                  </div>

                  <div class="form-group">
                      <label for="rfc">Persona</label>
                      <select required name="fisicaomoral" class="form-control" id="fisicaomoral" aria-invalid="false">
                        <option ></option>
                        <optgroup>
                          <option value="Moral">Moral</option>
                          <option value="Física">Física</option>
                        </optgroup>
                        
                      </select>
                  </div>

                  <div class="form-group">
                      <label for="razonsocial">Denominación/Razon social</label>
                      <input required type="text" name="razonsocial" class="form-control" id="razonsocial" placeholder="Denominación/Razon social" aria-invalid="false" >
                  </div>

                  <div class="form-group">
                    <label for="calle">Calle</label>
                    <input required type="text" name="calle" class="form-control" id="calle" placeholder="Calle" aria-invalid="false" >
                  </div>
                  
                  <div class="form-group">
                    <label for="numeroext">Número ext.</label>
                    <input required type="text" name="numeroext" class="form-control" id="numeroext" placeholder="Número ext." aria-invalid="false" >
                  </div>
                  
                  <div class="form-group">
                    <label for="numeroint">Número int.</label>
                    <input required type="text" name="numeroint" class="form-control" id="numeroint" placeholder="Número ext." aria-invalid="false" >
                  </div>

                  <div class="form-group">
                    <label for="colonia">Colonia</label>
                    <input required type="text" name="colonia" class="form-control" id="colonia" placeholder="Colonia" aria-invalid="false" >
                  </div>

                  <div class="form-group">
                    <label for="municipio">Municipio</label>
                    <input required type="text" name="municipio" class="form-control" id="municipio" placeholder="Municipio" aria-invalid="false" >
                  </div>


                  <div class="form-group">
                    <label for="entidad">Entidad federativa</label>
                    <input required type="text" name="entidad" class="form-control" id="entidad" placeholder="Entidad federativa" aria-invalid="false" >
                  </div>

                  <div class="form-group">
                      <label for="cp">CP</label>
                      <input required type="text" name="cp" class="form-control" id="cp" placeholder="CP" aria-invalid="false" >
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
<!-- Modal -->
<div class="modal fade" id="confirmar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form action="{{url('confirmarobra').'/'.$obra->id}}" method="POST" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Confirmar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            @csrf                        
            <div class="form-group">
                <label for="porcentaje">Descuento</label>
                <div class="input-group mb-3">
                    <input required type="number" step="0.01" min="0" max="100" name="porcentaje" class="form-control" id="porcentaje" placeholder="%" aria-invalid="false" value="0.0">
                    <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-percent"></i></span>
                    </div>
                </div>                
            </div>

            <div class="input-group">
                <div class="custom-file">                                    
                    <input required  type="file" class="custom-file-input" id="contrato" name="contrato">
                    <label class="custom-file-label" for="contrato">Contrato</label>                                    
                </div>                      
            </div>
        </div>
        <div class="modal-footer">
            <button style="" type="submite" class="confirmarclick btn btn-info" data-texto="¿Los datos son correctos?<br>1.-Asigna el descuento(0 en caso de no contar con descuento).<br>2.-Revisa los datos.<br>3.-Confirma"><i class="fa fa-check" aria-hidden="true"><span>Confirmar</span></i></button>
        </div>
    </form>
    </div>
  </div>
</div>
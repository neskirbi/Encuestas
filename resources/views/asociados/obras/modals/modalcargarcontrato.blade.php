<!-- Modal -->
<div class="modal fade" id="cargar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form action="{{url('CargarContrato').'/'.$obra->id}}" method="POST" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Cargar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            @csrf                        
            <div class="input-group">
                <div class="custom-file">                                    
                    <input required  type="file" class="custom-file-input" id="contrato" name="contrato">
                    <label class="custom-file-label" for="contrato">Contrato</label>                                    
                </div>                      
            </div>
        </div>
        <div class="modal-footer">
            <button style="" type="submite" class="confirmarclick btn btn-info" data-texto="¿Desea cargar este contrato?"><i class="fa fa-check" aria-hidden="true"><span> Cargar</span></i></button>
        </div>
    </form>
    </div>
  </div>
</div>
<!-- Button trigger modal -->
<button type="button" style="display:none;" class="btn btn-primary" id="BotonModalAlerta" data-toggle="modal" data-target="#AlertaModal">
  Mostrar Alerta
</button>

<!-- Modal -->
<div class="modal fade" id="AlertaModal" tabindex="-1" role="dialog" aria-labelledby="AlertaModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Alerta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> 
      </div>
      <div class="modal-body">
        <p id="AlertaBody"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
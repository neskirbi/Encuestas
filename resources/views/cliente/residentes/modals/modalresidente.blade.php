<!-- Modal -->
<div class="modal fade" id="modalresidente" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Registrar Residente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="residentes" >
        @csrf
      <div class="modal-body">
       
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-user"></i></span>
          </div>
          <input type="text" name="nombre" class="form-control" placeholder="Nombre" required>
        </div>

        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
          </div>
          <input type="text" name="mail" class="form-control" placeholder="Correo" required>
        </div>

        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-key"></i></span>
          </div>
          <input type="text" name="pass" class="form-control" placeholder="Contraseña" required>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Obras</label>
              <select multiple="" class="form-control" name="contenedor" id="contenedor" >
                @foreach($obras as $obra)
                <option onclick="AsignarObra(this);" value="{{$obra->id}}">{{$obra->obra}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Obras Asiganadas</label>
              <select multiple="" class="form-control" name="obras[]" id="obras" required>
             
              </select>
            </div>
          </div>
        </div>
      </div>
      
      <div class="modal-footer">
        <button type="submit" class="btn btn-info">Listo</button>
      </div>
    </form>
    </div>
  </div>
</div>
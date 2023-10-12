<!-- ModalRegistro -->
<div class="modal fade" id="modalchofer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Chófer</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form method="post" action="choferes">
                @csrf
                <div class="card-body">

                    <div class="form-group">
                        <label for="vehiculo">Vehículo</label>
                        <select required type="text" name="vehiculo" class="form-control" id="vehiculo" aria-invalid="false" >
                        <option value="">--Seleccionar vehículo--</option>
                        @foreach($vehiculos as $vehiculo)
                        <option value="{{$vehiculo->id}}">{{$vehiculo->matricula}}</option>
                        @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="nombres">Nombre(s)</label>
                        <input required type="text" name="nombres" class="form-control" id="nombres" placeholder="Nombre(s)" aria-invalid="false" >
                    </div>

                    <div class="form-group">
                        <label for="apellidos">Apellidos</label>
                        <input required type="text" name="apellidos" class="form-control" id="apellidos" placeholder="Apellidos" aria-invalid="false" >
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
<!-- ModalRegistro -->
<div class="modal fade" id="modaldescuentos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <form action="descuentos" method="POST">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Otorgar Descuento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="obra">Cliente</label>
                    <select required class="form-control" name="obra" id="obra">
                        <option value="">--Obra--</option>
                        @foreach($obras as $obra)
                        <option value="{{$obra->id}}">{{$obra->obra}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="porcentaje">Descuento</label>
                            <div class="input-group mb-3">
                                <input required type="number" step="0.01" min="1" max="100" name="porcentaje" class="form-control" id="porcentaje" placeholder="%" aria-invalid="false" >
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-percent"></i></span>
                                </div>
                            </div>
                        </div>   
                    </div>
                </div>
                                     
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Guardar</button>                        
            </div>
            </form>
        
        </div>
    </div>
</div>
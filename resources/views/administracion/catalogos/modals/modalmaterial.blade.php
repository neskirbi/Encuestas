<!-- ModalRegistro -->
<div class="modal fade" id="modalmaterial" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="guardarmaterialadm" method="POST" id="formmaterial">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Material</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                    @csrf

                    <div class="form-group">
                        <label for="categoriamaterial">Categoría Material</label>
                        <select required class="form-control" id="categoriamaterial" name="categoriamaterial">
                            <option value="">--Seleccionar Categoría--</option>
                            @foreach($categoriasmateriales as $categoriamaterial)
                            <option value="{{$categoriamaterial->id}}">{{$categoriamaterial->categoriamaterial}}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="material">Material</label>
                        <input required type="text" class="form-control" id="material" name="material" placeholder="Material">
                    </div>

                    <div class="form-group">
                        <label for="precio">Precio</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input required type="number" step="0.01" class="form-control" id="precio" name="precio">                        
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
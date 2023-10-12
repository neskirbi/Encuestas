<!-- ModalRegistro -->
<div class="modal fade" id="modalcategoriamaterial" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="guardarcategoriamaterialadm" method="POST" id="formcategoriamaterial">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Categoría Material</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                    @csrf
                    <div class="form-group">
                        <label for="categoriamaterial">Categoría</label>
                        <input type="text" class="form-control" id="categoriamaterial" name="categoriamaterial" placeholder="Categoría">
                    </div>
                        
                    
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
            </form>  
        </div>
    </div>
</div>
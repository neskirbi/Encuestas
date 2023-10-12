<!-- ModalRegistro -->
<div class="modal fade" id="modalcomprobante" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <form action="{{ url('Cargarcomprobante') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card card-info modal-content">
            <div class="card-header">
                <h3 class="card-title">Comprobante de Pago</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">                       
                        <input required style="display:none;" type="text" name="pidcom" class="form-control" id="pidcom" aria-invalid="false" >
                    </div>                    
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="Comprobante">Comprobante</label>                                            
                            <div class="input-group">
                                <div class="custom-file">                                    
                                    <input  required type="file" class="custom-file-input" id="comprobante" name="comprobante">
                                    <label class="custom-file-label" for="Comprobante">Cargar en jpg</label>                                    
                                </div>                      
                            </div>
                        </div>
                    </div>
                   
                </div>


            </div>
            <div class="card-footer">
                <button class="btn btn-primary float-right">Guardar</button>
            </div>
        </form>
        </div>
    </div>
</div>
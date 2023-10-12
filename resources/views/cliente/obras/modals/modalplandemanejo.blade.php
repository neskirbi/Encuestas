<!-- ModalRegistro -->
<div class="modal fade" id="modalplanmanejo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{ url('cargarplan') }}/{{$obra->id}}" method="post" enctype="multipart/form-data">
        @csrf
        <input name="_method" type="hidden" value="PUT">
        <div class="card card-info modal-content">
            <div class="card-header">
                <h3 class="card-title">Plan de manejo de residuos</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nautorizacion">Numero de autorización</label>
                            <input required type="text" name="nautorizacion" class="form-control" id="nautorizacion" placeholder="Numero de autorización" aria-invalid="false" >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="vigenciaplan">Vigencia del plan de manejo</label>                                           
                            <input required type="date" name="vigenciaplan" class="form-control" id="vigenciaplan" placeholder="Vigencia del plan de manejo" aria-invalid="false">
                        </div>
                        
                    </div>
                </div>

                

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="declaratoria">Declaratoria o manifestación de impacto ambiental</label>                                            
                            <div class="input-group">
                                <div class="custom-file">                                    
                                    <input  required type="file" class="custom-file-input" id="declaratoria" name="declaratoria">
                                    <label class="custom-file-label" for="declaratoria">Cargar en pdf</label>                                    
                                </div>                      
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="planmanejo">Plan de manejo de residuos</label>                                            
                            <div class="input-group">
                                <div class="custom-file">                                    
                                    <input  required type="file" class="custom-file-input" id="planmanejo" name="planmanejo">
                                    <label class="custom-file-label" for="planmanejo">Cargar en pdf</label>                                    
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
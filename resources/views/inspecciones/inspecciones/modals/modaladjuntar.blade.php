<!-- Modal -->
<div class="modal fade" id="modaladjuntar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Adjuntar PDF</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{url('AdjuntarArchivos')}}" method="post" enctype='multipart/form-data'>
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="card">                    
                    <div class="card-body">
                        <div class="row" style="display:none;">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input required data-invalido="true" type="text" name="id" id="id"  class="form-control" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="adjuntar">Adjuntar PDF</label>
                                    <div class="input-group">
                                        <div class="custom-file">                                    
                                        <input required type="file" class="custom-file-input" id="archivo" name="archivo">
                                            <label class="custom-file-label" for="archivo">Adjuntar PDF</label>                                    
                                        </div>                      
                                    </div>
                                </div>
                            </div>
                        </div>                        
                    </div>
                </div>
            </div>
          
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">                    
                    <div class="card-body">
                        <button class="btn btn-info">Cargar</button>
                    </div>
                </div>
            </div>
        </div>
        </form>

        
        
      </div>
      <div class="modal-footer">
      
      </div>
    </div>
  </div>
</div>
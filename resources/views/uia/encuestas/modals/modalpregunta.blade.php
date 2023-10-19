<!-- Modal -->

<div class="modal fade" id="modalpregunta" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

  <div class="modal-dialog modal-dialog-centered" role="document">

    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title" id="exampleModalLongTitle">Pregunta</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

          <span aria-hidden="true">&times;</span>

        </button>

      </div>

      <div class="modal-body">

        <form action="{{url('formularios')}}" method="post">

        @csrf

        <div class="row">

            <div class="col-md-12">

                <div class="card">                    

                    <div class="card-body">

                        <div class="row" style="display:none;">

                            <div class="col-md-12">

                                <div class="form-group">

                                    <input required data-invalido="true" type="text" name="id" id="id"  class="form-control" aria-invalid="false" min="1" step="0.01" value="{{$id}}">

                                </div>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-12">

                                <div class="form-group">

                                    <label for="tipo">Tipo de Pregunta</label>

                                    <select required type="text" name="tipo" class="form-control" id="tipo" aria-invalid="false" onchange="PonExtra(this);">

                                        <option value="">--Selecciones un Tipo--</option>

                                        <option value="0">Encabezado</option>

                                        <option value="1">Texto</option>

                                        <option value="3">Select</option>                                        

                                        <option value="4">Foto</option>                                        
                                        
                                        <option value="5">Ubicación</option>

                                    

                                    </select>

                                </div>

                            </div>

                        </div>

                        <div id="extra"></div>

                        

                        <div class="row">

                            <div class="col-md-3">

                                <div class="form-group">

                                    <label for="orden">Orden</label>

                                    <input required data-invalido="true" type="number" name="orden" id="orden"  class="form-control" aria-invalid="false" min="1" step="0.01" value="">

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

                        <button class="btn btn-info">Generar</button>

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
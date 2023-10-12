<!-- ModalRegistro -->
<div class="modal fade" id="mtransporte" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{ url('AgregarTransporte')}}/{{$obra->id}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card card-info modal-content">
            <div class="card-header">
                <h3 class="card-title">Agregar Transporte</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="nautorizacion">Transporte</label>
                            <select required name="transporte" id="transporte" class="form-control" onchange="CargarTransporte(this);">
                            <option value="">--Transporte--</option>
                                @foreach($transportes as $transporte)
                                <option value="{{$transporte->id}}" data-precio="{{$transporte->precio}}" data-descripcion="{{$transporte->descripcion}}">{{$transporte->transporte}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="precio">Precio</label>                                                                      
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id=""><i class="fa fa-usd" aria-hidden="true"></i></span>
                                </div>
                                <input  type="number" class="form-control" id="preciot" name="precio" min="0" step="0.0001">
                                <p style="color:#3c3c3c; font-size:13px;">Manejar el precio por viaje a la obra.</p>
                            </div>
                        </div>
                    </div>
                   
                </div>

                

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="vigenciaplan">Descripción</label>   
                            <textarea disabled name="" id="descripciont" class="form-control"></textarea>                                        
                        </div>
                        
                    </div>
                </div>

                

                
            </div>
            <div class="card-footer">
                <button class="btn btn-primary float-right">Agregar</button>
            </div>
            </form>
        </div>
    </div>
</div>
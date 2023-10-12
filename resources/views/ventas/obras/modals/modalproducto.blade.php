<!-- ModalRegistro -->
<div class="modal fade" id="mproducto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{ url('AgregarProducto')}}/{{$obra->id}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card card-info modal-content">
            <div class="card-header">
                <h3 class="card-title">Agregar Producto</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="nautorizacion">Producto</label>
                            <select required name="producto" id="producto" class="form-control" onchange="CargarProducto(this);">
                            <option value="">--Productos--</option>
                                @foreach($productos as $producto)
                                <option value="{{$producto->id}}" data-precio="{{$producto->precio}}" data-descripcion="{{$producto->descripcion}}">{{$producto->producto}}</option>
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
                                <input  type="number" class="form-control" id="precio" name="precio" min="0" step="0.0001">
                            </div>
                        </div>
                    </div>
                   
                </div>

                

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="vigenciaplan">Descripción</label>   
                            <textarea disabled name="" id="descripcionp" class="form-control"></textarea>                                        
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
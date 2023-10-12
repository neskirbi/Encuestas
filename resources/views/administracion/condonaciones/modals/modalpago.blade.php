<!-- ModalRegistro -->
<div class="modal fade" id="modalcondonacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
           
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-university" aria-hidden="true"></i> Transferencia Bancaria</h4></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                <form action="{{url('condonaciones')}}" method="POST">
                    @csrf
                   
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                        <div class="boxpago" style="">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input required type="text" onblur="FormatNumber(this)" id="pmonto" name="pmonto" class="form-control" placeholder="Monto">
                                
                                <div class="input-group-append">
                                </div>
                            </div>
                        </div>
                        
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">&nbsp;</div>
                    </div>
                    <div class="row">
                        <div class="col-md-12"> 
                            <div class="form-group">
                                <label for="pobra">Obra</label>
                                
                                <select class="form-control" name="pobra" id="pobra" aria-invalid="false" onchange="GetGeneradorDatos(this);">
                                    <option value="0">--Obra--</option>
                                    @foreach($pobras as $pobra)
                                    <option value="{{$pobra->id}}" title="{{$pobra->obra}}" data-planta="{{$pobra->planta}}">{{strlen($pobra->obra)<100 ? $pobra->obra : mb_substr($pobra->obra,0,99,"UTF-8").' ...'}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                        <div class="form-group">
                            <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-recycle" aria-hidden="true"></i></span>
                            </div>
                            <input disabled type="text" id="pplanta" name="pplanta" class="form-control"  value="" >
                            
                            <input type="text" id="pidcliente" name="pidcliente" style="display:none;">
                            <div class="input-group-append">
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    
                   
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="detalle">Detalle</label>
                                <textarea required name="detalle" id="detalle" placeholder="Detalle" class="form-control"></textarea>
                            </div>
                            
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submite" class="btn btn-info">Generar</button>
                        <p style="color:#ff0000;">Después de generar el pago, favor de revisar el apartado de pagos  Dashboard -> Pagos para verificar que se ha generado.</p>
                    
                    </div>
                        
                </form>
                        
                    
            </div>
          
            
        </div>
    </div>
</div>
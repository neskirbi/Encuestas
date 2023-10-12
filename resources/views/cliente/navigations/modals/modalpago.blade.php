<!-- ModalRegistro -->
<div class="modal fade" id="modalpago" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
           
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-university" aria-hidden="true"></i> Transferencia Bancaria</h4></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                <form action="{{url('PagoCliente')}}" method="POST" id="FormPagoCliente">
                    @csrf
                   
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                        <div class="boxpago" style="">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input type="text" onblur="FormatNumber(this)" id="pmonto" name="pmonto" class="form-control" placeholder="Monto">
                                
                                <div class="input-group-append">
                                </div>
                            </div>
                            <input data-invalido="true" type="text" id="pid" name="pid" style="display:none;">
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
                                <?php $pobras=GetObrasPago();?>
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
                            <div class="input-group-append">
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                        <div class="form-group">
                            <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-user" aria-hidden="true"></i></span>
                            </div>
                            <input type="text" id="pnombre" name="pnombre" class="form-control" placeholder="Nombre Completo" value="" required>
                            <div class="input-group-append">
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-10">
                        <div class="input-group">
                            <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-map" aria-hidden="true"></i></span>
                            </div>
                            <input type="text" id="pdireccion" name="pdireccion" class="form-control" placeholder="Dirección" required>
                            <div class="input-group-append">
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                        <div class="form-group">
                            <label for="entidad">C.P.</label>
                            <input type="text" id="pcp" name="pcp" class="form-control" placeholder="Código Postal" required>
                        </div> 
                        </div>
                        <div class="col-md-5">
                        <div class="form-group">
                            <label for="municipio">Alcaldía/Municipio</label>
                            <input type="text" id="pmunicipio" name="pmunicipio" class="form-control" placeholder="Alcaldía/Municipio" required>
                        </div> 
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                        <div class="form-group">
                            <label for="entidad">Entidad federativa</label>
                            <!--<input  type="text" name="entidad" class="form-control" id="entidad" placeholder="Entidad federativa" aria-invalid="false" >-->
                            <select required name="pentidad" class="form-control" id="pentidad" aria-invalid="false" >
                            <option value="">--Entidad Federativa--</option>
                            <option value="Aguascalientes">Aguascalientes</option>
                            <option value="Baja California">Baja California</option>
                            <option value="Baja California Sur">Baja California Sur</option>
                            <option value="Campeche">Campeche</option>
                            <option value="Chiapas">Chiapas</option>
                            <option value="Chihuahua">Chihuahua</option>
                            <option value="CDMX">Ciudad de México</option>
                            <option value="Coahuila">Coahuila</option>
                            <option value="Colima">Colima</option>
                            <option value="Durango">Durango</option>
                            <option value="Estado de México">Estado de México</option>
                            <option value="Guanajuato">Guanajuato</option>
                            <option value="Guerrero">Guerrero</option>
                            <option value="Hidalgo">Hidalgo</option>
                            <option value="Jalisco">Jalisco</option>
                            <option value="Michoacán">Michoacán</option>
                            <option value="Morelos">Morelos</option>
                            <option value="Nayarit">Nayarit</option>
                            <option value="Nuevo León">Nuevo León</option>
                            <option value="Oaxaca">Oaxaca</option>
                            <option value="Puebla">Puebla</option>
                            <option value="Querétaro">Querétaro</option>
                            <option value="Quintana Roo">Quintana Roo</option>
                            <option value="San Luis Potosí">San Luis Potosí</option>
                            <option value="Sinaloa">Sinaloa</option>
                            <option value="Sonora">Sonora</option>
                            <option value="Tabasco">Tabasco</option>
                            <option value="Tamaulipas">Tamaulipas</option>
                            <option value="Tlaxcala">Tlaxcala</option>
                            <option value="Veracruz">Veracruz</option>
                            <option value="Yucatán">Yucatán</option>
                            <option value="Zacatecas">Zacatecas</option>
                            </select>
                        </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info"  data-texto="¿Desea generar una referencia para realizar un pago?" aria-hidden="true" onclick="Submite('FormPagoCliente',this)"> <i class="fa fa-dollar"></i> Generar Pago</button>
                        <p style="color:#ff0000;">Después de generar el pago, favor de revisar el apartado de pagos  Dashboard -> Pagos para verificar que se ha generado.</p>
                    
                    </div>
                        
                </form>
                        
                    
            </div>
          
            
        </div>
    </div>
</div>
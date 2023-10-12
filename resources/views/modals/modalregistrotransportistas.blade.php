<!-- ModalRegistro -->
<div class="modal fade bd-example-modal-sm" id="registrotransportistas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="{{url('transportista')}}">
            <div class="modal-body">
                @csrf
                <div class="form-group">
                    <label for="transportista">Nombre</label>
                    <input required type="text" class="form-control" id="transportista" name="transportista" minlength="1" maxlength="150" placeholder="Nombre">
                </div>

               <div class="form-group">
                    <label for="mail">Correo</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fa fa-envelope" aria-hidden="true"></i></div>
                        </div>                        
                        <input required  autocomplete="false" type="email" class="form-control" id="mail" name="mail" minlength="1" maxlength="150" placeholder="Correo" value="">
                        
                    </div>
                </div>

                <div class="form-group">
                    <label for="pass">Contraseña</label>
                    <input required autocomplete="false" onkeyup="ValidarPassRegistro();" type="password" class="form-control" id="pass" minlength="4" maxlength="10" name="pass" placeholder="Contraseña" value="">
                </div>

                <div class="form-group">
                    <label for="passconfirm">Confirmar Contraseña</label>
                    <input required autocomplete="false" onkeyup="ValidarPassRegistro();" type="password" class="form-control" id="pass2" minlength="4" maxlength="10" name="pass2" placeholder="Confirmar Contraseña" value="">
                </div>

                
                <!--<div class="form-group">
                    <label for="passconfirm">¿Acepta Términos y Condiciones?</label>
                    <a href="terminosycondiciones" target="_blank">Términos y Condiciones</a>
                    <input required autocomplete="false" type="checkbox" class="form-control" style="width:20px;" id="accept" name="accept">
                </div>-->
                    
            </div>   
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Enviar</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- ModalRegistro -->
<div class="modal fade bd-example-modal-sm" id="login" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Clientes</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="{{url('login2')}}">
            @csrf
            <div class="modal-body">
                
                <div class="form-group">
                    <label for="mail">Correo</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fa fa-envelope" aria-hidden="true"></i></div>
                        </div>                        
                        <input required type="email" class="form-control" id="mail" name="mail" placeholder="Correo">                     
                    </div>
                </div>

                <div class="form-group">
                    <label for="pass">Contraseña</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fa fa-key" aria-hidden="true"></i></div>
                        </div>
                        <input required type="password" class="form-control" id="pass" name="pass" placeholder="Contraseña">
                    </div>
                </div>

                <div class="form-group">
                    <label for="passconfirm">¿Olvidaste tu contraseña?</label>
                    <br>
                    <a class="btn btn-default btn-outline-secondary" href="PassReset">Recuperar</a>                    
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Enviar</button>
            </div>
            </form>
        </div>
    </div>
</div>
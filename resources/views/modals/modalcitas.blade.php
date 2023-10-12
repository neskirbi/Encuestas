<!DOCTYPE html>
<html lang="en">
<head>
    @include('cliente.header')
    <title>Citas</title>
</head>
<body>
    @include('cliente.navbar')
    <div class="d-flex justify-content-center" style="background-color:#fff; border:solid 1px #ccc;">
        <form>
            <div class="form-row">
                <div class="col-md-4 mb-3">
                <label for="validationCustom01">First name</label>
                <input type="text" class="form-control" id="validationCustom01" placeholder="First name" value="Mark" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
                </div>
                <div class="col-md-4 mb-3">
                <label for="validationCustom02">Last name</label>
                <input type="text" class="form-control" id="validationCustom02" placeholder="Last name" value="Otto" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
                </div>
                <div class="col-md-4 mb-3">
                <label for="validationCustomUsername">Fecha</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupPrepend">@</span>
                    </div>
                    <input onclick="AbrirModalFechas();" type="text" class="form-control" id="validationCustomUsername" placeholder="Username" aria-describedby="inputGroupPrepend" required>
                    <div class="invalid-feedback">
                    Please choose a username.
                    </div>
                </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-6 mb-3">
                <label for="validationCustom03">Ubicación</label>
                <input onclick="AbrirModalMapa();" type="text" class="form-control" id="validationCustom03" placeholder="City" required>
                <div class="invalid-feedback">
                    Please provide a valid city.
                </div>
                </div>
                <div class="col-md-3 mb-3">
                <label for="validationCustom04">State</label>
                <input type="text" class="form-control" id="validationCustom04" placeholder="State" required>
                <div class="invalid-feedback">
                    Please provide a valid state.
                </div>
                </div>
                <div class="col-md-3 mb-3">
                <label for="validationCustom05">Zip</label>
                <input type="text" class="form-control" id="validationCustom05" placeholder="Zip" required>
                <div class="invalid-feedback">
                    Please provide a valid zip.
                </div>
                </div>
            </div>
            <div class="form-group">
                <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                <label class="form-check-label" for="invalidCheck">
                    Agree to terms and conditions
                </label>
                <div class="invalid-feedback">
                    You must agree before submitting.
                </div>
                </div>
            </div>
            <button class="btn btn-primary" type="submit">Submit form</button>
        </form>
    </div>
    
    
    <!-- Modalfechas -->
    <div class="modal fade bd-example-modal-lg" id="fechas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Fecha</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Horario</th>
                            <th>Lunes 5 Mayo</th>
                            <th>Martes 6 Mayo</th>
                            <th>Miercoles 7 Mayo</th>
                            <th>Jueves 8 Mayo</th>
                            <th>Viernes 9 Mayo</th>
                            <th>Sabado 10 Mayo</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>9:00</td>
                            <td><img src="https://i.pinimg.com/originals/39/98/08/399808c7787f2c87cfa2b217deb4245b.png"  width="50px" alt=""></td>
                            <td><img src="https://i.pinimg.com/originals/39/98/08/399808c7787f2c87cfa2b217deb4245b.png"  width="50px" alt=""></td>
                            <td><img src="https://i.pinimg.com/originals/39/98/08/399808c7787f2c87cfa2b217deb4245b.png"  width="50px" alt=""></td>
                            <td><img src="https://i.pinimg.com/originals/39/98/08/399808c7787f2c87cfa2b217deb4245b.png"  width="50px" alt=""></td>
                            <td><img src="https://i.pinimg.com/originals/39/98/08/399808c7787f2c87cfa2b217deb4245b.png"  width="50px" alt=""></td>
                            <td><img src="https://i.pinimg.com/originals/39/98/08/399808c7787f2c87cfa2b217deb4245b.png"  width="50px" alt=""></td>
                            <td><img src="https://i.pinimg.com/originals/39/98/08/399808c7787f2c87cfa2b217deb4245b.png"  width="50px" alt=""></td>
                        </tr>
                        <tr>
                            <td>10:00</td>
                            <td><img src="https://i.pinimg.com/originals/39/98/08/399808c7787f2c87cfa2b217deb4245b.png"  width="50px" alt=""></td>
                            <td><img src="https://i.pinimg.com/originals/39/98/08/399808c7787f2c87cfa2b217deb4245b.png"  width="50px" alt=""></td>
                            <td><img src="https://i.pinimg.com/originals/39/98/08/399808c7787f2c87cfa2b217deb4245b.png"  width="50px" alt=""></td>
                            <td><img src="https://i.pinimg.com/originals/39/98/08/399808c7787f2c87cfa2b217deb4245b.png"  width="50px" alt=""></td>
                            <td><img src="https://i.pinimg.com/originals/39/98/08/399808c7787f2c87cfa2b217deb4245b.png"  width="50px" alt=""></td>
                            <td><img src="https://i.pinimg.com/originals/39/98/08/399808c7787f2c87cfa2b217deb4245b.png"  width="50px" alt=""></td>
                            <td><img src="https://i.pinimg.com/originals/39/98/08/399808c7787f2c87cfa2b217deb4245b.png"  width="50px" alt=""></td>
                        </tr>
                        <tr>
                            <td>11:00</td>
                            <td><img src="https://i.pinimg.com/originals/39/98/08/399808c7787f2c87cfa2b217deb4245b.png"  width="50px" alt=""></td>
                            <td><img src="https://i.pinimg.com/originals/39/98/08/399808c7787f2c87cfa2b217deb4245b.png"  width="50px" alt=""></td>
                            <td><img src="https://i.pinimg.com/originals/39/98/08/399808c7787f2c87cfa2b217deb4245b.png"  width="50px" alt=""></td>
                            <td><img src="https://i.pinimg.com/originals/39/98/08/399808c7787f2c87cfa2b217deb4245b.png"  width="50px" alt=""></td>
                            <td><img src="https://i.pinimg.com/originals/39/98/08/399808c7787f2c87cfa2b217deb4245b.png"  width="50px" alt=""></td>
                            <td><img src="https://i.pinimg.com/originals/39/98/08/399808c7787f2c87cfa2b217deb4245b.png"  width="50px" alt=""></td>
                            <td><img src="https://images.emojiterra.com/google/android-11/512px/1f7e5.png"  width="50px" alt=""></td>
                        </tr>
                        <tr>
                            <td>12:00</td>
                            <td><img src="https://i.pinimg.com/originals/39/98/08/399808c7787f2c87cfa2b217deb4245b.png"  width="50px" alt=""></td>
                            <td><img src="https://i.pinimg.com/originals/39/98/08/399808c7787f2c87cfa2b217deb4245b.png"  width="50px" alt=""></td>
                            <td><img src="https://i.pinimg.com/originals/39/98/08/399808c7787f2c87cfa2b217deb4245b.png"  width="50px" alt=""></td>
                            <td><img src="https://images.emojiterra.com/google/android-11/512px/1f7e5.png"  width="50px" alt=""></td>
                            <td><img src="https://i.pinimg.com/originals/39/98/08/399808c7787f2c87cfa2b217deb4245b.png"  width="50px" alt=""></td>
                            <td><img src="https://i.pinimg.com/originals/39/98/08/399808c7787f2c87cfa2b217deb4245b.png"  width="50px" alt=""></td>
                            <td><img src="https://i.pinimg.com/originals/39/98/08/399808c7787f2c87cfa2b217deb4245b.png"  width="50px" alt=""></td>
                        </tr>
                        <tr>
                            <td>13:00</td>
                            <td><img src="https://i.pinimg.com/originals/39/98/08/399808c7787f2c87cfa2b217deb4245b.png"  width="50px" alt=""></td>
                            <td><img src="https://i.pinimg.com/originals/39/98/08/399808c7787f2c87cfa2b217deb4245b.png"  width="50px" alt=""></td>
                            <td><img src="https://i.pinimg.com/originals/39/98/08/399808c7787f2c87cfa2b217deb4245b.png"  width="50px" alt=""></td>
                            <td><img src="https://i.pinimg.com/originals/39/98/08/399808c7787f2c87cfa2b217deb4245b.png"  width="50px" alt=""></td>
                            <td><img src="https://i.pinimg.com/originals/39/98/08/399808c7787f2c87cfa2b217deb4245b.png"  width="50px" alt=""></td>
                            <td><img src="https://i.pinimg.com/originals/39/98/08/399808c7787f2c87cfa2b217deb4245b.png"  width="50px" alt=""></td>
                            <td><img src="https://i.pinimg.com/originals/39/98/08/399808c7787f2c87cfa2b217deb4245b.png"  width="50px" alt=""></td>
                        </tr>
                    </tbody>
                </table>
                
            </div>
            <!--<div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>-->
            </div>
        </div>
    </div>

    <!-- Modalubicacion -->
    <div class="modal fade bd-example-modal-lg" id="mapa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubicación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="https://storage.googleapis.com/support-forums-api/attachment/thread-9014924-11470506657998028469.JPG" width="100%" alt="">
                
            </div>
            <!--<div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>-->
            </div>
        </div>
    </div>
</body>
</html>
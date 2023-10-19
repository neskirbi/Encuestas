<div class="row">

    <div class="col-md-12">

        <div class="card">                    

            <div class="card-body">

                <?php

                $preguntasid=array();

                $fotosid=array();

                foreach($preguntas as $pregunta){

                    if($edit==1){

                        echo('<hr>');

                    }

                    switch($pregunta->tipo){



                        case 0:

                            //$preguntasid[]=$pregunta->id;

                            ?>

                            @if($edit==1)

                            <div class="row">

                                <div class="col-md-12">

                                    <form action="{{url('formularios')}}/{{$pregunta->id}}" method="post">

                                    @csrf

                                    @method("DELETE")

                                    <button class="btn btn-danger btn-sm float-right"><i class="fa fa-times" aria-hidden="true"></i></button>

                                    </form>

                                </div>

                            </div>

                            @endif

                            <div class="row">

                                <div class="col-md-12">

                                    <div class="callout callout-warning">

                                        <h5>{{$pregunta->pregunta}}</h5>

                                    </div>

                                </div>

                            </div>



                            

                            @if($edit==1)

                            <form action="{{url('UpdatePregunta')}}/{{$pregunta->id}}" method="post">

                            @csrf

                            <div class="row">

                                <div class="col-md-12">

                                    <div class="form-group">

                                        <label for="orden">Encabezado</label>

                                        <input required data-invalido="true" type="text" name="texto" id="texto"  class="form-control" aria-invalid="false" value="{{$pregunta->pregunta}}">

                                    </div>

                                </div>

                            </div>

                            

                            <div class="row">

                                <div class="col-md-2">

                                    <div class="form-group">

                                        <label for="orden">Orden</label>

                                        <input required data-invalido="true" type="number" name="orden" id="orden"  class="form-control" aria-invalid="false" min="1" step="0.01" value="{{$pregunta->orden}}">

                                    </div>

                                </div>

                            </div>





                            <div class="row">

                                <div class="col-md-3">

                                    <div class="form-group">

                                        <button class="btn btn-warning">Actualizar</button>

                                    </div>

                                </div>

                            </div>

                            </form>

                            @endif

                    



                            <?php

                        break;





                        case 1:

                            $preguntasid[]=$pregunta->id;

                            ?>

                                @if($edit==1)

                                <div class="row">

                                    <div class="col-md-12">

                                        <form action="{{url('formularios')}}/{{$pregunta->id}}" method="post">

                                        @csrf

                                        @method("DELETE")

                                        <button class="btn btn-danger btn-sm float-right"><i class="fa fa-times" aria-hidden="true"></i></button>

                                        </form>

                                    </div>

                                </div>

                                @endif

                                <div class="row">

                                    <div class="col-md-12">

                                        <div class="form-group">

                                            <label for="pregunta">{{$pregunta->pregunta}}</label>

                                            <input required data-invalido="true" type="text" name="pregunta[]" id="pregunta"  class="form-control" aria-invalid="false">

                                        </div>

                                    </div>

                                </div>



                                

                                @if($edit==1)

                                <form action="{{url('UpdatePregunta')}}/{{$pregunta->id}}" method="post">

                                @csrf

                                <div class="row">

                                    <div class="col-md-12">

                                        <div class="form-group">

                                            <label for="orden">Encabezado</label>

                                            <input required data-invalido="true" type="text" name="texto" id="texto"  class="form-control" aria-invalid="false" value="{{$pregunta->pregunta}}">

                                        </div>

                                    </div>

                                </div>

                                

                                <div class="row">

                                    <div class="col-md-2">

                                        <div class="form-group">

                                            <label for="orden">Orden</label>

                                            <input required data-invalido="true" type="number" name="orden" id="orden"  class="form-control" aria-invalid="false" min="1" step="0.01" value="{{$pregunta->orden}}">

                                        </div>

                                    </div>

                                </div>





                                <div class="row">

                                    <div class="col-md-3">

                                        <div class="form-group">

                                            <button class="btn btn-warning">Actualizar</button>

                                        </div>

                                    </div>

                                </div>

                                </form>

                                @endif

                        



                                <?php

                            break;

                            

                            case 2:

                            

                            break;

                            

                            case 3:

                                $preguntasid[]=$pregunta->id;

                                $opciones=explode(',',$pregunta->opciones);

                                ?>

                

                                @if($edit==1)

                                

                                <div class="row">

                                    <div class="col-md-12">

                                        <form action="{{url('formularios')}}/{{$pregunta->id}}" method="post">

                                        @csrf

                                        @method("DELETE")

                                        <button class="btn btn-danger btn-sm float-right"><i class="fa fa-times" aria-hidden="true"></i></button>

                                        </form>

                                    </div>

                                </div>

                                @endif

                                <div class="row">

                                    <div class="col-md-12">

                                        <div class="form-group">

                                            <label for="pregunta">{{$pregunta->pregunta}}</label>

                                            <select required name="pregunta[]" id="pregunta" class="form-control">

                                            <option value="">----</option>

                                            @foreach($opciones as $opcion)

                                            <option value="{{$opcion}}">{{$opcion}}</option>

                                            @endforeach

                                        </select>

                                        </div>

                                    </div>

                                </div>



                                @if($edit==1)

                                <form action="{{url('UpdatePregunta')}}/{{$pregunta->id}}" method="post">

                                @csrf

                                <div class="row">

                                    <div class="col-md-12">

                                        <div class="form-group">

                                            <label for="orden">Encabezado</label>

                                            <input required data-invalido="true" type="text" name="texto" id="texto"  class="form-control" aria-invalid="false" value="{{$pregunta->pregunta}}">

                                        </div>

                                    </div>

                                </div>





                                <div class="row">

                                    <div class="col-md-12">

                                        <div class="form-group">

                                            <label for="opciones">Opciones(Separadas por coma)</label>

                                            <textarea required data-invalido="true" type="text" name="opciones" id="opciones"  class="form-control" aria-invalid="false">{{$pregunta->opciones}}</textarea>

                                        </div>

                                    </div>

                                </div>

                                

                                <div class="row">

                                    <div class="col-md-2">

                                        <div class="form-group">

                                            <label for="orden">Orden</label>

                                            <input required data-invalido="true" type="number" name="orden" id="orden"  class="form-control" aria-invalid="false" min="1" step="0.01" value="{{$pregunta->orden}}">

                                        </div>

                                    </div>

                                </div>





                                <div class="row">

                                    <div class="col-md-3">

                                        <div class="form-group">

                                            <button class="btn btn-warning">Actualizar</button>

                                        </div>

                                    </div>

                                </div>

                                </form>

                                @endif



                                <?php

                            break;



                            case 4:

                                $fotosid[]=$pregunta->id;

                                ?>

                

                                @if($edit==1)

                                <div class="row">

                                    <div class="col-md-12">

                                        <form action="{{url('formularios')}}/{{$pregunta->id}}" method="post">

                                        @csrf

                                        @method("DELETE")

                                        <button class="btn btn-danger btn-sm float-right"><i class="fa fa-times" aria-hidden="true"></i></button>

                                        </form>

                                    </div>

                                </div>

                                @endif

                                <div class="row">

                                    <div class="col-md-12">

                                        <div class="form-group">

                                            <label for="pregunta">{{$pregunta->pregunta}}</label>

                                            <div class="input-group">

                                                <div class="custom-file">                                    

                                                <input required type="file" class="custom-file-input" id="foto" name="foto[]">

                                                    <label class="custom-file-label" for="foto">{{$pregunta->pregunta}}</label>                                    

                                                </div>                      

                                            </div>

                                        </div>

                                    </div>

                                </div>



                                @if($edit==1)

                                <form action="{{url('UpdatePregunta')}}/{{$pregunta->id}}" method="post">

                                @csrf

                                <div class="row">

                                    <div class="col-md-12">

                                        <div class="form-group">

                                            <label for="orden">Encabezado</label>

                                            <input required data-invalido="true" type="text" name="texto" id="texto"  class="form-control" aria-invalid="false" value="{{$pregunta->pregunta}}">

                                        </div>

                                    </div>

                                </div>

                                

                                <div class="row">

                                    <div class="col-md-2">

                                        <div class="form-group">

                                            <label for="orden">Orden</label>

                                            <input required data-invalido="true" type="number" name="orden" id="orden"  class="form-control" aria-invalid="false" min="1" step="0.01" value="{{$pregunta->orden}}">

                                        </div>

                                    </div>

                                </div>





                                <div class="row">

                                    <div class="col-md-3">

                                        <div class="form-group">

                                            <button class="btn btn-warning">Actualizar</button>

                                        </div>

                                    </div>

                                </div>

                                </form>

                                @endif

                        



                                <?php

                            break;


                            case 5:

                                //$preguntasid[]=$pregunta->id;
    
                                ?>
    
                                @if($edit==1)
    
                                <div class="row">
    
                                    <div class="col-md-12">
    
                                        <form action="{{url('formularios')}}/{{$pregunta->id}}" method="post">
    
                                        @csrf
    
                                        @method("DELETE")
    
                                        <button class="btn btn-danger btn-sm float-right"><i class="fa fa-times" aria-hidden="true"></i></button>
    
                                        </form>
    
                                    </div>
    
                                </div>
    
                                @endif
    
                                <div class="row">
    
                                    <div class="col-md-12">
    
                                         <h5>{{$pregunta->pregunta}}</h5>
    
                                    </div>
    
                                </div>
    
    
    
                                
    
                                @if($edit==1)
    
                                <form action="{{url('UpdatePregunta')}}/{{$pregunta->id}}" method="post">
    
                                @csrf

                                
                              
    
                                <div class="row">
    
                                    <div class="col-md-12">
                                        
                                    
    
                                        <div class="form-group">
    
                                            <label for="orden">Ubiación</label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input data-invalido="true" type="text" name="latitud" disabled   class="form-control" aria-invalid="false" placeholder="Latitud" id="latitud">
                                                </div>
                                                <div class="col-md-6">
                                                    <input data-invalido="true" type="text" name="longitud" disabled   class="form-control" aria-invalid="false" placeholder="Longitud" id="longitud">
                                                </div>
                                            </div>
                                            <br>

                                            <div class="alert alert-danger alert-dismissible" id="uerror" style="display:none;">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                <h5><i class="icon fas fa-check"></i> Error!</h5>
                                                No se puede obtener ubicación.
                                            </div>
    
                                            <div class="alert alert-success alert-dismissible" id="ucorrecto" style="display:none;">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                <h5><i class="icon fas fa-check"></i> Correcto!</h5>
                                                Ubicado.
                                            </div>
    
                                        </div>
    
                                    </div>
    
                                </div>
    
                                
    
                                <div class="row">
    
                                    <div class="col-md-2">
    
                                        <div class="form-group">
    
                                            <label for="orden">Orden</label>
    
                                            <input required data-invalido="true" type="number" name="orden" id="orden"  class="form-control" aria-invalid="false" min="1" step="0.01" value="{{$pregunta->orden}}">
    
                                        </div>
    
                                    </div>
    
                                </div>
    
                                <div class="row">
    
                                    <div class="col-md-3">
    
                                        <div class="form-group">
    
                                            <button class="btn btn-warning">Actualizar</button>
    
                                        </div>
    
                                    </div>
    
                                </div>
    
                                </form>
    
                                @endif
    
                        

                                <script>
                                    function funcionInit(){
                                        if (!"geolocation" in navigator) {
                                            return alert("Tu navegador no soporta el acceso a la ubicación. Intenta con otro");
                                        }

                                        const onUbicacionConcedida = ubicacion => {
                                            $("#latitud").val(ubicacion.coords.latitude);
                                            $("#longitud").val(ubicacion.coords.longitude);
                                            $('#confirmar').show();
                                            $('#advertencia').hide();
                                            console.log(ubicacion.coords.latitude);
                                        }
                                    
                                        const onErrorDeUbicacion = err => {
                                            console.log("Error obteniendo ubicación: ", err);
                                        }

                                        const opcionesDeSolicitud = {
                                            enableHighAccuracy: true, // Alta precisión
                                            maximumAge: 0, // No queremos caché
                                            timeout: 5000 // Esperar solo 5 segundos
                                        };
                                        // Solicitar
                                        navigator.geolocation.getCurrentPosition(onUbicacionConcedida, onErrorDeUbicacion, opcionesDeSolicitud);

                                    }
                                    function funcionInit(){
                                        if (!"geolocation" in navigator) {
                                            return alert("Tu navegador no soporta el acceso a la ubicación. Intenta con otro");
                                        }

                                        const onUbicacionConcedida = ubicacion => {
                                            $("#latitud").val(ubicacion.coords.latitude);
                                            $("#longitud").val(ubicacion.coords.longitude);                                            
                                            $('#uerror').hide();
                                            $('#ucorrecto').show();
                                            console.log(ubicacion.coords.latitude);
                                        }
                                    
                                        const onErrorDeUbicacion = err => {
                                            console.log("Error obteniendo ubicación: ", err);                                            
                                            $('#ucorrecto').hide();
                                            $('#uerror').show();
                                        }

                                        const opcionesDeSolicitud = {
                                            enableHighAccuracy: true, // Alta precisión
                                            maximumAge: 0, // No queremos caché
                                            timeout: 5000 // Esperar solo 5 segundos
                                        };
                                        // Solicitar
                                        navigator.geolocation.getCurrentPosition(onUbicacionConcedida, onErrorDeUbicacion, opcionesDeSolicitud);

                                    }


                                    funcionInit();
                                        
                                </script>    
    
    
                                <?php




                            break;

                        }

                    }

        

    

    

                    ?>



                </div>

            </div>

        </div>

    </div>





    @if($edit!=1)

    <div class="row"style="display:none;">

        <div class="col-md-12">

            <div class="card">                    

                <div class="card-body">

                <div class="row">

                        <div class="col-md-12">

                            <div class="form-group">

                                <input type="text" class="form-control" name="id_encuesta" value="{{$id_encuesta}}">

                            </div>

                        </div>

                    </div>



                    <div class="row">

                        <div class="col-md-12">

                            <div class="form-group">

                                <textarea class="form-control" name="preguntas" cols="30" rows="10">{{implode(",",$preguntasid)}}</textarea>

                            </div>

                        </div>

                    </div>



                    <div class="row">

                        <div class="col-md-12">

                            <div class="form-group">

                                <textarea class="form-control" name="fotos" cols="30" rows="10">{{implode(",",$fotosid)}}</textarea>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    @endif
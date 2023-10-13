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
                                    <form action="{{url('encuestas')}}/{{$pregunta->id}}" method="post">
                                    @csrf
                                    @method("DELETE")
                                    <button class="btn btn-danger btn-sm float-right"><i class="fa fa-times" aria-hidden="true"></i></button>
                                    </form>
                                </div>
                            </div>
                            @endif
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="callout callout-info">
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
                                        <form action="{{url('encuestas')}}/{{$pregunta->id}}" method="post">
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
                                        <form action="{{url('encuestas')}}/{{$pregunta->id}}" method="post">
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
                                        <form action="{{url('encuestas')}}/{{$pregunta->id}}" method="post">
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
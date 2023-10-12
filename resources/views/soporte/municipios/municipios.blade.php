<!DOCTYPE html>
<html lang="en">
<head>
  @include('soporte.header')
  <title>{{GetSiglas(0)}} | Municipios</title>

  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
@include('toast.toasts')  
<div class="wrapper">

  <!-- Navbar -->
 
  @include('soporte.navigations.navigation')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('soporte.sidebars.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
     
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><i class="nav-icon fa fa-map" aria-hidden="true"></i> <b>{{$entidad->entidad}}</b></h3>

                
                
              </div>
              <!-- /.card-header -->
              <div class="card-body" style="overflow-x:scroll;">

                <div class="p-2">
                  <button class="btn btn-primary" onclick="AddMunicipios(HtmltoArray('{{$opciones}}'));"><span><i class="fa fa-plus" aria-hidden="true"></i></span> Municipio</button>
                </div>

                <div class="row">
                  <div class="col-md-12" >
                   
                    <table class="table table-hover text-nowrap" id="municipios">
                      <thead>
                        <tr>
                        <th colspan="2">Municipio</th>
                        <th>Latitud</th> 
                        <th>Longitud</th>            
                        <th colspan="2">Opciones</th>
                        </tr>
                      </thead>
                      <tbody>
                    
                        @foreach($municipios as $index=>$municipio)
                        <tr>
                          <td  colspan="2" title="{{$municipio->entidad}}"><select class="form-control" id="entidad{{$index}}"><option value="{{$municipio->id_entidad}}">{{$municipio->entidad}}</option><optgroup></optgroup>{!!$opciones!!}</select>
                            <input type="text" class="form-control" id="municipio{{$index}}" placeholder="Municipio" value="{{$municipio->municipio}}">
                            <input style="display:none;" type="text" class="form-control" id="id{{$index}}" placeholder="Id" value="{{$municipio->id}}">
                          </td>
                          <td><input type="text" class="form-control" id="lat{{$index}}" placeholder="Latitud" value="{{$municipio->lat}}"></td>
                          <td><input type="text" class="form-control" id="lon{{$index}}" placeholder="Longitud" value="{{$municipio->lon}}"></td>
                          <td>
                            <button title="Guardar" class="btn btn-success" onclick="RevisaFormulario(this,{{$index}});"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>                          
                          </td>
                        </tr>
                        @endforeach
                        
                      </tbody>
                    </table>
                   
                  </div>
                </div>
                
                
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
             
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.1.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);

 
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App, funcion de sidebar -->
<script src="dist/js/adminlte.js"></script>

<script>
  var fila=-1;
  function AddMunicipios(opciones){
    var html='';
    html+='<tr id="'+fila+'">';
      html+='<td><select class="form-control" id="entidad'+fila+'"><option value="{{$entidad->id}}">{{$entidad->entidad}}</option><optgroup></optgroup>'+opciones+'</select>';
      html+='<input type="text" class="form-control" id="municipio'+fila+'" placeholder="Municipio">';
      html+='<input  style="display:none;" type="text" class="form-control" id="id'+fila+'" data-invalido="true"></td>';
      html+='<td><input type="text" class="form-control" id="lat'+fila+'" placeholder="Latitud"></td>';
      html+='<td><input type="text" class="form-control" id="lon'+fila+'" placeholder="Longitud"></td>';
      html+='<td>';
      html+='<button title="Guardar" class="btn btn-success" onclick="RevisaFormulario(this,'+fila+');"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>';
      html+='</td>';
      html+='<td>';
      html+='<button title="Borrar" class="btn btn-danger"><i class="fa fa-times" aria-hidden="true"></i> Borrar</button>';
      html+='</td>';
    html+='</tr>';

    $('#municipios').append(html);
    fila--;
  }

  function RevisaFormulario(_this,row){
    console.log(1);
    if(EsValido(row)){
      console.log(2);
        if(confirm("¿Los datos son correctos?")){ 
          console.log(3);
            bloqueaclick(_this);  
           
            var response = GuardarMunicipio(row);     
            desbloqueaclick(_this); 
        }
    }
  }

  function GuardarMunicipio(row){
    var id=$('#id'+row).val();
    var entidad=$('#entidad'+row).val();
    var municipio=$('#municipio'+row).val();
    var lat=$('#lat'+row).val();
    var lon=$('#lon'+row).val();
    console.log({id:id,entidad:entidad,municipio:municipio,lat:lat,lon:lon});
    $.ajax({      
      headers: { "APP-KEY": AppKey() },
      method:'post',
      url: Url()+"api/GuardarMunicipio",
      data:{id:id,entidad:entidad,municipio:municipio,lat:lat,lon:lon},
      context: document.body
    }).done(function(data) { 
      console.log(data);
      if(data.message!=''){
        id=$('#id'+row).val(data.message);
        location.reload();
      }
      
    });
  }
</script>

@include('soporte.footer')
</body>
</html>

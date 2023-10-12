<!DOCTYPE html>
<html lang="en">
<head>
    @include('sedema.header')
    <title>{{GetSiglas(0)}} | Citas y Folios</title>
</head>
<style>
    body {
    background-image: url("{{asset('images/portada.jpg')}}");
    background-size: cover;
    background-repeat: no-repeat;
    margin: 0;
    }
    .item-color{
        color:#fff;
    }
</style>
<body>
    @include('sedema.navigations.navbar')
    @include('toast.toasts')    
    <h2 class="text-center display-4">Buscador</h2>
      <div class="row">
          <div class="col-md-8 offset-md-2">
              <form action="simple-results.html">
                  <div class="input-group">
                      <input type="search" class="form-control form-control-lg" placeholder="Nombre de la obra">
                      <div class="input-group-append">
                          <button type="submit" class="btn btn-lg btn-default">
                              <i class="fa fa-search"></i>
                          </button>
                      </div>
                  </div>
              </form>
          </div>
      </div>


</body>

<script>

    
    $('.toastrDefaultSuccess').click(function() {
        toastr.success('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
    });

    $('.toastrDefaultError').click(function() {
      toastr.error('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
    });
</script>
@include('footer')

</html>
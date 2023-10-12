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
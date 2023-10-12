<!DOCTYPE html>
<html lang="en">
<head>
    @include('header')
   
  
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <title>{{GetSiglas(0)}} | Citas y Folios</title>

   
</head>
<style>
    
    
    .item-color{
        color:#fff;
    }

    .fondo {

        position: absolute;
        top:0px;
        z-index: -100;
        width:100%;
        margin: 0;
    }

    @media only screen and (max-width: 800px ) {
        .fondo {

            position: absolute;
            top:0px;
            z-index: -100;
            width:100%;
            margin: 0;
        }
        .caru{
            display: none;
        }
    }
    @media only screen and (min-width: 801px ) {

        .fondo {

          
        }

        .caru{
            width:100%;
            height:500px;
            margin-right:auto;
            margin-left:auto;
        }
    }
</style>
<body>
    
    

    @include('navbar')
    @include('toast.toasts')
    
    <img src="{{asset('images/portada.jpg')}}" alt="" class="fondo">




<!--<div style="height:100px; background-color:#1E1E1E; position:absolute; width:100%; bottom:0px;">
    <p><font color="#fff">Contacto</font></p>
    
</div>-->
</body>
        
    
    


    @include('footer')

</html>
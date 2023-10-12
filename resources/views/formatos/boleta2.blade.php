<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Citas</title>
    <style>
        .contenido{
            padding: 5px;
            border-radius:5px;
            background-color:#e5e4e2;
        }

        .contenido2{
            padding: 5px;
        }

        .letra{
            font-size:13px;
        }

        .letra2{
            font-size:10px;
        }

        @page{
		margin-bottom:50px;
        }
    
        
        footer {
            position: fixed;
            bottom: -40px;
            width: 100%;
            height:80px;
        }
        .hoja{
            page-break-after: always;
            text-align: justify;
            margin-bottom:20px;
        }
        .qr{
            background-image:url("{{url('images/qr/boleta/'.$cita->qr)}}");
            background-repeat:no-repeat;
            background-position:center;
            background-size: contain;
            float: right;


            width:90px;
            height:90px;
        }

        .qr2{
            border:1px #000 solid;
            width:90px;
            height:90px;
        }
        .firmas{
            display:inline-block;
            padding:10px;
            text-align:center;
            width:40%;
        }

        

    </style>
</head>
<body>
    <img src="{{$png}}" alt="" class="qr2" height="150px" width="150px" > 
    
    <img src="{{$svg}}" alt="" class="qr2" height="150px" width="150px" >

    
    
   

    
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Cedula</title>
</head>
<style>
	@page{
		margin-bottom:103px;
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
		position:absolute;
		right:0px;
	}
	.firmas{
		display:inline-block;
		padding:10px;
		text-align:center;
		width:40%;
	}
	body{
		font-family:Arial;
		font-size:12px;

		background-image: url("{{asset('images/cedulas/fondos/cedulaFondo1.jpg')}}");
		background-size: 700px;
		background-repeat: no-repeat;
		background-position: center top;

 		

	}
	
	

	

</style>

<body style="font-size:15px;">

<main>
	<div class="hoja">
		
		<br>
        <br>
        <br>
		<br>
        <br>
        <br>
		<br>
        <br>
        <br>
        <br>	
        
       
		<center>
			<h2>Cedula de identificación <br>para Recolección de <br>Residuos Sólidos Urbanos</h2>
			<img src="{{asset($url)}}" alt="QR" width="50%">
		</center>
		
       
		
        <br>
        <br>
		<p>
			<center>Fecha de Registro:{{FechaFormateada($negocio->created_at)}}<center>
		</p>
		<p>
			<center>Folio de Registro:{{($negocio->id)}}<center>
		</p>
		<p>
			<center>Número de Autorización:0000<center>
		</p>
		
		
		<p>
			<center>ESTE DOCUMENTO DEBERÁ EXHIBIRSE<center>
			<center>EN UN LUGAR VISIBLE PARA USO DE LA AUTORIDAD<center>
		</p>
		<hr   width=400 size="2px" color="purple">

		<p>
			<center>Palacio Municipal de Lázaro Cárdenas, Lic. Adolfo López Mateos 597<center>
			<center>C.P.77300 Centro, Kantunilkín, Quintana Roo, México.<center>
		</p>
		
	</div>
	
</main>
<script>
	$( document ).ready(function(){
		window.print();
	});
</script>
</body>
</html>
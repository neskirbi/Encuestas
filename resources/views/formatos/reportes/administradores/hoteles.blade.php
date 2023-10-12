<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
</head>
<body>
    <table border="1">
        <thead>
        <tr>
            <th>Nombre del Propietario</th>
            <th>Razón Social</th>
            <th>Nombre del Hotel</th>
            <th>Calle</th>
            <th>Número Ext.</th>
            <th>Número Int.</th>
            <th>Colonia</th>
            <th>Alcaldía/Municipio</th>
            <th>C.P.</th>
            <th>Entidad Federativa</th>
            <th>¿Cuántas habitaciones dispone su establecimiento para hospedar?</th>
            <th> ¿En qué categoría pertenece principalmente su establecimiento?</th>
            <th>¿Cuál es el aforo máximo en llaves del establecimiento?</th>
            <th>¿Cuántos m2 de superficie tiene su establecimiento?</th>
            <th>¿Cuántos empleados tiene?</th>
            <th>Aproximadamente, ¿qué porcentaje de sus trabajadores son mujeres?</th>
            <th>¿Cuántos años lleva su negocio abierto?</th>
            <th>¿Qué precio Tarifa maneja este establecimiento por noche?</th>
            <th>¿Se encuentra afiliado a la Asociación Mexicana de Hoteles y Moteles?</th>
            <th>¿Su establecimiento forma parte de una franquicia?</th>
            <th>¿Cómo es su tratamiento de Aguas Residuales?</th>
            <th>¿Qué tipos de Residuos Sólidos desecha con más frecuencia?</th>
            <th>¿Cuántas bolsas de basura genera su establecimiento al día?</th>
            <th>¿El año pasado realizó sus pagos al municipio de Lazaro Cardenas por la recolección de residuos que genera su establecimiento?</th>
            <th>¿Usted contrata a empresas certificadas para la recolección y manejo de residuos sólidos en la isla?</th>
            <th>¿En qué horario acostumbra usted sacar su basura?</th>
            <th>¿Donde coloca usted su basura?</th>
            <th>Wi-Fi</th>
            <th>Área Infantil.</th>
            <th>Aire acondicionado.</th>
            <th>Servicio de reservación.</th>
            <th>Entrega a Domicilio.</th>
            <th>Servicio para llevar.</th>
            <th>Trampas de grasa.</th>
            <th>¿Comparado con el mismo mes del año anterior, ¿cómo se comportaron las ventas de su empresa durante enero?</th>
            <th>¿Ha considerado cerrar su establecimiento de manera definitiva?</th>
            <th>¿Cuál considera que sería la principal razón para cerrar su establecimiento?</th>
            <th>¿Su establecimiento se ha visto en la necesidad de despedir personal debido a la contingencia?</th>
            <th>¿Qué porcentaje del total de su plantilla laboral considera que fue o se verá afectada?</th>
            <th>¿Ha implementado medidas sanitarias en su establecimiento?</th>
            <th>¿Qué medidas sanitarias implementó para su establecimiento?</th>
            <th>¿Qué Redes Sociales utiliza y como aparece en ellas?</th>
            <th>Facebook</th>
            <th>Instagram</th>
            <th>Twitter</th>
            <th>You Tube</th>
            <th>Tik Tok.</th>
        </tr>
        </thead>
        <tbody>
        @foreach($hoteles as $hotel)
        <?php $hotel=json_decode($hotel->json);?>
        <tr>                
            <td>{{$hotel->nombrepropietario}}</td>
            <td>{{$hotel->razonsocial}}</td>
            <td>{{$hotel->nombrehotel}}</td>
            <td>{{$hotel->calle}}</td>
            <td>{{$hotel->numeroext}}</td>
            <td>{{$hotel->numeroint}}</td>
            <td>{{$hotel->colonia}}</td>
            <td>{{$hotel->municipio}}</td>
            <td>{{$hotel->cp}}</td>
            <td>{{$hotel->entidad}}</td>
            <td>{{$hotel->numerohabitaciones}}</td>
            <td>{{$hotel->categoria}}</td>
            <td>{{$hotel->aforoenllaves}}</td>
            <td>{{$hotel->metrosestablecimiento}}</td>
            <td>{{$hotel->porcentmujeres}}</td>
            <td>{{$hotel->numeroempleados}}</td>
            <td>{{$hotel->añosnegocio}}</td>
            <td>{{$hotel->tarifanoche}}</td>
            <td>{{$hotel->afiliado}}</td>
            <td>{{$hotel->franquicia}}</td>
            <td>{{$hotel->tratamientoagua}}</td>
            <td>{{$hotel->desechoresiduos}}</td>
            <td>{{$hotel->numbolsasbasura}}</td>
            <td>{{$hotel->pagosrealizados}}</td>
            <td>{{$hotel->manejoresiduos}}</td>
            <td>{{$hotel->horariobasura}}</td>
            <td>{{$hotel->donde}}</td>
            <td>{{$hotel->wifi}}</td>
            <td>{{$hotel->areainfantil}}</td>
            <td>{{$hotel->aireacon}}</td>
            <td>{{$hotel->reservacion}}</td>
            <td>{{$hotel->entrega}}</td>
            <td>{{$hotel->llevar}}</td>
            <td>{{$hotel->trampas}}</td>
            <td>{{$hotel->ventas}}</td>
            <td>{{$hotel->cerrar}}</td>
            <td>{{$hotel->razon}}</td>
            <td>{{$hotel->despedir}}</td>
            <td>{{$hotel->plantilla}}</td>
            <td>{{$hotel->medidas}}</td>
            <td>{{$hotel->implemento}}</td>
            <td>{{$hotel->redsocial}}</td>
            <td>{{$hotel->facebook}}</td>
            <td>{{$hotel->instagram}}</td>
            <td>{{$hotel->twitter}}</td>
            <td>{{$hotel->youtube}}</td>
            <td>{{$hotel->tiktok}}</td>

        </tr>
        @endforeach
            
           
        </tbody>
        
    </table>
</body>
</html>

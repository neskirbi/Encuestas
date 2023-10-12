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
            <th>Nombre del propietario de este establecimiento:</th>
            <th>Raz&oacute;n Social:</th>
            <th>Teléfono</th>
            <th>Nombre completo del Contacto Comercial:</th>
            <th>Calle</th>
            <th>Número Ext.</th>
            <th>Número Int.</th>
            <th>Colonia</th>
            <th>Alcaldía/Municipio</th>
            <th>C.P.</th>
            <th>Entidad Federativa</th>
            <th>¿A qué giro pertenece principalmente su establecimiento?</th>
            <th>¿Cuántos comensales atiende este establecimiento (clientes sentados) ?</th>
            <th>¿Cuál es el aforo máximo del establecimiento?</th>
            <th>¿Cuántos m2 de superficie tiene su establecimiento?</th>
            <th>¿Cuántos años lleva su negocio abierto?</th>
            <th>¿Se encuentra afiliado a la Cámara Nacional de la Industria de Restaurantes y Alimentos Condimentados (CANIRAC) ?</th>
            <th>¿Su establecimiento forma parte de una franquicia?</th>
            <th>¿En qué categoría considera que se encuentra su restaurante?</th>
            <th>Wi-Fi</th>
            <th>Área Infantil.</th>
            <th>Aire acondicionado.</th>
            <th>Servicio de reservación.</th>
            <th>Entrega a Domicilio.</th>
            <th>Servicio para llevar.</th>
            <th>Trampas de grasa.</th>
            <th>¿Cómo se clasifica su restaurante?</th>
            <th>Rango de Precios por persona en el que se encuentra su restaurante?</th>
            <th>¿Practica usted el reciclaje de residuos sólidos?</th>
            <th>¿Qué tipos de Residuos Sólidos desecha con más frecuencia?</th>
            <th>¿Cuántas bolsas de basura genera su establecimiento al día?</th>
            <th>¿El año pasado realizó sus pagos al municipio de Lazaro Cardenas por la recolección de residuos que genera su establecimiento?</th>
            <th>¿ Usted contrata a empresas certificadas para la recolección y manejo de residuos sólidos en la isla.?</th>
            <th>¿En qué horario acostumbra usted sacar su basura?</th>
            <th>¿Donde coloca usted su basura?</th>
            <th>¿Cómo es su tratamiento de aguas residuales?</th>
            <th>¿Cuenta con correo Electrónico?</th>
            <th>Facebook</th>
            <th>Instagram</th>
            <th>Twitter</th>
            <th>You Tube</th>
            <th>Tik Tok.</th>
            <th>¿Comparado con el mismo mes del año anterior, ¿cómo se comportaron las ventas de su empresa durante enero?</th>
            <th>¿Ha considerado cerrar su establecimiento de manera definitiva?</th>
            <th>¿Cuál considera que sería la principal razón para cerrar su establecimiento?</th>
            <th>¿Su establecimiento se ha visto en la necesidad de despedir personal debido a la contingencia?</th>
            <th>¿Qué porcentaje del total de su plantilla laboral considera que fue o se verá afectada?</th>
            <th>¿Ha implementado medidas sanitarias en su establecimiento?</th>
            <th>¿Qué medidas sanitarias implementó para su establecimiento?</th>
        </tr>
        </thead>
        <tbody>
        @foreach($restaurantes as $restaurante)
        <?php $restaurante=json_decode($restaurante->json);?>
        <tr>                
        <td>{{$restaurante->cliente}}</td>
        <td>{{$restaurante->razonsocial}}</td>
        <td>{{$restaurante->telefono}}</td>
        <td>{{$restaurante->contactocomercial}}</td>
        <td>{{$restaurante->calle}}</td>
        <td>{{$restaurante->numeroext}}</td>
        <td>{{$restaurante->numeroint}}</td>
        <td>{{$restaurante->colonia}}</td>
        <td>{{$restaurante->municipio}}</td>
        <td>{{$restaurante->cp}}</td>
        <td>{{$restaurante->entidad}}</td>
        <td>{{$restaurante->giro}}</td>
        <td>{{$restaurante->ncomensales}}</td>
        <td>{{$restaurante->aforo}}</td>
        <td>{{$restaurante->superficie}}</td>
        <td>{{$restaurante->antiguedad}}</td>
        <td>{{$restaurante->afiliado}}</td>
        <td>{{$restaurante->franquicia}}</td>
        <td>{{$restaurante->categoria}}</td>
        <td>{{$restaurante->wifi}}</td>
        <td>{{$restaurante->areainfantil}}</td>
        <td>{{$restaurante->aireacon}}</td>
        <td>{{$restaurante->reservacion}}</td>
        <td>{{$restaurante->entrega}}</td>
        <td>{{$restaurante->llevar}}</td>
        <td>{{$restaurante->trampas}}</td>
        <td>{{$restaurante->clasificacion}}</td>
        <td>{{$restaurante->rangoprecio}}</td>
        <td>{{$restaurante->reciclaje}}</td>
        <td>{{$restaurante->tresiduo}}</td>
        <td>{{$restaurante->bolsas}}</td>
        <td>{{$restaurante->pagos}}</td>
        <td>{{$restaurante->contrata}}</td>
        <td>{{$restaurante->horarios}}</td>
        <td>{{$restaurante->donde}}</td>
        <td>{{$restaurante->tratamiento}}</td>
        <td>{{$restaurante->correo}}</td>
        <td>{{$restaurante->facebook}}</td>
        <td>{{$restaurante->instagram}}</td>
        <td>{{$restaurante->twitter}}</td>
        <td>{{$restaurante->youtube}}</td>
        <td>{{$restaurante->tiktok}}</td>
        <td>{{$restaurante->ventas}}</td>
        <td>{{$restaurante->cerrar}}</td>
        <td>{{$restaurante->razon}}</td>
        <td>{{$restaurante->despedir}}</td>
        <td>{{$restaurante->plantilla}}</td>
        <td>{{$restaurante->medidas}}</td>
        <td>{{$restaurante->implemento}}</td>

        </tr>
        @endforeach
            
           
        </tbody>
        
    </table>
</body>
</html>

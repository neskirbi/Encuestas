<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
</head>
<body>
    <table>
        <thead>
        <tr>
            <th style="width:25px;">Planta</th>
            <th style="width:100px;">Obra</th>
            <th style="width:150px;">Tipo</th>
            <th style="">Cantidad</th>
            <th style="">Valor</th>
            
        </tr>
        </thead>
        <tbody>
            @foreach($obras as $obra)
            <tr>
                <td>{{$obra->planta}}</td>
                <td>{{$obra->obra}}</td>
                <td>{{CodificaTipoObra($obra->tipoobra)}}</td>                
                <td>{{$obra->cantidadobra}}</td>
                <td>{{$obra->valor}}</td>
            </tr>
            @endforeach
           
        </tbody>
        
    </table>
</body>
</html>
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
            <th style="width:30px; text-align:center;">RAZÓN SOCIAL</th>
            <th style="width:30px; text-align:center;">OBRA</th>
            <th style="width:30px; text-align:center;">MONTO</th>
            <th style="width:30px; text-align:center;">REFERENCIA</th>
            <th style="width:30px; text-align:center;">DECRIPCIÓN</th>
            <th style="width:30px; text-align:center;">FECHA</th>
        </tr>
        </thead>
        <tbody>
            @foreach($pagos as $pago)
            <tr>
                
                <td style="width:30px; text-align:center; word-wrap:break-word;">{{$pago->generador}}</td>
                <td style="width:30px; text-align:center; word-wrap:break-word;">{{$pago->obra}}</td>
                <td style="width:30px; text-align:center; word-wrap:break-word;">$ {{$pago->monto}}</td>
                <td style="width:30px; text-align:center; word-wrap:break-word;">{{$pago->referencia}}</td>
                <td style="width:30px; text-align:center; word-wrap:break-word;">{{$pago->descripcion}}</td>
                <td style="width:30px; text-align:center; word-wrap:break-word;">{{$pago->created_at}}</td>
            </tr>
            @endforeach
        </tbody>
        
    </table>
</body>
</html>

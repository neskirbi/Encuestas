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
            <th style="width:30px; text-align:center;">Generado</th>
            <th style="width:30px; text-align:center;">Obra</th>
            <th style="width:30px; text-align:center;">Detalle</th>
            <th style="width:30px; text-align:center;">Fecha</th>
            <th style="width:30px; text-align:center;">Subtotal</th>
            <th style="width:30px; text-align:center;">IVA</th>
            <th style="width:30px; text-align:center;">Total</th>
        </tr>
        </thead>
        <tbody>
            <?php $tcantidad=0; $tconsto=0; ?>
            @foreach($pedidos as $pedido)
            <tr>
                <td style="width:30px; text-align:center; word-wrap:break-word;">{{$pedido->generador}}</td>
                <td style="width:30px; text-align:center; word-wrap:break-word;">{{$pedido->obra}}</td>
                <td style="width:30px; text-align:center; word-wrap:break-word;">{{$pedido->detalle}}</td>
                <td style="width:30px; text-align:center; word-wrap:break-word;">{{$pedido->created_at}}</td>
                <td style="width:30px; text-align:center; word-wrap:break-word;">${{number_format($pedido->subtotal,2)}}</td>
                <td style="width:30px; text-align:center; word-wrap:break-word;">{{$pedido->iva}}%</td>
                <td style="width:30px; text-align:center; word-wrap:break-word;">${{number_format($pedido->total,2)}}</td>
                
            </tr>
            
            @endforeach
            
        </tbody>
        
    </table>
</body>
</html>

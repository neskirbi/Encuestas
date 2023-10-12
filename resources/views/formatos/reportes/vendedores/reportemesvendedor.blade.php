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
            <th style="width:30px; text-align:center;">Material</th>
            <th style="width:30px; text-align:center;">Cantidad</th>
        </tr>
        </thead>
        <tbody>
            <?php $tcantidad=0; $tconsto=0; ?>
            @foreach($materialesmes as $materialmes)
            <tr>
                <td style="width:30px; text-align:center; word-wrap:break-word;">{{$materialmes->material}}</td>                
                <td style="width:30px; text-align:center; word-wrap:break-word;">{{number_format($materialmes->cantidad,2)}}</td>
                
                
            </tr>
            @endforeach
           
        </tbody>
        
    </table>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
</head>
<body>
    <table border="1" >
        <thead>
        <tr>
            <th style="text-align:center;">Mes</th>
            <th style="width:80px; text-align:center;">Material</th>
            <th style="width:20px; text-align:center;">Cantidad</th>
            <th style="width:20px; text-align:center;">Total Mes</th>
        </tr>
        </thead>
        <tbody>
            @foreach($materiales as $material)
            <tr>
                <td>{{$material->mes}}</td>
                <td>{{$material->material}}</td>
                <td>{{number_format(intval(str_replace(",","",$material->cantidad)),2)}}</td>
                <td></td>
            </tr>
            @endforeach
           
        </tbody>
        
    </table>
</body>
</html>

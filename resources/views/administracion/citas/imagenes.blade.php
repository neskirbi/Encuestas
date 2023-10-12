<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>imagenes</title>
</head>
<body>
    <table border="1">
        <tr>
            <th>
                <img src="" alt=""  id="imagen0" width="300px">               
            </th>
            <th>
                <img src="" alt=""  id="imagen1" width="300px">
            </th>
        </tr>
    </table>
    
</body>
<script>
window.addEventListener("paste", processEvent);
var imagenes=['',''];
function processEvent(e) {
    for(var j=0;j<imagenes.length;j++){
        if(imagenes[j]=='')
        for (var i = 0; i < e.clipboardData.items.length; i++) {
            // get the clipboard item
            // obtengo el clipboard item
            var clipboardItem = e.clipboardData.items[0];
            var type = clipboardItem.type;

            // verifico si es una imagen
            if (type.indexOf("image") != -1) {

                // obtengo el contenido de la imagen BLOB
                var blob = clipboardItem.getAsFile();
                //Pasando la imagen a base64 y poniendola en un arreglo para depues cargarla
                var reader = new window.FileReader();
                reader.readAsDataURL(blob);
                reader.onload = function(result) {
                    console.log(reader.result.replace('data:image/png;base64,', '').toString());
                    imagenes[j]=reader.result.replace('data:image/png;base64,', '').toString();
                    
                }
                // creo un la URL del objeto
                var blobUrl = URL.createObjectURL(blob);
                console.log("blobUrl", blobUrl);
                // agrego la captura a mi imagen
                document.getElementById("imagen"+j).setAttribute("src", blobUrl);
                return;

            } else {
                console.log("No soportado " + type);
            }
        }
    }
}


</script>
</html>
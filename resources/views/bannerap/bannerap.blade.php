<!DOCTYPE html>
<html lang="en>
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <title>Cookies, Terminos y Condiciones</title>
       <link rel="stylesheet" href="./estilos.css">
</head>
<style>
 

.cookies-box {
    position: fixed;
    bottom: 0;
    background: #494646;
    width: 100%;
    display: flex;
    justify-content: center;
    box-shadow: -2px 0 14px 8px rgba(0, 0, 0, 8);
    transition: all 400ms ease;

}

.cookies-box .container-cookies {
    padding: 10px 0;
    max-width: 90%;
    display:flex;
    align-items: center;

}
.cookies-box .container-cookies .paraffo{

}
.cookies-box .container-cookies .paraffo p{
    color:azure
}
.cookies-box .container-cookies .paraffo p a{
    color:darkgrey;
}
.cookies-box .container-cookies .botones{
    display: flex;
    flex-direction: row;
    margin-left: 15px;
}
.cookies-box .container-cookies .botones button{
    background: transparent;
    color: #fff;
    border: 2px solid #fff ;
    padding: 5px 25px 5px 25px;
    border-radius: 30px;
    cursor: pointer;
    transition: all 200ms ease-in;
   

}
.cookies-box .container-cookies .botones button:hover{
    color: #FCE204;
    border:  2px solid #FCE204;
}
.cookies-box .container-cookies .botones button:last-child{
    margin-right: 5px;
}

.modal{
    position: fixed;
    background:#494646;
    color: #fff;
    border:2px solid rgba(0,0,0, 5);
    padding:20px;
    top: 50%;
    left:50%;
    visibility: hidden;
    opacity: 0;
    border-radius: 5px;
    transform: translate(-50%,-50%);
    transition: all 300ms ease;

}

.modal .titulo{
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;

}

.modal .titulo button{
    padding: 5px;
    background: transparent;
    border: 2px solid #000;
    font-weight: bold;

}
.modal .titulo button:hover{
    border: 2px solid #000;
    color: #fff;
}


.modal.parrafo{
    text-align: justify;
    margin-bottom: 25px;    
}

.modal .aceptar-modal button{
    background: transparent;
    color: #000;
    border: 2px solid #fff ;
    padding: 5px 10px;
    border-radius: 30px;
    cursor: pointer;
    transition: all 200ms ease-in;
   

}
.modal .aceptar-modal .botones button:hover{
    color: #FCE204;
    border:  2px solid #FCE204;
}

#mostarpo{
    cursor: pointer;

}


</style>
<body>
<div class="cookies-box" id="contenedor">
    <div class="container-cookies">
        <div class="parrafo">
            <p style="color:#fff;">
                Utilizamos cookies para darte la mejor experiencia de usuario y entrega de publicidad, entre otras cosas. Si continúas navegando el sitio, das tu consentimiento para utilizar dicha tecnología, según nuestro <a href="AvisoPrivacidad" target="_blank">Aviso Privacidad</a>. Puedes cambiar la configuración en tu navegador cuando gustes.
            </p>

        </div>
        <div class="botones">
            <button onclick="Ocultar();">Aceptar</button> 
        </div>
    </div>
</div>



</div>

<script>
function Ocultar(){
    $('#contenedor').slideUp(500);
}
</script>


</body>
        
</html>
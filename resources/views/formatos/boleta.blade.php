<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Citas</title>
    <style>
        .contenido{
            padding: 5px;
            border-radius:5px;
            background-color:#e5e4e2;
        }

        .contenido2{
            padding: 5px;
        }

        .letra{
            font-size:13px;
        }

        .letra2{
            font-size:10px;
        }

        @page{
		margin-bottom:50px;
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
            
            background-image:url("{{url('images/qr/boleta/'.$cita->qr)}}");
            background-repeat:no-repeat;
            background-position:center;
            background-size: contain;
            float: right;


            width:90px;
            height:90px;
        }
        .firmas{
            display:inline-block;
            padding:10px;
            text-align:center;
            width:40%;
        }

    </style>
</head>
<body>
    

        <div>
            @if($id_planta=='0e8332117ef04888838b4037b7e99ee3')
            <img src="{{public_path('images/boletas/cirec/logo.png')}}" height="50px" style="float: left;">
            <img src="{{public_path('images/boletas/cirec/logo2.jpg')}}" height="50px" style="float: right;">
            @endif

            @if($id_planta=='2bbe5acbd4894dfea786416d22da3875')
            <img src="{{public_path('images/boletas/acubo/logo.png')}}" height="50px" style="float: left;">
            <img src="{{public_path('images/boletas/acubo/logo2.png')}}" height="50px" style="float: right;">
            @endif
        </div>
        <br><br><br><br>
        <div class="contenido letra" style="float: left;  ">Folio: {{$cita->folio}}</div>
        <div class="contenido letra" style=" float: right; margin-right:0px;">Fecha: {{FechaFormateada($cita->fechacita)}}</div>
        <br>    <br>    
        <div class="contenido letra" style="float: left;  ">Planta de reciclaje:</div>
        <div class="contenido2 letra2" style="float: left; max-width:300px; ">{{$cita->planta}}</div>
        <div class="contenido2 letra" style="float: right; ">{{$cita->plantaauto}}</div>
        <div class="contenido letra" style="float: right; ">No. Autorización: </div>

        <br><br><br>
        <div class="contenido" style=" ">
        <table width="100%">
        <tr>
        <td class="letra">No. de registro generador(Resolutivo de Impacto Ambiental, numero de registro):</td>
        <td class="letra">{{$cita->nautorizacion}}</td>
        </tr>
        <tr>
        <td class="letra">Razón social de la persona física o moral generadora:</td>
        <td class="letra">{{$cita->razonsocial}}</td>
        </tr>
        
        </table>
        <table width="100%">
            <tr>
            <td colspan="4" class="letra">Domicilio fiscal generador:</td>
            </tr>
            <tr>
            <td class="letra">Calle</td>
            <td  class="letra">{{$cita->calleynumerofis}}</td>
            <td class="letra">Colonia</td>
            <td  class="letra">{{$cita->coloniafis}}</td>
            </tr>
            <tr>
            <td class="letra">C.P.</td>
            <td  class="letra">{{$cita->cpfis}}</td>
            <td class="letra">Alcaldia/Municipio</td>
            <td  class="letra">{{$cita->municipiofis}}</td>
            </tr>
        </table>

        <table width="100%">
            <tr>
            <td colspan="4" class="letra">Domicilio del origen de los residuos:</td>
            </tr>
            <tr>
            <td class="letra">Calle</td>
            <td  class="letra">{{$cita->calleynumeroobr}}</td>
            <td class="letra">Colonia</td>
            <td  class="letra">{{$cita->coloniaobr}}</td>
            </tr>
            <tr>
            <td class="letra">C.P.</td>
            <td  class="letra">{{$cita->cpobr}}</td>
            <td class="letra">Alcaldia/Municipio</td>
            <td  class="letra">{{$cita->municipioobr}}</td>
            </tr>
        </table>       
        </div>
        <br>
        
        <div class="contenido letra" style=" ">
            <table width="100%">
                <tr>
                <td >Tipo de vehículo</td>
                <td >Marca y modelo</td>
                <td >Matrícula</td>
                </tr>
                <tr>
                <td style=" border-bottom-style: dotted ;">{{$cita->vehiculo}}</td>
                <td style=" border-bottom-style: dotted ;">{{$cita->marcaymodelo}}</td>
                <td style=" border-bottom-style: dotted ;">{{$cita->matricula}}</td>
                </tr>
                
                <tr>
                <td>Tarjeton RAMIR:</td>
                <td colspan="2">{{$cita->ramir}}</td>
                </tr>
            </table>
        
        </div>

        <br>
        <div class="contenido" >
            <table width="100%" style="text-align: center;">
                <tr >
                <td class="letra" style=" border-bottom-style: dotted ;">Tipo de residuo</td>
                <td class="letra" style=" border-bottom-style: dotted ;">Unidad</td>
                <td class="letra" style=" border-bottom-style: dotted ;">Cantidad</td>
                <td class="letra" style=" border-bottom-style: dotted ;">Precio Unitario</td>
                <td class="letra" style=" border-bottom-style: dotted ;">Total</td>
                </tr>

                <tr>
                <td class="letra">{{$cita->material}}</td>
                <td class="letra">{{$cita->unidades}}</sup></td>
                <td class="letra">{{$cita->cantidad}}</td>
                <td class="letra">{{$cita->precio}}</td>
                <td class="letra">{{$cita->cantidad * $cita->precio }}</td>
                </tr>
            
            </table>
        
        </div>

        <br>
        
        <div class="contenido" style=" ">
            <table width="100%">
                <tr>
                <td >Condiciones de trasporte de los residuos</td>
                
                <td>{{$cita->condicionesmaterial}}</td>
                </tr>
            
            </table>
        
        </div>

        <br>
        
        <div class="contenido" style=" ">
            <table width="100%">
                <tr>
                <td width="50%" style=" border-bottom-style: dotted ;"><center>Entregó los residuos</center></td>
                <td  style=" border-bottom-style: dotted ;"><center>Recibió residuos</center></td>
                </tr>

                <tr>
                <td ><center>{{$cita->nombrecompleto}}</center></td>
                <td ><center>{{$cita->recibio}}</center></td>
                </tr>

                <tr> 
                <td class="letra" style="text-align: justify;">Manifiesto bajo protesta de decir verdad que conozco del contenido y volumen de los residuos entregados a la planta de reciclaje y que estos vienen libres de cualquier residuo peligroso de otra índole no especificado en la presente nota.</td>
                <td ><center>{{$cita->cargo}}</center></td>
                </tr>
            
            </table>
        
        </div>

        <br>
        <div class="contenido" style=" height:90px;">
            <table width="100%">
                <tr>
                <td style=" border-bottom-style: dotted ;">Observaciones</td>
            
                </tr>

                <tr>
                <td class="letra">{{$cita->observacion}}</td>
                </tr>

            
            </table>
        
        </div>
        <br>
        <table width="100%">
            <tr>
                <td style="width:100%;">
                    <div class="contenido">
                    <table width="100%">
                        <tr>
                        <td class="letra" style=" border-bottom-style: dotted ;">Dirección del establecimiento</td>
                        </tr>

                        <tr>
                        <td class="letra">{{$cita->direccionplanta}}</td>
                        </tr>
                    
                    </table>
                    </div>
                </td>
                
                <td style="width:30%;">
                    <div class="qr" ></div>
                    
                </td>
            </tr>
        </table>
    
        <br>
        <p>&nbsp;</p><br>
        @if($id_planta=='0e8332117ef04888838b4037b7e99ee3')
        <p style="text-align: justify;">
            <FONT style= "font-size:10px;">
                MEDIANTE LA EMISIÓN DE ESTA BOLETA SE HACE CONSTAR LA ENTREGA POR PARTE DEL USUARIO (EN ADELANTE, EL “CLIENTE”) A CONCRETOS SUSTENTABLES MEXICANOS, S.A. de C.V (EN ADELANTE, EL “EL PRESTADOR”), DE LOS RESIDUOS QUE SE SEÑALAN EN LA PRESENTE BOLETA Y EN LAS CANTIDADES QUE AQUÍ MISMO SE ESTABLECEN, PARA QUE EL PRESTADOR LLEVE A CABO EL RECICLAJE DE LOS MISMOS, ASUMIENDO EN ESTE ACTO EL CLIENTE CUALQUIER RESPONSABILIDAD QUE PUDIERA DERIVARSE DE LOS RESIDUOS SOLIDOS QUE HUBIESE TIRADO EN LA PLANTA  DE RECICLAJE “CIREC MIGUEL HIDALGO” Y, EN CONSECUENCIA, LIBERA A EL PRESTADOR DE CUALQUIER RESPONSABILIDAD SOBRE LOS MISMOS.
                <br>
                <br>

                Derivado de lo anterior, el CLIENTE libera a el PRESTADOR, sus accionistas, empleados, funcionarios, prestadores de servicios, y cualquier otra persona relacionada con la misma y con las actividades de reciclaje de residuos que se llevan a cabo en la planta de reciclaje ”CIREC MIGUEL HIDALGO” (conjuntamente referidos como el “PRESTADOR”), de cualquier clase de responsabilidad , ya sea civil, penal, en materia ambiental y de manejo de residuos peligrosos  o de cualquier otra índole, así  como de cualquier demanda, acción judicial o administrativa, que el CLIENTE, cualquier autoridad gubernamental o algún tercero tengan  actualmente o puedan llegar a tener  en lo decisivo con motivo de cualquier daño o perjuicio  que se derive  de los residuos que el CLIENTE hubiese tirado en la planta  de reciclaje “CIREC MIGUEL HIDALGO”.
                <br>
                <br>

                EL CLIENTE reconoce que las actividades que lleva a cabo el PRESTADOR corresponden  única y exclusivamente al reciclaje de los residuos que el CLIENTE ponga a su disposición los cuales únicamente podrán  pertenecer a las siguiente categorías: i) Concreto Simple y Armado; ii) Mampostería con Recubrimiento; iii) Petróleos; iv) Mezcla Asfáltica; v) De excavación; vi) Elementos prefabricados con materiales mixtos; vii) Otros Residuos de manejo especial; viii) Residuos Sólidos Urbanos; ix) Petróleos Mezclados. Cualquier otro tipo de residuos, incluyendo residuos peligros no son aceptados por el PRESTADOR en la planta de reciclaje ”CIREC MIGUEL HIDALGO” Cualquier otra actividad previa a entregar los residuos en la planta de reciclaje “CIREC MIGUEL HIDALGO” será exclusivamente por cuenta y cargo del CLIENTE y toda responsabilidad  sobre las mismas  recaerá única y exclusivamente  sobre el CLIENTE.
                <br>
                <br>
                Como se define en este párrafo, “Indemnización al Prestador” significará cualesquiera y todas las responsabilidades, pérdidas, sentencias o laudos definitivos, cantidades pagadas en transacción de acciones o reclamaciones, costos , daños, perjuicios, multas y gastos (incluyendo honorarios razonables de abogados) que se originen de, se relacionen con o hayan sido sostenidos o sufridos por el PRESTADOR  o cualesquiera de sus accionistas o las empresas de su grupo de interés económico como resultado de la entrega de residuos por parte del CLIENTE. La obligación del CLIENTE de indemnizar al PRESTADOR estará sujeta a lo siguiente:
                <br>
                
                <ul>
                    <li type="disc">En caso de que ocurra cualquier caso que pueda dar lugar a una indemnización , el PRESTADOR deberá requerir al CLIENTE mediante notificación por escrito especificado las bases de la indemnización al Prestador, para que dentro de un plazo de 15 (quince) días naturales, el CLIENTE tome todas las acciones que resulten necesarias para remediar el evento que haya dado lugar a la Indemnización al Prestador.</li>
                    <li type="disc">En caso de que el CLIENTE no subsane el evento dentro del dicho periodo de 15 (quince) días naturales a la entera satisfacción de el PRESTADOR, éste tendrá derecho a ser indemnizado en contra de  y en relación con dicha  Indemnización al Prestador, sin limitación alguna,  en los términos de la presente.</li>
                    <li type="disc">Independientemente de lo anterior y con respecto a cualquier gasto o costo que el PRESTADOR deba desembolsar por motivo de cualquier reclamación  relacionada con los residuos entregados en la planta de reciclaje “CIREC MIGUEL HIDALGO”, todos y cada uno de los dichos costos y gastos incurridos por el PRESTADOR al conducir una defensa por dicha indemnización al Prestador serán asumidos de manera inmediata y sin excusa alguna por el CLIENTE.</li>
                </ul>
                
                
                <br>
                Adicionalmente a los dispuesto en las secciones anteriores o en cualquier otro lugar de la presente Boleta, el CLIENTE acepta indemnizar y sacar en paz y a salvo a el PRESTADOR de y contra cualquier tipo de indemnización al Prestador, contingencia o reclamación  de cualquier clase que se relacione o derive de cualquier forma de la disposición de residuos en la planta de reciclaje “CIREC MIGUEL HIDALGO”.
                <br>
                <br>
                Asimismo, el CLIENTE reconoce que el PRESTADOR podrá utilizar y compartir información suya que incluya  Datos Personales y/o Datos Sensibles Personales de la conformidad con lo establecido en la Ley Federal de Protección de Datos  Personales en Posesión de los Particulares, por lo que el CLIENTE reconoce y acepta conocer los términos establecidos en la Ley Federal de Protección de Datos Personales en Posesión de los Particulares. Por lo tanto , el PRESTADOR y el CLIENTE se obligan por esta vía a cumplir con dichas disposiciones en todo momento durante la vigencia de su relación  contractual y con posterioridad a la conclusión en la misma, por cualquier causa, reconociendo expresamente que la falta de cumplimiento a dichas obligaciones podrá hacerlas acreedoras a alguna de las sanciones establecidas en la Ley Federal de Protección de Datos Personales en Posesión de los Particulares.
                <br>
                <br>
                Tanto el CLIENTE como el PRESTADOR reconocen y aceptan que cualquier tipo de transferencia de información personal confirme a lo establecido en la Ley Federal de Protección de Datos Personales en posesión de los Particulares se encuentra debidamente regulado en los avisos de privacidad correspondiente a cada una de ellos y en consecuencia, acuerdan expresamente sujetarse a las disposiciones relacionadas con la transferencia  y manejo de la información personal establecidas en los avisos de privacidad correspondientes.
                <br>
                <br>
                Declara el CLIENTE que ha leído cuidadosamente esta Boleta, así como sus términos y condiciones señaladas en la misma, y que entiende plenamente su contenido y alcance legal, estando enterado que el presente es una liberación de responsabilidad y un acuerdo entre el PRESTADOR y el CLIENTE. Asimismo, declara expresamente que firmo esta liberación de responsabilidad de forma libre y consciente, aceptando completamente sus términos y condiciones, y que en cuenta con la capacidad legal suficiente para suscribirla.
                <br>
                <br>
                Para cualquier asunto relacionado con la interpretación  o ejecución de la presente, así como respecto a cualquier  conflicto o controversia que pudiere sugerir respecto a la misma, las partes acuerdan sujetarse a las leyes y tribunales de la Ciudad de México, renunciando a cualquier otra jurisdicción que pudiere corresponderles a sus domicilios presentes o futuros o por cualquier otra razón.
            </FONT>
        </p>
        @endif
        <img src="{{$cita->foto0}}" width="250px" style="float: left;">

        <img src="{{$cita->foto1}}" width="250px" style="float: right;">

      
    
    
</body>
</html>

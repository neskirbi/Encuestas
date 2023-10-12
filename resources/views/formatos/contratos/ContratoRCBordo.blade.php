<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Contrato de Residuos</title>
</head>
<style>
	@page{
		margin-bottom:103px;
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
            
			position:relative;
			background-image:url("{{asset('images/qr/contrato').'/'.$id.'.png'}}");
			background-repeat:no-repeat;
			background-position:center;
			background-size: contain;
			
	
	
			width:80px;
			height:80px;
		}
	.firmas{
		display:inline-block;
		padding:10px;
		text-align:center;
		width:40%;
	}
	.body{
		font-family:Arial;
		font-size:12px;
	}

	

</style>

<body style="font-size:13px;">
<footer>
	<img src="{{asset('images/qr/contrato').'/'.$id.'.png'}}" width="80px" class="qr">	
</footer>
<main>
	<div class="hoja">
		<p>CONTRATO DE PRESTACIÓN DE SERVICIOS PARA LA DISPOSICIÓN DE RESIDUOS SÓLIDOS DE LA CONSTRUCCIÓN Y DEMOLICIÓN, SUMINISTRO DE MATERIALES Y TRANSPORTE ("CONTRATO") QUE CELEBRAN, POR UNA PARTE, LA SOCIEDAD DENOMINADA CONCRETOS SUSTENTABLES MEXICANOS, S.A.P.I DE C.V. (EN LO SUCESIVO "CSMX"), REPRESENTADA EN ESTE ACTO POR EL SEÑOR SEBASTIÁN ALBERTO HUERDO PANI Y, POR LA OTRA PARTE, <b>{{$generador->razonsocial}}</b> (EN LO SUCESIVO DENOMINADA COMO EL "CLIENTE"), CADA UNA REFERIDA COMO UNA "PARTE" Y CONJUNTAMENTE REFERIDOS COMO LAS "PARTES", AL TENOR DE LAS SIGUIENTES DECLARACIONES Y CLÁUSULAS:
			
		</p>
			<center><u>D E C L A R A C I O N E S</u></center>
		<p>
			<b> • Declara CSMX, por conducto de su representante legal, que:</b>
		</p>
		<OL TYPE="A">

			<li>Es una sociedad mercantil debidamente constituida de conformidad con las leyes de los Estados Unidos Mexicanos tal y como consta en la escritura pública número 18,879, otorgada ante la fe del licenciado Victoriano José Gutiérrez Valdés, titular de la notaría número 202 del distrito federal (ahora Ciudad de México) cuyo primer testimonio quedó inscrito en el registro público de la propiedad y del comercio del distrito federal (ahora ciudad de México) bajo el folio mercantil electrónico número 487921-1 el día 14 de febrero de 2013.</li>
			<li>Su representante legal cuenta con las facultades necesarias y suficientes para celebrar el presente Contrato y para obligar a su representada en los términos del mismo, mismas facultades que a la fecha no les han sido revocadas, modificadas o limitadas en forma alguna.</li>
			<li>Se encuentra debidamente inscrita en el Registro Federal de Contribuyentes con el número CSM1212179B8.</li>
			<li>Se dedica, entre otras cosas, al establecimiento, puesta en marcha y operación de plantas de reciclaje de residuos de construcción y/o demolición en favor de terceras personas, así como a la elaboración y comercialización de cemento portland y materiales similares.</li>
			<li>Cuenta con la experiencia y especialización necesarias en las ciencias y técnicas correspondientes para el desarrollo del proyecto objeto del presente Contrato, así como con los conocimientos y demás recursos técnicos, financieros, tecnológicos y humanos necesarios y suficientes para la prestación de los Servicios (según dicho término se define más adelante).</li>
			<li>Es su deseo celebrar el presente Contrato de conformidad con las Declaraciones y Cláusulas aquí establecidas.</li>
		</OL>

		<p>
		     <b> • Declara EL CLIENTE, por conducto de su apoderado legal, que: </b> 
		</p>

		<OL TYPE="A">
			<li> Es una sociedad mercantil debidamente constituida de conformidad con las leyes de los Estados Unidos Mexicanos por el Licenciado {{$generador->notario}} tal y como consta en el documento número {{$generador->numeroactacont}} con fecha {{FechaFormateadaContratos($generador->fechaconst)}}.</li>
			<li> Su representante legal cuenta con las facultades necesarias y suficientes para celebrar el presente Contrato y para obligar a su representada en los términos del mismo, mismas facultades que a la fecha no les han sido revocadas, modificadas o limitadas en forma alguna.</li>
			<li> Cuenta con la experiencia y especialización necesarias en las ciencias y técnicas correspondientes para el desarrollo del objeto del presente Contrato, así como con los conocimientos y demás recursos técnicos, financieros, tecnológicos, materiales y humanos necesarios y suficientes para hacer frente al mismo.</li>
			<li> Es su deseo celebrar el presente Contrato de conformidad con las Declaraciones y Cláusulas aquí establecidas.</li>
		</OL>


		<p>	
		   <b> • Declaran ambas Partes, por conducto de sus representantes legales: </b>
		</p>

		<OL TYPE="A">
			<li>Que en este acto se reconocen mutuamente la personalidad con que concurren a la celebración del presente Contrato.</li>
			<li>Que una vez expuesto lo anterior, es su libre voluntad suscribir y respetar estrictamente el presente Contrato.</li>
			
		</OL>
		<p>
			<center>Conformes las Partes en las declaraciones que anteceden, convienen en otorgar las siguientes:</center>
		</p>	

		
	</div>
	<div class="hoja">
		<center><u>C L A U S U L A S</u></center>

		<p>
			<b>PRIMERA.</b> <u>INTERPRETACIÓN.</u>  El presente Contrato se interpretará de la siguiente forma:
		</p>

		<ul>
			<li> Las palabras escritas con mayúsculas iniciales, así como las frases compuestas de palabras escritas con mayúsculas iniciales, son términos definidos que para todos los efectos del presente Contrato tendrán el significado que respectivamente se les atribuye en el presente Contrato o en los Anexos del mismo, según sea aplicable.</li>
			<li> Salvo disposición en contrario, todas las referencias a Cláusulas y Anexos, se entenderán respecto a Cláusulas y Anexos del presente Contrato.  Asimismo, las frases “este Contrato” y el “presente Contrato” incluyen las disposiciones contenidas en el cuerpo del Contrato y en todos y cada uno de sus Anexos.</li>
			<li> Los Anexos del presente Contrato forman una parte integrante del mismo para todos los efectos a que haya lugar, y se tienen por reproducidos en el mismo como si a la letra se insertasen.</li>
			<li> Los términos definidos en forma singular tendrán el significado correlativo en plural cuando se utilicen en forma plural y viceversa.</li>
			<li> Las palabras referentes a personas se entenderán como referencias a personas tanto morales como físicas. </li>
			<li> Las referencias en este Contrato a las disposiciones del presente Contrato o de cualquier otro contrato o documento se entenderán tal y como éstos sean modificados.</li>
		</ul>

		<p>
			<b>SEGUNDA.</b> <u>OBJETO.</u>  En virtud del presente instrumento y conforme a lo dispuesto en la Norma Ambiental para la Ciudad de México (antes Distrito Federal) NACDMX-007-2019, EL CLIENTE requiere de los servicios de reciclaje de residuos de construcción y demolición, suministro de materiales y transporte acordados que presta CSMX y (en adelante los “SERVICIOS”), mismos que se detallan en el <b>Anexo 1</b> del presente Contrato el cual forma parte integral del mismo y, a su vez, el CLIENTE se obliga a adquirir de CSMX los materiales reciclados para la construcción en los términos que se detallan en el presente Contrato y en su Anexo 1. Si durante la vigencia del Contrato, el CLIENTE solicita materiales o cantidades de reciclaje adicionales o distintas a las previamente establecidas en el <b>Anexo 1</b> antes referido, EL CLIENTE deberá pagar las mismas como eventos separados del proyecto inicial, razón por la cual las PARTES acordarán los precios a los cuales CSMX cobrará dichos servicios adicionales al CLIENTE.
		</p>
		<p>
			Los residuos, serán recibidos de acuerdo con el sistema de citas establecido por CSMX.
		</p>	
		<p>
			<b>TERCERA.</b> <u>RECICLAJE DE RESIDUOS.</u> . EL CLIENTE reconoce que las actividades de reciclaje que lleva a cabo CSMX corresponden única y exclusivamente al reciclaje de los residuos que EL CLIENTE ponga a su disposición los cuales únicamente podrán pertenecer a las siguientes categorías: i) concreto simple y armado; ii) mampostería con recubrimiento; iii) pétreos; iv) mezcla asfáltica; v) de excavación; vi) elementos prefabricados con materiales mixtos; vii) otros residuos de manejo especial; viii) residuos sólidos urbanos; y ix) pétreos mezclados. Cualquier otro tipo de residuos, incluyendo residuos peligrosos no son aceptados por CSMX en la planta de reciclaje “BORDO PONIENTE” cualquier otra actividad previa a entregar los residuos en la planta de reciclaje “BORDO PONIENTE” será exclusivamente por cuenta y cargo del CLIENTE y toda responsabilidad sobre las mismas recaerá única y exclusivamente sobre EL CLIENTE. Asimismo, EL CLIENTE reconoce y acepta que CSMX estará obligado a compartir con las autoridades que correspondan, toda la información relacionada con la entrega de residuos no permitidos conforme a lo aquí señalado.
		</p>
		<p>
			En tal virtud y para efectos de que CSMX pueda llevar un atinado control de la planta de reciclaje “BORDO PONIENTE”, EL CLIENTE se obliga a tirar únicamente los residuos sólidos manifestados en su “Plan de Manejo”, el cual deberá entregar a CSMX con anterioridad a que este reciba los residuos. CSMX verificará que los residuos tirados coincidan efectivamente con lo reportado en el “Plan de Manejo” del CLIENTE, aceptando EL CLIENTE en este acto que en caso de no tirar los residuos sólidos especificados, incluyendo las cantidades señaladas en dicho “Plan de Manejo”, deberá cubrir a CSMX además del costo total de la contraprestación por los residuos no reciclados y reportados en su “Plan de Manejo”, una pena convencional equivalente al 10% (diez por ciento) del monto total de la contraprestación que le corresponda a CSMX por el reciclaje de los residuos sólidos no entregados.
		</p>
		<p>
			EL CLIENTE en este acto manifiesta que los trabajos de construcción o demolición que llevará a cabo y de los cuales se obtendrán los residuos a reciclarse bajo el presente Contrato se encuentran ubicados en la obra que realiza este en {{$obra->calle}} {{$obra->numeroext}} {{$obra->numeroint}}, {{$obra->colonia}}, {{$obra->municipio}}, C.P. {{$obra->cp}}, {{$obra->entidad}}
		</p>
	</div>
	<div class="hoja">
		<p>
			<b>CUARTA.</b> <u>CONTRAPRESTACION, LUGAR Y FORMA DE PAGO.</u> El pago de la contraprestación convenida por los SERVICIOS materia del presente Contrato se hará con base en los precios establecidos en el Anexo 1 del presente Contrato tanto para el reciclaje de residuos de construcción y demolición como para la adquisición de materiales reciclados, por lo que el CLIENTE se obliga a pagar por anticipado a CSMX la suma total que resulte de aplicar los precios señalados en el Anexo 1 a la cantidad de residuos a ser tirados por el CLIENTE en las instalaciones de CSMX para su reciclaje, así como de los materiales que adquiera el propio CLIENTE. Al pago de las contraprestaciones antes mencionadas deberá agregársele el Impuesto al Valor Agregado correspondiente. Los precios aplicables estarán vigentes únicamente durante el periodo de ejecución de la obra por parte del Cliente, el cual será de {{FechaFormateadaContratos($obra->fechainicio)}}  al día {{FechaFormateadaContratos($obra->fechafin)}} día. En el entendido que en caso de que la obra continúe por un mayor plazo, los precios antes referidos estarán sujetos a cambio y serán determinados única y exclusivamente por CSMX. 
		</p>
		
		<p>
			Para determinar el monto de la contraprestación a ser cobrada, CSMX emitirá la factura en la que se desglosará la relación valorada de los residuos y materiales a ser entregados, misma que deberá cumplir con todos los requisitos para la emisión de facturas que indica la legislación vigente.
		</p>
		<p>
			El CLIENTE pagará a CSMX la cantidad mencionada en la factura correspondiente emitida por parte de CSMX de conformidad con los requisitos establecidos por las disposiciones fiscales aplicables y bajo los términos que se detallan a continuación:
		</p>
		<p>
			En caso de que surjan ajustes en la cantidad de residuos y materiales a ser entregados, CSMX emitirá la(s) factura(s) correspondientes en las cuales se ajusten dichas cantidades y el CLIENTE estará obligado a pagar los mismos dentro de los 5 (cinco) días naturales posteriores a la entrega de la(s) factura(s) ajustada(s).
		</p>
			
		<p>
			<u>Forma de Pago:</u>
		</p>
		
		<p>EL CLIENTE se obliga a pagar a CSMX el total de la contraprestación por la cantidad de residuos a reciclar, así como por el suministro de materiales en una sola exhibición y a más tardar dentro de los 5 (cinco) días hábiles siguientes a la firma del presente Contrato y en fecha previa a la prestación de los SERVICIOS.</p>
		<p>Los pagos a realizar por el CLIENTE en favor de CSMX como contraprestación por los SERVICIOS prestados por ésta deberán efectuarse en la siguiente cuenta bancaria:</p>
		<p>
			Banco: 	{{$configuracion->banco}}
			<br>
			CLABE:		{{$configuracion->clabe}}
			<br>
			Cuenta No.	{{$configuracion->cuenta}}
			<br>
			Sucursal No.	7820
			<br>
			A nombre de:	{{$configuracion->razonsocial}}
			<br>

		<p>
			<u>Garantía e Intereses Moratorios:</u>
		</p>
		
		<p>
			Para garantizar el pago total de los residuos a reciclar y los materiales a suministrarse por parte de CSMX, el CLIENTE suscribe en este acto, un pagaré en términos idénticos al formato de pagaré que se adjunta al presente como <b>Anexo 2</b>.
		</p>
		<p>
		Para el caso en que el CLIENTE no realice el pago de cualquiera de las facturas que CSMX emita al amparo del presente Contrato dentro del plazo pactado de 5 (cinco) días naturales a partir de la fecha de entrega de las mismas, el CLIENTE pagará a CSMX un interés moratorio sobre los saldos insolutos que se calculará conforme a una tasa mensual del 3% (tres por ciento) por cada mes o fracción que transcurra a partir de que se hubiere incurrido en mora, más el Impuesto al Valor Agregado que se genere sobre dichos intereses.
		</p>
		<p>
			Cualquier entrega de dinero que realice el CLIENTE, existiendo intereses pendientes por cubrir, se aplicará en términos de lo establecido por el artículo 2094 del Código Civil Federal y su correlativo para la Ciudad de México, y por ello a intereses en primer orden.
		</p>
		<p><b>QUINTA</b>. <u>VIGENCIA</u>. Las Partes acuerdan que el presente se mantendrá vigente hasta la total conclusión de los SERVICIOS y una vez que el CLIENTE haya liquidado el pago total de la Contraprestación a favor de CSMX.</p>
		
	</div>
	<div class="hoja">


		<p><b>SEXTA</b>. <u>CALIDAD</u>. CSMX se obliga a prestar los SERVICIOS con la más alta calidad posible de conformidad con los más altos estándares de la industria, conforme a lo establecido en el <b>Anexo 1</b> del presente Contrato, la cual deberá incluirse a todas y cada una de las obligaciones que deriven de la prestación de SERVICIOS que le proporcione al CLIENTE, incluyendo el suministro de materiales. A solicitud del CLIENTE, CSMX presentará a su costa los ensayos y certificados de calidad de los materiales a suministrar, obligándose a cumplir la normativa legal vigente al respecto, tomando en cuenta que al tratarse de materiales reciclados de diferentes fuentes esta podrá variar.</p>

		<p>En caso de observarse en los materiales cualesquiera defectos o alteraciones en la calidad o cantidad de estos, el CLIENTE notificará a CSMX quien se obliga a reemplazarlos a la mayor brevedad por otros de similares características.</p>

		<p>Queda estrictamente prohibido para el CLIENTE fabricar concreto hidráulico con agregado reciclado en obra, deberá ser el cumplimiento de los requisitos técnicos exigidos para cada uso concreto los que determinen finalmente su adecuación a un determinado uso. La calidad técnica del material, independientemente de su composición, es el elemento que determina la viabilidad del material en una aplicación y EL CLIENTE será el único responsable de determinar si cumple o no para ese determinado uso, liberando en este acto a CSMX de cualquier responsabilidad que pudiera surgir por el uso que el CLIENTE dé al material reciclado suministrado por CSMX.</p>

		<p><b>SÉPTIMA</b>. <u>INCUMPLIMIENTO</u>. Se entenderá por incumplimiento, cualquiera de las transgresiones o intento de trasgresión a las Cláusulas del presente instrumento por cualquiera de las Partes.</p>

		<p>La violación de las Partes a cualquiera de las obligaciones contenidas en este instrumento, será considerada un incumplimiento y dará lugar a las acciones civiles, administrativas o penales a que haya lugar, siendo facultad de CSMX el ejercer las acciones civiles y administrativas, así como solicitar el ejercicio de las sanciones penales que sean aplicables, incluyendo sin limitación alguna, las sanciones previstas en los artículos 231 de la Ley Federal del Derecho de Autor, 386 y 402 de la Ley Federal de Protección a la Propiedad Industrial, 210, 211 y demás aplicables del Código Penal Federal, así como los correlativos de los códigos locales y cualquier otra disposición legal que sea aplicable.</p>

		<p>Queda entendido que independientemente del tipo de acciones ejercidas, el incumplimiento al presente Contrato obligará al CLIENTE a indemnizar a CSMX y a sus Clientes de los daños y perjuicios causados por dicho incumplimiento, incluyendo el resarcimiento de los gastos y costas legales incurridos e independientemente de cualesquiera penas convencionales aplicables conforme al presente Contrato. Asimismo, en caso de cualquier incumplimiento por parte del CLIENTE a sus obligaciones bajo el presente Contrato, CSMX estará facultado a dar por terminado anticipadamente el mismo sin mayor formalidad que una simple notificación y sin necesidad de declaración judicial alguna.</p>
	
		<p><b>OCTAVA</b>. <u>RESPONSABILIDAD</u>. El CLIENTE asume en este acto y se obliga a responder por cualquier responsabilidad que pudiera derivarse de los residuos sólidos que este hubiese tirado en la planta de reciclaje “BORDO PONIENTE” y, en consecuencia, libera a CSMX sus accionistas, empleados, directores, funcionarios, prestadores de servicios, y cualquier otra persona relacionada con la misma y con las actividades de reciclaje de residuos que se llevan a cabo en la planta de reciclaje “BORDO PONIENTE”, de cualquier clase de responsabilidad, ya sea civil, penal, en materia ambiental y de manejo de residuos peligrosos o de cualquier otra índole, así como de cualquier demanda, acción judicial o administrativa, que el CLIENTE, cualquier autoridad gubernamental o algún tercero tengan actualmente o puedan llegar a tener en lo sucesivo con motivo de cualquier daño o perjuicio que se derive de los residuos que el CLIENTE hubiese tirado en la planta de reciclaje “BORDO PONIENTE”.</p>

		<p>Asimismo, declara el CLIENTE expresamente que firmó esta liberación de responsabilidad de forma libre y consciente, aceptando completamente sus términos y condiciones, y que cuenta con la capacidad legal suficiente para suscribirla.</p>

		<p><b>NOVENA</b>. <u>INDEMNIZACIÓN</u>. El CLIENTE se obliga ilimitadamente a indemnizar y a sacar en paz y a salvo a CSMX (incluyendo sucesores y/o cesionarios) de cualesquier reclamaciones, demandas, acciones, juicios, litigios, procedimientos, pérdidas, responsabilidades, daños, perjuicios, costos y gastos (incluyendo honorarios y costos de abogados) que sean experimentados o incurridos por CSMX (incluyendo sucesores y/o cesionarios) en relación con: (i) los residuos tirados por el CLIENTE en la planta de reciclaje “BORDO PONIENTE”; y (ii) cualquier reclamación presentada por cualquier tercero, incluyendo, sin limitación, cualesquier acreedor, entidad, agencia o autoridad gubernamental, en contra de CSMX por dichas causas.</p>
	</div>
	
	<div class="hoja">
		<p>En caso de que ocurra cualquier caso que pueda dar lugar a una indemnización, CSMX requerirá al CLIENTE mediante notificación por escrito especificando las bases de la indemnización para que dentro de un plazo de 15 (quince) días naturales, EL CLIENTE tome todas las acciones que resulten necesarias para remediar el evento que haya dado lugar a la indemnización al prestador.</p>

		<p>En caso de que EL CLIENTE no subsane el evento dentro de dicho periodo de 15 (quince) días naturales a la entera satisfacción de CSMX, éste tendrá derecho a ser indemnizado en contra de y en relación con dicha indemnización, sin limitación alguna y sin necesidad de declaración judicial, en los términos del presente Contrato.</p>

		<p>Independientemente de lo anterior y con respecto a cualquier gasto o costo que CSMX deba desembolsar por motivo de cualquier reclamación relacionada con los residuos entregados en la planta de reciclaje “BORDO PONIENTE”, todos y cada uno de dichos costos y gastos incurridos por CSMX al conducir una defensa por dicha indemnización serán asumidos de manera inmediata y sin excusa alguna por el CLIENTE</p>

		<p><b>DÉCIMA</b>. <u>CONFIDENCIALIDAD</u>. Ambas PARTES reconocen y aceptan que con motivo de la celebración del presente Contrato, tanto el CLIENTE como CSMX podrán tener acceso, o podrán recibir información sobre procesos técnicos, marcas, tecnología, diseños, aparatos, métodos, prácticas, patentes, registros, bases de datos, etc., utilizados por ambas PARTES, relacionados o conectados con las actividades que desarrollan, por lo que las PARTES, convienen expresamente y se obligan a considerar toda la información a que tengan acceso sobre ellas como confidencial y secreta. Por lo tanto, se obligan a no revelarla, ni en todo ni en parte, a ninguna persona sin el consentimiento previo y por escrito de la parte propietaria de la información confidencial, salvo por aquellas revelaciones de información expresamente pactadas por las PARTES en el presente Contrato. En consecuencia, cada una de las PARTES se obliga en su nombre y en el de todo su personal, a mantener la más estricta confidencialidad y a no revelar a ninguna persona física o moral, la información confidencial de la otra parte, durante la vigencia del presente Contrato y hasta por un periodo de 5 (cinco) años contados a partir de la fecha en que el presente instrumento se dé por terminado. En caso de existir dudas sobre si determinada información es considerada como confidencial, deberá ser tratada como tal. En caso de que alguna de las partes incumpla esta obligación, se hará acreedora a las penas que para tal efecto establezcan la Ley de Propiedad Industrial y el Código Penal Federal.</p>

		<p>En cualquier caso por el que el presente Contrato hubiere terminado, ya sea por haber concluido la vigencia del mismo, por haber sido terminado de manera anticipada, o inclusive en caso de rescisión, las PARTES se obligan, dentro de los primeros 5 (cinco) días naturales siguientes a aquél en que haya surtido efectos la terminación de que trate, a devolver a la otra parte toda la documentación, información y/o material relativos al presente Contrato que dicha Parte le hubiera proporcionado en relación con el mismo o que de cualquier otra forma estrictamente correspondan a dicha Parte o a cualquier empresa relacionada con ésta. De igual manera, ambas PARTES se obligan, una vez concluido el presente Contrato, a abstenerse de divulgar o usar cualquier información, documentación, material o producto que esté relacionada con el presente Contrato o con la otra Parte para todo propósito.</p>

		<p><b>DÉCIMA PRIMERA</b>. <u>RESPONSABILIDAD LABORAL</u>. CSMX reconoce y acepta expresamente que cuenta con los elementos y recursos propios necesarios y suficientes de conformidad con el artículo 13 de la Ley Federal del Trabajo y cualesquiera otras disposiciones legales en materia laboral que resulten aplicables en los Estados Unidos Mexicanos para cumplir con todas y cada una de las obligaciones que resulten a su cargo con motivo de la celebración del presente Contrato. En tal virtud, CSMX asumirá cualquier obligación derivada de su responsabilidad laboral y/o de cualquier otra naturaleza con respecto a sus empleados o cualquier otra persona que pueda utilizar para el cumplimiento de las obligaciones establecidas a su cargo en el presente Contrato.</p>

		<p>De esta forma, CSMX acepta expresamente que será responsable del pago de salarios, prestaciones, impuestos, derechos y cualquier otro tipo de obligación establecida en ley o por cualquier otra causa, que se genere con motivo del personal que destine o contrate para el cumplimiento de las obligaciones establecidas a su cargo en el presente Contrato. En consecuencia, CSMX se obliga a sacar en paz y a salvo a el CLIENTE de cualquier reclamación de tipo laboral o de cualquier otra índole que como resultado de la celebración y ejecución del presente Contrato se llegare a entablar en contra del CLIENTE y a reembolsarle todos los gastos relacionados con dicha reclamación, incluyendo los honorarios involucrados por concepto de abogados. Asimismo, por virtud del presente Contrato no se creará relación laboral alguna entre CSMX o sus empleados y el CLIENTE</p>
	</div>
	
	<div class="hoja">
		<p><b>DÉCIMA SEGUNDA</b>. <u>PROTECCIÓN DE DATOS PERSONALES</u>. En caso de que la Información Confidencial revelada entre las Partes incluya Datos Personales y/o Datos Sensibles Personales de conformidad con lo establecido en la Ley Federal de Protección de Datos Personales en Posesión de los Particulares, las partes se sujetaran a lo siguiente:</p>

		<ol type="a">
			<li> Ambas Partes reconocen y aceptan conocer los términos establecidos en la Ley Federal de Protección de Datos Personales en Posesión de los Particulares. Por lo tanto, ambas Partes se obligan por esta vía a cumplir con dichas disposiciones en todo momento durante la vigencia de su relación contractual y con posterioridad a la conclusión de la misma, por cualquier causa, reconociendo expresamente que la falta de cumplimiento a dichas obligaciones podrá hacerlas acreedoras a alguna de las sanciones establecidas en la Ley Federal de Protección de Datos Personales en Posesión de los Particulares.</li>
			<li> Adicionalmente las Partes reconocen y aceptan que cualquier tipo de transferencia de información personal conforme a lo establecido en la Ley Federal de Protección de Datos Personales en Posesión de los Particulares se encuentra debidamente regulado en los avisos de privacidad correspondientes a cada una de ellas y en consecuencia, las Partes acuerdan expresamente sujetarse a las disposiciones relacionadas con la transferencia y manejo de información personal establecidas en los avisos de privacidad correspondientes.</li>
		</ol>

		<p><b>DÉCIMA TERCERA.</b> <u>DAÑOS Y PERJUICIOS.</u> En caso de que el CLIENTE incumpla con sus obligaciones de confidencialidad contenidas en el presente Contrato, CSMX podrá reclamar al CLIENTE el resarcimiento y el pago de los daños y perjuicios que dicho incumplimiento le ocasione, sin perjuicio de las acciones penales que en su caso pudieran ejercerse en términos de la legislación aplicable.</p>
		<p><b>DÉCIMA CUARTA.</b> <u>NOTIFICACIONES.</u> Las notificaciones y/o avisos que se hagan las Partes deberán enviarse por escrito, por correo certificado, mensajería especializada o cualquier otro medio que asegure y acredite su recibo por el destinatario, a los domicilios de las Partes que a continuación se señalan, en días y horas hábiles. Todas las notificaciones, avisos o comunicaciones que las Partes se dirijan en términos de esta Cláusula se entenderán como notificadas en la fecha de su entrega, siempre que se cuente con el acuse de recibo o confirmación de recibo correspondiente.</p>
		<table style="width:100%;">
			<tr>
				<td style="width:50%; text-align:center;">
					CSMX
					<br>
					Av. Palmas 755 interior 12, Colonia Lomas de Chapultepec, Miguel Hidalgo, Ciudad de México, C.P. 11000
				</td>
				<td style="width:50%; text-align:center;">
					EL CLIENTE
					<br>
					{{$generador->calle.', '.$generador->numeroint.', '.$generador->numeroext.', Colonia '.$generador->colonia.', '.$generador->municipio.', Ciudad '.$generador->entidad.', C.P.'.$generador->cp}}
				</td>
			</tr>
		</table>
		

		<p>Mientras las Partes no se notifiquen por escrito un cambio de domicilio, los avisos, notificaciones y demás diligencias judiciales y extrajudiciales que se hagan en los domicilios indicados, surtirán plenamente sus efectos.</p>
		<p><b>DÉCIMA QUINTA.</b> <u>RELACIÓN ENTRE LAS PARTES.</u> Nada de lo establecido en el presente Contrato deberá entenderse como si existiera una relación de socios o asociados entre las Partes, ni los obligará a la celebración de contrato adicional alguno con la otra Parte, de igual manera ninguna de las Partes tendrá las facultades o poderes para obligar a la otra bajo ninguna circunstancia. </p>
		<p><b>DÉCIMA SEXTA.</b> <u>EJERCICIO DE DERECHOS.</u> Cualquier falta o demora por alguna de las Partes en el ejercicio de alguno de los derechos contenidos en el presente Contrato, no será considerado como renuncia a dicho derecho, ni tampoco se considerará que prescribió o prescribirá en un futuro por el hecho de que se haya ejercido de manera parcial, ni tampoco se considerará por ese simple hecho que haya prescrito cualquier otro derecho o privilegio establecido en el presente Contrato.</p>
		<p><b>DÉCIMA SÉPTIMA.</b> <u>ENCABEZADOS.</u> Los encabezados de las distintas cláusulas de este Contrato son solamente para conveniencia de referencia y no modifican, definen o limitan de modo alguno los términos, condiciones o disposiciones que aquí se contienen.</p>
		<p><b>DÉCIMA OCTAVA.</b> <u>ACUERDO ENTRE LAS PARTES.</u> Las Partes reconocen y aceptan que el presente Contrato contiene todos y cada uno de los acuerdos tomados por las Partes y que sus términos y condiciones dejan sin efecto alguno cualquier discusión o negociación anterior en relación con el presente Contrato.</p>
	</div>
	
	<div class="hoja">
		<p><b>DÉCIMA NOVENA.</b> <u>CONVENIO APLICABLE.</u> En caso de que cualquier término, restricción o condición del presente Contrato deba ser invalidado o no ejecutable, el resto del Contrato y las restricciones en él contenidas no se verán afectadas y el resto del Contrato será válido y ejecutable en los términos de la legislación aplicable.</p>
		<p><b>VIGÉSIMA.</b> <u>MODIFICACIONES.</u> Ninguna modificación al presente Contrato será válida o tendrá efecto legal alguno a menos que se realicen mediante Contrato modificatorio firmado de conformidad por ambas Partes y en el cual se hará referencia en las declaraciones al presente Contrato.</p>
		<p><b>VIGÉSIMA PRIMERA.</b> <u>LEGISLACIÓN Y JURISDICCIÓN APLICABLE.</u> Para la interpretación y cumplimiento del presente Contrato, las Partes se someten expresamente a la jurisdicción de los Tribunales competentes en la Ciudad de México, renunciando a cualquier otro fuero que por razón de sus domicilios presentes o futuros pudiera corresponderles.</p>
		<p>
			<center>[RESTO DE LA HOJA INTENCIONALMENTE EN BLANCO / SIGUE HOJA DE FIRMAS]</center>
		</p>


	</div>
	<div class="hoja">

		<p>EN TESTIMONIO DE LO CUAL, estando las Partes enteradas y conformes con su contenido y alcances legales, el presente Contrato se firma por duplicado en la Ciudad de México el {{FechaFormateadaContratos(date('Y-m-d'))}}.</p>
		<br>
		<p>		
			<center>
				"CSMX" 
				<br>
				CONCRETOS SUSTENTABLES MEXICANOS, S.A.P.I DE C.V.
			</center>
			
		</p>
		<br>
		<p>
			<center>
				_________________________________
				<br>
				Por: Sebastián Alberto Huerdo Pani 
				<br>
				Cargo: Representante Legal
			</center>
		</p>
		<br>
		<p>
			<center>
				"EL CLIENTE"
				<br>
				{{$generador->razonsocial}}
			</center>
			
		</p>
		<p>
			<center>
				_________________________________
				<br>
				Por: {{$generador->fisicaomoral=='Moral' ?  $generador->nombresrepre.' '.$generador->apellidosrepre : $generador->nombresfisica.' '.$generador->apellidosfisica }}
				<br>
				Cargo: Representante Legal
			</center>
		</p>
		<p>
			<center>
				<b>
					"ANEXO 1"
					<br>
					MATERIALES Y SERVICIOS 
				</b>
			</center>
			
			
		</p>
		<p>El presente Anexo formará parte integral del Contrato de Prestación de Servicios Profesionales y suministro de materiales que prestará CONCRETOS SUSTENTABLES MEXICANOS, S.A.P.I DE C.V. a {{$generador->razonsocial}}, para lo cual a continuación se describe a detalle las especificaciones del proceso de reciclaje de residuos sólidos de la construcción y demolición así como la venta de materiales y demás especificaciones del proyecto.</p>
		<p>1. El CLIENTE manifiesta su interés en contratar con CSMX para el suministro de los materiales y Servicios que se detallan a continuación:</p>
		<br>
		<br>
		<br>
		<table border="1px" style="border-collapse: collapse; width:100%; padding:5px;">
			<thead>
				<tr style="background-color:#00B050;">
					<th>Categoría</th>
					<th>Material</th>
					<th style="width:50px;">Cantidad en Tn</th>
					<th style="width:80px;">Cantidad en m<sup>3</sup></th>
					<th style="width:50px;">P.U.</th>
					<th style="width:100px;">Total</th>
				</tr>
				
			</thead>
			<tbody>
				<?php 
				$categoria="";
				if(count($materiales)){
					$Subtotal=0;

					foreach($materiales as $material){	
						$Subtotal+=$material->precio*$material->cantidad;
						echo'<tr>';
							if($categoria!=$material->categoriamaterial){
								echo'<td rowspan="'.$material->filas.'">'.$material->categoriamaterial.'</td>';
								$categoria=$material->categoriamaterial;
							}
							echo'<td>'.$material->material.'</td>';
							echo'<td style="background-color:#FFFF00;"><center>'.$material->cantidad*1.5.'</center></td>';
							
							echo'<td style="background-color:#FFFF00;"><center>'.$material->cantidad.'</center></td>';
							echo'<td><center>$ '.$material->precio.'</center></td>';
							echo'<td><center>$ '.number_format($material->precio*$material->cantidad,2).'</center></td>';
						echo'</tr>';
					}
						
						
					echo'<tr style="border: none;">';
						
						echo'<td style="border: none;">';
						echo'<td style="border: none;">';
						echo'<td style="border: none;">';
						echo'<td style="border: none;">';
						echo'<td style="border: none;">Subtotal:</td>';
						echo'<td style="border: none;"><center>$ '.number_format($Subtotal,2).'</center></td>';
					echo'</tr>';
					
					echo'<tr style="border: none;">';
						
						echo'<td style="border: none;">';
						echo'<td style="border: none;">';
						echo'<td style="border: none;">';
						echo'<td style="border: none;">';
						echo'<td style="border: none;">IVA:</td>';
						echo'<td style="border: none;"><center>$ '.number_format($obra->ivaobra*$Subtotal /100,2).'</center></td>';
					echo'</tr>';

					echo'<tr style="border: none;">';
						
						echo'<td style="border: none;">';
						echo'<td style="border: none;">';
						echo'<td style="border: none;">';
						echo'<td style="border: none;">';
						echo'<td style="border: none;">Total:</td>';
						echo'<td style="border: none;"><center>$'.number_format ($Subtotal+($obra->ivaobra*$Subtotal /100),2).'</center></td>';
					echo'</tr>';
					
				}
						
				?>
							
			</tbody>
		</table>
		

		</div>
		<div class="hoja">
		<table border="1px" style="border-collapse: collapse; width:100%; padding:5px;">
			<thead>
				<tr style="background-color:#00B050;">
					<th>Categoría</th>
					<th>Producto</th>
					<th>Unidad</th>
					<th style="width:80px;">P.U.</th>
				</tr>
				
			</thead>
			<tbody>
				<?php 
				$categoria="";
					
					foreach($productos as $producto){
						echo'<tr>';
							if($categoria!=$producto->categoria){
								echo'<td rowspan="'.$producto->filas.'">'.$producto->categoria.'</td>';
								$categoria=$producto->categoria;
							}	
						
							echo'<td>'.$producto->producto.'</td>';
							echo'<td><center>m<sup>3</sup></center></td>';
							echo'<td><center>$ '.number_format($producto->precio,2).'</center></td>';
						echo'</tr>';
					}	
				?>
							
			</tbody>
		</table>
		<br>
		<br>
		<table border="1px" style="border-collapse: collapse; width:100%; padding:5px;">
			<thead>
				<tr style="background-color:#00B050;">
					<th>Categoría</th>
					<th>Transporte</th>					
					<th>Capacidad</th>
					<th style="width:80px;">P.U.</th>
					<th>Viajes</th>
					<th>Total</th>
				</tr>
				
			</thead>
			<tbody>
				<?php 
				$categoria="";
					$Subtotal=0;
					foreach($transportes as $transporte){
						$Subtotal+=$transporte->precio*$transporte->cantidad;
						echo'<tr>';							
							echo'<td>Transporte</td>';
							echo'<td>'.$transporte->transporte.'</td>';
							echo'<td><center>'.$transporte->capacidad.' m<sup>3</sup></center></td>';
							echo'<td><center>$ '.number_format($transporte->precio,2).'</center></td>';
							echo'<td><center>'.$transporte->cantidad.'</center></td>';
							echo'<td><center>$ '.number_format($transporte->precio*$transporte->cantidad,2).'</center></td>';
						echo'</tr>';
					}
					
							echo'<tr style="border: none;">';
								echo'<td style="border: none;">';
								echo'<td style="border: none;">';
								echo'<td style="border: none;">';
								echo'<td style="border: none;">';
								echo'<td style="border: none;">Subtotal:</td>';
								echo'<td style="border: none;"><center>$ '.number_format($Subtotal,2).'</center></td>';
							echo'</tr>';
							
							echo'<tr style="border: none;">';
								echo'<td style="border: none;">';
								echo'<td style="border: none;">';
								echo'<td style="border: none;">';
								echo'<td style="border: none;">';
								echo'<td style="border: none;">IVA:</td>';
								echo'<td style="border: none;"><center>$ '.number_format($obra->ivaobra*$Subtotal /100,2).'</center></td>';
							echo'</tr>';

							echo'<tr style="border: none;">';
								echo'<td style="border: none;">';
								echo'<td style="border: none;">';
								echo'<td style="border: none;">';
								echo'<td style="border: none;">';
								echo'<td style="border: none;">Total:</td>';
								echo'<td style="border: none;"><center>$ '.number_format ($Subtotal+($obra->ivaobra*$Subtotal /100),2).'</center></td>';
							echo'</tr>';
				?>
							
			</tbody>
		</table>
		<p>Los precios aplicables estarán vigentes únicamente durante el periodo de ejecución de la obra por parte del Cliente, el cual será del {{FechaFormateadaContratos($generador->fechainicio)}} al día {{FechaFormateadaContratos($generador->fechafin)}} . En el entendido que en caso de que la obra continúe por un mayor plazo, los precios antes referidos estarán sujetos a cambio y serán determinados única y exclusivamente por CSMX. </p>
		<p>
			<b>Todos los precios son antes de IVA</b>
		</p>
	
	</div>
	
	<div class="hoja">
		<p>
			<center><b>ANEXO 2</b></center>
		</p>
		<p>
			<center><b>
				PAGARÉ
				<br>
				(SIN PROTESTO)
			</b></center>
		</p>
		<p> <center>POR LA CANTIDAD DE $ {{number_format($total,2)}} M.N.</center></p>

		<p>Por este pagaré <b>{{$generador->razonsocial}}</b> (el “Suscriptor”) una persona moral debidamente constituida bajo las leyes mexicanas, representada en este acto por <b>{{$generador->fisicaomoral=='Moral' ?  $generador->nombresrepre.' '.$generador->apellidosrepre : $generador->nombresfisica.' '.$generador->apellidosfisica }}</b> con capacidad legal y suficiente para suscribir el presente pagaré conforme a la legislación de los Estados Unidos Mexicanos, con domicilio en <b>{{$generador->calle.' Ext.'.$generador->numeroext.' Int.'.$generador->numeroint.' '.$generador->colonia.', '.$generador->municipio.', '.$generador->entidad.' '}}</b> a través del presente Título de Crédito reconozco y prometo que debo y pagaré incondicionalmente a CONCRETOS SUSTENTABLES MEXICANOS, S.A.P.I DE C.V. ("el Acreedor"), en la cuenta número <b>{{$configuracion->cuenta}}</b> que el Acreedor tiene con la institución bancaria <b>{{$configuracion->banco}}</b> la suma principal de $ {{number_format($total,2)}} ({{ucfirst(CantidadLetras($total))}} Pesos 00/100, Moneda Nacional) moneda de curso legal de los Estados Unidos Mexicanos, debiendo realizar el pago en términos de lo pactado en el Contrato de Prestación de Servicios y Suministro de materiales suscrito entre mi representada y CONCRETOS SUSTENTABLES MEXICANOS, S.A.P.I DE C.V. con fecha {{FechaFormateadaContratos(SumarDias(date('Y-m-d'),5))}} (la “Fecha de Vencimiento”).</p>
		<p>El Suscriptor conviene ante el Acreedor que el incumplimiento del pago total de cualquier cantidad debida al amparo del presente, cuando ésta sea debida, generará el pago de un interés moratorio a una tasa mensual equivalente al 3% (tres por ciento). Dicha tasa se devengará diariamente, considerando para tales efectos, meses de 30 días (la "Tasa Moratoria"). Los intereses con base en la Tasa Moratoria se generarán en forma diaria hasta que el pago total del monto vencido (incluyendo principal e intereses) sea efectuado en su totalidad en favor del Acreedor. El Acreedor a su opción, podrá determinar si ejerce o no su derecho de reclamar el pago de intereses moratorios, y de que dichos intereses comiencen a devengarse.</p>

		<p>Adicionalmente, el incumplimiento de cualquier pago bajo el presente PAGARÉ  facultará al Acreedor para acelerar el vencimiento del presente PAGARÉ y cobrarlo inmediatamente junto con todos los intereses devengados.</p>
		Para todo lo relacionado con este PAGARÉ, El Suscriptor designa como su domicilio el siguiente: <b>{{$generador->calle.' Ext.'.$generador->numeroext.' Int.'.$generador->numeroint.' '.$generador->colonia.', '.$generador->municipio.', '.$generador->entidad.' '}}</b>.
		<p>
		<p>
			Por el presente, el Suscriptor renuncia expresa e irrevocablemente a cualquier diligencia, demanda, protesto o notificación de cualquier clase. La omisión por parte del Acreedor de ejercer cualquiera de sus derechos bajo este PAGARÉ en cualquier instancia en particular no constituirá una dispensa a los mismos en esa instancia o en cualquier instancia posterior. El Suscriptor se obliga a pagar los gastos de cobranza y honorarios de abogados en caso de incumplimiento en el pago de este PAGARÉ
		</p>
		<p>
			Este PAGARÉ se suscribe y será regido por, e interpretado de conformidad con, las leyes de los Estados Unidos Mexicanos. El Suscriptor se somete expresa e irrevocablemente a la jurisdicción de cualquier tribunal competente en la Ciudad de México, México, para cualquier controversia derivada o en relación con este PAGARÉ, o para el reconocimiento o ejecución de cualquier sentencia. El Suscriptor en este acto renuncia de manera expresa e irrevocable a cualquier otra jurisdicción que pudiere corresponderle en virtud de su domicilio presente o futuro o por cualquier otro motivo.
		</p>
		<p>
		Este PAGARÉ se suscribe en la Ciudad de México, México el {{FechaFormateadaContratos(date('Y-m-d'))}}.
		</p>
			<center>
				El Suscriptor:
				<br>
				POR SU PROPIO DERECHO
				<br><br>
				____________________________________
			</center>
		</p>
		<p>
		ESTE ANEXO Y PAGARE FORMAN PARTE INTEGRAL DEL CONTRATO DE PRESTACIÓN DE SERVICIOS Y SUMINISTRO DE MATERIALES FIRMADO ENTRE EL SUSCRIPTOR Y EL ACREEDOR CON FECHA DEL {{FechaFormateadaContratos(date('Y-m-d'))}}.
		</p>
	</div>
</main></body></html>
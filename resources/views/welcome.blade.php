<!DOCTYPE html>
<html>
<head><meta charset="utf-8">
	<title>SEDE - ESPOCH MORONA SANTIAGO</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/home_estilos.css') }}">
	<link rel="shortcut icon" href="vendor/adminlte/dist/img/rebre-icon-load.ico" />
</head>
<style>
    /* Estilos para el botón flotante de accesibilidad */
    #accessibility-button {
      position: fixed;
      bottom: 20px;
      right: 20px;
      width: 50px;
      height: 50px;
      background-color: #4CAF50;
      color: #fff;
      border-radius: 50%;
      text-align: center;
      line-height: 50px;
      cursor: pointer;
      z-index: 9999;
	   transition: background-color 0.3s ease;
	  
    }

    /* Estilos para el menú de accesibilidad */
    #accessibility-menu {
      position: fixed;
      bottom: 90px;
      right: 20px;
      width: 150px;
      background-color: #fff;
      border: 1px solid #333;
      border-radius: 5px;
      padding: 10px;
      display: none;
      z-index: 9999;
	  transition: background-color 0.3s ease;
	 
    }

    /* Estilos para los botones del menú de accesibilidad */
    .accessibility-button {
     padding: 10px 20px;
			font-size: 16px;
			font-weight: bold;
			text-align: center;
			color: #fff;
			background-color: #4CAF50;
			border: none;
			border-radius: 10px;
			cursor: pointer;
			transition: background-color 0.3s ease;
			outline: none;
		background-color: #3e8e41;
    }
	.separador-horizontal {
		margin-top: 10px;
		margin-bottom: 10px;
		border-top: 1px solid #000000;
	}

    /* Estilos para el modo de personas daltónicas */
    .color-blind-mode {
      /* Aquí puedes definir los estilos que se ajusten a las necesidades del modo para personas daltónicas */
      filter: url('#rojo-verde');
    }
	body {
	border: 8px solid #057c46;
	min-height: 100%;
   	}
  </style>
</head>
<body>
  <button id="accessibility-button" onclick="toggleAccessibilityMenu()"><i class="fa-solid fa-universal-access fa-2xl"></i></button>
  <div id="accessibility-menu">
    <button class="accessibility-button" onclick="decreaseFontSize()">A-</button>
    <button class="accessibility-button" onclick="increaseFontSize()">A+</button>
    <button class="accessibility-button" onclick="toggleColorBlindMode()">Daltonismo</button>
  </div>
  <script>
    // Función para crear o leer la cookie de preferencia de color
    function setPreferredColorBlindMode(value) {
      document.cookie = "colorBlindMode=" + value + "; path=/";
    }

    function getPreferredColorBlindMode() {
      var name = "colorBlindMode=";
      var decodedCookie = decodeURIComponent(document.cookie);
      var cookies = decodedCookie.split(';');
      for (var i = 0; i < cookies.length; i++) {
        var cookie = cookies[i];
        while (cookie.charAt(0) === ' ') {
          cookie = cookie.substring(1);
        }
        if (cookie.indexOf(name) === 0) {
          return cookie.substring(name.length, cookie.length);
        }
      }
      return "";
    }

    // Función para aplicar el modo de personas daltónicas
    function applyColorBlindMode() {
      var preferredMode = getPreferredColorBlindMode();
      var button = document.getElementById("accessibility-button");
      var body = document.body;
      if (preferredMode === "true") {
        body.classList.add("color-blind-mode");
      } else {
        body.classList.remove("color-blind-mode");
      }
    }

    // Llamada inicial para aplicar el modo de personas daltónicas
    applyColorBlindMode();

    function toggleAccessibilityMenu() {
      var menu = document.getElementById("accessibility-menu");
      if (menu.style.display === "none") {
        menu.style.display = "block";
      } else {
        menu.style.display = "none";
      }
    }

    function decreaseFontSize() {
      document.body.style.fontSize = "smaller";
      document.getElementById("accessibility-button").style.position = "fixed";
      document.getElementById("accessibility-button").classList.remove("color-blind-mode");
      document.getElementById("accessibility-menu").style.display = "none";
    }

    function increaseFontSize() {
      document.body.style.fontSize = "larger";
      document.getElementById("accessibility-button").style.position = "fixed";
      document.getElementById("accessibility-button").classList.remove("color-blind-mode");
      document.getElementById("accessibility-menu").style.display = "none";
    }

    function toggleColorBlindMode() {
      var button = document.getElementById("accessibility-button");
      var body = document.body;
      var preferredMode = getPreferredColorBlindMode();
      if(preferredMode === "true") {
        setPreferredColorBlindMode("false");
      } else {
        setPreferredColorBlindMode("true");
      }
      applyColorBlindMode();
      button.style.position = "fixed";
      document.getElementById("accessibility-menu").style.display = "none";
    }
	
  </script>
  <script src="https://kit.fontawesome.com/b6b3c6b97d.js" crossorigin="anonymous"></script>
   <svg xmlns="http://www.w3.org/2000/svg" style="display:none;">
    
    <filter id="rojo-verde">
      <feColorMatrix type="matrix" values="0.625 0.375 0 0 0 0.7 0.3 0 0 0 0 0.3 0.7 0 0 0 0 0 1 0"/>
    </filter>
  </svg>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<body>
	<header>
		<h1>REBRETEC</h1>
	<div class="centered"></div>
		<div class="logo">
			<img src="{{ asset('assets/logos/original.JPG') }}" alt="Logo">
		</div>
		<ul class="menu">
			<li><a  class="btn" href="{{route('bienvenida')}}">Inicio</a></li>
			<li><a  class="btn" href="#noticias">Información</a></li>
			<li><a  class="btn" href="#servicios">Servicios TI</a></li>
			@if (Route::has('login'))
            @auth
				<li><a href="{{ route('dashboard') }}" class="btn" style="background-color: rgb(255, 98, 0);">Panel Administrativo</a></li>
            @else
				<li><a href="{{ route('login') }}" class="btn">Ingresar</a></li>

                @if (Route::has('register'))
					<li><a href="{{ route('register') }}" class="btn">Registrarse</a></li>
                @endif

            @endauth
         @endif
		</ul>
	</header>
	
    @if (session('info'))
		<script>
			alert('{{ addslashes(session('info')) }}');
		</script>
	@endif

	<div class="carousel" align="center">
		<img src="{{ asset('assets/logos/LOGO2_ .jpg') }}" alt="Imagen promocional">
	</div>
	<div class="request-info">
		<p>REDUCCIÓN DE LA BRECHA TECNOLÓGICA DIGITAL A TRAVÉS DE ESTRATEGIAS Y LÍNEAS DE ACCIÓN PARA EL FORTALECIMIENTO DE LA AGENDA DE TRANSFORMACIÓN DIGITAL 2022-2025 EN EL CANTÓN MORONA</p>
		<a href="{{ route('login') }}">Solicitar Servicio</a>
	</div>
	<div class="news-events">
		<div class="separador-horizontal"></div>
		<h2>Noticias y eventos</h2>
		<div class="news-event">
			<img src="{{ asset('assets/logos/foto1.jpg') }}" alt="Imagen de noticia o evento">
			<div class="news-event-info">
				<h3>Cursos sobre el manejo de residuos tecnológicos</h3>
				<p>Descripción breve de la noticia o evento. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
			</div>
		</div>
		<div class="news-event">
			<img src="{{ asset('assets/logos/foto2.jpg')}}" alt="Imagen de noticia o evento">
			<div class="news-event-info">
				<h3>Feria de proyectos de vinculación Riobamba</h3>
				<p>Descripción breve de la noticia o evento. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
			</div>
		</div>
		<div class="news-event">
			<img src="{{ asset('assets/logos/foto3.jpg')}}" alt="Imagen de noticia o evento">
			<div class="news-event-info">
				<h3>Feria de vinculación Macas</h3>
				<p>Descripción breve de la noticia o evento. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
			</div>
		</div>
		
			<div class="news-event-info">
				<div class="separador-horizontal"></div>
				<h3 id="noticias">¿En dónde lo hacemos?</h3>
				<br><p>El presente proyecto se ejecuta en el cantón Morona en el sector urbano y rural. Además,
				se utilizará la distribución del Distrito 14D01 Morona Educación para el enfoque en las instituciones educativas.</p></BR>
				<center><iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d127568.14822704914!2d-78.181457!3d-2.335323!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x91d20f5e5c178825%3A0x2309c4619946ac5c!2sMacas!5e0!3m2!1ses!2sec!4v1688950949494!5m2!1ses!2sec" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
			</center>
			</div>
			
	</div>
	<div class="services">
		<div class="separador-horizontal"></div>
		<div class="service">
			<h3>¿De qué trata nuestro proyecto?</h3>
			<P>Realizar un proceso de reciclaje tecnológico para repotenciar y poner en marcha equipos de cómputo que facilitará el proceso de enseñanza-aprendizaje en las instituciones educativas del cantón Morona que no tienen acceso a una educación en competencias digitales debido a la falta de recursos económicos. Además, se propone una capacitación presencial sobre el manejo de los equipos tecnológicos, así como de programas, aplicaciones, páginas web de apoyo educativo y herramientas TICs para el aprendizaje del idioma inglés. También se realizará un levantamiento de información para conocer las prioridades de la
			ciudadanía y de las instituciones educativas y se priorizarán aquellas instituciones que tienen menos recursos tecnológicos disponibles.</P>
			<br><center><iframe width="560" height="315" src="https://www.youtube.com/embed/C9WFPdqvR3Q" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
			</br></CENTER>
		</div>
		<div class="separador-horizontal"></div>
		<div class="service">
			<h3>¿Por que lo hacemos?</h3>
			<P>La acumulación de basura electrónica es un gran problema que afecta a la sociedad debido a su toxicidad y complejidad. La Escuela Superior Politécnica de Chimborazo ha emprendido un proyecto de vinculación con la finalidad de reducir la brecha tecnológica en la provincia
			de Morona Santiago. El proyecto busca fortalecer y promover la transformación digital en el cantón Morona a través de estrategias y líneas de acción.
Promover el reciclaje tecnológico, recuperar partes y piezas que puedan ser reutilizadas, 
reducir niveles de contaminación ocasionados por los residuos tecnológicos.</P>
		</div>
		
		<div class="separador-horizontal"></div>
		<div class="services">
		<h2 id="servicios">Servicios</h2>
		<div class="service">
			<h3>Servicio 1</h3>
			<p>Contribución a la conservación del medio ambiente a través de la implementación de un proceso responsable de reciclaje de equipos de cómputo en el cantón Morona cumpliendo con la normativa y 
			recomendaciones nacionales para el manejo de residuos tecnológicos.</p>
		</div>
		<div class="service">
			<h3>Servicio 2</h3>
			<P>Reutilización de partes y piezas de equipos reciclados para rehabilitar equipos de cómputo de las unidades educativas del cantón Morona que 
			requieran intervención técnica y garantizar que estos regresen a la operatividad y servicio de la comunidad educativa.</p>
		</div>
		<div class="service">
			<h3>Servicio 3</h3>
			<P>Implementación de una serie de programas de capacitación dirigidos a la comunidad que permitan fomentar el uso adecuado 
			de las tecnologías de la información y la comunicación desarrollando habilidades y competencias digitales.</P>
		</div>
		
		</div>
	</div></div>
	<div class="useful-links">
		<div class="separador-horizontal"></div>
		<h2>Enlaces útiles</h2>
		<ul>
			<li><a class="btn" href="http://sedemacas.espoch.edu.ec/?q=node/103">ESPOCH- Morona Santiago</a></li>
			<li><a class="btn" href="http://sedemacas.espoch.edu.ec/?q=services">Oferta Académica</a></li>
			<li><a class="btn" href="http://sedemacas.espoch.edu.ec/?q=contacts">Contactos</a></li>
			<li><a class="btn" href="https://servicios.espoch.edu.ec/ServicioEspoch/">SERVICIOS TICS</a></li>
			<li><a class="btn" href="https://www.facebook.com/espochms">Facebook</a></li>
			<li><a class="btn" href="http://sedemacas.espoch.edu.ec/?q=node/121">Investigación ESPOCH</a></li>
		</ul>
	</div>
	<div class="separador-horizontal"></div>
	<div class="contact-info">
		<h2>Información de contacto</h2>
		<p>Ponte en contacto con nosotros para más información sobre nuestros programas académicos y servicios.</p>
		<ul>
			<li>
				<strong>Dirección:</strong> Av. Antonio José de Sucre s/n y Calle Riobamba, Riobamba, Ecuador
			</li>
			<li>
				<strong>Teléfono:</strong> +593 (3) 2999-740
			</li>
			<li>
				<strong>Correo electrónico:</strong> info@sedespoch.edu.ec
			</li>
		</ul>
	</div>
	<footer>
		<p>Derechos reservados © 2023 SED - Escuela Superior Politécnica de Chimborazo</p>
	</footer>
</body>
</html>
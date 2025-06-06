<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Denuncias</title>
  <link rel="stylesheet" href="css/config.css">
  <link rel="stylesheet" href="css/dispositvio.css">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <script src="https://kit.fontawesome.com/20f9d7f848.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>

<body>
  <?php include 'php/verificar_sesion.php' ?>
  <header>



    <svg style="position: absolute;" class="wave1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
      <path fill="#004aad" fill-opacity="1"
        d="M0,128L48,133.3C96,139,192,149,288,176C384,203,480,245,576,261.3C672,277,768,267,864,234.7C960,203,1056,149,1152,133.3C1248,117,1344,139,1392,149.3L1440,160L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z">
      </path>
    </svg>
    <div class="header1">
      <button id="abrir" class="abrir-menu">
        <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor" class="abrir"
          viewBox="0 0 16 16">
          <path fill-rule="evenodd"
            d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
        </svg>
      </button>
    </div>
    <a href="index.html" class="a"> <img class="logo" src="img/logo1.png" alt="" /></a>

    <nav class="header" id="nav">
      <button class="cerrar-menu" id="cerrar">
        <svg xmlns="http://www.w3.org/2000/svg" width="60" height="46" fill="currentColor" class="cerrar"
          viewBox="0 0 16 16">
          <path
            d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
        </svg>
      </button>

      <div class="lista">
        <ul class="nav-list">
          <li><a href="index.html">Inicio</a></li>
          <li><a href="Denuncias-html.php">Denuncias</a></li>
          <li><a href="qn.php">Quienes somos</a></li>
          <li><a href="mapa.php">Mapa</a></li>
          <li><a href="Dispositivo.php">Dispositivo</a></li>
          <li><a href="contactos.php">Contactos</a></li>
          <li id="userNameContainer" style="display: none;">
            <span id="userNameDisplay"></span>
          </li>
          <li>
            <div class="profile-icon-container">
              <div class="profile-icon" id="profileIcon" onclick="openConfigModal()">
                <!-- Si hay una foto de perfil, mostrarla -->
                <img id="profileImage" style="display: none;" src="" alt="Perfil">
                <!-- Si no hay foto, mostrar iniciales -->
                <span class="profile-initials" id="profileInitials">?</span>
              </div>
              <div class="profile-tooltip" id="profileTooltip">
                <span id="profileName">Usuario</span>
              </div>
            </div>
          </li>

          <li>
            <button class="iconocampana" onclick="openModal()" style="background-color: transparent; border: none;">
              <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="icon"
                viewBox="0 0 16 16">
                <path
                  d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2m.995-14.901a1 1 0 1 0-1.99 0A5 5 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901" />
              </svg>
            </button>
          </li>
        </ul>

      </div>
    </nav>
    <div id="modal-container">
      <div id="modal-content">
        <p class="textocontenet">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" padd height="16" fill="currentColor" class="circle-fill"
            viewBox="0 0 16 16" color="red">
            <circle cx="8" cy="8" r="8" />
          </svg>
          Nagua tiene una nueva zona roja sea formo <br /><br />
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="circle-fill"
            viewBox="0 0 16 16" color="red">
            <circle cx="8" cy="8" r="8" />
          </svg>
          Ya fue respondido tu mensage (revisa tu chat privado)
          <br /><br />
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="circle-fill"
            viewBox="0 0 16 16" color="red">
            <circle cx="8" cy="8" r="8" />
          </svg>Comfirma tu correo electronico <br /><br />
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="circle-fill"
            viewBox="0 0 16 16" color="red">
            <circle cx="8" cy="8" r="8" />
          </svg>
          Se registro tu usuario (no olvides tu contraseña) <br />
        </p>
        <span class="close-btn" onclick="closeModal()">
          <p>Cerrar</p>
        </span>
      </div>
    </div>

  </header>



  <div style="margin-bottom: -10px;" class="hero__waves">

  </div>


  <div style="display: flex;" class="hero">


    <div class="Dispositivo">
      <ul class="carousel-container radio">
        <li>
          <input class="carousel-toggle" id="slide-1" type="radio" name="c-toggle" checked />
          <label class="dot" for="slide-1"></label>
          <ul class="carousel-content">
            <li class="img1">
              <img src="img/IMG-20240106-WA0003.svg" loading="lazy" />
              <label class="arrow back" for="slide-2">&#8250;</label>
              <label class="arrow next" for="slide-4">&#8249;</label>
            </li>
          </ul>
        </li>
        <li>
          <input class="carousel-toggle" id="slide-2" type="radio" name="c-toggle" />
          <label class="dot" for="slide-2"></label>
          <ul class="carousel-content">
            <li class="img1">
              <img src="img/IMG-20240106-WA0002.jpg" loading="lazy" />
              <label class="arrow back" for="slide-3">&#8250;</label>
              <label class="arrow next" for="slide-1">&#8249;</label>
            </li>
          </ul>
        </li>
        <li>
          <input class="carousel-toggle" id="slide-3" type="radio" name="c-toggle" />
          <label class="dot" for="slide-3"></label>
          <ul class="carousel-content">
            <li class="img1">
              <img src="img/IMG-20240106-WA0003.jpg" loading="lazy" />
              <label class="arrow back" for="slide-4">&#8250;</label>
              <label class="arrow next" for="slide-2">&#8249;</label>
            </li>
          </ul>
        </li>
        <li>
          <input class="carousel-toggle" id="slide-4" type="radio" name="c-toggle" />
          <label class="dot" for="slide-4"></label>
          <ul class="carousel-content">
            <li class="img">
              <img src="img/IMG-20240106-WA0004.jpg" loading="lazy" />
              <label class="arrow back" for="slide-1">&#8250;</label>
              <label class="arrow next" for="slide-3">&#8249;</label>
            </li>
          </ul>
        </li>
      </ul>
    </div>




    <div id="modal-container1">
      <div id="modal-content1">

        <p class="textocontenet1">Como Funciona el dispositivo: El dispositivo se coloca en un poste de luz, este
          contendrá un medidor de decibeles el cual tendrá un límite establecido, que sería el
          límite legal, el dispositivo estará conectado a través de la red global
          con una velocidad de 2G para que este pueda enviar la información que vaya recolectando a una base de datos de
          la policía, el poste de luz tendrá un para rayos de cobre para evitar que se dañen el dispositivo con una
          caída de un rayo.</p>
        <span id="close-btn1" onclick="closeModal2()">
          <p>Cerrar</p>
        </span>
      </div>
    </div>
    <div class="contenedor1">

      <div>

        <H1 class="title2">NES</H1>
        <H1 class="title3">Dispositivo sensorial auditivo</H1>
        <div class="colores">
          <svg xmlns="http://www.w3.org/2000/svg" width="56" height="56" color="#000000" fill="currentColor"
            class="bi bi-circle-fill" viewBox="0 0 16 16">
            <circle cx="8" cy="8" r="8" />
          </svg>
          <svg xmlns="http://www.w3.org/2000/svg" width="56" height="56" color="#004aad" fill="currentColor"
            class="bi bi-circle-fill" viewBox="0 0 16 16">
            <circle cx="8" cy="8" r="8" />
          </svg>
          <svg xmlns="http://www.w3.org/2000/svg" width="56" height="56" color="#a6a6a6" fill="currentColor"
            class="bi bi-circle-fill" viewBox="0 0 16 16">
            <circle cx="8" cy="8" r="8" />
          </svg>
        </div>

      </div>

      <div class="contenedor2">
        <a href="Denuncias-html.php">
          <button id="btn-solicitar">
            Solicitar <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor"
              class="bi bi-newspaper" viewBox="0 0 16 16">
              <path
                d="M0 2.5A1.5 1.5 0 0 1 1.5 1h11A1.5 1.5 0 0 1 14 2.5v10.528c0 .3-.05.654-.238.972h.738a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 1 1 0v9a1.5 1.5 0 0 1-1.5 1.5H1.497A1.497 1.497 0 0 1 0 13.5zM12 14c.37 0 .654-.211.853-.441.092-.106.147-.279.147-.531V2.5a.5.5 0 0 0-.5-.5h-11a.5.5 0 0 0-.5.5v11c0 .278.223.5.497.5z" />
              <path
                d="M2 3h10v2H2zm0 3h4v3H2zm0 4h4v1H2zm0 2h4v1H2zm5-6h2v1H7zm3 0h2v1h-2zM7 8h2v1H7zm3 0h2v1h-2zm-3 2h2v1H7zm3 0h2v1h-2zm-3 2h2v1H7zm3 0h2v1h-2z" />
            </svg>
          </button>
        </a href="Denuncias-html.php">

        <button id="Info" onclick="openModal1()">Mas informacion <svg xmlns="http://www.w3.org/2000/svg" width="30"
            height="30" fill="currentColor" class="bi bi-link-45deg" viewBox="0 0 16 16">
            <path
              d="M4.715 6.542 3.343 7.914a3 3 0 1 0 4.243 4.243l1.828-1.829A3 3 0 0 0 8.586 5.5L8 6.086a1 1 0 0 0-.154.199 2 2 0 0 1 .861 3.337L6.88 11.45a2 2 0 1 1-2.83-2.83l.793-.792a4 4 0 0 1-.128-1.287z" />
            <path
              d="M6.586 4.672A3 3 0 0 0 7.414 9.5l.775-.776a2 2 0 0 1-.896-3.346L9.12 3.55a2 2 0 1 1 2.83 2.83l-.793.792c.112.42.155.855.128 1.287l1.372-1.372a3 3 0 1 0-4.243-4.243z" />
          </svg></button>
      </div>
    </div>


  </div>

  </div>

  <dialog id="modaldesolicitar">
    <p></p>
    <button id="cerrarmodal">cerrar</button>
  </dialog>
  <div class="footer-basic">
    <footer>
      <div style="margin-bottom: -10px;" class="hero__waves">

      </div>
      <div class="social">
        <a href="https://www.instagram.com/nes29448/"><i class="icon ion-social-instagram"></i></a>
        <a href="https://mail.google.com/mail/u/0/#inbox"><i class="fa-solid fa-envelope"></i></a>
        <a href="https://twitter.com/Nes39489676"><i class="icon ion-social-twitter"></i></a>
        <a
          href="https://m.facebook.com/story.php?story_fbid=1254163131833931&substory_index=1254163131833931&id=100089342328341&sfnsn=mo&mibextid=RUbZ1f"><i
            class="icon ion-social-facebook"></i></a>
      </div>

      <ul class="list-inline">
        <li class="list-inline-item"><a href="index.html">Home</a></li>
        <li class="list-inline-item"><a href="Denuncias-html.php">Denuncias</a></li>
        <li class="list-inline-item"><a href="qn.php">Quienes Somos</a></li>
        <li class="list-inline-item"><a href="Dispositivo.php">Dispositivos</a></li>
        <li class="list-inline-item"><a href="contactos.php">Contactanos</a></li>
      </ul>
      <p class="copyright">Company NES © 2023</p>
    </footer>
  </div>

  <!-- Modal de Configuración -->
		<div id="configModal" class="config-modal">
			<div class="config-modal-content">
				<div class="config-header">
					<h2>Configuración de perfil</h2>
					<span class="close-config" onclick="closeConfigModal()">&times;</span>
				</div>
				<div class="config-body">
					<form id="configForm" onsubmit="return saveConfig(event)">
						<div class="config-group">
							<label for="configNombre">Nombre</label>
							<input type="text" id="configNombre" name="nombre" required>
						</div>
						<div class="config-group">
							<label for="configEmail">Email</label>
							<input type="email" id="configEmail" name="email" required>
						</div>
						<div class="config-group">
							<label for="configPassword">Nueva Contraseña</label>
							<input type="password" id="configPassword" name="password">
							<small>Dejar en blanco si no desea cambiarla</small>
						</div>
						<div class="config-buttons">
							<button type="submit" class="btn-guardar">Guardar cambios</button>
							<button type="button" class="btn-cerrar" onclick="cerrarSesion()">Cerrar sesión</button>
						</div>
					</form>
				</div>
			</div>
		</div>
  <script>
		// Mostrar el nombre del usuario si está logueado
		document.addEventListener('DOMContentLoaded', function () {
			// Función para cargar datos del usuario
			function loadUserProfile() {
				// Verificar si el usuario está logueado 
				if (typeof window.usuarioLogueado !== 'undefined' && window.usuarioLogueado) {
					// Si ya tenemos el nombre en el objeto window
					if (window.nombreUsuario) {
						updateProfileIcon(window.nombreUsuario);
					} else {
						// Obtener datos del usuario desde el servidor
						fetch('php/get_user_data.php')
							.then(response => response.json())
							.then(data => {
								if (!data.error) {
									updateProfileIcon(data.nombre);
								}
							})
							.catch(error => console.error('Error cargando perfil:', error));
					}
				}
			}

			// Función para actualizar el ícono de perfil con las iniciales
			function updateProfileIcon(nombre) {
				const profileInitials = document.getElementById('profileInitials');
				const profileName = document.getElementById('profileName');

				if (profileInitials && profileName && nombre) {
					// Obtener iniciales (primera letra del nombre y primera del apellido si existe)
					const nameParts = nombre.trim().split(' ');
					let initials = nameParts[0].charAt(0);

					if (nameParts.length > 1) {
						initials += nameParts[nameParts.length - 1].charAt(0);
					}

					profileInitials.textContent = initials.toUpperCase();
					profileName.textContent = nombre;
				}
			}

			// Llamar a la función para cargar el perfil
			loadUserProfile();
		});
	</script>
  <script src="javascript/Dispositivomodal.js"></script>
  <script src="javascript/menu.js"></script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script src="javascript/config.js"></script>
  <script src="javascript/menu_usuario.js"></script>


</body>

</html>
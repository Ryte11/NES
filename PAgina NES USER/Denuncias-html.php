<!-- 
  Archivo editado por Marcos
  Última edición: 30/04/2025
  Cambios: Actualización del formulario de denuncias, incluyendo selector de provincias 
  y tipos de denuncias adicionales
-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Denuncias</title>
  <link rel="stylesheet" href="css/config.css">
  <link rel="stylesheet" href="css/denuncias1.css">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <script src="https://kit.fontawesome.com/20f9d7f848.js" crossorigin="anonymous"></script>
</head>

<body>
<<<<<<< HEAD:PAgina NES USER/Denuncias-html.html

  <header>

=======
  
  <header >
   <?php include 'php/verificar_sesion.php' ?>
>>>>>>> 62b13fd5f5b783e51704ef8f9f85f0d5cd3dc2b7:PAgina NES USER/Denuncias-html.php
    <div class="header1">
      <button id="abrir" class="abrir-menu"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
          fill="currentColor" class="abrir" viewBox="0 0 16 16">
          <path fill-rule="evenodd"
            d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
        </svg>
      </button>
    </div>
    <a href="index.html" class="a"> <img class="logo" src="img/logo1.png" alt=""></a>

    <nav class="header" id="nav">

<<<<<<< HEAD:PAgina NES USER/Denuncias-html.html
      <button class="cerrar-menu" id="cerrar"><svg xmlns="http://www.w3.org/2000/svg" width="60" height="46"
          fill="currentColor" class="cerrar" viewBox="0 0 16 16">
          <path
            d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
        </svg>
      </button>


      <div class="lista">
        <ul class="nav-list">
          <li><a href="index.html">Inicio</a></li>
          <li><a href="Denuncias-html.html">Denuncias</a></li>
          <li><a href="qn.html">Quienes somos</a></li>
          <li><a href="mapa.html">Mapa</a></li>
          <li><a href="Dispositivo.html">Dispositivo</a></li>
          <li><a href="Contactos.html">Contactos</a></li>
          <li style="background-color: transparent;">
            <button class="iconocampana" onclick="openModal()"
              style="color: black; background-color: #ffff; border: none;">
              <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="icon"
                viewBox="0 0 16 16">
                <path
                  d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2m.995-14.901a1 1 0 1 0-1.99 0A5 5 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901" />
              </svg>
            </button>
          </li>
        </ul>
      </div>
=======
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
              <li style="background-color: transparent;">
                <button class="iconocampana" onclick="openModal()" style="color: black; background-color: #ffff; border: none;">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      width="36"
                      height="36"
                      fill="currentColor"
                      class="icon"
                      viewBox="0 0 16 16"
                    >
                      <path
                        d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2m.995-14.901a1 1 0 1 0-1.99 0A5 5 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901"
                      />
                    </svg>
                  </button>
            </li>
          </ul>
        </div>
>>>>>>> 62b13fd5f5b783e51704ef8f9f85f0d5cd3dc2b7:PAgina NES USER/Denuncias-html.php
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
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" style=" width: 100%;">
      <path fill="#2a5298" fill-opacity="1"
        d="M0,96L48,101.3C96,107,192,117,288,149.3C384,181,480,235,576,229.3C672,224,768,160,864,133.3C960,107,1056,117,1152,133.3C1248,149,1344,171,1392,181.3L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
      </path>
    </svg>
  </div>


  <div style="display: flex;" class="hero">

    <section class="hero__main container">
      <div class="hero__texts">
        <h1 class="hero__title">Haz Tu Denuncia</h1>
        <p class="hero__subtitle"> Chatea con Nosotros</p>
        <button class="hero__cta" onclick="openModalform()">Envia tu caso ya</button>

      </div>

    </section>
    <div class="modal" id="denunciaModal">
      <div class="modal-content">
        <button class="close-btn" onclick="closeModalform()">&times;</button>
        <h2 style="margin-top: 0; color: #1F2937; margin-bottom: 1.5rem;">Formulario de Denuncia</h2>

        <form id="denunciaForm" onsubmit="handleSubmit(event)" action="guardar_denuncia.php" method="POST">
          <div class="form-group">
            <label class="form-label">Nombre Completo</label>
            <input type="text" class="form-input" id="nombre" name="nombre">
            <span class="error-message" id="nombre-error"></span>
          </div>

          <div class="form-group">
            <label class="form-label">Cedula</label>
            <input type="text" class="form-input" id="Cedula" name="Cedula">
            <span class="error-message" id="Cedula-error"></span>
          </div>

          <div class="form-group">
            <label class="form-label">Provincia</label>
            <select class="form-select" id="provincia" name="provincia" required>
              <option value="">Seleccione una provincia</option>
              <option value="Azua">Azua</option>
              <option value="Baoruco">Baoruco</option>
              <option value="Barahona">Barahona</option>
              <option value="Dajabon">Dajabón</option>
              <option value="Distrito Nacional">Distrito Nacional</option>
              <option value="Duarte">Duarte</option>
              <option value="El Seibo">El Seibo</option>
              <option value="Elias Piña">Elías Piña</option>
              <option value="Espaillat">Espaillat</option>
              <option value="Hato Mayor">Hato Mayor</option>
              <option value="Hermanas Mirabal">Hermanas Mirabal</option>
              <option value="Independencia">Independencia</option>
              <option value="La Altagracia">La Altagracia</option>
              <option value="La Romana">La Romana</option>
              <option value="La Vega">La Vega</option>
              <option value="Maria Trinidad Sanchez">María Trinidad Sánchez</option>
              <option value="Monseñor Nouel">Monseñor Nouel</option>
              <option value="Monte Cristi">Monte Cristi</option>
              <option value="Monte Plata">Monte Plata</option>
              <option value="Pedernales">Pedernales</option>
              <option value="Peravia">Peravia</option>
              <option value="Puerto Plata">Puerto Plata</option>
              <option value="Samana">Samaná</option>
              <option value="San Cristobal">San Cristóbal</option>
              <option value="San Jose de Ocoa">San José de Ocoa</option>
              <option value="San Juan">San Juan</option>
              <option value="San Pedro de Macoris">San Pedro de Macorís</option>
              <option value="Santiago">Santiago</option>
              <option value="Santiago Rodriguez">Santiago Rodríguez</option>
              <option value="Santo Domingo">Santo Domingo</option>
              <option value="Valverde">Valverde</option>
            </select>
            <span class="error-message" id="provincia-error"></span>
          </div>

          <div class="form-group">
            <label class="form-label">Dirección Específica</label>
            <input type="text" class="form-input" id="ubicacion" name="ubicacion"
              placeholder="Calle, sector, número, punto de referencia" required>
            <span class="error-message" id="ubicacion-error"></span>
          </div>

          <div class="form-group">
            <label class="form-label">Tipo de Denuncia</label>
            <select class="form-select" id="tipo" name="tipo" required>
              <option value="">Seleccione un tipo</option>
              <option value="bocinas">Bocinas</option>
              <option value="vehiculos">Vehículos</option>
              <option value="construccion">Construcciones fuera de horario</option>
              <option value="ruido">Ruido de parlantes</option>
            </select>
            <span class="error-message" id="tipo-error"></span>
          </div>

          <div class="form-group">
            <label class="form-label">Descripción de la Denuncia</label>
            <textarea class="form-input" id="descripcion" name="descripcion"></textarea>
            <span class="error-message" id="descripcion-error"></span>
          </div>

          <button type="submit" class="submit-btn">Enviar tu Denuncia</button>
        </form>
      </div>
    </div>



    <div class="contenedor">
      <div class="chat-caja">
        <div class="chat-header">
          <img src="img/logo.png" alt="NES Logo">
          <div class="chat-header-info">
            <h2 class="chat-header-title">Asistente NES</h2>
            <p class="chat-header-subtitle">Noise Environment System</p>
          </div>
        </div>
        <div class="chat-body">
          <!-- Los mensajes se mostrarán aquí dinámicamente -->
        </div>
        <div class="chat-footer">
          <form id="form">
            <input type="text" id="input" placeholder="Escribe tu mensaje aquí..." autocomplete="off"
              aria-label="Mensaje" />
            <button type="submit" aria-label="Enviar mensaje">
              Enviar
            </button>
          </form>
        </div>
      </div>
    </div>

<<<<<<< HEAD:PAgina NES USER/Denuncias-html.html
=======
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


>>>>>>> 62b13fd5f5b783e51704ef8f9f85f0d5cd3dc2b7:PAgina NES USER/Denuncias-html.php
  </div>

  <div class="footer-basic">
    <footer>

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
        <li class="list-inline-item"><a href="mapa.php">mapa</a></li>
        <li class="list-inline-item"><a href="Dispositivo.php">Dispositivos</a></li>
        <li class="list-inline-item"><a href="contactos.php">Contactanos</a></li>
      </ul>
      <p class="copyright">Company NES © 2023</p>
    </footer>
<<<<<<< HEAD:PAgina NES USER/Denuncias-html.html
  </div>
=======
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
>>>>>>> 62b13fd5f5b783e51704ef8f9f85f0d5cd3dc2b7:PAgina NES USER/Denuncias-html.php

  <script src="javascript/alertas1.js"></script>
  <script src="javascript/mapa.js"></script>
<<<<<<< HEAD:PAgina NES USER/Denuncias-html.html
  <script src="javascript/ai_chat.js"></script>
=======
  <script src="javascript/chat1.js" defer></script>
  <script src="javascript/config.js"></script>
	<script src="javascript/menu_usuario.js"></script>
 
>>>>>>> 62b13fd5f5b783e51704ef8f9f85f0d5cd3dc2b7:PAgina NES USER/Denuncias-html.php
</body>

</html>
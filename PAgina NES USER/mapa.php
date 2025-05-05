<?php
require 'php/conexion_html.php';

// Consultar todos los dispositivos
$sql = "SELECT id_dispositivo, latitud, longitud, zona_referencia, fecha_instalacion FROM dispositivos";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="es">
<?php include 'php/verificar_sesion.php' ?>

<head>
  <title>Mapa de la República Dominicana</title>
  <meta charset="UTF-8">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="css/Mapa.css" />
  <link rel="stylesheet" href="css/config.css" />
  <script src="https://kit.fontawesome.com/20f9d7f848.js" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css" />
  <title>Mapa</title>
</head>

<body>
  <header>
    <div class="header1">
      <button id="abrir" class="abrir-menu"><svg xmlns="http://www.w3.org/2000/svg" width="60" height="60"
          fill="currentColor" class="abrir" viewBox="0 0 16 16">
          <path fill-rule="evenodd"
            d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
        </svg>
      </button>
    </div>
    <a href="index.html" class="a"> <img class="logo" src="img/logo. png" alt=""></a>

    <nav class="header" id="nav">
      <button class="cerrar-menu" id="cerrar"><svg xmlns="http://www.w3.org/2000/svg" width="60" height="46"
          fill="currentColor" class="cerrar" viewBox="0 0 16 16">
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
            <button class="iconocampana" onclick="openModal()" style="background-color: white; color: black;">
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
  </header>

  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" style="width: 100%; " class="wave">
    <path fill="#2a5298" fill-opacity="1" d="M0,96L48,101.3C96,107,192,117,288,149.3C384,
            181,480,235,576,229.3C672,224,768,160,864,133.3C960,107,1056,117,1152,133.3C1248,149,1344,
            171,1392,181.3L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,
            320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
  </svg>

  <div class="mapatitulo">
    <div class="todoslostextos">
      <h1 class="estilo_titulo1">Lugares</h1>

      <div class="svg">
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="40" fill="currentColor" class="bi bi-geo-alt-fill"
          viewBox="0 0 16 16">
          <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6" />
        </svg>
      </div>

      <div id="modal-container">
        <div id="modal-content">
          <p class="textocontenet">
          <div class="notification-item">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="circle-fill"
              viewBox="0 0 16 16">
              <circle cx="8" cy="8" r="8" fill="red" />
            </svg>
            <span>Nagua tiene una nueva zona roja</span>
          </div>

          <div class="notification-item">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="circle-fill"
              viewBox="0 0 16 16">
              <circle cx="8" cy="8" r="8" fill="red" />
            </svg>
            <span>Ya fue respondido tu mensaje (revisa tu chat privado)</span>
          </div>

          <div class="notification-item">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="circle-fill"
              viewBox="0 0 16 16">
              <circle cx="8" cy="8" r="8" fill="red" />
            </svg>
            <span>Confirma tu correo electrónico</span>
          </div>

          <div class="notification-item">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="circle-fill"
              viewBox="0 0 16 16">
              <circle cx="8" cy="8" r="8" fill="red" />
            </svg>
            <span>Se registró tu usuario (no olvides tu contraseña)</span>
          </div>
          </p>
          <span class="close-btn" onclick="closeModal()">
            <p>Cerrar</p>
          </span>
        </div>
      </div>

      <p class="mapasubtitulo">
        Son marcas la cuales señales representan zonas que se nosotros
        clasificamos como ruidosas o no gracias a la información que
        almacenamos.
      </p>

      <h1 class="estilo_titulo2">Dispositivo</h1>

      <div class="svg2">
        <svg xmlns="http://www.w3.org/2000/svg" width="56" height="66" fill="currentColor" class="bi bi-volume-down"
          viewBox="0 0 16 16">
          <path
            d="M9 4a.5.5 0 0 0-.812-.39L5.825 5.5H3.5A.5.5 0 0 0 3 6v4a.5.5 0 0 0 .5.5h2.325l2.363 1.89A.5.5 0 0 0 9 12zM6.312 6.39 8 5.04v5.92L6.312 9.61A.5.5 0 0 0 6 9.5H4v-3h2a.5.5 0 0 0 .312-.11M12.025 8a4.5 4.5 0 0 1-1.318 3.182L10 10.475A3.5 3.5 0 0 0 11.025 8 3.5 3.5 0 0 0 10 5.525l.707-.707A4.5 4.5 0 0 1 12.025 8" />
        </svg>
      </div>

      <p class="mapasubtitulo">
        Es el icono con el cual al momento de hacer clic en alguno de los
        lugares o zonas podrás recocer en que lugar de esa zona hay un
        dispositivo NES operativo.
      </p>
    </div>

    <main style="display: flex; flex-direction: column; align-items: center; color: white;">
      <h1>Dispositivos registrados</h1>
      <div id="mapa" class=""
        style="height: 500px; width: 65%; margin: 20px auto; border: 2px solid #ddd; border-radius: 10px;">
      </div>
    </main>
  </div>

  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" style="margin-top: -30px; " class="svg1">
    <path fill="#2a5298" fill-opacity="1"
      d="M0,128L60,144C120,160,240,192,360,170.7C480,149,600,75,720,69.3C840,64,960,128,1080,165.3C1200,203,1320,213,1380,218.7L1440,224L1440,0L1380,0C1320,0,1200,0,1080,0C960,0,840,0,720,0C600,0,480,0,360,0C240,0,120,0,60,0L0,0Z">
    </path>
  </svg>

  <div class="footer-basic">
    <footer>
      <div style="margin-bottom: -10px" class="hero__waves"></div>
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
        <li class="list-inline-item">
          <a href="Denuncias-html.php">Denuncias</a>
        </li>
        <li class="list-inline-item"><a href="qn.php">Quienes Somos</a></li>
        <li class="list-inline-item">
          <a href="Dispositivo.php">Dispositivos</a>
        </li>
        <li class="list-inline-item">
          <a href="contactos.php">Contactanos</a>
        </li>
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
  <script src="javascript/menu.js"></script>
  <script src="javascript/Mapa.js"></script>

  <script>
    // Función para abrir el modal de notificaciones
    function openModal() {
      document.getElementById('modal-container').style.display = 'flex';
    }

    // Función para cerrar el modal de notificaciones
    function closeModal() {
      document.getElementById('modal-container').style.display = 'none';
    }

    // Función para abrir el modal de configuración
    function openConfigModal() {
      document.getElementById('configModal').style.display = 'block';

      // Cargar datos actuales del usuario si está disponible
      fetch('php/get_user_data.php')
        .then(response => response.json())
        .then(data => {
          if (!data.error) {
            document.getElementById('configNombre').value = data.nombre || '';
            document.getElementById('configEmail').value = data.email || '';
          }
        })
        .catch(error => console.error('Error cargando datos del usuario:', error));
    }

    // Función para cerrar el modal de configuración
    function closeConfigModal() {
      document.getElementById('configModal').style.display = 'none';
    }

    // Función para guardar la configuración
    function saveConfig(event) {
      event.preventDefault();

      const formData = new FormData(document.getElementById('configForm'));

      fetch('php/update_user.php', {
        method: 'POST',
        body: formData
      })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            alert('Datos actualizados correctamente');
            closeConfigModal();
            // Actualizar perfil
            if (data.nombre) {
              updateProfileIcon(data.nombre);
            }
          } else {
            alert('Error al actualizar datos: ' + data.message);
          }
        })
        .catch(error => {
          console.error('Error:', error);
          alert('Error al procesar la solicitud');
        });

      return false;
    }

    // Función para cerrar sesión
    function cerrarSesion() {
      fetch('php/logout.php')
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            window.location.href = 'login.php';
          } else {
            alert('Error al cerrar sesión');
          }
        })
        .catch(error => console.error('Error:', error));
    }
  </script>

  <script>
    // Inicializar el mapa una sola vez
    const mapaDiv = L.map('mapa').setView([18.7357, -70.1627], 8);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '© OpenStreetMap contributors'
    }).addTo(mapaDiv);

    // Agregar marcadores desde PHP
    <?php
    while ($row = $result->fetch_assoc()) {
      echo "L.marker([" . $row['latitud'] . ", " . $row['longitud'] . "])
                .addTo(mapaDiv)
                .bindPopup(`
                    <b>ID:</b> " . $row['id_dispositivo'] . "<br>
                    <b>Zona:</b> " . $row['zona_referencia'] . "<br>
                    <b>Fecha:</b> " . $row['fecha_instalacion'] . "
                `);";
    }
    ?>
  </script>
  <script src="javascript/config.js"></script>
</body>

</html>
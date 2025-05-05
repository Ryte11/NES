<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dispositivos</title>
    <link rel="stylesheet" href="css/dispositivo1.css">
    <link rel="stylesheet" href="css/guiaUsuario.css">
    <link rel="stylesheet" href="css/modoOscuro.css">
</head>

<body>
    <div class="menu-lat">
        <div class="menu">
            <div class="imagen">
                <a href="PanelDeControl.php">
                    <img src="IMG/logo1.png" alt="">
                </a>
            </div>

            <div class="menu-prin">
                <div class="menu-1">
                    <div class="input-div">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" width="32" height="32" stroke-width="2.5">
                            <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
                            <path d="M21 21l-6 -6"></path>
                        </svg>
                        <input type="search" placeholder="search" id="menuSearch">
                    </div>
                    <a href="PanelDeControl.php" class="menu-item">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" width="32" height="32" stroke-width="1.75">
                            <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                            <path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                            <path d="M13.41 10.59l2.59 -2.59"></path>
                            <path d="M7 12a5 5 0 0 1 5 -5"></path>
                        </svg>
                        <h3>Panel de control</h3>

                    </a>
                    <a href="Alertas.php" class="menu-item">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" width="32" height="32" stroke-width="1.75">
                            <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                            <path d="M12 8v4"></path>
                            <path d="M12 16h.01"></path>
                        </svg>
                        <h3>Alertas</h3>
                    </a>
                    <a href="" class="menu-item" id="menuNotificaciones">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" width="32" height="32" stroke-width="1.75">
                            <path
                                d="M10 5a2 2 0 1 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6">
                            </path>
                            <path d="M9 17v1a3 3 0 0 0 6 0v-1"></path>
                        </svg>
                        <h3>Notificaciones</h3>
                    </a>
                    <a href="Dashboard.php" class="menu-item">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" width="32" height="32" stroke-width="1.75">
                            <path d="M5 4h4a1 1 0 0 1 1 1v6a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1v-6a1 1 0 0 1 1 -1">
                            </path>
                            <path d="M5 16h4a1 1 0 0 1 1 1v2a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1v-2a1 1 0 0 1 1 -1">
                            </path>
                            <path d="M15 12h4a1 1 0 0 1 1 1v6a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1v-6a1 1 0 0 1 1 -1">
                            </path>
                            <path d="M15 4h4a1 1 0 0 1 1 1v2a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1v-2a1 1 0 0 1 1 -1">
                            </path>
                        </svg>
                        <h3>Dashboard</h3>
                    </a>
                    <a href="Dispositivo.php" class="menu-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-device-watch">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M6 9a3 3 0 0 1 3 -3h6a3 3 0 0 1 3 3v6a3 3 0 0 1 -3 3h-6a3 3 0 0 1 -3 -3v-6z" />
                            <path d="M9 18v3h6v-3" />
                            <path d="M9 6v-3h6v3" />
                        </svg>
                        <h3>Dispositivo</h3>
                    </a>
                    <li class="lista">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-users">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                            <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                            <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                        </svg>
                        <a href="Usuario.html">Usuarios</a>
                        <ul class="submenu">
                            <li><a href="Usuario.html">Usuarios Administrativos</a></li>
                            <li><a href="UsuarioMaxAdmin.html">Máximo Administrador</a></li>
                            <li><a href="UsuarioTecnico.php">Usuario Tecnico</a></li>
                        </ul>
                    </li>
                    <a href="Configuracion.php" class="menu-item">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" width="32" height="32" stroke-width="1.75">
                            <path
                                d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z">
                            </path>
                            <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0"></path>
                        </svg>
                        <h3>Configuración</h3>
                    </a>
                </div>
                <hr class="linea">
                <!-- guia de usuario menu 2 -->
                <div class="menu-1">

                    <button href="" class="menu-item" onclick="toggleGuide()">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" width="32" height="32" stroke-width="1.75">
                            <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                            <path d="M12 16v.01"></path>
                            <path d="M12 13a2 2 0 0 0 .914 -3.782a1.98 1.98 0 0 0 -2.414 .483"></path>
                        </svg>
                        <h3>Guía de usuario</h3>
                    </button>
                    <a href="login.html" class="menu-item">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" width="32" height="32" stroke-width="1.75">
                            <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2">
                            </path>
                            <path d="M9 12h12l-3 -3"></path>
                            <path d="M18 15l3 -3"></path>
                        </svg>
                        <h3>Cerrar Sesión</h3>
                    </a>
                </div>
            </div>
        </div>

    </div>

    <main class="main-content">
        <header class="header">
            <h1 class="title">Dispotivos</h1>

            <div class="container">
                <div class="stat-button light" id="sistemas-btn">
                    <p class="stat-number">32</p>
                    <p class="stat-label">Dispostivos</p>
                </div>
            </div>
        </header>

        <div class="content-card">
            <div class="search-container">
                <div>
                    <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                    <input type="text" class="search-input" placeholder="Buscador" id="searchInput">
                </div>
                <!-- <button id="openModalBtn"><i class="fas fa-plus">+</i></button> -->

            </div>


            <!-- Formulario oculto -->
            <!-- <div class="overlay" id="modalOverlay">
                <div class="modal">

                    <form id="dispositivo-form" method="POST" action="php/Dispositivo.php">
                        <h2>Incorpora un dispositivo!</h2>

                        <input type="text" id="id" name="id" placeholder="ID del dispositivo" class="id">
                        <p class="error-message" style="display: none; color: red;"></p>

                        <input type="text" id="fecha" name="fecha" placeholder="Fecha de instalación (AAAA-MM-DD)"
                            class="fecha">
                        <p class="error-message" style="display: none; color: red;"></p>

                        <input type="text" id="ubicacion" name="ubicacion"
                            placeholder="Ubicación geográfica (Por coordenadas)" class="ubicacion">
                        <p class="error-message" style="display: none; color: red;"></p>

                        <input type="text" id="instalador" name="instalador"
                            placeholder="Nombre del instalador o responsable" class="instalador">
                        <p class="error-message" style="display: none; color: red;"></p>

                        <input type="text" id="zona" name="zona" placeholder="Zona de referencia" class="zona">
                        <p class="error-message" style="display: none; color: red;"></p>

                        <textarea id="comentario" name="comentario" placeholder="Comentario"
                            class="comentario"></textarea>
                        <p class="error-message" style="display: none; color: red;"></p>

                        <select id="estado-dispositivo" name="estado-dispositivo" class="estado-dispositivo">
                            <option value="">Estado del dispositivo</option>
                            <option value="activo">Activo</option>
                            <option value="inactivo">Inactivo</option>
                        </select>
                        <p class="error-message" style="display: none; color: red;"></p>

                        <button type="submit" id="agregar-dispositivo-btn">
                            Agregar dispositivo
                        </button>
                    </form>

                </div>
            </div> -->

            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Ubicación</th>
                        <th>ID Dispositivo</th>
                        <th>Fecha/Date</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include 'php/conexion.php';

                    try {
                        $sql = "SELECT d.*, t.nombre_completo as nombre_tecnico 
                    FROM dispositivos d 
                    LEFT JOIN tecnicos t ON d.id_tecnico = t.id 
                    ORDER BY d.fecha_instalacion DESC";

                        $stmt = $conexion->prepare($sql);
                        $stmt->execute();

                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "<tr>";
                            echo "<td>
                        <div class='alert-item'>
                            <div class='alert-icon'>i</div>
                            <div class='alert-info'>
                                <div>" . htmlspecialchars($row['nombre_instalador']) . "</div>
                                <div class='code'>" . htmlspecialchars($row['id_dispositivo']) . "</div>
                            </div>
                        </div>
                    </td>";
                            echo "<td>" . htmlspecialchars($row['zona_referencia']) . "</td>";
                            echo "<td><span class='tag1'>" . htmlspecialchars($row['id_dispositivo']) . "</span></td>";
                            echo "<td><a href='#' class='view-btn'>" . date('d/m/Y', strtotime($row['fecha_instalacion'])) . "</a></td>";
                            echo "</tr>";
                        }
                    } catch (PDOException $e) {
                        echo "<tr><td colspan='5'>Error al cargar los dispositivos: " . $e->getMessage() . "</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </main>


    <script src="js/Dispositivo2.js"></script>
    <script src="js/modoOscuro.js"></script>
</body>

</html>
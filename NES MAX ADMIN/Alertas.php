<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/alertas1.css">
    <link rel="stylesheet" href="css/modoOscuro.css">
    <title>Alertas ax Admin</title>
</head>

<body>
    <div class="principal">
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
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="32"
                                height="32" stroke-width="2.5">
                                <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
                                <path d="M21 21l-6 -6"></path>
                            </svg>
                            <input type="search" placeholder="search" id="menuSearch">
                        </div>
                        <a href="PanelDeControl.php" class="menu-item">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="32"
                                height="32" stroke-width="1.75">
                                <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                                <path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                <path d="M13.41 10.59l2.59 -2.59"></path>
                                <path d="M7 12a5 5 0 0 1 5 -5"></path>
                            </svg>
                            <h3>Panel de control</h3>

                        </a>
                        <a href="Alertas.php" class="menu-item">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="32"
                                height="32" stroke-width="1.75">
                                <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                                <path d="M12 8v4"></path>
                                <path d="M12 16h.01"></path>
                            </svg>
                            <h3>Alertas</h3>
                        </a>
                        <a href="" class="menu-item" id="menuNotificaciones">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="32"
                                height="32" stroke-width="1.75">
                                <path
                                    d="M10 5a2 2 0 1 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6">
                                </path>
                                <path d="M9 17v1a3 3 0 0 0 6 0v-1"></path>
                            </svg>
                            <h3>Notificaciones</h3>
                        </a>
                        <a href="Dashboard.html" class="menu-item">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="32"
                                height="32" stroke-width="1.75">
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
                        <a href="Dispositivo.html" class="menu-item">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-device-watch">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M6 9a3 3 0 0 1 3 -3h6a3 3 0 0 1 3 3v6a3 3 0 0 1 -3 3h-6a3 3 0 0 1 -3 -3v-6z" />
                                <path d="M9 18v3h6v-3" />
                                <path d="M9 6v-3h6v3" />
                            </svg>
                            <h3>Dispositivo</h3>
                        </a>
                        <a href="Configuracion.html" class="menu-item">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="32"
                                height="32" stroke-width="1.75">
                                <path
                                    d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z">
                                </path>
                                <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0"></path>
                            </svg>
                            <h3>Configuración</h3>
                        </a>
                    </div>
                    <hr class="linea">
                    <div class="menu-1">

                        <button href="" class="menu-item" onclick="toggleGuide()">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="32"
                                height="32" stroke-width="1.75">
                                <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                                <path d="M12 16v.01"></path>
                                <path d="M12 13a2 2 0 0 0 .914 -3.782a1.98 1.98 0 0 0 -2.414 .483"></path>
                            </svg>
                            <h3>Guía de usuario</h3>
                        </button>
                        <a href="login.html" class="menu-item">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="32"
                                height="32" stroke-width="1.75">
                                <path
                                    d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2">
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
        <div class="derecha">
            <div class="header">
                <h2 class="titulo-panel">Alertas</h2>
                <div class="datos">
                    <div class="perfil">
                        <img src="IMG/Victoria.png" alt="">
                        <div class="online"></div>
                        <h2>Victoria</h2>
                    </div>
                    <div class="perfil-modal" id="perfilModal">
                        <div class="perfil-modal-content">
                            <div class="perfil-modal-header">
                                <h3>Editar Perfil</h3>
                                <span class="close-perfil">&times;</span>
                            </div>
                            <div class="perfil-modal-body">
                                <div class="perfil-imagen-container">
                                    <img id="perfilPreview" src="IMG/Victoria.png" alt="Foto de perfil">
                                    <input type="file" id="perfilImagen" accept="image/*" style="display: none;">
                                    <button id="cambiarFotoBtn" class="btn-cambiar-foto">Cambiar Foto</button>
                                </div>
                                <div class="perfil-form">
                                    <div class="form-group">
                                        <label for="nombreUsuario">Nombre</label>
                                        <input type="text" id="nombreUsuario" value="Victoria">
                                    </div>
                                    <button id="guardarPerfil" class="btn-guardar">Guardar Cambios</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="Notificaciones" id="Notificaciones">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" width="32" height="32" stroke-width="1.75">
                            <path
                                d="M10 5a2 2 0 1 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6">
                            </path>
                            <path d="M9 17v1a3 3 0 0 0 6 0v-1"></path>
                        </svg>
                        <div class="notificaciones-container">
                            <p class="recientes">Notificaciones recientes</p>
                            <div class="noti-1">
                                <img src="IMG/circle-noti.png" alt="notificacion" class="circulo">
                                <p class="p1">Alertas: Dispositivo</p>
                                <p class="p2">+7 Reportes en Santo Domingo</p>
                            </div>
                            <div class="noti-2">
                                <img src="IMG/circle-noti.png" alt="notificacion" class="circulo-2">
                                <p class="p1">Alertas: Dispositivo</p>
                                <p class="p2">+7 Reportes en Santo Domingo</p>
                            </div>
                            <div class="noti-3">
                                <img src="IMG/circle-noti.png" alt="notificacion" class="circulo-3">
                                <p class="p1">Alertas: Dispositivo</p>
                                <p class="p2">+7 Reportes en Santo Domingo</p>
                            </div>
                            <div class="noti-4">
                                <img src="IMG/circle-noti.png" alt="notificacion" class="circulo-4">
                                <p class="p1">Alertas: Dispositivo</p>
                                <p class="p2">+7 Reportes en Santo Domingo</p>
                            </div>
                        </div>
                    </div>


                </div>

            </div>
            <main class="main-content">
                <header class="header">
                    <div class="container">
                        <div class="stat-button light" id="sistemas-btn">
                            <p class="stat-number">32</p>
                            <p class="stat-label">Sistema</p>
                        </div>
                        <div class="stat-button dark" id="dispositivos-btn">
                            <p class="stat-number">99+</p>
                            <p class="stat-label">Dispositivos</p>
                        </div>
                    </div>
                </header>

                <div class="content-card">
                    <div class="header-search">
                        <div class="search-container">
                            <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="11" cy="11" r="8"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            </svg>
                            <input type="text" class="search-input" placeholder="Buscador" id="searchInput">
                        </div>

                        <div class="menuicon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="24"
                                height="24" stroke-width="2">
                                <path d="M4 6h16"></path>
                                <path d="M7 12h13"></path>
                                <path d="M10 18h10"></path>
                            </svg>
                        </div>
                    </div>

                    <table>
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Ubicación</th>
                                <th>Tipo de denuncia</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="tabla-contenido">
                            <?php
                            $host = "localhost:";
                            $usuario = "root";
                            $password = "";
                            $baseDeDatos = "nes";
                            $conn = new mysqli($host, $usuario, $password, $baseDeDatos);


                            if ($conn->connect_error) {
                                die("Conexión fallida: " . $conn->connect_error);
                            }

                            $sql = "SELECT * FROM denuncias_users ORDER BY id DESC";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <tr class="data-row">
                                        <td>
                                            <div class="alert-item">
                                                <div class="alert-icon">i</div>
                                                <div class="alert-info">
                                                    <div><?php echo htmlspecialchars($row['nombre']); ?></div>
                                                    <div class="code"><?php echo htmlspecialchars($row['codigo']); ?></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td><?php echo htmlspecialchars($row['ubicacion']); ?></td>
                                        <td><span class="tag"><?php echo htmlspecialchars($row['tipo']); ?></span></td>
                                        <td>
                                        <button class="view-btn" onclick="toggleDetails(<?php echo $row['id']; ?>)">
                                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2">
                                                    <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                    <path
                                                        d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                                </svg>
                                                Vista
                                            </button>
                                        </td>
                                        <td><button class="more-btn" data-tooltip="Más opciones">...</button></td>
                                    </tr>

                                    <tr class="expandable-content" id="content-<?php echo $row['id']; ?>" data-content="<?php echo $row['id']; ?>"
                                        style="display: none;">
                                        <td colspan="5">
                                            <div class="info-grid">
                                                <div class="info-item">
                                                    <i>📅</i>
                                                    <span><?php echo htmlspecialchars($row['fecha']); ?></span>
                                                </div>
                                                <div class="info-item">
                                                    <i>📍</i>
                                                    <span><?php echo htmlspecialchars($row['ubicacion']); ?></span>
                                                </div>
                                                <div class="info-item">
                                                    <i>✉️</i>
                                                    <span><?php echo htmlspecialchars($row['nombre']); ?></span>
                                                </div>
                                            </div>
                                            <div class="case-description">
                                                <p><?php echo htmlspecialchars($row['descripcion']); ?></p>
                                            </div>
                                           <button class="view-case-btn" onclick="openModal(<?php echo $row['id']; ?>)">Ver caso</button>
                                        </td>
                                    </tr>

                                    
                            <!-- Modal para ver detalles del caso -->
                            <div id="caseModal" class="modal">
                                <div class="modal-content">
                                    <div class="case-header">
                                    <div class="close-modal"
                                            onclick="document.getElementById('caseModal').classList.remove('active');">✕
                                        </div>
                                        <h2 class="case-title">Caso <?php echo htmlspecialchars($row['id']); ?></h2>
                                        <p class="case-subtitle">Reportado por <?php echo htmlspecialchars($row['nombre']); ?></p>
                                        <span class="status-badge">En proceso</span>
                                    </div>

                                    <div class="case-info-grid">
                                        <div class="info-card">
                                            <div class="info-card-label">📅 Fecha de reporte</div>
                                            <div class="info-card-value"><?php echo htmlspecialchars($row['fecha']); ?></div>
                                        </div>
                                        <div class="info-card">
                                            <div class="info-card-label">📍 Ubicación</div>
                                            <div class="info-card-value"><?php echo htmlspecialchars($row['ubicacion']); ?></div>
                                        </div>
                                        <div class="info-card">
                                            <div class="info-card-label">🔊 Tipo de denuncia</div>
                                            <div class="info-card-value"><?php echo htmlspecialchars($row['tipo']); ?></div>
                                        </div>
                                        <div class="info-card">
                                            <div class="info-card-label">🔢 Código</div>
                                            <div class="info-card-value"><?php echo htmlspecialchars($row['codigo']); ?></div>
                                        </div>
                                    </div>

                                    <div class="case-description1">
                                        <h3>Descripción del caso</h3>
                                        <p><?php echo htmlspecialchars($row['descripcion']); ?></p>
                                        
                                    </div>

                                    <div class="comment-section">
                                        <textarea class="comment-input" placeholder="Escribe un comentario sobre este caso..."></textarea>
                                        <div class="button-group">
                                            <button class="btn btn-deny" onclick="updateStatus('denied')">
                                                ✕ Denegar
                                            </button>
                                            <button class="btn btn-accept" onclick="updateStatus('accepted')">
                                                ✓ Aceptar
                                            </button>
                                            <button class="demo-button" onclick="resetStatus()" style="margin-left: 10px; background: #64748b;">
                                                Resetear Estado
                                            </button>
                                            <button class="Enviar">
                                                Enviar
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                    <?php
                                }
                            } else {
                                echo "<tr><td colspan='5'>No hay datos disponibles</td></tr>";
                            }

                            $conn->close();
                            ?>


                            <!-- Modal para ver detalles del caso -->
                            <div id="caseModal" class="modal">
                                <div class="modal-content">
                                    <div class="case-header">
                                    <div class="close-modal"
                                            onclick="document.getElementById('caseModal').classList.remove('active');">✕
                                        </div>
                                        <h2 class="case-title">Caso 123-4567891-1</h2>
                                        <p class="case-subtitle">Reportado por Manuel Alejandro</p>
                                        <span class="status-badge">En proceso</span>
                                    </div>

                                    <div class="case-info-grid">
                                        <div class="info-card">
                                            <div class="info-card-label">📅 Fecha de reporte</div>
                                            <div class="info-card-value">13/2/2024</div>
                                        </div>
                                        <div class="info-card">
                                            <div class="info-card-label">📍 Ubicación</div>
                                            <div class="info-card-value">Santo Domingo ESTE</div>
                                        </div>
                                        <div class="info-card">
                                            <div class="info-card-label">🔊 Tipo de denuncia</div>
                                            <div class="info-card-value">Ruidos Por Parlantes</div>
                                        </div>
                                        <div class="info-card">
                                            <div class="info-card-label">🔢 Código</div>
                                            <div class="info-card-value">123-4567891-1</div>
                                        </div>
                                    </div>

                                    <div class="case-description1">
                                        <h3>Descripción del caso</h3>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod
                                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                                            ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                        <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore
                                            eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui
                                            officia deserunt mollit anim id est laborum.</p>
                                    </div>

                                    <div class="comment-section">
                                        <textarea class="comment-input" placeholder="Escribe un comentario sobre este caso..."></textarea>
                                        <div class="button-group">
                                            <button class="btn btn-deny" onclick="updateStatus('denied')">
                                                ✕ Denegar
                                            </button>
                                            <button class="btn btn-accept" onclick="updateStatus('accepted')">
                                                ✓ Aceptar
                                            </button>
                                            <button class="demo-button" onclick="resetStatus()" style="margin-left: 10px; background: #64748b;">
                                                Resetear Estado
                                            </button>
                                            <button class="Enviar">
                                                Enviar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </tbody>
                    </table> 
                </div>
            </main>
        </div>
    </div>


    <script src="js/alertas.js"></script>         
    <script src="js/alertas4.js" defer></script>
    <script src="js/modoOscuro.js"></script>
</body>

</html>
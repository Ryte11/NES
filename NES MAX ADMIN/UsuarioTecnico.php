<?php
include 'php/conexion.php';

// Contar técnicos
$queryCountTecnicos = "SELECT COUNT(*) as total FROM tecnicos";
$stmtCountTecnicos = $conexion->query($queryCountTecnicos);
$totalTecnicos = $stmtCountTecnicos->fetchColumn();

// Contar dispositivos
$queryCountDispositivos = "SELECT COUNT(*) as total FROM dispositivos";
$stmtCountDispositivos = $conexion->query($queryCountDispositivos);
$totalDispositivos = $stmtCountDispositivos->fetchColumn();

// Consulta paginada para técnicos
$porPagina = 10;
$pagina = isset($_GET['pagina']) ? (int) $_GET['pagina'] : 1;
$inicio = ($pagina - 1) * $porPagina;

$query = "SELECT id, usuario, nombre_completo, cedula FROM tecnicos LIMIT :inicio, :porPagina";
$stmt = $conexion->prepare($query);
$stmt->bindValue(':inicio', $inicio, PDO::PARAM_INT);
$stmt->bindValue(':porPagina', $porPagina, PDO::PARAM_INT);
$stmt->execute();
$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Obtener total de páginas
$queryTotal = "SELECT COUNT(*) as total FROM tecnicos";
$stmtTotal = $conexion->query($queryTotal);
$totalRegistros = $stmtTotal->fetchColumn();
$totalPaginas = ceil($totalRegistros / $porPagina);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/usuario.css">
    <title>Usuarios tecnicos</title>
    <style>
        .action-icon {
            cursor: pointer;
            margin: 0 5px;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content_edit {
            display: flex;
            flex-direction: column !important;
            background: white;
            padding: 20px;
            border-radius: 10px;
            width: 400px;

            text-align: center;
        }

        .close-modal {
            background: #dc3545;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        .close-modal:hover {
            background: #a71d2a;
        }

        .stats-container {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
            padding: 20px;
        }

        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            flex: 1;
        }

        .stat-card h3 {
            margin: 0;
            color: #666;
            font-size: 16px;
        }

        .stat-card .stat-number {
            font-size: 32px;
            font-weight: bold;
            color: #2e70c6;
            margin: 10px 0 0 0;
        }

        .pagination {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin: 20px 0;
        }

        .pagination a {
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            text-decoration: none;
            color: #333;
        }

        .pagination a.active {
            background: #2e70c6;
            color: white;
            border-color: #2e70c6;
        }

        .map-container {
            margin: 20px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        #mapa {
            height: 500px;
            width: 100%;
        }
    </style>
    <link rel="stylesheet" href="css/modoOscuro.css">
    <title>Usuarios Admins</title>
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
                        <a href="Dashboard.php" class="menu-item">
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
                        <a href="Dispositivo.php" class="menu-item">
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
                        <li class="lista">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-users">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                            </svg>
                            <a href="Usuario.html">Usuarios</a>
                            <ul class="submenu">
                                <li><a href="Usuario.html">Usuarios Administrativos</a></li>
                                <li><a href="UsuarioMaxAdmin.php">Máximo Administrador</a></li>
                                <li><a href="UsuarioMaxAdmin.php">Usurios tecnicos</a></li>
                            </ul>
                        </li>
                         <a href="contactos.php" class="menu-item">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-address-book">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path
                                    d="M20 6v12a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2z" />
                                <path d="M10 16h6" />
                                <path d="M13 11m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                <path d="M4 8h3" />
                                <path d="M4 12h3" />
                                <path d="M4 16h3" />
                            </svg>
                            <h3>Contactos</h3>
                        </a>
                        <a href="Configuracion.php" class="menu-item">
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
                    <!-- guia de usuario menu 2 -->
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
                <h2 class="titulo">Gestión de Usuarios tecnicos</h2>
                <div class="datos">
                    <div class="perfil">
                        <img src="IMG/Victoria.png" alt="">
                        <div class="online"></div>
                        <h2>Victoria</h2>
                    </div>
                    <!-- Popup Modal para Editar Perfil -->
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

            <div class="stats-container">
                <div class="stat-card">
                    <h3>Total Técnicos</h3>
                    <p class="stat-number"><?php echo $totalTecnicos; ?></p>
                </div>
                <div class="stat-card">
                    <h3>Total Dispositivos</h3>
                    <p class="stat-number"><?php echo $totalDispositivos; ?></p>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <span></span>
                    <h2 class="card-title">Usuarios Administradores Tecnicos</h2>
                    <button class="add-button">+</button>
                </div>
                <table class="users-table">
                    <thead>
                        <tr>
                            <th>Usuario</th>
                            <th>Nombre Completo</th>
                            <th>Cédula</th>
                            <th>Modificar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($resultado as $tecnico): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($tecnico['usuario']); ?></td>
                                <td><?php echo htmlspecialchars($tecnico['nombre_completo']); ?></td>
                                <td><?php echo htmlspecialchars($tecnico['cedula']); ?></td>
                                <td>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="action-icon" onclick="abrirModificar(
                                        '<?php echo $tecnico['id']; ?>', 
                                        '<?php echo addslashes(htmlspecialchars($tecnico['usuario'])); ?>', 
                                        '<?php echo addslashes(htmlspecialchars($tecnico['nombre_completo'])); ?>', 
                                        '<?php echo addslashes(htmlspecialchars($tecnico['cedula'])); ?>'
                                    )">
                                        <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                        <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                        <path d="M16 5l3 3" />
                                    </svg>
                                </td>
                                <td>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="action-icon"
                                        onclick="eliminarTecnico('<?php echo $tecnico['id']; ?>')">
                                        <path d="M4 7l16 0" />
                                        <path d="M10 11l0 6" />
                                        <path d="M14 11l0 6" />
                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                    </svg>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="pagination">
                    <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                        <a href="?pagina=<?php echo $i; ?>" <?php echo ($i == $pagina) ? 'class="active"' : ''; ?>>
                            <?php echo $i; ?>
                        </a>
                    <?php endfor; ?>
                </div>
            </div>

            <!-- editar -->
            <!-- Modal para modificar técnico -->
            <div class="modal" id="modalModificar">
                <div class="modal-content_edit">
                    <h3>Modificar Técnico</h3>
                    <form id="formModificar" method="POST" action="php/modificar_tecnico.php">
                        <input type="hidden" id="modificarId" name="id">
                        <div class="form-group">
                            <input type="text" id="modificarUsuario" name="usuario" placeholder="Usuario" required>
                        </div>
                        <div class="form-group">
                            <input type="text" id="modificarNombre" name="nombre_completo" placeholder="Nombre Completo"
                                required>
                        </div>
                        <div class="form-group">
                            <input type="text" id="modificarCedula" name="cedula" placeholder="Cédula" required>
                        </div>
                        <button type="submit" class="create-button">Guardar Cambios</button>
                        <button type="button" class="close-modal" onclick="cerrarModal()">Cancelar</button>
                    </form>
                </div>
            </div>
            <!-- nuevo usuario tecnico -->
            <div class="modal" id="userModal">
                <div class="modal-content">
                    <div class="modal-left">
                        <img src="IMG/stacked-waves-haikei.png" alt="Waves" class="waves-bg">
                        <h2>Agregar un nuevo técnico</h2>
                    </div>
                    <div class="modal-right">
                        <h3>Nuevo Técnico</h3>
                        <p>Llena los campos y agrega un nuevo técnico!</p>

                        <form id="userForm" method="POST" action="php/crear_tecnico.php">
                            <div class="form-group">
                                <input type="text" class="form-input" id="usuario" name="usuario" placeholder="Usuario"
                                    required>
                                <small id="usuarioError" class="error-message" style="display: none; color: red;">El
                                    usuario debe tener al menos
                                    3 caracteres.</small>
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-input" id="nombre_completo" name="nombre_completo"
                                    placeholder="Nombre Completo" required>
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-input" id="cedula" name="cedula" placeholder="Cédula"
                                    required>
                            </div>

                            <div class="form-group">
                                <input type="password" class="form-input" id="contrasena" name="contrasena"
                                    placeholder="Contraseña" required>
                                <small id="passwordError" class="error-message" style="display: none; color: red;">La
                                    contraseña debe tener al
                                    menos 6 caracteres.</small>
                            </div>

                            <button type="submit" class="create-button">Crear Técnico</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="map-container">
                <div id="mapa"></div>
            </div>

            <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
            <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css">

            <script>
                // Inicializar el mapa
                const map = L.map('mapa').setView([18.7357, -70.1627], 8);

                // Agregar el tile layer
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '© OpenStreetMap contributors'
                }).addTo(map);

                // Función para cargar los dispositivos
                async function cargarDispositivos() {
                    try {
                        const response = await fetch('php/obtener_dispositivos.php');
                        if (!response.ok) {
                            throw new Error('Error al obtener los dispositivos');
                        }
                        const dispositivos = await response.json();

                        dispositivos.forEach(d => {
                            if (d.latitud && d.longitud) {
                                const marker = L.marker([parseFloat(d.latitud), parseFloat(d.longitud)])
                                    .addTo(map)
                                    .bindPopup(`
                                        <div style="min-width: 200px;">
                                            <h3 style="margin: 0 0 10px 0;">Dispositivo ${d.id_dispositivo}</h3>
                                            <p style="margin: 5px 0;"><b>Instalador:</b> ${d.nombre_instalador || 'No especificado'}</p>
                                            <p style="margin: 5px 0;"><b>Fecha:</b> ${d.fecha_instalacion || 'No especificada'}</p>
                                            <p style="margin: 5px 0;"><b>Zona:</b> ${d.zona_referencia || 'No especificada'}</p>
                                        </div>
                                    `);
                            }
                        });
                    } catch (error) {
                        console.error('Error:', error);
                    }
                }

                // Cargar los dispositivos cuando el mapa esté listo
                map.whenReady(() => {
                    cargarDispositivos();
                });
            </script>
        </div>
    </div>

    <script>
        function abrirModificar(id, usuario, nombre, cedula) {
            document.getElementById('modificarId').value = id;
            document.getElementById('modificarUsuario').value = usuario;
            document.getElementById('modificarNombre').value = nombre;
            document.getElementById('modificarCedula').value = cedula;
            document.getElementById('modalModificar').style.display = 'flex';
        }

        function cerrarModal() {
            document.getElementById('modalModificar').style.display = 'none';
        }

        function eliminarTecnico(id) {
            if (confirm('¿Estás seguro de que deseas eliminar este técnico?')) {
                window.location.href = 'php/eliminar_tecnico.php?id=' + id;
            }
        }
    </script>
    <script src="js/USerAdminTecnic.js"></script>
    <script src="js/UserAdmin1.js"></script>
    <script src="js/modoOscuro.js"></script>

</body>

</html>
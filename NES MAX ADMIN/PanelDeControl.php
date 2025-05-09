<?php
// Iniciar sesión


$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "nes";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    // En producción, es mejor no mostrar detalles específicos del error
    die(json_encode(['error' => 'Error de conexión a la base de datos']));
}

// Consulta para contar tipos de denuncias
$sql = "SELECT tipo, COUNT(*) AS cantidad FROM denuncias_users GROUP BY tipo";
$result = $conn->query($sql);

// Preparamos los datos para el gráfico
$tipos = [];
$valores = [];

while ($row = $result->fetch_assoc()) {
    $tipos[] = $row['tipo'];
    $valores[] = $row['cantidad'];
}



// Obtener total de denuncias
$sqlTotal = "SELECT COUNT(*) AS total FROM denuncias_users";
$resultTotal = $conn->query($sqlTotal);
$totalDenuncias = 0;

if ($resultTotal && $row = $resultTotal->fetch_assoc()) {
    $totalDenuncias = $row['total'];
}

// Función para formatear el tipo de denuncia en un mensaje más descriptivo
function formatearTipoDenuncia($tipo) {
    switch (strtolower($tipo)) {
        case 'vehiculos':
            return "Alerta por fuerte ruido vehicular o bocinas";
        case 'construccion':
            return "Alerta por ruido de construcción fuera del horario permitido";
        case 'parlantes':
            return "Alerta por ruido excesivo de parlantes o música";
        default:
            return "Alerta por ruido de " . $tipo;
    }
}

// Obtener las denuncias más recientes
$sql = "SELECT id, nombre, ubicacion, tipo, descripcion, fecha FROM denuncias_users ORDER BY fecha DESC LIMIT 4";
$result = $conn->query($sql);

// Contador de alertas activas
$sqlContador = "SELECT COUNT(*) as total FROM denuncias_users WHERE fecha > DATE_SUB(NOW(), INTERVAL 24 HOUR)";
$resultContador = $conn->query($sqlContador);
$rowContador = $resultContador->fetch_assoc();
$alertasActivas = $rowContador['total'];

// Obtener la denuncia más reciente para mostrar "hace cuánto tiempo"
$sqlReciente = "SELECT fecha, ubicacion FROM denuncias_users ORDER BY fecha DESC LIMIT 1";
$resultReciente = $conn->query($sqlReciente);
$rowReciente = $resultReciente->fetch_assoc();

// Calcular tiempo transcurrido
$tiempoTranscurrido = "";
$ubicacionReciente = "";
if ($rowReciente) {
    $fechaReciente = new DateTime($rowReciente['fecha']);
    $ahora = new DateTime();
    $intervalo = $fechaReciente->diff($ahora);
    
    if ($intervalo->days > 0) {
        $tiempoTranscurrido = $intervalo->days . " días atrás";
    } elseif ($intervalo->h > 0) {
        $tiempoTranscurrido = $intervalo->h . " horas atrás";
    } elseif ($intervalo->i > 0) {
        $tiempoTranscurrido = $intervalo->i . " min atrás";
    } else {
        $tiempoTranscurrido = "hace un momento";
    }
    
    $ubicacionReciente = $rowReciente['ubicacion'];
}

// Obtener conteo por ubicación
$sqlUbicacion = "SELECT ubicacion, COUNT(*) as cantidad FROM denuncias_users GROUP BY ubicacion ORDER BY cantidad DESC LIMIT 1";
$resultUbicacion = $conn->query($sqlUbicacion);
$rowUbicacion = $resultUbicacion->fetch_assoc();
$ubicacionConMasDenuncias = "";
$cantidadDenuncias = 0;
if ($rowUbicacion) {
    $ubicacionConMasDenuncias = $rowUbicacion['ubicacion'];
    $cantidadDenuncias = $rowUbicacion['cantidad'];
}

// Obtener tipo más común
$sqlTipoComun = "SELECT tipo, COUNT(*) as cantidad FROM denuncias_users GROUP BY tipo ORDER BY cantidad DESC LIMIT 1";
$resultTipoComun = $conn->query($sqlTipoComun);
$rowTipoComun = $resultTipoComun->fetch_assoc();
$tipoComun = "";
$ubicacionTipoComun = "";
if ($rowTipoComun) {
    $tipoComun = $rowTipoComun['tipo'];
    
    // Obtener ubicación más común para este tipo
    $sqlUbicacionTipo = "SELECT ubicacion, COUNT(*) as cantidad FROM denuncias_users WHERE tipo = '{$tipoComun}' 
                          GROUP BY ubicacion ORDER BY cantidad DESC LIMIT 1";
    $resultUbicacionTipo = $conn->query($sqlUbicacionTipo);
    $rowUbicacionTipo = $resultUbicacionTipo->fetch_assoc();
    if ($rowUbicacionTipo) {
        $ubicacionTipoComun = $rowUbicacionTipo['ubicacion'];
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/Style.css">
    <link rel="stylesheet" href="css/guiaUsuario.css">
    <link rel="stylesheet" href="css/modoOscuro.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <link rel="stylesheet" href="css/notificaciones.css">
    <title>Panel De Control</title>
</head>
<style>
    .hidden {
        display: none;
    }

    #myChart{
      width: 75% !important;  
      height: 75% !important;
    }

    
        
    
</style>
<?php include 'php/verificar_sesion.php' ?>

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
                                <li><a href="UsuarioTecnicos.php">Tecnico Usuario</a></li>
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
                <h2 class="titulo-panel">Panel de control</h2>
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
    <span class="notification-count-badge" id="notificationCountBadge">0</span> <!-- Badge para el conteo general -->
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
        stroke-linecap="round" stroke-linejoin="round" width="32" height="32" stroke-width="1.75">
        <path
            d="M10 5a2 2 0 1 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6">
        </path>
        <path d="M9 17v1a3 3 0 0 0 6 0v-1"></path>
    </svg>
    <div class="notificaciones-container">
        <div class="notificaciones-header">
            <p class="recientes">Notificaciones</p>
        </div>
        <div class="notificaciones-body">
            <div class="notification-category" id="categoryDispositivo">
                <h4>Dispositivo <span class="count" id="notifCountDispositivo">(0)</span></h4>
                <!-- <p class="detalle-noti">Ver detalles de dispositivos</p> -->
            </div>
            <div class="notification-category" id="categorySistema">
                <h4>Sistema <span class="count" id="notifCountSistema">(0)</span></h4>
                <!-- <p class="detalle-noti">Ver detalles de denuncias</p> -->
            </div>
        </div>
    </div>
</div>


                </div>
            </div>
            <div class="contenido">
                <div class="arriba">
                    <div class="div-gradiant" >
                        <div class="text">
                            <h3>Alertas</h3>
                            <p>Sistema de alertas, Este refleja todas las alertas enviadas por el usuario y el
                                dispositivo.</p>
                            <button>
                                <a href="Alertas.php"
                                    style="color: white; text-decoration: none; cursor: pointer;">Gestionar Alertas</a>
                            </button>
                        </div>
                        <div class="img-div">
                            <div>
                                <img src="IMG/under-constructions-55 (1).svg" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="arribaChart">
                        <h3 class="titulo-chart">Denuncias Totales</h3>
                        <canvas id="myChart" ></canvas>
                        <script>
                            
                            const tipos = <?= json_encode($tipos); ?>;
                            const valores = <?= json_encode($valores); ?>;

                            const ctx = document.getElementById('myChart').getContext('2d');
                            new Chart(ctx, {
                                type: 'doughnut',
                                data: {
                                    labels: tipos,
                                    datasets: [{
                                        data: valores,
                                        backgroundColor: [
                                            '#4B0082',
                                            '#00BCD4',
                                            '#FF4444',
                                            '#FFC107',
                                            '#8BC34A',
                                            '#FF9800'
                                        ],
                                        borderWidth: 0,
                                        cutout: '80%'
                                    }]
                                },
                                options: {
                                    plugins: {
                                        legend: {
                                            display: true,
                                            position: 'bottom'
                                        }
                                    },
                                    responsive: true,
                                    maintainAspectRatio: false
                                }
                            });
                        </script>
                        <div class="chart-container">
                            <canvas id="myChart"></canvas>
                            <div class="total"><?= $totalDenuncias ?></div>
                        </div>
                      
                    </div>
                    <div class="alertas-panel">
                        <div class="alertas-titulo">Alertas Recientes</div>
                        <ul class="alertas-lista">
                            <li class="alerta-item">
                                <div class="alerta-punto"></div>
                                <div class="alerta-contenido">
                                    <div class="alertas-activas"><?php echo $alertasActivas; ?> alertas activas</div>
                                </div>
                            </li>
                            <li class="alerta-item">
                                <div class="alerta-punto"></div>
                                <div class="alerta-contenido">
                                    Ultima alerta <?php echo $tiempoTranscurrido; ?>
                                    en <?php echo $ubicacionReciente; ?>
                                </div>
                            </li>
                            <li class="alerta-item">
                                <div class="alerta-punto"></div>
                                <div class="alerta-contenido">
                                <?php echo $cantidadDenuncias; ?> denuncias en <?php echo $ubicacionConMasDenuncias; ?>
                                </div>
                            </li>
                            <li class="alerta-item">
                                <div class="alerta-punto"></div>
                                <div class="alerta-contenido">
                                <?php echo formatearTipoDenuncia($tipoComun); ?> en <?php echo $ubicacionTipoComun; ?>
                                </div>
                            </li>
                        </ul>
                        <a href="Alertas.php">
                            <button class="gestion-btn">Gestionar Alertas</button>
                        </a>
                    </div>
                </div>
                <div class="abajo">

                    <div class="div-gradiant">
                        <div class="text">
                            <h3>Dashboard</h3>
                            <p>Dashboard, este muestra una serie de gráficos los cuales muestran los datos de todas las
                                denuncias.</p>
                            <button>Ver Dashboard</button>
                        </div>
                        <div class="img-div">
                            <div class="svg-2">
                                <img src="IMG/finance-app-1-98 (1).svg" alt="">
                            </div>
                        </div>
                    </div>

                    <div class="grafico-container">
                        <div class="titulo">Tendencias de Denuncias</div>
                        <div class="leyenda">
                            <div class="leyenda-item">
                                <div class="leyenda-color" style="background-color: #000080;"></div>
                                <span>Denuncias</span>
                            </div>
                            <div class="leyenda-item">
                                <div class="leyenda-color" style="background-color: #00BCD4;"></div>
                                <span>Dispositvos</span>
                            </div>
                            <div class="leyenda-item">
                                <div class="leyenda-color" style="background-color: #FF4444;"></div>
                                <span>Vehiculos</span>
                            </div>
                        </div>
                        <div class="chart-wrapper">
                            <canvas id="denunciasChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>




            <!-- guia de usuario -->
            <div id="guide" class="guide">
                <div class="guide-header">
                    <div class="header-content">
                        <span class="emoji">📘</span>
                        <h2>Guía Completa de Uso</h2>
                    </div>
                    <i class="close-button" onclick="toggleGuide()">✕</i>
                </div>
                <div class="guide-content">
                    <div class="nav-button" onclick="showPrevious()">
                        <i class="arrow-left">‹</i>
                    </div>
                    <div class="content-area">
                        <div id="slide1" class="slide">
                            <div class="section">
                                <div class="blue-line"></div>
                                <div class="section-content">
                                    <h3>
                                        <span class="emoji">🚀</span> Introducción
                                    </h3>
                                    <p>Bienvenido a nuestra plataforma. Esta guía te ayudará a navegar y aprovechar al
                                        máximo todas
                                        las funcionalidades.</p>
                                </div>
                            </div>
                            <div class="section">
                                <div class="blue-line"></div>
                                <div class="section-content">
                                    <h3>
                                        <span class="emoji">🔐</span> Primeros Pasos
                                    </h3>
                                    <p>1. Registro: Crea tu cuenta utilizando tu correo electrónico o redes sociales.
                                    </p>
                                    <p>2. Perfil: Completa tu información personal para personalizar tu experiencia.</p>
                                </div>
                            </div>
                            <div class="section">
                                <div class="blue-line"></div>
                                <div class="section-content">
                                    <h3>
                                        <span class="emoji">🛠️</span> Configuración Avanzada
                                    </h3>
                                    <p>3. Personalización: Ajusta configuraciones de privacidad y notificaciones.</p>
                                    <p>4. Integraciones: Conecta tu cuenta con otras plataformas.</p>
                                    <p>5. Seguridad: Configura autenticación de dos factores.</p>
                                </div>
                            </div>
                        </div>
                        <div id="slide2" class="slide hidden">
                            <div class="section">
                                <div class="blue-line"></div>
                                <div class="section-content">
                                    <h3>
                                        <span class="emoji">🧭</span> Navegación Principal
                                    </h3>
                                    <p>Explora nuestro menú dividido en secciones intuitivas:</p>
                                    <ul>
                                        <li>Inicio: Vista general de servicios.</li>
                                        <li>Perfil: Gestiona tu información.</li>
                                        <li>Servicios: Accede a todas las funcionalidades.</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="section">
                                <div class="blue-line"></div>
                                <div class="section-content">
                                    <h3>
                                        <span class="emoji">📊</span> Gestión de Datos
                                    </h3>
                                    <p>6. Análisis: Explora herramientas de seguimiento y reportes.</p>
                                    <p>7. Exportación: Descarga y comparte informacion importante.</p>
                                    <p>8. Respaldos: Configura copias de seguridad automáticas.</p>
                                </div>
                            </div>
                            <div class="section">
                                <div class="blue-line"></div>
                                <div class="section-content">
                                    <h3>
                                        <span class="emoji">❓</span> Soporte Técnico
                                    </h3>
                                    <p>Si encuentras un problema, contacta a nuestro equipo de soporte disponible 24/7.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="nav-button" onclick="showNext()">
                        <i class="arrow-right">›</i>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="denunciasChart.js"></script>

    <script src="js/profile.js"></script>
    <script src="js/PanelControl.js"></script>
    <script src="js/modoOscuro.js"></script>
    <script src="js/notificaciones.js"></script>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/config.css">
    <link rel="stylesheet" href="css/guiaUsuario.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="css/edit_profile.css">
    <title>Panel De Control</title>
</head>
<style>
    .hidden {
        display: none;
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
                                <li><a href="UsuarioTecnico.php">Tecnico Usuario</a></li>
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
                <h2 class="titulo">Configuración</h2>
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
            <div class="flex-1 p-6">
                <form id="configForm" action="guardar_configuracion.php" method="POST">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-white p-6 rounded shadow">
                            <h2 class="text-2xl font-bold text-blue-700 mb-4">Sistema</h2>
                            <h3 class="text-xl font-semibold mb-2">
                                <i class="fas fa-cogs mr-2"></i>
                                Preferencias Generales
                            </h3>
                            <div class="mb-4 flex items-center justify-between">
                                <span>Modo Oscuro</span>
                                <label class="switch">
                                    <input id="modoOscuro" name="modoOscuro" type="checkbox"
                                        class="configuracion-input" />
                                    <span class="slider round"></span>
                                </label>
                            </div>
                            <div>
                                <label class="block text-gray-700" for="idioma">Idioma</label>
                                <select class="w-full p-2 border rounded configuracion-input" id="idioma" name="idioma">
                                    <option value="es">Español</option>
                                    <option value="en">Inglés</option>
                                    <option value="fr">Francés</option>
                                    <option value="de">Alemán</option>
                                </select>
                            </div>
                        </div>
                        <div class="bg-white p-6 rounded shadow">
                            <h2 class="text-2xl font-bold text-blue-700 mb-4">Notificaciones</h2>
                            <h3 class="text-xl font-semibold mb-2">
                                <i class="fas fa-bell mr-2"></i>
                                Configuración de Dispositivos
                            </h3>
                            <div class="mb-4 flex items-center justify-between">
                                <span>Notificaciones por Email</span>
                                <label class="switch">
                                    <input id="notificacionesEmail" name="notificacionesEmail" type="checkbox"
                                        class="configuracion-input" />
                                    <span class="slider round"></span>
                                </label>
                            </div>
                            <div class="flex items-center justify-between">
                                <span>Notificaciones Push</span>
                                <label class="switch">
                                    <input id="notificacionesPush" name="notificacionesPush" type="checkbox"
                                        class="configuracion-input" />
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                        <div class="bg-white p-6 rounded shadow">
                            <h2 class="text-2xl font-bold text-blue-700 mb-4">Copias de Seguridad</h2>
                            <h3 class="text-xl font-semibold mb-2">Programar Copias de Seguridad</h3>
                            <div class="mb-4">
                                <label class="block text-gray-700" for="frecuenciaBackup">Frecuencia de Copia de
                                    Seguridad</label>
                                <select class="w-full p-2 border rounded configuracion-input" id="frecuenciaBackup"
                                    name="frecuenciaBackup">
                                    <option value="diaria">Diaria</option>
                                    <option value="semanal">Semanal</option>
                                    <option value="mensual">Mensual</option>
                                </select>
                            </div>
                            <div class="mt-4">
                                <button type="button" id="crearBackup"
                                    class="bg-blue-700 text-white px-4 py-2 rounded">Crear Copia de Seguridad</button>
                            </div>
                        </div>

                        <!-- Reemplazar este div en tu código -->
                        <div class="bg-white p-6 rounded shadow">
                            <h2 class="text-2xl font-bold text-blue-700 mb-4">Configuración de perfil</h2>
                            <div class="perfil-contenido">
                                <div class="perfil-imagen-container">
                                    <img id="perfilPreview" src="IMG/Victoria.png" alt="Foto de perfil"
                                        class="w-24 h-24 rounded-full object-cover mb-3">
                                    <input type="file" id="perfilImagen" accept="image/*" style="display: none;">
                                    <button id="cambiarFotoBtn" class="bg-blue-700 text-white px-4 py-2 rounded">Cambiar
                                        Foto</button>
                                </div>
                                <div class="perfil-form mt-4">
                                    <div class="form-group">
                                        <label for="nombreUsuario" class="block text-gray-700">Nombre</label>
                                        <input type="text" id="nombreUsuario"
                                            class="w-full p-2 border rounded configuracion-input" value="Victoria">
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="emailUsuario" class="block text-gray-700">Correo electrónico</label>
                                        <input type="email" id="emailUsuario"
                                            class="w-full p-2 border rounded configuracion-input"
                                            value="victoria@ejemplo.com">
                                    </div>
                                    <button id="guardarPerfilInline"
                                        class="bg-blue-700 text-white px-4 py-2 rounded mt-4">Guardar Cambios</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-6">
                        <button type="submit" class="bg-blue-700 text-white px-4 py-2 rounded">Guardar
                            Configuración</button>
                    </div>

                </form>
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
                                        <p>Bienvenido a nuestra plataforma. Esta guía te ayudará a navegar y aprovechar
                                            al
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
                                        <p>1. Registro: Crea tu cuenta utilizando tu correo electrónico o redes
                                            sociales.
                                        </p>
                                        <p>2. Perfil: Completa tu información personal para personalizar tu experiencia.
                                        </p>
                                    </div>
                                </div>
                                <div class="section">
                                    <div class="blue-line"></div>
                                    <div class="section-content">
                                        <h3>
                                            <span class="emoji">🛠️</span> Configuración Avanzada
                                        </h3>
                                        <p>3. Personalización: Ajusta configuraciones de privacidad y notificaciones.
                                        </p>
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
                                        <p>Si encuentras un problema, contacta a nuestro equipo de soporte disponible
                                            24/7.
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

        <script src="js/config.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
        <style>
            /* Estilo para el modo oscuro */
            .dark-mode {
                background-color: #121212;
                color: #ffffff;
            }
        </style>
        <script>
            // Al cargar la página, aplicar el modo oscuro si está activado en localStorage
            document.addEventListener('DOMContentLoaded', () => {
                const modoOscuroCheckbox = document.getElementById('modoOscuro');
                const isDarkMode = localStorage.getItem('modoOscuro') === 'true';

                if (isDarkMode) {
                    document.body.classList.add('dark-mode');
                    if (modoOscuroCheckbox) modoOscuroCheckbox.checked = true;
                }

                // Escuchar cambios en el checkbox y guardar el estado en localStorage
                if (modoOscuroCheckbox) {
                    modoOscuroCheckbox.addEventListener('change', () => {
                        const isChecked = modoOscuroCheckbox.checked;
                        document.body.classList.toggle('dark-mode', isChecked);
                        localStorage.setItem('modoOscuro', isChecked);
                    });
                }
            });

            document.addEventListener('DOMContentLoaded', () => {
                // Referencias a los elementos
                const idiomaSelect = document.getElementById('idioma');
                const notificacionesEmailCheckbox = document.getElementById('notificacionesEmail');
                const notificacionesPushCheckbox = document.getElementById('notificacionesPush');

                // Cargar configuraciones desde localStorage
                const savedIdioma = localStorage.getItem('idioma');
                const savedNotificacionesEmail = localStorage.getItem('notificacionesEmail') === 'true';
                const savedNotificacionesPush = localStorage.getItem('notificacionesPush') === 'true';

                // Aplicar configuraciones al cargar la página
                if (savedIdioma && idiomaSelect) idiomaSelect.value = savedIdioma;
                if (notificacionesEmailCheckbox) notificacionesEmailCheckbox.checked = savedNotificacionesEmail;
                if (notificacionesPushCheckbox) notificacionesPushCheckbox.checked = savedNotificacionesPush;

                // Guardar cambios en localStorage
                if (idiomaSelect) {
                    idiomaSelect.addEventListener('change', () => {
                        localStorage.setItem('idioma', idiomaSelect.value);
                    });
                }

                if (notificacionesEmailCheckbox) {
                    notificacionesEmailCheckbox.addEventListener('change', () => {
                        localStorage.setItem('notificacionesEmail', notificacionesEmailCheckbox.checked);
                    });
                }

                if (notificacionesPushCheckbox) {
                    notificacionesPushCheckbox.addEventListener('change', () => {
                        localStorage.setItem('notificacionesPush', notificacionesPushCheckbox.checked);
                    });
                }
            });

            document.addEventListener('DOMContentLoaded', () => {
                const crearBackupButton = document.getElementById('crearBackup');

                if (crearBackupButton) {
                    crearBackupButton.addEventListener('click', () => {
                        // Simulación de datos de usuarios
                        const usuarios = [
                            { ID: 1, Nombre: 'Luisangel', Email: 'luisangelgamer20@gmail.com', Rol: 'admin' },
                            { ID: 2, Nombre: 'Victoria flores', Email: 'luisangelgamer2000@gmail.com', Rol: 'normal' },
                            // Agregar más usuarios según sea necesario
                        ];

                        // Simulación de datos de dispositivos
                        const dispositivos = [
                            { ID: 1, Nombre: 'Sensor A', Tipo: 'Temperatura', Estado: 'Activo' },
                            { ID: 2, Nombre: 'Cámara B', Tipo: 'Seguridad', Estado: 'Inactivo' },
                            // Agregar más dispositivos según sea necesario
                        ];

                        // Simulación de datos de alertas
                        const alertas = [
                            { ID: 1, Mensaje: 'Temperatura alta', Fecha: '2023-10-01', Prioridad: 'Alta' },
                            { ID: 2, Mensaje: 'Movimiento detectado', Fecha: '2023-10-02', Prioridad: 'Media' },
                            // Agregar más alertas según sea necesario
                        ];

                        // Crear hojas de datos
                        const hojaUsuarios = XLSX.utils.json_to_sheet(usuarios);
                        const hojaDispositivos = XLSX.utils.json_to_sheet(dispositivos);
                        const hojaAlertas = XLSX.utils.json_to_sheet(alertas);

                        // Crear libro de trabajo
                        const libro = XLSX.utils.book_new();
                        XLSX.utils.book_append_sheet(libro, hojaUsuarios, 'Usuarios');
                        XLSX.utils.book_append_sheet(libro, hojaDispositivos, 'Dispositivos');
                        XLSX.utils.book_append_sheet(libro, hojaAlertas, 'Alertas');

                        // Generar archivo Excel
                        const nombreArchivo = `reporte_completo_${new Date().toISOString().slice(0, 10)}.xlsx`;
                        XLSX.writeFile(libro, nombreArchivo);

                        alert('Reporte completo generado exitosamente en formato Excel.');
                    });
                }
            });
        </script>

        <script src="js/profile_settings.js"></script>
        <script src="js/profile.js"></script>

</body>

</html>
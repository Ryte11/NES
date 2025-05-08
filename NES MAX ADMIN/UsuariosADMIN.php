<?php
// Iniciar sesión
session_start();

// Configuración de conexión a la base de datos
$servername = "localhost:";
$username = "root"; 
$password = ""; 
$dbname = "nes";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Añade al inicio del script para ver los errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);




// Consulta para obtener usuarios con rol de administrador
$sql = "SELECT id, nombre, email, password, rol FROM usuarios WHERE rol = 'normal'";
$result = mysqli_query($conn, $sql);



// Aquí agregaremos el código para procesar la edición de usuarios

// Procesar actualización de usuario cuando se envía el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'editar_usuario') {
    // Capturar datos del formulario
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Inicializar mensaje de éxito/error
    $mensaje = "";
    
    // Validar entrada
    if (empty($nombre) || empty($email)) {
        $mensaje = "Error: Nombre y email son obligatorios";
    } else {
        // Si el password está vacío, actualizamos solo nombre y email
        if (empty($password)) {
            $sql = "UPDATE usuarios SET nombre = ?, email = ? WHERE id = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "ssi", $nombre, $email, $id);
        } else {
            // Si hay password, lo actualizamos también
            // Encriptar la contraseña (recomendado)
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "UPDATE usuarios SET nombre = ?, email = ?, password = ? WHERE id = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "sssi", $nombre, $email, $password_hash, $id);
        }
        
        if (mysqli_stmt_execute($stmt)) {
            $mensaje = "Usuario actualizado correctamente";
            // Recargar la página para ver los cambios
            echo "<script>
                  alert('Usuario actualizado correctamente');
                  window.location.href = window.location.pathname;
                  </script>";
        } else {
            $mensaje = "Error al actualizar usuario: " . mysqli_error($conn);
        }
        
        mysqli_stmt_close($stmt);
    }
}

// Procesar eliminación de usuario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'eliminar_usuario') {
    $id = $_POST['id'];
    
    $sql = "DELETE FROM usuarios WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    
    if (mysqli_stmt_execute($stmt)) {
        echo "<script>
              alert('Usuario eliminado correctamente');
              window.location.href = window.location.pathname;
              </script>";
    } else {
        echo "<script>alert('Error al eliminar usuario: " . mysqli_error($conn) . "');</script>";
    }
    
    mysqli_stmt_close($stmt);
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/usuario.css">
    <title>Usuarios Admins</title>
    <style>
        /* Estilos para los botones de acción y tooltips */
        .action-btn {
            background-color: #f0f0f0;
            border: none;
            border-radius: 4px;
            padding: 8px;
            cursor: pointer;
            position: relative;
            transition: all 0.3s ease;
        }

        .action-btn:hover {
            background-color: #e0e0e0;
        }

        .tooltip {
            position: relative;
            display: inline-block;
        }

        .tooltip-content {
            visibility: hidden;
            position: absolute;
            z-index: 10;
            bottom: 125%;
            left: 50%;
            transform: translateX(-50%);
            background-color: white;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border-radius: 6px;
            padding: 0;
            opacity: 0;
            transition: opacity 0.3s, visibility 0.3s;
            white-space: nowrap;
            overflow: hidden;
        }

        .tooltip:hover .tooltip-content {
            visibility: visible;
            opacity: 1;
        }

        .tooltip-btn {
            display: block;
            padding: 8px 16px;
            border: none;
            background: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .tooltip-btn:hover {
            background-color: #f5f5f5;
        }

        .tooltip-btn.edit {
            color: #4CAF50;
        }

        .tooltip-btn.delete {
            color: #F44336;
        }

        /* Estilos para los modales */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .modal.show {
            opacity: 1;
        }

        .modal-content {
            margin: -20% auto;
            border-radius: 12px;
            width: 50%;
            transform: translateY(-50px);
            opacity: 0;
            transition: all 0.4s ease;
            overflow: hidden;
        }

        .modal-content-detele {
            background-color: #fff;
            margin: -20% auto;
            border-radius: 12px;
            width: 50%;
            transform: translateY(-50px);
            opacity: 0;
            transition: all 0.4s ease;
            overflow: hidden;
        }


        .modal.show .modal-content {
            transform: translateY(0);
            opacity: 1;
        }

        .edit-modal-content {
            display: flex;
            flex-direction: column;
            padding: 20px;
        }

        .edit-modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
            margin-bottom: 20px;
        }

        .edit-modal-header h3 {
            font-size: 20px;
            color: #333;
            margin: 0;
        }

        .close-modal {
            font-size: 24px;
            cursor: pointer;
            color: #aaa;
            transition: color 0.2s;
        }

        .close-modal:hover {
            color: #333;
        }

        .edit-form-group {
            margin-bottom: 15px;
        }

        .edit-form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
            color: #555;
        }

        .edit-form-input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
            transition: border 0.3s;
        }

        .edit-form-input:focus {
            border-color: #4a90e2;
            outline: none;
        }

        .edit-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 20px;
        }

        .cancel-btn, .save-btn, .confirm-btn, .cancel-delete-btn {
            padding: 10px 20px;
            border-radius: 6px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            border: none;
        }

        .cancel-btn, .cancel-delete-btn {
            background-color: #f5f5f5;
            color: #555;
        }

        .cancel-btn:hover, .cancel-delete-btn:hover {
            background-color: #eaeaea;
        }

        .save-btn {
            background-color: #4CAF50;
            color: white;
        }

        .save-btn:hover {
            background-color: #45a049;
        }

        .confirm-btn {
            background-color: #F44336;
            color: white;
        }

        .confirm-btn:hover {
            background-color: #e53935;
        }

        /* Estilos para el modal de confirmación de eliminación */
        .delete-modal-content {
            background-color: #fff;
            height: 260px;
            border-radius: 12px;
            text-align: center;
            padding: 30px;
        }

        .delete-icon {
            font-size: 60px;
            color: #F44336;
            margin-bottom: 20px;
        }

        .delete-title {
            font-size: 24px;
            margin-bottom: 10px;
            color: #333;
        }

        .delete-message {
            color: #666;
            margin-bottom: 25px;
            font-size: 16px;
        }

        /* Animación para los modales */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeOut {
            from { opacity: 1; transform: translateY(0); }
            to { opacity: 0; transform: translateY(-20px); }
        }

        .fadeIn {
            animation: fadeIn 0.3s forwards;
        }

        .fadeOut {
            animation: fadeOut 0.3s forwards;
        }
        


.modal.show .modal-content {
    transform: translateY(0) scale(1);
    opacity: 1;
}

/* Cabecera del modal */
.edit-modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 22px 30px;
    background-color: #ffffff;
    border-bottom: 1px solid #eaedf3;
}

.edit-modal-header h3 {
    font-size: 22px;
    color: #2c3e50;
    margin: 0;
    font-weight: 600;
    position: relative;
}

.close-modal {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #f8f9fb;
    color: #94a3b8;
    font-size: 22px;
    cursor: pointer;
    transition: all 0.2s ease;
    border: none;
}

.close-modal:hover {
    background-color: #f1f5f9;
    color: #64748b;
    transform: rotate(90deg);
}

/* Contenido del formulario */
.edit-modal-content {
    display: flex;
    flex-direction: column;
    padding: 30px;
}

.edit-form-group {
    margin-bottom: 24px;
    position: relative;
}

.edit-form-group label {
    display: block;
    margin-bottom: 10px;
    font-weight: 500;
    color: #64748b;
    font-size: 15px;
}

.edit-form-input {
    width: 100%;
    padding: 16px;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    font-size: 15px;
    background-color: #f8fafc;
    transition: all 0.25s ease;
    box-sizing: border-box;
    color: #1e293b;
}

.edit-form-input:focus {
    border-color: #3b82f6;
    background-color: #ffffff;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
    outline: none;
}

.edit-form-input::placeholder {
    color: #94a3b8;
}

/* Botones del modal */
.edit-buttons {
    display: flex;
    justify-content: flex-end;
    gap: 12px;
    margin-top: 10px;
}

.cancel-btn {
    padding: 14px 24px;
    border-radius: 10px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s ease;
    border: 1px solid #e2e8f0;
    background-color: #ffffff;
    color: #64748b;
    font-size: 15px;
}

.cancel-btn:hover {
    background-color: #f8fafc;
    color: #334155;
}

.save-btn, .guardar-btn {
    padding: 14px 28px;
    border-radius: 10px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.25s ease;
    border: none;
    background-color: #3b82f6;
    color: white;
    font-size: 15px;
    position: relative;
    overflow: hidden;
}

.save-btn:hover, .guardar-btn:hover {
    background-color: #2563eb;
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(59, 130, 246, 0.25);
}

.save-btn:active, .guardar-btn:active {
    transform: translateY(0);
    box-shadow: 0 2px 5px rgba(59, 130, 246, 0.2);
}

/* Efecto de ondas al hacer clic */
.save-btn::after, .guardar-btn::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 5px;
    height: 5px;
    background: rgba(255, 255, 255, 0.4);
    opacity: 0;
    border-radius: 100%;
    transform: scale(1, 1) translate(-50%, -50%);
    transform-origin: 50% 50%;
}

.save-btn:focus:not(:active)::after, .guardar-btn:focus:not(:active)::after {
    animation: ripple 0.6s ease-out;
}

@keyframes ripple {
    0% {
        transform: scale(0, 0);
        opacity: 0.5;
    }
    100% {
        transform: scale(20, 20);
        opacity: 0;
    }
}

/* Estilos específicos para campos de edición de usuario */
.user-form .edit-form-input {
    padding-left: 45px;
}

.user-form .input-icon {
    position: absolute;
    left: 16px;
    top: 46px;
    color: #94a3b8;
    font-size: 18px;
}

.user-form .edit-form-group:focus-within .input-icon {
    color: #3b82f6;
}

/* Mensaje de validación */
.input-validation {
    font-size: 13px;
    margin-top: 6px;
    display: none;
}

.input-validation.error {
    display: block;
    color: #ef4444;
}

.input-validation.success {
    display: block;
    color: #10b981;
}

.edit-form-input.error {
    border-color: #ef4444;
}

.edit-form-input.success {
    border-color: #10b981;
}

/* Área de contraseña */
.password-container {
    position: relative;
}

.toggle-password {
    position: absolute;
    right: 16px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: #94a3b8;
    cursor: pointer;
    font-size: 18px;
}

.toggle-password:hover {
    color: #64748b;
}

/* Animaciones para el modal */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-30px) scale(0.95); }
    to { opacity: 1; transform: translateY(0) scale(1); }
}

@keyframes fadeOut {
    from { opacity: 1; transform: translateY(0) scale(1); }
    to { opacity: 0; transform: translateY(-30px) scale(0.95); }
}

.fadeIn {
    animation: fadeIn 0.4s cubic-bezier(0.165, 0.84, 0.44, 1) forwards;
}

.fadeOut {
    animation: fadeOut 0.3s ease-out forwards;
}
    </style>
</head>

<body>

    <div class="principal">
        <div class="menu-lat">
            <div class="menu">
                <div class="imagen">
                    <a href="PanelDeControl.html">
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
                        <a href="PanelDeControl.html" class="menu-item">
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
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-users">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                            </svg>
                            <a href="Usuario.html">Usuarios</a>
                            <ul class="submenu">
                                <li><a href="UsuariosADMIN.php">Usuarios Administrativos</a></li>
                                <li><a href="UsuarioMAXADMIN.php">Máximo Administrador</a></li>
                                <li><a href="UsuarioTecnicos.php">Usurios tecnicos</a></li>
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
                <h2 class="titulo">Gestión de Usuarios</h2>
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
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round"
                            stroke-linejoin="round" width="32" height="32" stroke-width="1.75">
                            <path d="M10 5a2 2 0 1 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6">
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

            <div class="card">
                <div class="card-header">
                    <span></span>
                    <h2 class="card-title">Usuarios Administradores</h2>
                    <button class="add-button">+</button>
                </div>
            
                <table class="users-table">
                    <thead>
                        <tr>
                            <th>Usuario</th>
                            <th>ID</th>
                            <th>Correo electrónico</th>
                            <th></th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        // Mostrar los datos de la tabla usuarios
                        if (mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_assoc($result)) {
                                echo '<tr style="position: relative;">
                                        <td>
                                            <div class="user-info">
                                                <div class="user-avatar">
                                                    <img src="IMG/Victoria.png" alt="' . $row["nombre"] . '">
                                                </div>
                                                <span>' . $row["nombre"] . '</span>
                                            </div>
                                        </td>
                                        <td class="text-gray">' . $row["id"] . '</td>
                                        <td class="text-gray">' . $row["email"] . '</td>
                                        <td>
                                            <span class="verified-icon">✓</span>
                                        </td>
                                        <td>
                                            <div class="tooltip">
                                                <button class="action-btn" aria-label="Opciones">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <circle cx="12" cy="12" r="1"></circle>
                                                        <circle cx="12" cy="5" r="1"></circle>
                                                        <circle cx="12" cy="19" r="1"></circle>
                                                    </svg>
                                                </button>
                                                <div class="tooltip-content">
                                                    <button class="tooltip-btn edit" data-id="' . $row["id"] . '" data-nombre="' . $row["nombre"] . '" data-email="' . $row["email"] . '">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 8px; vertical-align: middle;">
                                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                                        </svg>
                                                        Editar
                                                    </button>
                                                    <button class="tooltip-btn delete" data-id="' . $row["id"] . '" data-nombre="' . $row["nombre"] . '">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 8px; vertical-align: middle;">
                                                            <polyline points="3 6 5 6 21 6"></polyline>
                                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                            <line x1="10" y1="11" x2="10" y2="17"></line>
                                                            <line x1="14" y1="11" x2="14" y2="17"></line>
                                                        </svg>
                                                        Eliminar
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>';
                            }
                        } else {
                            echo '<tr><td colspan="5">No hay usuarios administradores registrados</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <!-- Modal para agregar nuevo usuario -->
            <div class="modal" id="userModal">
                <div class="modal-content">
                    <div class="modal-left">
                        <img src="IMG/stacked-waves-haikei.png" alt="Waves" class="waves-bg">
                        <h2>Agregar un nuevo administrador</h2>
                    </div>
                    <div class="modal-right">
                        <h3>Nuevo Usuario</h3>
                        <p>Llena los campos y agrega un nuevo Usuario!!</p>
            
                        <form id="userForm" method="POST" action="php/user.php">
                            <div class="form-group">
                                <input type="text" class="form-input" id="usuario" name="nombre" placeholder="Usuario">
                                <div class="error-message" id="usuarioError">Este ID es incorrecto</div>
                            </div>
                        
                            <div class="form-group">
                                <input type="email" class="form-input" id="email" name="email" placeholder="Correo electrónico">
                                <div class="error-message" id="emailError">Correo electrónico inválido</div>
                            </div>
                        
                            <div class="form-group">
                                <input type="password" class="form-input" id="password" name="password" placeholder="Contraseña">
                                <div class="error-message" id="passwordError">Contraseña inválida</div>
                            </div>
                        
                            <button type="submit" class="create-button">Crear usuario</button>
                        </form>
                    </div>
                </div>
            </div>
            
            <!-- Modal para editar usuario -->
            <div class="modal" id="editModal">
    <div class="modal-content">
        <div class="edit-modal-content">
            <div class="edit-modal-header">
                <h3>Editar usuario</h3>
                <span class="close-modal" id="closeEditModal">&times;</span>
            </div>
            
            <!-- No usamos form tag porque lo manejaremos con JavaScript -->
            <input type="hidden" id="edit_id" name="id">
            
            <div class="edit-form-group">
                <label for="edit_nombre">Nombre de usuario</label>
                <input type="text" class="edit-form-input" id="edit_nombre" name="nombre">
            </div>
            
            <div class="edit-form-group">
                <label for="edit_email">Correo electrónico</label>
                <input type="email" class="edit-form-input" id="edit_email" name="email">
            </div>
            
            <div class="edit-form-group">
                <label for="edit_password">Nueva contraseña (dejar vacío para mantener actual)</label>
                <input type="password" class="edit-form-input" id="edit_password" name="password" placeholder="Nueva contraseña">
            </div>
            
            <div class="edit-buttons">
                <button type="button" class="cancel-btn" id="cancelEdit">Cancelar</button>
                <button type="button" class="save-btn">Guardar cambios</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para confirmar eliminación -->
<div class="modal" id="deleteModal">
    <div class="modal-content">
        <div class="delete-modal-content">
            <div class="delete-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="15" y1="9" x2="9" y2="15"></line>
                    <line x1="9" y1="9" x2="15" y2="15"></line>
                </svg>
            </div>
            <h3 class="delete-title">¿Eliminar usuario?</h3>
            <p class="delete-message">¿Estás seguro de que deseas eliminar a <span id="delete_user_name"></span>? Esta acción no se puede deshacer.</p>
            <input type="hidden" id="delete_id" name="id">
            <div class="edit-buttons">
                <button type="button" class="cancel-delete-btn" id="cancelDelete">Cancelar</button>
                <button type="button" class="confirm-btn">Sí, eliminar</button>
            </div>
        </div>
    </div>
</div>
        </div>
    </div>

    <script src="js/UserAdmin1.js"></script>
    <script>
        // Script para manejar los modales y acciones
        document.addEventListener('DOMContentLoaded', function() {
            // Referencias a los modales
            const userModal = document.getElementById('userModal');
            const editModal = document.getElementById('editModal');
            const deleteModal = document.getElementById('deleteModal');
            
            // Botones para abrir/cerrar modales
            const addButton = document.querySelector('.add-button');
            const closeEditModal = document.getElementById('closeEditModal');
            const cancelEdit = document.getElementById('cancelEdit');
            const cancelDelete = document.getElementById('cancelDelete');
            
            // Botones de editar y eliminar (delegación de eventos)
            document.addEventListener('click', function(e) {
                // Botón de editar
                if (e.target.closest('.tooltip-btn.edit')) {
                    const btn = e.target.closest('.tooltip-btn.edit');
                    const id = btn.getAttribute('data-id');
                    const nombre = btn.getAttribute('data-nombre');
                    const email = btn.getAttribute('data-email');
                    
                    // Rellenar el formulario con los datos del usuario
                    document.getElementById('edit_id').value = id;
                    document.getElementById('edit_nombre').value = nombre;
                    document.getElementById('edit_email').value = email;
                    
                    // Mostrar el modal
                    openModal(editModal);
                }
                
                // Botón de eliminar
                if (e.target.closest('.tooltip-btn.delete')) {
                    const btn = e.target.closest('.tooltip-btn.delete');
                    const id = btn.getAttribute('data-id');
                    const nombre = btn.getAttribute('data-nombre');
                    
                    // Establecer el ID del usuario a eliminar
                    document.getElementById('delete_id').value = id;
                    document.getElementById('delete_user_name').textContent = nombre;
                    
                    // Mostrar el modal
                    openModal(deleteModal);
                }
            });
            
            // Abrir modal de nuevo usuario
            addButton.addEventListener('click', function() {
                openModal(userModal);
            });
            
            // Cerrar modal de edición
            closeEditModal.addEventListener('click', function() {
                closeModal(editModal);
            });
            
            // Cancelar edición
            cancelEdit.addEventListener('click', function() {
                closeModal(editModal);
            });
            
            // Cancelar eliminación
            cancelDelete.addEventListener('click', function() {
                closeModal(deleteModal);
            });
            
            // Función para abrir modal con animación
            function openModal(modal) {
                modal.style.display = 'block';
                setTimeout(() => {
                    modal.classList.add('show');
                    modal.querySelector('.modal-content').classList.add('fadeIn');
                }, 10);
            }
            
            // Función para cerrar modal con animación
            function closeModal(modal) {
                modal.classList.remove('show');
                modal.querySelector('.modal-content').classList.remove('fadeIn');
                modal.querySelector('.modal-content').classList.add('fadeOut');
                
                setTimeout(() => {
                    modal.style.display = 'none';
                    modal.querySelector('.modal-content').classList.remove('fadeOut');
                }, 300);
            }
            
            // Cerrar modal al hacer clic fuera del contenido
            window.addEventListener('click', function(e) {
                if (e.target === editModal) {
                    closeModal(editModal);
                }
                if (e.target === deleteModal) {
                    closeModal(deleteModal);
                }
                if (e.target === userModal) {
                    closeModal(userModal);
                }
            });
            
            // Validación del formulario de edición
            const editForm = document.getElementById('editForm');
            if (editForm) {
                editForm.addEventListener('submit', function(e) {
                    let isValid = true;
                    
                    const nombre = document.getElementById('edit_nombre').value.trim();
                    const email = document.getElementById('edit_email').value.trim();
                    
                    if (nombre === '') {
                        isValid = false;
                        document.getElementById('edit_nombre').style.borderColor = '#F44336';
                    } else {
                        document.getElementById('edit_nombre').style.borderColor = '#ddd';
                    }
                    
                    if (email === '' || !validateEmail(email)) {
                        isValid = false;
                        document.getElementById('edit_email').style.borderColor = '#F44336';
                    } else {
                        document.getElementById('edit_email').style.borderColor = '#ddd';
                    }
                    
                    if (!isValid) {
                        e.preventDefault();
                    }
                });
            }
            
            // Función para validar email
            function validateEmail(email) {
                const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return re.test(email);
            }

            
        });


        // Script para manejar los modales y acciones
document.addEventListener('DOMContentLoaded', function() {
    // Referencias a los modales
    const userModal = document.getElementById('userModal');
    const editModal = document.getElementById('editModal');
    const deleteModal = document.getElementById('deleteModal');
    
    // Botones para abrir/cerrar modales
    const addButton = document.querySelector('.add-button');
    const closeEditModal = document.getElementById('closeEditModal');
    const cancelEdit = document.getElementById('cancelEdit');
    const cancelDelete = document.getElementById('cancelDelete');
    
    // Botones de editar y eliminar (delegación de eventos)
    document.addEventListener('click', function(e) {
        // Botón de editar
        if (e.target.closest('.tooltip-btn.edit')) {
            const btn = e.target.closest('.tooltip-btn.edit');
            const id = btn.getAttribute('data-id');
            const nombre = btn.getAttribute('data-nombre');
            const email = btn.getAttribute('data-email');
            
            // Rellenar el formulario con los datos del usuario
            document.getElementById('edit_id').value = id;
            document.getElementById('edit_nombre').value = nombre;
            document.getElementById('edit_email').value = email;
            document.getElementById('edit_password').value = ''; // Limpiar campo de contraseña
            
            // Mostrar el modal
            openModal(editModal);
        }
        
        // Botón de eliminar
        if (e.target.closest('.tooltip-btn.delete')) {
            const btn = e.target.closest('.tooltip-btn.delete');
            const id = btn.getAttribute('data-id');
            const nombre = btn.getAttribute('data-nombre');
            
            // Establecer el ID del usuario a eliminar
            document.getElementById('delete_id').value = id;
            document.getElementById('delete_user_name').textContent = nombre;
            
            // Mostrar el modal
            openModal(deleteModal);
        }
    });
    
    // Abrir modal de nuevo usuario
    if (addButton) {
        addButton.addEventListener('click', function() {
            openModal(userModal);
        });
    }
    
    // Cerrar modal de edición
    if (closeEditModal) {
        closeEditModal.addEventListener('click', function() {
            closeModal(editModal);
        });
    }
    
    // Cancelar edición
    if (cancelEdit) {
        cancelEdit.addEventListener('click', function() {
            closeModal(editModal);
        });
    }
    
    // Cancelar eliminación
    if (cancelDelete) {
        cancelDelete.addEventListener('click', function() {
            closeModal(deleteModal);
        });
    }
    
    // Envío del formulario de edición
    const saveEditBtn = editModal.querySelector('.save-btn');
    if (saveEditBtn) {
        saveEditBtn.addEventListener('click', function() {
            const id = document.getElementById('edit_id').value;
            const nombre = document.getElementById('edit_nombre').value;
            const email = document.getElementById('edit_email').value;
            const password = document.getElementById('edit_password').value;
            
            if (validateEditForm()) {
                // Crear un formulario dinámico para enviar los datos
                const form = document.createElement('form');
                form.method = 'POST';
                form.style.display = 'none';
                
                const actionInput = document.createElement('input');
                actionInput.name = 'action';
                actionInput.value = 'editar_usuario';
                form.appendChild(actionInput);
                
                const idInput = document.createElement('input');
                idInput.name = 'id';
                idInput.value = id;
                form.appendChild(idInput);
                
                const nombreInput = document.createElement('input');
                nombreInput.name = 'nombre';
                nombreInput.value = nombre;
                form.appendChild(nombreInput);
                
                const emailInput = document.createElement('input');
                emailInput.name = 'email';
                emailInput.value = email;
                form.appendChild(emailInput);
                
                const passwordInput = document.createElement('input');
                passwordInput.name = 'password';
                passwordInput.value = password;
                form.appendChild(passwordInput);
                
                document.body.appendChild(form);
                form.submit();
            }
        });
    }
    
    // Envío del formulario de eliminación
    const confirmDeleteBtn = deleteModal.querySelector('.confirm-btn');
    if (confirmDeleteBtn) {
        confirmDeleteBtn.addEventListener('click', function() {
            const id = document.getElementById('delete_id').value;
            
            // Crear un formulario dinámico para enviar los datos
            const form = document.createElement('form');
            form.method = 'POST';
            form.style.display = 'none';
            
            const actionInput = document.createElement('input');
            actionInput.name = 'action';
            actionInput.value = 'eliminar_usuario';
            form.appendChild(actionInput);
            
            const idInput = document.createElement('input');
            idInput.name = 'id';
            idInput.value = id;
            form.appendChild(idInput);
            
            document.body.appendChild(form);
            form.submit();
        });
    }
    
    // Función para abrir modal con animación
    function openModal(modal) {
        modal.style.display = 'block';
        setTimeout(() => {
            modal.classList.add('show');
            modal.querySelector('.modal-content').classList.add('fadeIn');
        }, 10);
    }
    
    // Función para cerrar modal con animación
    function closeModal(modal) {
        modal.classList.remove('show');
        modal.querySelector('.modal-content').classList.remove('fadeIn');
        modal.querySelector('.modal-content').classList.add('fadeOut');
        
        setTimeout(() => {
            modal.style.display = 'none';
            modal.querySelector('.modal-content').classList.remove('fadeOut');
        }, 300);
    }
    
    // Cerrar modal al hacer clic fuera del contenido
    window.addEventListener('click', function(e) {
        if (e.target === editModal) {
            closeModal(editModal);
        }
        if (e.target === deleteModal) {
            closeModal(deleteModal);
        }
        if (e.target === userModal) {
            closeModal(userModal);
        }
    });
    
    // Validación del formulario de edición
    function validateEditForm() {
        let isValid = true;
        
        const nombre = document.getElementById('edit_nombre').value.trim();
        const email = document.getElementById('edit_email').value.trim();
        
        if (nombre === '') {
            isValid = false;
            document.getElementById('edit_nombre').style.borderColor = '#F44336';
        } else {
            document.getElementById('edit_nombre').style.borderColor = '#ddd';
        }
        
        if (email === '' || !validateEmail(email)) {
            isValid = false;
            document.getElementById('edit_email').style.borderColor = '#F44336';
        } else {
            document.getElementById('edit_email').style.borderColor = '#ddd';
        }
        
        return isValid;
    }
    
    // Función para validar email
    function validateEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }
});
    </script>
</body>

</html>

<?php
// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>
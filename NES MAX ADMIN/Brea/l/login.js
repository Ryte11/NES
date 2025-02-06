
document.getElementById('loginForm').addEventListener('submit', function (e) {
    e.preventDefault(); // Evitar que se envíe el formulario automáticamente

    // Obtener los valores
    const userId = document.getElementById('userId').value;
    const password = document.getElementById('password').value;

    // Limpiar mensajes de error previos
    document.getElementById('userIdError').textContent = '';
    document.getElementById('passwordError').textContent = '';

    let isValid = true;

    // Validación del ID de usuario
    const idRegex = /^[a-zA-Z0-9]+$/; // Solo letras y números
    if (!idRegex.test(userId)) {
        document.getElementById('userIdError').textContent = 'Ese ID es incorrecto';
        isValid = false;
    }

    // Validación de la contraseña
    if (!password.trim()) {
        document.getElementById('passwordError').textContent = 'Contraseña requerida';
        isValid = false;
    }

    // Si todo es válido, enviar el formulario
    if (isValid) {
        alert('Formulario enviado correctamente');
        // Aquí puedes agregar la lógica para enviar datos al servidor
    }
});

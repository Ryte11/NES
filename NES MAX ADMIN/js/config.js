document.addEventListener('DOMContentLoaded', () => {
    // Obtener elementos
    const modoOscuroCheckbox = document.getElementById('modoOscuro');
    const idiomaSelect = document.getElementById('idioma');
    const notificacionesEmailCheckbox = document.getElementById('notificacionesEmail');
    const notificacionesPushCheckbox = document.getElementById('notificacionesPush');

    // Cargar configuraciones desde localStorage
    const configuraciones = {
        modoOscuro: localStorage.getItem('modoOscuro') === 'true',
        idioma: localStorage.getItem('idioma') || 'Español',
        notificacionesEmail: localStorage.getItem('notificacionesEmail') === 'true',
        notificacionesPush: localStorage.getItem('notificacionesPush') === 'true'
    };

    // Aplicar configuraciones iniciales
    modoOscuroCheckbox.checked = configuraciones.modoOscuro;
    idiomaSelect.value = configuraciones.idioma;
    notificacionesEmailCheckbox.checked = configuraciones.notificacionesEmail;
    notificacionesPushCheckbox.checked = configuraciones.notificacionesPush;

    if (configuraciones.modoOscuro) {
        document.body.classList.add('dark-mode');
    }

    // Guardar configuraciones al cambiar
    modoOscuroCheckbox.addEventListener('change', () => {
        const isDarkMode = modoOscuroCheckbox.checked;
        localStorage.setItem('modoOscuro', isDarkMode);
        document.body.classList.toggle('dark-mode', isDarkMode);
    });

    idiomaSelect.addEventListener('change', () => {
        const idioma = idiomaSelect.value;
        localStorage.setItem('idioma', idioma);
    });

    notificacionesEmailCheckbox.addEventListener('change', () => {
        const emailNotifications = notificacionesEmailCheckbox.checked;
        localStorage.setItem('notificacionesEmail', emailNotifications);
    });

    notificacionesPushCheckbox.addEventListener('change', () => {
        const pushNotifications = notificacionesPushCheckbox.checked;
        localStorage.setItem('notificacionesPush', pushNotifications);
    });
});
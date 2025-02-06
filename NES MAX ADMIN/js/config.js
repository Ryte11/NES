document.getElementById('modoOscuro').addEventListener('change', function () {
    if (this.checked) {
        document.body.classList.add('bg-gray-900', 'text-white', 'dark-mode');
    } else {
        document.body.classList.remove('bg-gray-900', 'text-white', 'dark-mode');
    }
});

document.getElementById('idioma').addEventListener('change', function () {
    alert('Idioma cambiado a: ' + this.value);
});

document.getElementById('notificacionesEmail').addEventListener('change', function () {
    if (this.checked) {
        alert('Notificaciones por Email activadas');
    } else {
        alert('Notificaciones por Email desactivadas');
    }
});

document.getElementById('notificacionesPush').addEventListener('change', function () {
    if (this.checked) {
        alert('Notificaciones Push activadas');
    } else {
        alert('Notificaciones Push desactivadas');
    }
});

document.getElementById('notificationBell').addEventListener('click', function () {
    alert('Tienes nuevas notificaciones');
});
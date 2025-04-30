document.addEventListener('DOMContentLoaded', () => {
    const isDarkMode = localStorage.getItem('modoOscuro') === 'true';

    if (isDarkMode && !window.location.pathname.includes('login.html')) {
        document.body.classList.add('dark-mode');
    }
});

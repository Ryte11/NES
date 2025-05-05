// Script para manejar el modal de contactos
document.addEventListener('DOMContentLoaded', function() {
    // Obtenemos el modal
    const modal = document.getElementById('mensajeModal');
    
    // Obtenemos el botón para cerrar
    const closeBtn = document.querySelector('.close');
    
    // Obtenemos todos los botones "Ver Mensaje"
    const verBtns = document.querySelectorAll('.btn-ver');
    
    // Añadimos evento click a cada botón "Ver Mensaje"
    verBtns.forEach(function(btn) {
        btn.addEventListener('click', function() {
            // Obtenemos los datos del botón
            const id = this.getAttribute('data-id');
            const mensaje = this.getAttribute('data-mensaje');
            const email = this.getAttribute('data-email');
            const nombre = this.getAttribute('data-nombre');
            
            // Rellenamos el modal con los datos
            document.getElementById('modal-nombre').textContent = nombre;
            document.getElementById('modal-email').textContent = email;
            document.getElementById('modal-mensaje').textContent = mensaje;
            document.getElementById('contacto_id').value = id;
            
            // Mostramos el modal
            modal.style.display = 'block';
        });
    });
    
    // Cerrar el modal al hacer clic en la X
    closeBtn.addEventListener('click', function() {
        modal.style.display = 'none';
    });
    
    // Cerrar el modal al hacer clic fuera de él
    window.addEventListener('click', function(event) {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    });
    
    // Manejo del formulario de respuesta
    const responderForm = document.getElementById('responderForm');
    responderForm.addEventListener('submit', function(e) {
        // No es necesario prevenir el comportamiento por defecto ya que queremos enviar el formulario
        // Solo usamos esto para validaciones adicionales si fueran necesarias
        
        // Podríamos añadir validaciones aquí si fuera necesario
        // Por ejemplo, asegurarnos de que hay una respuesta si se pulsa el botón "Responder"
        const accion = e.submitter.value;
        if (accion === 'responder') {
            const respuesta = document.getElementById('respuesta').value.trim();
            if (!respuesta) {
                e.preventDefault();
                alert('Por favor, escribe una respuesta antes de enviar.');
                return false;
            }
        }
        
        // Si todo está bien, el formulario se enviará normalmente
    });
});
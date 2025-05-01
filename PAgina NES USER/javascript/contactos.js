/// este code es para el menu hamburguesa
const nav = document.querySelector("#nav");
const abrir = document.querySelector("#abrir");
const cerrar = document.querySelector("#cerrar");
const logo = document.getElementsByClassName("logo")

abrir.addEventListener("click", () => {
    nav.classList.add("visible");
   
})
cerrar.addEventListener("click", () => {
    nav.classList.remove("visible");
})

//kmkefneikfne


// Agregar después del código existente
function validarFormulario() {
    const nombre = document.getElementById('Nombre').value.trim();
    const email = document.getElementById('Email').value.trim();
    const mensaje = document.getElementById('Mensaje').value.trim();

    if (nombre.length < 3) {
        alert('El nombre debe tener al menos 3 caracteres');
        return false;
    }

    if (!email.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/)) {
        alert('Por favor, ingrese un email válido');
        return false;
    }

    if (mensaje.length < 10) {
        alert('El mensaje debe tener al menos 10 caracteres');
        return false;
    }

    return true;
}
function enviarContacto(event) {
    event.preventDefault();

    if (!validarFormulario()) {
        return false;
    }

    const formData = new FormData(document.getElementById('contactForm'));

    fetch('./php/guardar_contacto.php', {
        method: 'POST',
        body: formData,
        headers: {
            'Accept': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Error en la respuesta del servidor');
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            alert(data.message);
            document.getElementById('contactForm').reset();
        } else {
            alert('Error: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error al enviar el mensaje. Por favor, intente nuevamente.');
    });

    return false;
}






let map;

function initMap() {
  map = new google.maps.Map(document.getElementById("map"), {
    center: new google.maps.LatLng(18.918806051800235, -70.19208059596711),
    zoom: 8,
  });



  const citymap = {
    chicago: {
      center: { lat: 18.954921735051237, lng: -71.38838399329879 }, 
      population: 7856,
    },

    chicago2: {
      center: { lat: 18.114921735051237, lng: -71.38838399329879 }, 
      population: 7856,
    },

    newyork: {
      center: { lat: 18.65959455090463, lng: -70.05354513029361 }, 
      population: 8837,
    },
    newyork2: {
      center: { lat: 18.75959455090463, lng: -70.05354513029361 }, 
      population: 7837,
    },

    losangeles: {
      center: { lat: 18.608980747160004, lng: -68.75881558366454 }, 
      population: 17799,
    },

    losangeles2: {
      center: { lat: 18.98980747160004, lng: -70.85881558366454 }, 
      population: 9799,
    },


    vancouver: {
      center: { lat:  19.607261044278904, lng: -71.39911674595989 },  
      population: 71502,
    },

    vancouver2: {
      center: { lat:  18.507261044278904, lng: -71.39911674595989 },  
      population: 8502,
    },

  };


  



  for (const city in citymap) {
 
    const cityCircle = new google.maps.Circle({
      strokeColor: "#FF0000",
      strokeOpacity: 0.8,
      strokeWeight: 2,
      fillColor: "#FF0000",
      fillOpacity: 0.35,
      map,
      center: citymap[city].center,
      radius: Math.sqrt(citymap[city].population) * 100,
    });
  }

  

  
}

  


  // Create markers.
  for (let i = 0; i < features.length; i++) {
    const marker = new google.maps.Marker({
      position: features[i].position,
      icon: icons[features[i].type].icon,
      map: map,
    });
  }




window.initMap = initMap;

  

function openModal() {
    document.getElementById("modal-container").style.display = "flex";
}

function closeModal() {
    document.getElementById("modal-container").style.display = "none";
}




//coordenadas
// Definir features antes del bucle
const features = [
    // Aquí tus marcadores
    {
        position: new google.maps.LatLng(18.918806051800235, -70.19208059596711),
        type: 'default'
    }
    // Agrega más marcadores según necesites
];

// Luego tu código existente
for (let i = 0; i < features.length; i++) {
    const marker = new google.maps.Marker({
        position: features[i].position,
        icon: icons[features[i].type].icon,
        map: map,
    });
}

document.addEventListener("DOMContentLoaded", function () {
    const cerrarPopup = document.getElementById("cerrarPopup");
    const popupConfirmar = document.getElementById("popupConfirmar");
    const guardarBtn = document.getElementById("guardarBtn");
    let latitud, longitud;

    // Función para obtener la ubicación actual
    function obtenerUbicacion() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                function(position) {
                    latitud = position.coords.latitude;
                    longitud = position.coords.longitude;
                },
                function(error) {
                    console.error("Error al obtener la ubicación:", error);
                    alert("No se pudo obtener la ubicación");
                }
            );
        } else {
            alert("Tu navegador no soporta geolocalización");
        }
    }

    // Obtener ubicación al cargar la página
    obtenerUbicacion();

    cerrarPopup?.addEventListener("click", () => {
        popupConfirmar.style.display = "none";
    });

    guardarBtn?.addEventListener("click", () => {
        const password = document.getElementById("password").value;

        if (!password) {
            alert("Debes ingresar tu contraseña.");
            return;
        }

        const formData = new FormData();
        formData.append("password", password);
        formData.append("latitud", latitud);
        formData.append("longitud", longitud);

        fetch("php/guardar_dispositivo.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            if (data.success) {
                popupConfirmar.style.display = "none";
                document.getElementById("password").value = "";
                location.reload(); // Recargar la página para mostrar el nuevo marcador
            }
        })
        .catch(error => {
            console.error("Error:", error);
            alert("Hubo un error al guardar el dispositivo");
        });
    });
});

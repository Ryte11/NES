 
// Configuración del mapa
        const map = L.map('map').setView([18.7357, -70.1627], 8);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Datos actualizados de dispositivos en RD
        const dispositivos = [
            // Santo Domingo y alrededores
            { lat: 18.4861, lng: -69.9312, nombre: "Dispositivo Santo Domingo Este" },
            { lat: 18.4755, lng: -69.8845, nombre: "Dispositivo Santo Domingo Norte" },
            { lat: 18.4539, lng: -69.9689, nombre: "Dispositivo Santo Domingo Oeste" },
            { lat: 18.4718, lng: -69.9115, nombre: "Dispositivo Zona Colonial" },
            { lat: 18.4982, lng: -69.8712, nombre: "Dispositivo Los Mina" },
            
            // Santiago y región norte
            { lat: 19.4517, lng: -70.6973, nombre: "Dispositivo Santiago Centro" },
            { lat: 19.4389, lng: -70.6913, nombre: "Dispositivo Santiago Sur" },
            { lat: 19.4661, lng: -70.7088, nombre: "Dispositivo Santiago Norte" },
            { lat: 19.7892, lng: -70.6897, nombre: "Dispositivo Puerto Plata" },
            { lat: 19.7934, lng: -70.6871, nombre: "Dispositivo Playa Dorada" },
            
            // Región Este
            { lat: 18.5601, lng: -68.3725, nombre: "Dispositivo Punta Cana" },
            { lat: 18.4314, lng: -68.9719, nombre: "Dispositivo La Romana" },
            { lat: 18.7655, lng: -69.0339, nombre: "Dispositivo Higuey" },
            { lat: 18.4504, lng: -69.2395, nombre: "Dispositivo San Pedro de Macorís" },
            { lat: 18.4539, lng: -68.4242, nombre: "Dispositivo Bávaro" },
            
            // Región Sur
            { lat: 18.2714, lng: -70.3087, nombre: "Dispositivo San Cristóbal" },
            { lat: 18.2048, lng: -71.0993, nombre: "Dispositivo Barahona" },
            { lat: 18.4539, lng: -70.1198, nombre: "Dispositivo Bani" },
            { lat: 18.8082, lng: -71.2459, nombre: "Dispositivo San Juan" },
            { lat: 18.5539, lng: -70.5032, nombre: "Dispositivo Azua" },
            
            // Región Norte/Cibao
            { lat: 19.3815, lng: -70.4159, nombre: "Dispositivo La Vega" },
            { lat: 19.2257, lng: -70.5245, nombre: "Dispositivo Bonao" },
            { lat: 19.5652, lng: -70.8849, nombre: "Dispositivo Mao" },
            { lat: 19.3012, lng: -69.5513, nombre: "Dispositivo Samaná" },
            { lat: 19.1821, lng: -70.1498, nombre: "Dispositivo Cotuí" }
        ];

        // Agregar marcadores al mapa
        dispositivos.forEach(dispositivo => {
            L.marker([dispositivo.lat, dispositivo.lng])
                .bindPopup(dispositivo.nombre)
                .addTo(map);
        });

        // Gráfico de denuncias por provincia
      const provinciasChart = new Chart(
            document.getElementById('provinciasChart'),
            {
                type: 'bar',
                data: {
                    labels: ['Santo Domingo', 'Santiago', 'La Romana', 'Puerto Plata', 'San Pedro', 'Pedernales', 'Barahona', 'Elías Piña', 'Monte plata', 'Bayaguana'],
                    datasets: [{
                        label: 'Denuncias por Provincia',
                        data: [420, 280, 190, 150, 120, 90, 85, 80, 75, 30],
                        backgroundColor: [
                           'rgba(0, 74, 173, 0.9)',
                            'rgba(0, 80, 187, 0.85)',
                            'rgba(0, 86, 201, 0.8)',
                            'rgba(0, 92, 215, 0.75)',
                            'rgba(0, 98, 229, 0.7)',
                            'rgba(0, 104, 243, 0.65)',
                            'rgba(0, 110, 255, 0.6)',
                            'rgba(0, 116, 255, 0.55)',
                            'rgba(0, 122, 255, 0.5)',
                            'rgba(0, 128, 255, 0.45)'

                        ],
                        borderWidth: 0,
                        borderRadius: 8,
                        maxBarThickness: 45,
                        minBarLength: 10
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        },
                        title: {
                            display: true,
                            text: 'Denuncias por Provincia',
                            font: {
                                size: 16,
                                weight: 'bold',
                                family: "'Segoe UI', sans-serif"
                            },
                            padding: 20,
                            color: '#333'
                        },
                        tooltip: {
                            backgroundColor: 'rgba(255, 255, 255, 0.9)',
                            titleColor: '#333',
                            bodyColor: '#333',
                            bodyFont: {
                                size: 14
                            },
                            borderColor: 'rgba(78, 84, 200, 0.1)',
                            borderWidth: 1,
                            padding: 12,
                            displayColors: false,
                            callbacks: {
                                label: function(context) {
                                    return `${context.parsed.y} denuncias`;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                display: true,
                                color: 'rgba(0, 0, 0, 0.05)',
                                drawBorder: false
                            },
                            ticks: {
                                font: {
                                    size: 12
                                },
                                color: '#666',
                                padding: 10
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                font: {
                                    size: 12
                                },
                                color: '#666',
                                padding: 10
                            }
                        }
                    },
                    animation: {
                        duration: 2000,
                        easing: 'easeInOutQuart'
                    },
                    layout: {
                        padding: {
                            top: 10,
                            right: 20,
                            bottom: 10,
                            left: 20
                        }
                    },
                    maintainAspectRatio: false
                }
            }
        );
       // gráfico de tendencia de denuncias
        const denunciasChart = new Chart(
            document.getElementById('denunciasChart'),
            {
                type: 'line',
                data: {
                    labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio'],
                    datasets: [{
                        label: 'Total de Denuncias Mensuales',
                        data: [580, 320, 560, 280, 420, 150],
                        fill: true,
                        backgroundColor: 'rgba(19, 105, 227, 0.44)',
                        borderColor: '#004AAD',
                        tension: 0.4,
                        pointRadius: 6,
                        pointBackgroundColor: 'white',
                        pointBorderColor: 'rgba(78, 84, 200, 1)',
                        pointBorderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        title: {
                            display: true,
                            text: 'Tendencia de Denuncias Mensuales',
                            font: {
                                size: 16
                            }
                        },
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.1)'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            }
        );

  
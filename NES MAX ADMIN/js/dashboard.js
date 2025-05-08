

document.addEventListener('DOMContentLoaded', () => {
    // Initialize charts
    initializeCharts();
    
    // Initialize map
    initializeMap();
    
    // Fetch data
    fetchDashboardData();
});

function initializeCharts() {
    const provinciasCtx = document.getElementById('provinciasChart');
    const denunciasCtx = document.getElementById('denunciasChart');

    if (provinciasCtx) {
        provinciasChart = new Chart(provinciasCtx, {
            type: 'bar',
            data: {
                labels: [],
                datasets: [{
                    label: 'Denuncias por Provincia',
                    data: [],
                    backgroundColor: 'rgba(54, 162, 235, 0.5)'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    }

    if (denunciasCtx) {
        denunciasChart = new Chart(denunciasCtx, {
            type: 'line',
            data: {
                labels: [],
                datasets: [{
                    label: 'Denuncias Mensuales',
                    data: [],
                    borderColor: 'rgba(75, 192, 192, 1)'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    }
}

function initializeMap() {
    const mapContainer = document.getElementById('mapa');
    if (!mapContainer) return;

    map = L.map('mapa').setView([18.7357, -70.1627], 8);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    cargarDispositivos();
}

async function cargarDispositivos() {
    try {
        const response = await fetch('php/obtener_dispositivos.php');
        if (!response.ok) throw new Error('Error al obtener dispositivos');
        const dispositivos = await response.json();

        dispositivos.forEach(d => {
            if (d.latitud && d.longitud) {
                L.marker([parseFloat(d.latitud), parseFloat(d.longitud)])
                    .addTo(map)
                    .bindPopup(`
                        <div class="popup-content">
                            <h3>Dispositivo ${d.id_dispositivo}</h3>
                            <p><b>Instalador:</b> ${d.nombre_instalador || 'No especificado'}</p>
                            <p><b>Fecha:</b> ${d.fecha_instalacion || 'No especificada'}</p>
                            <p><b>Zona:</b> ${d.zona_referencia || 'No especificada'}</p>
                        </div>
                    `);
            }
        });
    } catch (error) {
        console.error('Error cargando dispositivos:', error);
    }
}

async function fetchDashboardData() {
    try {
        const response = await fetch('php/dashboard_data.php');
        if (!response.ok) throw new Error('Error en la respuesta del servidor');
        
        const data = await response.json();
        updateDashboardStats(data);
        updateCharts(data);
    } catch (error) {
        console.error('Error fetching dashboard data:', error);
    }
}

function updateDashboardStats(data) {
    // Update statistics
    document.querySelector('.stat-card:nth-child(1) .number').textContent = data.totalDevices || 0;
    document.querySelector('.stat-card:nth-child(2) .number').textContent = data.totalUsers || 0;
    document.querySelector('.stat-card:nth-child(3) .number').textContent = data.activeComplaints || 0;
    document.querySelector('.stat-card:nth-child(4) .number').textContent = data.resolvedComplaints || 0;
}

function updateCharts(data) {
    if (provinciasChart && data.provinciasData) {
        provinciasChart.data.labels = data.provinciasData.map(item => item.provincia);
        provinciasChart.data.datasets[0].data = data.provinciasData.map(item => item.count);
        provinciasChart.update();
    }

    if (denunciasChart && data.monthlyData) {
        denunciasChart.data.labels = data.monthlyData.map(item => item.month);
        denunciasChart.data.datasets[0].data = data.monthlyData.map(item => item.count);
        denunciasChart.update();
    }
}

function updateBasicStats(data) {
  // Update numbers in the dashboard
  document.querySelector(".stat-card:nth-child(1) .number").textContent =
    data.totalDevices;
  document.querySelector(".stat-card:nth-child(2) .number").textContent =
    data.totalUsers;
  document.querySelector(".stat-card:nth-child(3) .number").textContent =
    data.activeComplaints;
  document.querySelector(".stat-card:nth-child(4) .number").textContent =
    data.resolvedComplaints;

  // Update complaint types numbers if present
  const complaintTypes = data.complaintTypes || {};
  const bocinasCount = complaintTypes["Ruidos_Parlantes"] || 0;
  const vehiculosCount = complaintTypes["Vehículos"] || 0;
  const construccionesCount = complaintTypes["construccion"] || 0;
  const totalDenuncias = bocinasCount + vehiculosCount + construccionesCount;

  const statModernCards = document.querySelectorAll(
    ".stat-modern-card .number"
  );
  if (statModernCards.length >= 4) {
    statModernCards[0].textContent = bocinasCount;
    statModernCards[1].textContent = vehiculosCount;
    statModernCards[2].textContent = construccionesCount;
    statModernCards[3].textContent = totalDenuncias;
  }
}

function updateEnhancedAnalytics(data) {
  // New analytics section
  const analytics = {
    avgResponseTime: data.avgResponseTime || "N/A",
    priorityHigh: data.priorityComplaints?.high || 0,
    priorityMedium: data.priorityComplaints?.medium || 0,
    priorityLow: data.priorityComplaints?.low || 0,
    resolutionRate: calculateResolutionRate(data),
    weeklyTrend: calculateTrend(data.weeklyData),
  };

  // Update DOM elements with new analytics
  document.querySelector(".avg-response-time").textContent =
    typeof analytics.avgResponseTime === "number"
      ? `${analytics.avgResponseTime.toFixed(1)} horas`
      : analytics.avgResponseTime;

  updatePriorityChart(analytics);
  updateTrendIndicators(analytics);
}

function updateVisualizations(data) {
  // Update existing charts
  if (window.denunciasChart) {
    updateDenunciasChart(data);
  }
  if (window.provinciasChart) {
    updateProvinciasChart(data);
  }

  // Add new heatmap visualization
  if (data.heatmapData) {
    updateHeatmap(data.heatmapData);
  }
}

function calculateResolutionRate(data) {
  const resolved = data.resolvedComplaints || 0;
  const total = (data.activeComplaints || 0) + resolved;
  return total > 0 ? ((resolved / total) * 100).toFixed(1) : 0;
}

function calculateTrend(weeklyData) {
  if (!weeklyData || weeklyData.length < 2) return 0;
  const recent = weeklyData[weeklyData.length - 1];
  const previous = weeklyData[weeklyData.length - 2];
  return (((recent - previous) / previous) * 100).toFixed(1);
}



// Error handling and notifications
function showErrorNotification(message) {
  const notification = document.createElement("div");
  notification.className = "error-notification";
  notification.textContent = message;
  document.body.appendChild(notification);

  setTimeout(() => {
    notification.remove();
  }, 5000);
}

// Update charts with enhanced animations and interactivity
function updateDenunciasChart(data) {
  denunciasChart.data.labels = data.monthlyComplaintLabels.map((label) =>
    label.replace("-", "/")
  );
  denunciasChart.data.datasets[0].data = data.monthlyComplaintCounts;

  // Add trend line dataset
  if (data.trendline) {
    denunciasChart.data.datasets[1] = {
      label: "Tendencia",
      data: data.trendline,
      type: "line",
      borderColor: "rgba(255, 99, 132, 0.8)",
      borderDash: [5, 5],
      fill: false,
    };
  }

  denunciasChart.update("active");
}



// Gráfico de denuncias por provincia
const provinciasChart = new Chart(document.getElementById("provinciasChart"), {
  type: "bar",
  data: {
    labels: [
      "Santo Domingo",
      "Santiago",
      "La Romana",
      "Puerto Plata",
      "San Pedro",
      "Pedernales",
      "Barahona",
      "Elías Piña",
      "Monte plata",
      "Bayaguana",
    ],
    datasets: [
      {
        label: "Denuncias por Provincia",
        data: [420, 280, 190, 150, 120, 90, 85, 80, 75, 30],
        backgroundColor: [
          "rgba(0, 74, 173, 0.9)",
          "rgba(0, 80, 187, 0.85)",
          "rgba(0, 86, 201, 0.8)",
          "rgba(0, 92, 215, 0.75)",
          "rgba(0, 98, 229, 0.7)",
          "rgba(0, 104, 243, 0.65)",
          "rgba(0, 110, 255, 0.6)",
          "rgba(0, 116, 255, 0.55)",
          "rgba(0, 122, 255, 0.5)",
          "rgba(0, 128, 255, 0.45)",
        ],
        borderWidth: 0,
        borderRadius: 8,
        maxBarThickness: 45,
        minBarLength: 10,
      },
    ],
  },
  options: {
    responsive: true,
    plugins: {
      legend: {
        display: false,
      },
      title: {
        display: true,
        text: "Denuncias por Provincia",
        font: {
          size: 16,
          weight: "bold",
          family: "'Segoe UI', sans-serif",
        },
        padding: 20,
        color: "#333",
      },
      tooltip: {
        backgroundColor: "rgba(255, 255, 255, 0.9)",
        titleColor: "#333",
        bodyColor: "#333",
        bodyFont: {
          size: 14,
        },
        borderColor: "rgba(78, 84, 200, 0.1)",
        borderWidth: 1,
        padding: 12,
        displayColors: false,
        callbacks: {
          label: function (context) {
            return `${context.parsed.y} denuncias`;
          },
        },
      },
    },
    scales: {
      y: {
        beginAtZero: true,
        grid: {
          display: true,
          color: "rgba(0, 0, 0, 0.05)",
          drawBorder: false,
        },
        ticks: {
          font: {
            size: 12,
          },
          color: "#666",
          padding: 10,
        },
      },
      x: {
        grid: {
          display: false,
        },
        ticks: {
          font: {
            size: 12,
          },
          color: "#666",
          padding: 10,
        },
      },
    },
    animation: {
      duration: 2000,
      easing: "easeInOutQuart",
    },
    layout: {
      padding: {
        top: 10,
        right: 20,
        bottom: 10,
        left: 20,
      },
    },
    maintainAspectRatio: false,
  },
});

// gráfico de tendencia de denuncias
const denunciasChart = new Chart(document.getElementById("denunciasChart"), {
  type: "line",
  data: {
    labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio"],
    datasets: [
      {
        label: "Total de Denuncias Mensuales",
        data: [580, 320, 560, 280, 420, 150],
        fill: true,
        backgroundColor: "rgba(19, 105, 227, 0.44)",
        borderColor: "#004AAD",
        tension: 0.4,
        pointRadius: 6,
        pointBackgroundColor: "white",
        pointBorderColor: "rgba(78, 84, 200, 1)",
        pointBorderWidth: 2,
      },
    ],
  },
  options: {
    responsive: true,
    plugins: {
      title: {
        display: true,
        text: "Tendencia de Denuncias Mensuales",
        font: {
          size: 16,
        },
      },
      legend: {
        display: false,
      },
    },
    scales: {
      y: {
        beginAtZero: true,
        grid: {
          color: "rgba(0, 0, 0, 0.1)",
        },
      },
      x: {
        grid: {
          display: false,
        },
      },
    },
  },
});

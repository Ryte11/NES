document.addEventListener("DOMContentLoaded", () => {
  // Initialize charts
  initializeCharts();

  // Initialize map (only in JS, not in HTML)
  initializeMap();

  // Fetch data
  fetchDashboardData();
});

let provinciasChart = null;
let denunciasChart = null;
let map = null; // Declare map only once here

function initializeCharts() {
  const provinciasCtx = document.getElementById("provinciasChart");
  const denunciasCtx = document.getElementById("denunciasChart");

  if (provinciasChart) {
    provinciasChart.destroy();
    provinciasChart = null;
  }
  if (denunciasChart) {
    denunciasChart.destroy();
    denunciasChart = null;
  }

  if (provinciasCtx) {
    provinciasChart = new Chart(provinciasCtx, {
      type: "bar",
      data: {
        labels: [],
        datasets: [
          {
            label: "Denuncias por Provincia",
            data: [],
            backgroundColor: "rgba(54, 162, 235, 0.5)",
            borderColor: "rgba(54, 162, 235, 1)",
            borderWidth: 1,
          },
        ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
          y: {
            beginAtZero: true,
            ticks: {
              stepSize: 1,
            },
          },
        },
      },
    });
  }

  if (denunciasCtx) {
    denunciasChart = new Chart(denunciasCtx, {
      type: "line",
      data: {
        labels: [],
        datasets: [
          {
            label: "Denuncias Mensuales",
            data: [],
            borderColor: "rgba(75, 192, 192, 1)",
            backgroundColor: "rgba(75, 192, 192, 0.2)",
            fill: true,
            tension: 0.4,
            pointRadius: 5,
            pointHoverRadius: 7,
          },
        ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
          y: {
            beginAtZero: true,
            ticks: {
              stepSize: 1,
            },
          },
        },
      },
    });
  }
}

function initializeMap() {
  const mapContainer = document.getElementById("mapa");
  if (!mapContainer) return;

  if (map !== null) {
    map.remove();
    map = null;
  }

  map = L.map("mapa").setView([18.7357, -70.1627], 8);
  L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
    attribution: "© OpenStreetMap contributors",
  }).addTo(map);

  cargarDispositivos();
}

async function cargarDispositivos() {
  try {
    const response = await fetch("php/obtener_dispositivos.php");
    if (!response.ok) throw new Error("Error al obtener dispositivos");
    const dispositivos = await response.json();

    dispositivos.forEach((d) => {
      if (d.latitud && d.longitud) {
        L.marker([parseFloat(d.latitud), parseFloat(d.longitud)]).addTo(map)
          .bindPopup(`
                        <div class="popup-content">
                            <h3>Dispositivo ${d.id_dispositivo}</h3>
                            <p><b>Instalador:</b> ${
                              d.nombre_instalador || "No especificado"
                            }</p>
                            <p><b>Fecha:</b> ${
                              d.fecha_instalacion || "No especificada"
                            }</p>
                            <p><b>Zona:</b> ${
                              d.zona_referencia || "No especificada"
                            }</p>
                        </div>
                    `);
      }
    });
  } catch (error) {
    console.error("Error cargando dispositivos:", error);
  }
}

async function fetchDashboardData() {
  try {
    const response = await fetch("php/dashboard_data.php");
    if (!response.ok) throw new Error("Error en la respuesta del servidor");

    const data = await response.json();
    console.log("Datos recibidos del backend:", data);

    // Update basic stats and charts
    updateDashboardStats(data);
    updateCharts(data);

    // Also update the specialized stats if they exist
    updateBasicStats(data);
  } catch (error) {
    console.error("Error fetching dashboard data:", error);
  }
}

function updateDashboardStats(data) {
  // Update statistics
  const statCards = document.querySelectorAll(".stat-card .number");
  if (statCards.length >= 4) {
    statCards[0].textContent = data.totalDevices || 0;
    statCards[1].textContent = data.totalUsers || 0;
    statCards[2].textContent = data.activeComplaints || 0;
    statCards[3].textContent = data.resolvedComplaints || 0;
  }
}

function updateCharts(data) {
  if (
    provinciasChart &&
    data.provinciasData &&
    data.provinciasData.length > 0
  ) {
    provinciasChart.data.labels = data.provinciasData.map(
      (item) => item.provincia
    );
    provinciasChart.data.datasets[0].data = data.provinciasData.map(
      (item) => item.count
    );
    provinciasChart.update();
  }

  if (denunciasChart && data.monthlyData && data.monthlyData.length > 0) {
    denunciasChart.data.labels = data.monthlyData.map((item) => item.month);
    denunciasChart.data.datasets[0].data = data.monthlyData.map(
      (item) => item.count
    );
    denunciasChart.update();
  }
}

function updateBasicStats(data) {
  // Update specific complaint types if they exist
  const statModernCards = document.querySelectorAll(
    ".stat-modern-card .number"
  );
  if (statModernCards.length >= 4) {
    statModernCards[0].textContent = data.denuncias_bocinas || 0;
    statModernCards[1].textContent = data.denuncias_vehiculos || 0;
    statModernCards[2].textContent = data.denuncias_construcciones || 0;
    statModernCards[3].textContent = data.totalComplaints || 0;
  }
}

// Optional enhanced functions - can be used if needed but won't cause errors if not used
function updateEnhancedAnalytics(data) {
  if (!data) return;

  // New analytics section - only execute if these elements exist
  const avgResponseTimeEl = document.querySelector(".avg-response-time");
  if (avgResponseTimeEl && data.avgResponseTime) {
    avgResponseTimeEl.textContent =
      typeof data.avgResponseTime === "number"
        ? `${data.avgResponseTime.toFixed(1)} horas`
        : data.avgResponseTime;
  }

  if (data.priorityComplaints) {
    updatePriorityChart(data);
  }

  if (data.weeklyData) {
    updateTrendIndicators(data);
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

// These functions are defined but only called if needed
function updatePriorityChart(data) {
  // Only execute if this function is called with proper data
  if (!data.priorityComplaints) return;

  // Implementation would go here if needed
  console.log("Priority data available for chart:", data.priorityComplaints);
}

function updateTrendIndicators(data) {
  // Only execute if this function is called with proper data
  if (!data.weeklyData) return;

  // Implementation would go here if needed
  console.log("Weekly trend data available:", data.weeklyData);
}

function updateDenunciasChart(data) {
  if (!denunciasChart || !data.monthlyComplaintLabels) return;

  denunciasChart.data.labels = data.monthlyComplaintLabels.map((label) =>
    label.replace("-", "/")
  );
  denunciasChart.data.datasets[0].data = data.monthlyComplaintCounts;

  // Add trend line dataset if available
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

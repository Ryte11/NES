class ChatUI {
  constructor() {
    this.chatBody = document.querySelector(".chat-body");
    this.form = document.getElementById("form");
    this.input = document.getElementById("input");
    this.loadingDots = null;
    this.setupEventListeners();
    this.showWelcomeMessage();
  }

  setupEventListeners() {
    this.form.addEventListener("submit", (e) => {
      e.preventDefault();
      this.handleSubmit();
    });
  }

  showWelcomeMessage() {
    const welcomeMessage =
      "¡Hola! Soy el asistente de NES, especializado en temas de ruido ambiental. ¿En qué puedo ayudarte hoy?";
    this.addMessageToChat("AI", welcomeMessage);
  }

  showLoadingIndicator() {
    this.loadingDots = document.createElement("div");
    this.loadingDots.className = "loading-indicator";
    this.loadingDots.innerHTML = "<span>.</span><span>.</span><span>.</span>";
    this.chatBody.appendChild(this.loadingDots);
    this.chatBody.scrollTop = this.chatBody.scrollHeight;
  }

  hideLoadingIndicator() {
    if (this.loadingDots) {
      this.loadingDots.remove();
      this.loadingDots = null;
    }
  }

  handleSubmit() {
    const message = this.input.value.trim();
    if (message) {
      this.addMessageToChat("Usuario", message);
      this.sendMessageToServer(message);
      this.input.value = "";
    }
  }

  addMessageToChat(sender, message) {
    const messageDiv = document.createElement("div");
    messageDiv.className = `mensaje ${sender.toLowerCase()}`;

    messageDiv.innerHTML = `
            <div class="mensaje-header">
                <strong>${sender}</strong>
                <span class="mensaje-time">${new Date().toLocaleTimeString()}</span>
            </div>
            <div class="mensaje-contenido">${message}</div>
        `;

    this.chatBody.appendChild(messageDiv);
    this.scrollToBottom();
  }

  scrollToBottom() {
    this.chatBody.scrollTo({
      top: this.chatBody.scrollHeight,
      behavior: "smooth",
    });
  }

  async sendMessageToServer(message) {
    try {
      this.showLoadingIndicator();

      const response = await fetch("php/chat_response.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({ message }),
      });

      const data = await response.json();

      this.hideLoadingIndicator();

      if (data && data.response) {
        this.addMessageToChat("AI", data.response);
      } else if (data && data.error) {
        console.error("Error del servidor:", data.error);
        this.addMessageToChat(
          "AI",
          "Lo siento, ha ocurrido un error. Por favor, intenta de nuevo más tarde."
        );
      }
    } catch (error) {
      console.error("Error en la comunicación:", error);
      this.hideLoadingIndicator();
      this.addMessageToChat(
        "AI",
        "Lo siento, ha ocurrido un error de conexión. Por favor, verifica tu conexión a internet e intenta de nuevo."
      );
    }
  }
}

// Inicializar el chat cuando el DOM esté cargado
document.addEventListener("DOMContentLoaded", () => {
  new ChatUI();
});

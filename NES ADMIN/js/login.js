document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("loginForm").addEventListener("submit", function (event) {
        let userId = document.getElementById("userId").value.trim();
        let password = document.getElementById("password").value.trim();
        let userIdError = document.getElementById("userIdError");
        let passwordError = document.getElementById("passwordError");

        userIdError.textContent = "";
        passwordError.textContent = "";

        let isValid = true;

        if (userId === "") {
            userIdError.textContent = "El ID de usuario no puede estar vacío.";
            isValid = false;
        } else if (userId !== "admin") {
            userIdError.textContent = "El ID no existe'.";
            isValid = false;
        }

        if (password === "") {
            passwordError.textContent = "La contraseña no puede estar vacía.";
            isValid = false;
        } else if (password !== "admin123") {
            passwordError.textContent = "La contraseña no existe.";
            isValid = false;
        }

        if (!isValid) {
            event.preventDefault(); 
        }
    });
});

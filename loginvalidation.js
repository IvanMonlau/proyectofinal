// Obtener una referencia al botón de inicio de sesión
const loginButton = document.getElementById("login-button");

// Agregar un evento de clic al botón
loginButton.addEventListener("click", handleLoginClick);

function handleLoginClick(event) {
  event.preventDefault(); // Evita el envío del formulario por defecto

  // Obtener los valores de los campos de entrada
  const email = document.getElementById("email").value;
  const password = document.getElementById("password").value;

  // Validación básica
  if (!email || !password) {
    alert("Por favor, ingresa tu correo electrónico y contraseña.");
    return;
  }

  // Hacer una solicitud fetch
  fetch("../database/API/employeevalidation.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: new URLSearchParams({
      email: email,
      password: password,
    }),
  })
  .then(response => {
    if (!response.ok) {
      throw new Error('La solicitud falló: ' + response.statusText);
    }
    return response.text();
  })
  .then(data => {
    // Parsear la respuesta XML
    const parser = new DOMParser();
    const xmlDoc = parser.parseFromString(data, "text/xml");
    const estado = xmlDoc.querySelector("estado").textContent;

    // Verificar el estado de la respuesta
    if (estado === "ok") {
      window.location.href = "home.html";
    } else {
      alert("Correo electrónico o contraseña inválidos.");
    }
  })
  .catch(error => {
    console.error("Error durante el inicio de sesión:", error);
    alert("Ocurrió un error durante el inicio de sesión. Por favor, intenta de nuevo.");
  });
}
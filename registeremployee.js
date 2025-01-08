// Obtener una referencia al botón de inicio de sesión
const registerButton = document.getElementById("register-button");

// Agregar un evento de clic al botón
registerButton.addEventListener("click", handleRegisterClick);

// Función para crear un nuevo empleado
async function handleRegisterClick() {
  // Datos del nuevo empleado (reemplázalos con tus valores)
  const employeeData = {
    email: email,
    password: password,
    first_name: first_name,
    last_name: last_name,
    role: role
  };

  // Convertir los datos a formato JSON
  const data = JSON.stringify(employeeData);

  // Opciones de la solicitud fetch
  const options = {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: data
  };

  try {
    const response = await fetch('../database/API/employeecreation.php', options);
    if (!response.ok) {
      throw new Error('La solicitud no fue exitosa');
    }
    const responseData = await response.json();
    console.log('Respuesta del servidor:', responseData);
    // Mostrar un mensaje al usuario o realizar alguna otra acción basado en la respuesta
    alert(responseData.message);
  } catch (error) {
    console.error('Error:', error);
    alert('Ocurrió un error al crear el empleado. Por favor, inténtalo de nuevo.');
  }
}
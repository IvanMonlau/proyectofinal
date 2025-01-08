<?php
$servername = "localhost"; // nombre del servidor
$username = "ivan"; // nombre de usuario de la base de datos
$password = ""; // contraseña de la base de datos
$dbname = "project_db"; // nombre de la base de datos

$conn = new mysqli($servername, $username, $password, $dbname);

// Comprobar la conexión
if ($conn->connect_error) {
    die("La conexión ha fallado: " . $conn->connect_error);
}

// Obtener los datos del formulario
$email = $_POST["email"];
$password = $_POST["password"];

// Consulta SQL para comprobar si el usuario y la contraseña son válidos
$sql = "SELECT * FROM employees WHERE email='$email' AND password='$password'";
$resultado = $conn->query($sql);

// Crear el documento XML de respuesta
header('Content-Type: text/xml');
$xml = new SimpleXMLElement('<respuesta/>');

// Comprobar si la consulta devuelve algún resultado
if ($resultado->num_rows > 0) {
    // Usuario y contraseña válidos
    $xml->addChild('estado', 'ok');
} else {
    // Usuario o contraseña incorrectos
    $xml->addChild('estado', 'ko');
}

// Imprimir el documento XML de respuesta
echo $xml->asXML();

// Cerrar la conexión a la base de datos
$conn->close();
?>

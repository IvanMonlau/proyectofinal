<?php
$host = "localhost";
$username = "ivan"; 
$password = ""; 
$dbname = "project_db"; 

// Conexión a la base de datos
$conn = new mysqli($host, $username, $password, $dbname);

// Verifica la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Preparar la consulta SQL para insertar un nuevo usuario
$sql = "INSERT INTO users (email, password, first_name, last_name, address, created_at) VALUES (?, ?, ?, ?, ?, NOW())";

// Preparar la sentencia
$stmt = $conn->prepare($sql);

// Vincular parámetros
$stmt->bind_param("sssss", $email, $password, $first_name, $last_name, $address);


$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hashea la contraseña
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$address = $_POST['address'];

// Ejecutar la sentencia
$stmt->execute();

header('Content-Type: text/xml');
$xml = new SimpleXMLElement('<respuesta/>');

// Verificar si la inserción fue exitosa
if ($stmt->affected_rows > 0) {
    $xml->addChild('estado', 'ok');
    echo "Usuario creado exitosamente.";
} else {
    $xml->addChild('estado', 'ko');
    echo "Error al crear el usuario.";
}

echo $xml->asXML();

$stmt->close();
$conn->close();
?>
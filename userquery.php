<?php
$host = "localhost";
$username = "ivan"; // Usuario predeterminado de XAMPP
$password = "";     // Contraseña predeterminada de XAMPP (vacia)
$dbname = "project_db"; // Cambia este nombre por el nombre de tu base de datos

// Conexión a la base de datos
$conn = new mysqli($host, $username, $password, $dbname);

// Verifica la conexión
if ($conn->connect_error) {
    die("Conection failed: " . $conn->connect_error);
}

// Consulta para obtener todos los empleados
$sql = "SELECT id, email, password, first_name, last_name, address, created_at FROM users";
$result = $conn->query($sql);

header("Content-type: text/xml");
echo '<?xml version="1.0" encoding="UTF-8"?>';
echo '<users>';

// Verifica si hay resultados y los muestra
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo '<user>';
        echo '<id>' . $row["id"] . '</id>';
        echo '<email>' . $row["email"] . '</email>';
        echo '<password>' . $row["password"] . '</password>';
        echo '<first_name>' . $row["first_name"] . '</first_name>';
        echo '<last_name>' . $row["last_name"] . '</last_name>';
        echo '<address>' . $row["address"] . '</address>';
        echo '<created_at>' . $row["created_at"] . '</created_at>';
        echo '</user>';
    }
} else {
    echo "0 results";
}

echo '</users>';

$conn->close();
?>
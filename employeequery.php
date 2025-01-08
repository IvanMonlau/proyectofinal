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
$sql = "SELECT email, password, role, created_at FROM employees";
$result = $conn->query($sql);

header("Content-type: text/xml");
echo '<?xml version="1.0" encoding="UTF-8"?>';
echo '<employees>';

// Verifica si hay resultados y los muestra
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo '<employee>';
        echo '<email>' . $row["email"] . '</email>';
        echo '<password>' . $row["password"] . '</password>';
        echo '<role>' . $row["role"] . '</role>';
        echo '<created_at>' . $row["created_at"] . '</created_at>';
        echo '</employee>';
    }
} else {
    echo "0 results";
}

echo '</employees>';

$conn->close();
?>
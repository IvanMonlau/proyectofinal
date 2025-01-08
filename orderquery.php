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
$sql = "SELECT id, user_id, status, total_amount, created_at FROM orders";
$result = $conn->query($sql);

header("Content-type: text/xml");
echo '<?xml version="1.0" encoding="UTF-8"?>';
echo '<orders>';

// Verifica si hay resultados y los muestra
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo '<order>';
        echo '<id>' . $row["id"] . '</id>';
        echo '<user_id>' . $row["user_id"] . '</user_id>';
        echo '<status>' . $row["status"] . '</status>';
        echo '<total_amount>' . $row["total_amount"] . '€</total_amount>';
        echo '<created_at>' . $row["created_at"] . '</created_at>';
        echo '</order>';
    }
} else {
    echo "0 results";
}

echo '</orders>';

$conn->close();
?>
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
$sql = "SELECT id, product_id, reason, status, created_at FROM returns";
$result = $conn->query($sql);

header("Content-type: text/xml");
echo '<?xml version="1.0" encoding="UTF-8"?>';
echo '<returns>';

// Verifica si hay resultados y los muestra
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo '<return>';
        echo '<id>' . $row["id"] . '</id>';
        echo '<order_id>' . $row["order_id"] . '</order_id>';
        echo '<reason>' . $row["reason"] . '</reason>';
        echo '<status>' . $row["status"] . '</status>';
        echo '<created_at>' . $row["created_at"] . '</created_at>';
        echo '</return>';
    }
} else {
    echo "0 results";
}

echo '</returns>';

$conn->close();
?>
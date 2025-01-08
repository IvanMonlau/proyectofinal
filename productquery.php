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
$sql = "SELECT id, name, description, brand, price, category, stock, image_url, created_at FROM products";
$result = $conn->query($sql);

header("Content-type: text/xml");
echo '<?xml version="1.0" encoding="UTF-8"?>';
echo '<products>';

// Verifica si hay resultados y los muestra
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo '<product>';
        echo '<id>' . $row["id"] . '</id>';
        echo '<name>' . $row["name"] . '</name>';
        echo '<description>' . $row["description"] . '</description>';
        echo '<brand>' . $row["brand"] . '</brand>';
        echo '<price>' . $row["price"] . '</price>';
        echo '<category>' . $row["category"] . '</category>';
        echo '<stock>' . $row["stock"] . '</stock>';
        echo '<image>' . $row["image_url"] . '</image>';
        echo '<created_at>' . $row["created_at"] . '</created_at>';
        echo '</product>';
    }
} else {
    echo "0 results";
}

echo '</products>';

$conn->close();
?>
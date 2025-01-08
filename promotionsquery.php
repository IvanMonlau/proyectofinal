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
$sql = "SELECT id, product_id, discount, start_date, end_date FROM promotions";
$result = $conn->query($sql);

header("Content-type: text/xml");
echo '<?xml version="1.0" encoding="UTF-8"?>';
echo '<promotions>';

// Verifica si hay resultados y los muestra
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo '<promotion>';
        echo '<id>' . $row["id"] . '</id>';
        echo '<product_id>' . $row["product_id"] . '</product_id>';
        echo '<discount>' . $row["discount"] . '%</discount>';
        echo '<start_date>' . $row["start_date"] . '</start_date>';
        echo '<end_date>' . $row["end_date"] . '</end_date>';
        echo '</promotion>';
    }
} else {
    echo "0 results";
}

echo '</promotions>';

$conn->close();
?>
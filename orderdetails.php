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
$sql = "SELECT `order_details`.*, `orders`.`user_id` AS `user_id` FROM `order_details` LEFT JOIN `orders` ON `order_details`.`order_id` = `orders`.`id`";
$result = $conn->query($sql);

header("Content-type: text/xml");
echo '<?xml version="1.0" encoding="UTF-8"?>';
echo '<orders_details>';

// Verifica si hay resultados y los muestra
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo '<order_detail>';
        echo '<id>' . $row["id"] . '</id>';
        echo '<user_id>' . $row["user_id"] . '</user_id>';
        echo '<order_id>' . $row["order_id"] . '</order_id>';
        echo '<product_id>' . $row["product_id"] . '</product_id>';
        echo '<quantity>' . $row["quantity"] . '</quantity>';
        echo '<price>' . $row["price"] . '</price>';
        echo '<coupons>' . $row["coupons"] . '</coupons>';
        echo '</order_detail>';
    }
} else {
    echo "0 results";
}

echo '</orders_details>';

$conn->close();
?>
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
    $sql = "INSERT INTO employees (email, password, first_name, last_name, role, created_at) VALUES (?, ?, ?, ?, ?, NOW())";

    // Preparar la sentencia
    $stmt = $conn->prepare($sql);

    // Vincular parámetros
    $stmt->bind_param("sssss", $email, $password, $first_name, $last_name, $role);


    $email = $_POST['email'];
    $password = $_POST['password'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $role = $_POST['role'];

    echo $email;
    // Ejecutar la sentencia
    $stmt->execute();

    // Verificar si la inserción fue exitosa
    if ($stmt->affected_rows > 0) {
        $response = [
            'status' => 'success',
            'message' => 'Usuario creado exitosamente.'
        ];
    } else {
        $response = [
            'status' => 'error',
            'message' => 'Error al crear el usuario.'
        ];
    }
    
    // Enviar la respuesta en formato JSON
    header('Content-Type: application/json');
    echo json_encode($response);

    $stmt->close();
    $conn->close();

    header("Location: ../../desktop/login.html")
    ?>
<?php

// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "jaza11Alex";
$dbname = "test";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Validación de datos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Filtrado de datos
    $username = filter_var($username, FILTER_SANITIZE_STRING);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    
    if (empty($username) || empty($email) || empty($password)) {
        die("Por favor, completa todos los campos.");
    }

    // Hasheo de la contraseña
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    // Inserción de datos en la base de datos
    $sql = "INSERT INTO usuarios (username, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);

    try {
        $stmt->execute([$username, $email, $passwordHash]);
        // Redirección a la página principal después de la inserción exitosa
        header("Location: login.php");
    } catch (PDOException $e) {
        die("Error al insertar datos: " . $e->getMessage());
    }
}
// Cerrar la conexión
$conn = null;
?>
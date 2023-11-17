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

function iniciarSesion($conn, $username, $password) {
    $sql = "SELECT * FROM usuarios WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $username);
    $stmt->execute();

    $user = $stmt->fetch();

    if (!empty($user)) {
        if (password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['id_usuario'] = $user['id_usuario'];
            return true;
        }
    }

    return false;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    if (iniciarSesion($conn, $username, $password)) {
        header("Location: sesion.html");
    } else {
        echo "Usuario o contraseña incorrectos.";
    }
}

$conn = null;
?>
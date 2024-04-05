<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["password"])) {
    
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $conexion = mysqli_connect("localhost", "root", "", "myweb");
    $query = "INSERT INTO usuarios (username, email, password) VALUES ('$username', '$email', '$password')";
    $result = mysqli_query($conexion, $query);

    header("Location: registro_exitoso.php");
    exit;
}
?>

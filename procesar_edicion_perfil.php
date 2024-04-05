<?php

session_start();

if (!isset($_SESSION['user_id'])) {

    header("Location: inicio_sesion.html");
    exit;
}
$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit_username"]) && isset($_POST["edit_email"])) {

    $username = $_POST["edit_username"];
    $email = $_POST["edit_email"];
    $password = isset($_POST["edit_password"]) ? $_POST["edit_password"] : null;


    $conexion = mysqli_connect("localhost", "root", "", "myweb");

  
    if (!$conexion) {
        die("La conexión a la base de datos falló: " . mysqli_connect_error());
    }

   
    $query = "UPDATE usuarios SET username='$username', email='$email' WHERE id='$user_id'";
    

    if (mysqli_query($conexion, $query)) {
      
        echo "El usuario ha sido editado correctamente.";
    } else {
      
        echo "Error al editar el usuario: " . mysqli_error($conexion);
    }

    
    mysqli_close($conexion);
}
?>

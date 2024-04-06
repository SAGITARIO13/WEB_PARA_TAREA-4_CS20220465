<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["titulo"]) && isset($_POST["contenido"])) {
    
    
    if (!isset($_SESSION['user_id'])) {
        echo "Error: El usuario no ha iniciado sesión.";
        exit;
    }

    $user_id = $_SESSION['user_id'];
    $title = $_POST["titulo"];
    $content = $_POST["contenido"];

 
    $conexion = mysqli_connect("localhost", "root", "", "myweb");

    
    $query = "SELECT id FROM usuarios WHERE id = '$user_id'";
    $result = mysqli_query($conexion, $query);
    if (!$result || mysqli_num_rows($result) == 0) {
        echo "Error: El usuario no existe.";
        exit;
    }

  
    $query = "INSERT INTO publicaciones (user_id, titulo, contenido) VALUES ('$user_id', '$title', '$content')";
    $result = mysqli_query($conexion, $query);

    if ($result) {
        header("Location: registro_exitoso.php");
        exit;
    } else {
        echo "Error al procesar la creación de la publicación.";
    }
}
?>

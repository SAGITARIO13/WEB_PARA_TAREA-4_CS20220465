<?php
$user_id = $_SESSION['user_id'];
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["title"]) && isset($_POST["content"])) {
 
    $title = $_POST["title"];
    $content = $_POST["content"];

    $conexion = mysqli_connect("localhost", "root", "", "myweb");
    $query = "INSERT INTO publicaciones (title, content) VALUES ('$title', '$content')";
    $result = mysqli_query($conexion, $query);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publicación Exitosa</title>
</head>
<body>
    <h1>¡Publicación Exitosa!</h1>
    <p>Tu publicación ha sido agregada correctamente.</p>
    <a href="home.php"><button>Volver a la página principal</button></a>
</body>
</html>

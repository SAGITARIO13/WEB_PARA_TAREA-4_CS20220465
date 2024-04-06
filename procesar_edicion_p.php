<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"]) && isset($_POST["titulo"]) && isset($_POST["contenido"])) {
    $id = $_POST["id"];
    $title = $_POST["titulo"];
    $content = $_POST["contenido"];

    $conexion = mysqli_connect("localhost", "root", "", "myweb");
    
    $query = "UPDATE publicaciones SET titulo='$title', contenido='$content' WHERE id=$id";
    $result = mysqli_query($conexion, $query);

    if ($result) {
        header("Location: home.php");
        exit;
    } else {
        echo "Error al procesar la edición de la publicación.";
    }
}

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $conexion = mysqli_connect("localhost", "root", "", "myweb");
    $query = "SELECT * FROM publicaciones WHERE id=$id";
    $result = mysqli_query($conexion, $query);
    $row = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Publicación</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <a href="crear_publicacion.html">Crear Publicación</a>
        <a href="home.php">Buscar Publicaciones</a>
    </nav>
    <h1>Editar Publicación</h1>
    <form action="" method="post">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo" value="<?php echo $row['titulo']; ?>"><br>
        <label for="contenido">Contenido:</label>
        <textarea id="contenido" name="contenido"><?php echo $row['contenido']; ?></textarea><br>
        <input type="submit" value="Guardar Cambios">
    </form>
</body>
</html>

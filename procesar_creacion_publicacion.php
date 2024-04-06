<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["titulo"]) && isset($_POST["contenido"])) {
    
    
    $title = $_POST["titulo"];
    $content = $_POST["contenido"];

    $conexion = mysqli_connect("localhost", "root", "", "myweb");
    
    $query = "INSERT INTO publicaciones (titulo, contenido) VALUES ('$title', '$content')";
    $result = mysqli_query($conexion, $query);

    if ($result) {
        
        header("Location: home.php");
        exit;
    } else {
      
        echo "Error al procesar la creación de la publicación.";
    }
}


$conexion = mysqli_connect("localhost", "root", "", "myweb");
$query = "SELECT * FROM publicaciones";
$result = mysqli_query($conexion, $query);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <a href="crear_publicacion.html">Crear Publicación</a>
        <a href="home.php">Buscar Publicaciones</a>
    </nav>
    <h1>Publicaciones</h1>
    <form action="" method="get">
        <label for="search">Buscar:</label>
        <input type="text" id="search" name="search">
        <input type="submit" value="Buscar">
    </form>

    <table>
        <thead>
            <tr>
                <th>Título</th>
                <th>Contenido</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['titulo'] . "</td>";
                echo "<td>" . $row['contenido'] . "</td>";
                echo "</tr>";
            }
            mysqli_close($conexion);
            ?>
        </tbody>
    </table>
</body>
</html>

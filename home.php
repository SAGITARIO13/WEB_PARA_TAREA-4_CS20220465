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
            
            $conexion = mysqli_connect("localhost", "root", "", "myweb");

        
            $search_term = isset($_GET["search"]) ? $_GET["search"] : '';

            $query = "SELECT * FROM publicaciones";
            if (!empty($search_term)) {
                $query .= " WHERE title LIKE '%$search_term%' OR content LIKE '%$search_term%'";
            }

            
            $result = mysqli_query($conexion, $query);

            
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

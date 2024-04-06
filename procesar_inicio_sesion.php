<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login_email"]) && isset($_POST["login_password"])) {
    $email = $_POST["login_email"];
    $password = $_POST["login_password"];

    $conexion = mysqli_connect("localhost", "root", "", "myweb");
    $query = "SELECT * FROM usuarios WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conexion, $query);

 if ($result && mysqli_num_rows($result) > 0) {
 
    $_SESSION["loggedin"] = true;
    $_SESSION["username"] = $username;
    header("Location: crear_publicacion.html");
    exit;
    } 
    else {
    $error_message = "Credenciales incorrectas. Por favor, inténtalo de nuevo.";
    }
 
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Procesar Inicio de Sesión</title>
</head>
<body>
    <?php if (isset($error_message)) : ?>
        <div>
            <p><?php echo $error_message; ?></p>
        </div>
    <?php endif; ?>
</body>
</html>

<?php
session_start();/*
if (isset($_SESSION['error'])) {
    echo "<script> alert('" . $_SESSION['error'] . "') </script>";
    unset($_SESSION['error']);
}*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Registro Usuario</title>
</head>
<body>
    <nav>
        <ul>
            <li><a href="#">Inicio</a></li>
            <li><a href="#">Control de Stock</a></li>
            <li><a href="#"><img src="WhatsApp Image 2024-08-25 at 21.42.38.jpeg" alt="Logo" class="logo"></a></li>
            <li><a href="#">Estadística</a></li>
            <li><a href="#">Cerrar Sesión</a></li>
        </ul>
    </nav>
    <br>
    <div class="login-container">
        <h1>Ingreso!</h1>
        <form action="pagina.php" method="POST">
            <label for="username">Usuario</label>
            <input type="text" id="username" name="username" laceholder="Enter your username" required>
            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>
            <button type="submit" name="login">Login</button>
        </form>
    </div>

    <footer>
        <p>© 2024 Medical Stats. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
<?php
if (isset($_SESSION['error'])) {
    echo "<script> alert('" . $_SESSION['error'] . "') </script>";
    unset($_SESSION['error']);
}
?>


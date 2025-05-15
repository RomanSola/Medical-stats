<?php
session_start();
$conexion = mysqli_connect("localhost", "root", "", "medical_stats") or
    die("Problemas con la conexión");


if (isset($_POST['username']) && isset($_POST['password'])) {

    $user = $_POST['username'];
    $pass = $_POST['password'];

    if (empty($user) || empty($pass)) {
        $_SESSION['error'] = "Usuario o contraseña no pueden estar vacíos.";
        header("Location: login.php");
        exit();
    } else {

        $registros = mysqli_query($conexion, "select * from usuarios where usuario = '$user'") or
            die("Error de conexion" . mysqli_error($conexion));

        if ($reg = mysqli_fetch_array($registros)) {
            if ($pass == $reg['contrasena']) {
                $_SESSION['usuario'] = $user;
                //header('Location: pagina.php');
            } else {
                $_SESSION['error'] = "Usuario o contraseña incorrecto";
                header("Location: login.php");
                exit();
            }
        } else {
            $_SESSION['error'] = "Usuario no encontrado.";
            header("Location: login.php");
            exit();
        }
    }
}
$registros = mysqli_query($conexion, "select * from pacientes  order by id DESC LIMIT 5;") or
    die("Problemas en el select:" . mysqli_error($conexion));
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Stats</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <nav>
        <ul>
            <li><a href="pagina.php">Inicio</a></li>
            <li><a href="control.php">Control de Stock</a></li>
            <li> <img src="WhatsApp Image 2024-08-25 at 21.42.38.jpeg" alt="Logo" class="logo"></li>
            <li><a href="estadistica.php">Estadística</a></li>
            <li><a href="salir.php">Cerrar Sesión</a></li>
        </ul>
    </nav>
    <main>
        <h1>Registro de Pacientes</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Numero quirofano</th>
                    <th>Apellido y Nombre</th>
                    <th>Cirujia</th>
                    <th>Cirujano</th>
                    <th>1° Ayudante</th>
                    <th>2° Ayudante</th>
                    <th>Instrumentador</th>
                    <th>Anestecista</th>
                    <th>Tipo anestesia</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <form action="formulario.php" method="POST">
                    <?php
                    while ($reg = mysqli_fetch_array($registros)) {
                        $botton_name = "name_" . $reg['id'];
                        echo "<tr>";
                        echo "<td>" . $reg['id'] . "</td>";
                        echo "<td>" . $reg['fecha'] . "</td>";
                        echo "<td>" . $reg['numero_quirofano'] . "</td>";
                        echo "<td>" . $reg['nombre'] . "</td>";
                        echo "<td>" . $reg['procedimiento'] . "</td>";
                        echo "<td>" . $reg['cirujano'] . "</td>";
                        echo "<td>" . $reg['1_Ayudante'] . "</td>";
                        echo "<td>" . $reg['2_Ayudante'] . "</td>";
                        echo "<td>" . $reg['anestesista'] . "</td>";
                        echo "<td>" . $reg['instrumentador'] . "</td>";
                        echo "<td>" . $reg['tipo_anestesia'] . "</td>";
                        echo "<td><button class='btn-secondary' name='boton' value='$botton_name'>Editar</button></td>";
                        echo "</tr>";
                    }
                    ?>
                </form>

            </tbody>
        </table>
        <div class="button-container">
            <button class="btn-primary" onclick="window.location.href='formulario.php'">Agregar</button>
        </div>
    </main>
    <footer>
        <p>© 2024 Medical Stats. Todos los derechos reservados.</p>
    </footer>
</body>

</html>
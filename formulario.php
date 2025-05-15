<?php
session_start();
if (isset($_POST['boton'])) {
    $botonPresionado = $_POST['boton'];
    if ($botonPresionado != Null) {

        $conexion = mysqli_connect("localhost", "root", "", "medical_stats") or
            die("Problemas con la conexión");

        $id = substr($botonPresionado, 5);

        $registros = mysqli_query($conexion, "select * from pacientes where id = $id;") or
            die("Problemas en el select:" . mysqli_error($conexion));

        while ($reg = mysqli_fetch_array($registros)) {
?>

            <!DOCTYPE html>
            <html lang="es">

            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Formulario de Registro</title>
                <link rel="stylesheet" href="styles.css">
            </head>

            <body>
                <nav>
                    <ul>
                        <li><a href="pagina.php">Inicio</a></li>
                        <li><a href="control.php">Control de Stock</a></li>
                        <li><img src="WhatsApp Image 2024-08-25 at 21.42.38.jpeg" alt="Logo" class="logo"></li>
                        <li><a href="estadistica.php">Estadística</a></li>
                        <li><a href="salir.php">Cerrar Sesión</a></li>
                    </ul>
                </nav>

                <main>
                    <h1>Formulario de Registro</h1>
                    <div class="form-container">
                        <form action="insertar.php" method="post">

                            <input type="hidden" id="id" name="id" <?php echo "value='" . $reg['id'] . "'"; ?>>

                            <!--  <label for="fecha">Fecha:</label>
                <input type="date" id="fecha" name="fecha" required>

                <label for="hora">Hora:</label>
                <input type="time" id="hora" name="hora" required>
            -->
                            <label for="quirofano">Número quirófano:</label>
                            <input type="text" id="quirofano" name="numero_quirofano" <?php echo "value='" . $reg['numero_quirofano'] . "'"; ?> required>

                            <label for="apellido_nombre">Apellido y Nombre:</label>
                            <input type="text" id="apellido_nombre" name="nombre" <?php echo "value='" . $reg['nombre'] . "'"; ?> required>

                            <label for="cirujia">Procedimiento:</label>
                            <input type="text" id="cirujia" name="procedimiento" <?php echo "value='" . $reg['procedimiento'] . "'"; ?> required>

                            <label for="cirujano">Cirujano:</label>
                            <input type="text" id="cirujano" name="cirujano" <?php echo "value='" . $reg['cirujano'] . "'"; ?> required>

                            <label for="ayudante1">1° Ayudante:</label>
                            <input type="text" id="ayudante1" name="ayudante1" <?php echo "value='" . $reg['1_Ayudante'] . "'"; ?>required>

                            <label for="ayudante2">2° Ayudante:</label>
                            <input type="text" id="ayudante2" name="ayudante2" <?php echo "value='" . $reg['2_Ayudante'] . "'"; ?> required>

                            <label for="anestesista">Anestesista:</label>
                            <input type="text" id="anestesista" name="anestesista" <?php echo "value='" . $reg['anestesista'] . "'"; ?> required>

                            <label for="tipo_anestesia">Tipo anestesia:</label>
                            <input type="text" id="tipo_anestesia" name="tipo_anestesia" <?php echo "value='" . $reg['tipo_anestesia'] . "'"; ?> required>

                            <label for="instrumentador">Instrumentador:</label>
                            <input type="text" id="instrumentador" name="instrumentador" <?php echo "value='" . $reg['instrumentador'] . "'"; ?> required>

                            <input type="submit" value="Guardar">
                        </form>
                    </div>
                </main>
    <?php
        }
    }
}else{
    ?>

<!DOCTYPE html>
            <html lang="es">

            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Formulario de Registro</title>
                <link rel="stylesheet" href="styles.css">
            </head>

            <body>
                <nav>
                    <ul>
                        <li><a href="pagina.php">Inicio</a></li>
                        <li><a href="control.php">Control de Stock</a></li>
                        <li><img src="WhatsApp Image 2024-08-25 at 21.42.38.jpeg" alt="Logo" class="logo"></li>
                        <li><a href="estadistica.php">Estadística</a></li>
                        <li><a href="salir.php">Cerrar Sesión</a></li>
                    </ul>
                </nav>

                <main>
                    <h1>Formulario de Registro</h1>
                    <div class="form-container">
                        <form action="insertar.php" method="post">

                            <input type="hidden" id="id" name="id"  required>

                            <!--  <label for="fecha">Fecha:</label>
                <input type="date" id="fecha" name="fecha" required>

                <label for="hora">Hora:</label>
                <input type="time" id="hora" name="hora" required>
            -->
                            <label for="quirofano">Número quirófano:</label>
                            <input type="text" id="quirofano" name="numero_quirofano" required>

                            <label for="apellido_nombre">Apellido y Nombre:</label>
                            <input type="text" id="apellido_nombre" name="nombre"  required>

                            <label for="cirujia">Procedimiento:</label>
                            <input type="text" id="cirujia" name="procedimiento"  required>

                            <label for="cirujano">Cirujano:</label>
                            <input type="text" id="cirujano" name="cirujano"  required>

                            <label for="ayudante1">1° Ayudante:</label>
                            <input type="text" id="ayudante1" name="ayudante1"required>

                            <label for="ayudante2">2° Ayudante:</label>
                            <input type="text" id="ayudante2" name="ayudante2"  required>

                            <label for="anestesista">Anestesista:</label>
                            <input type="text" id="anestesista" name="anestesista"  required>

                            <label for="tipo_anestesia">Tipo anestesia:</label>
                            <input type="text" id="tipo_anestesia" name="tipo_anestesia"  required>

                            <label for="instrumentador">Instrumentador:</label>
                            <input type="text" id="instrumentador" name="instrumentador"  required>

                            <input type="submit" value="Guardar">
                        </form>
                    </div>
                </main>
<?php
}
?>
    <footer>
        <p>© 2024 Medical Stats. Todos los derechos reservados.</p>
    </footer>
            </body>

            </html>
<?php
$conexion=mysqli_connect("localhost","root","","medical_stats") or
die("Problemas con la conexión");

$registros=mysqli_query($conexion,"select * from pacientes  order by id DESC LIMIT 5;") or
die("Problemas en el select:".mysqli_error($conexion));
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
            <li><a href="#">Inicio</a></li>
            <li><a href="#">Control de Stock</a></li>
            <li><a href="#"><img src="WhatsApp Image 2024-08-25 at 21.42.38.jpeg" alt="Logo" class="logo"></a></li>
            <li><a href="#">Estadística</a></li>
            <li><a href="#">Cerrar Sesión</a></li>
        </ul>
    </nav>
<!--
    <main>
        <h1>Registro de Pacientes</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Numero quirofano</th>
                    <th>Apellido y Nombre</th>
                    <th>Cirujia</th>
                    <th>1° Ayudante</th>
                    <th>2° Ayudante</th>
                    <th>Anestecia</th>
                    <th>Tipo anestecia</th>
                    <th>Instrumentador</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>001</td>
                    <td>2024-08-25</td>
                    <td>10:30</td>
                    <td> 1 </td>
                    <td>Pérez Juan</td>
                    <td>Apendis</td>
                    <td>Quiroz Franco</td>
                    <td>Ramirez Pedro</td>
                    <td>General</td>
                    <td>123456</td>
                    <td>Pérez Carlos</td>
                    <td><button class="btn-secondary">Editar</button></td>
                </tr>
                <tr>
                    <td>002</td>
                    <td>2024-08-26</td>
                    <td>09:30</td>
                    <td> 3 </td>
                    <td>Pérez Juan</td>
                    <td>Apendis</td>
                    <td>Quiroz Franco</td>
                    <td>Ramirez Pedro</td>
                    <td>General</td>
                    <td>123456</td>
                    <td>Pérez Carlos</td>
                    <td><button class="btn-secondary">Editar</button></td>
                </tr>
                <tr>
                    <td>003</td>
                    <td></td>
                    <td></td>
                    <td>  </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><button class="btn-secondary">Editar</button></td>
                </tr>
                <tr>
                    <td>04</td>
                    <td></td>
                    <td></td>
                    <td> </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><button class="btn-secondary">Editar</button></td>
                </tr>
                <tr>
                    <td>005</td>
                    <td></td>
                    <td></td>
                    <td>  </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><button class="btn-secondary">Editar</button></td>
                </tr>
                <tr>
                    <td>06</td>
                    <td></td>
                    <td></td>
                    <td>  </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><button class="btn-secondary">Editar</button></td>
                </tr>-->
       
<main>
        <h1>Registro de Pacientes</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <!--<th>Hora</th>-->
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
<?php
    while ($reg = mysqli_fetch_array($registros)){
    $botton_name = "name_".$reg['id'];
        echo "<tr>";
        echo "<td>".$reg['id']."</td>";
        echo "<td>".$reg['fecha']."</td>";
        echo "<td>".$reg['numero_quirofano']."</td>";
        echo "<td>".$reg['nombre']."</td>";
        echo "<td>".$reg['procedimiento']."</td>";
        echo "<td>".$reg['cirujano']."</td>";
        echo "<td>".$reg['1_Ayudante']."</td>";
        echo "<td>".$reg['2_Ayudante']."</td>";
        echo "<td>".$reg['anestesista']."</td>";
        echo "<td>".$reg['instrumentador']."</td>";
        echo "<td>".$reg['tipo_anestesia']."</td>";
        echo "<td><button class='btn-secondary' name='$botton_name'>Editar</button></td>";
        echo "</tr>";
    }
?>            
            </tbody>
        </table>
        <div class="button-container">
            <button class="btn-primary" onclick="window.location.href='formulario.html'">Agregar</button>
        </div>
    </main>   
    <footer>
        <p>© 2024 Medical Stats. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
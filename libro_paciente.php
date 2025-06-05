<?php
session_start();
$_SESSION['usuario'] = "NombreUsuario";
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Medical Stats - Pacientes</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    /* Tabla fija, columnas proporcionales */
    table {
      table-layout: fixed;
      width: 100%;
      word-wrap: break-word;
    }

    th,
    td {
      /* permitir romper palabra y texto multilínea */
      white-space: normal !important;
    }

    /* Opcional: truncar texto muy largo con "..." */
    /* td {
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
    } */
  </style>
</head>

<body class="bg-green-50 min-h-screen flex flex-col">

  <!-- HEADER -->
  <header class="bg-green-100 shadow-md py-6 px-6">
    <div class="max-w-7xl mx-auto flex items-center justify-between relative min-h-[80px]">

      <!-- Izquierda -->
      <div class="flex items-center space-x-6 absolute left-0 top-1/2 transform -translate-y-1/2 px-4">
        <span class="text-sm text-green-800">👤 Usuario: <strong><?php echo $_SESSION['usuario']; ?></strong></span>
        <button class="text-green-700 hover:text-green-900 font-medium transition">🏠 Página Principal</button>
      </div>

      <!-- Logo centrado -->
      <div class="absolute left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2">
        <img src="LogoB.png" alt="Logo" class="h-16" />
      </div>

      <!-- Derecha -->
      <div class="flex items-center space-x-6 absolute right-0 top-1/2 transform -translate-y-1/2 px-4">
        <button class="text-green-700 hover:text-green-900 font-medium transition">📦 Insumos</button>
        <button class="text-green-700 hover:text-green-900 font-medium transition">📊 Estadística</button>
        <button class="text-green-700 hover:text-green-900 font-medium transition">📋 Menú</button>
      </div>

    </div>
  </header>

  <!-- MAIN CONTENIDO -->
  <main class="max-w-7xl mx-auto px-4 py-8 flex-grow">

    <!-- Buscador -->
    <div class="mb-6 max-w-md mx-auto md:max-w-2xl">
      <input type="text" placeholder="Buscar paciente"
        class="w-full border rounded-full py-2 px-4 shadow focus:outline-none focus:ring-2 focus:ring-green-500" />
    </div>

    <!-- Tabla responsive sin scroll horizontal -->
    <div class="rounded-lg shadow bg-white">
      <table class="min-w-full table-auto text-sm text-gray-800 border border-gray-200">
        <thead class="bg-green-200 text-green-900 font-semibold">
          <tr>
            <th class="border px-2 py-2 text-center w-10">ID</th>
            <th class="border px-2 py-2 w-24">Fecha</th>
            <th class="border px-2 py-2 text-center w-16">N° Quirófano</th>
            <th class="border px-2 py-2 text-center w-12">Edad</th>
            <th class="border px-2 py-2 w-20">DNI</th>
            <th class="border px-2 py-2 w-28">Localidad</th>
            <th class="border px-2 py-2 w-40">Apellido y Nombre</th>
            <th class="border px-2 py-2 w-40">Cirugía</th>
            <th class="border px-2 py-2 w-32">Cirujano</th>
            <th class="border px-2 py-2 w-32">1° Ayudante</th>
            <th class="border px-2 py-2 w-32">2° Ayudante</th>
            <th class="border px-2 py-2 w-32">Anestesista</th>
            <th class="border px-2 py-2 w-32">Instrumentador</th>
            <th class="border px-2 py-2 w-32">Tipo Anestesia</th>
            <th class="border px-2 py-2 text-center w-14">Editar</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $pacientes = [
            [
              'id' => 1, 'fecha' => '2025-05-28', 'numero_quirofano' => '3', 'edad' => '45', 'dni' => '12345678',
              'Localidad' => 'Ciudad A', 'nombre' => 'Juan Pérez', 'procedimiento' => 'Apendicectomía',
              'cirujano' => 'Dr. Gómez', '1_Ayudante' => 'Luis Martínez', '2_Ayudante' => 'Ana Ruiz',
              'anestesista' => 'Dra. Salas', 'instrumentador' => 'Carlos Méndez', 'tipo_anestesia' => 'General'
            ],
            [
              'id' => 2, 'fecha' => '2025-05-27', 'numero_quirofano' => '1', 'edad' => '30', 'dni' => '87654321',
              'Localidad' => 'Ciudad B', 'nombre' => 'María López', 'procedimiento' => 'Cesárea',
              'cirujano' => 'Dra. Fernández', '1_Ayudante' => 'José Ruiz', '2_Ayudante' => 'Marta Díaz',
              'anestesista' => 'Dr. Torres', 'instrumentador' => 'Pablo Salinas', 'tipo_anestesia' => 'Regional'
            ],
            [
              'id' => 3, 'fecha' => '2025-05-26', 'numero_quirofano' => '2', 'edad' => '60', 'dni' => '11223344',
              'Localidad' => 'Ciudad C', 'nombre' => 'Carlos Ramírez', 'procedimiento' => 'Bypass',
              'cirujano' => 'Dr. Morales', '1_Ayudante' => 'Sofía Pérez', '2_Ayudante' => 'Luis Torres',
              'anestesista' => 'Dra. Herrera', 'instrumentador' => 'Ana Salas', 'tipo_anestesia' => 'General'
            ],
            [
              'id' => 4, 'fecha' => '2025-05-25', 'numero_quirofano' => '4', 'edad' => '50', 'dni' => '55667788',
              'Localidad' => 'Ciudad D', 'nombre' => 'Lucía Fernández', 'procedimiento' => 'Colecistectomía',
              'cirujano' => 'Dr. Castro', '1_Ayudante' => 'Marta Gómez', '2_Ayudante' => 'José Ramírez',
              'anestesista' => 'Dra. Medina', 'instrumentador' => 'Pedro Ruiz', 'tipo_anestesia' => 'Regional'
            ],
            [
              'id' => 5, 'fecha' => '2025-05-24', 'numero_quirofano' => '5', 'edad' => '40', 'dni' => '99887766',
              'Localidad' => 'Ciudad E', 'nombre' => 'Ana Martínez', 'procedimiento' => 'Histerectomía',
              'cirujano' => 'Dra. Navarro', '1_Ayudante' => 'Luis Gómez', '2_Ayudante' => 'Sofía Díaz',
              'anestesista' => 'Dr. León', 'instrumentador' => 'Carlos Torres', 'tipo_anestesia' => 'General'
            ]
          ];

          foreach ($pacientes as $reg) {
            $botton_name = "name_" . $reg['id'];
            echo "<tr class='hover:bg-green-50'>";
            echo "<td class='border px-2 py-1 text-center'>" . $reg['id'] . "</td>";
            echo "<td class='border px-2 py-1'>" . $reg['fecha'] . "</td>";
            echo "<td class='border px-2 py-1 text-center'>" . $reg['numero_quirofano'] . "</td>";
            echo "<td class='border px-2 py-1 text-center'>" . $reg['edad'] . "</td>";
            echo "<td class='border px-2 py-1'>" . $reg['dni'] . "</td>";
            echo "<td class='border px-2 py-1'>" . $reg['Localidad'] . "</td>";
            echo "<td class='border px-2 py-1'>" . $reg['nombre'] . "</td>";
            echo "<td class='border px-2 py-1'>" . $reg['procedimiento'] . "</td>";
            echo "<td class='border px-2 py-1'>" . $reg['cirujano'] . "</td>";
            echo "<td class='border px-2 py-1'>" . $reg['1_Ayudante'] . "</td>";
            echo "<td class='border px-2 py-1'>" . $reg['2_Ayudante'] . "</td>";
            echo "<td class='border px-2 py-1'>" . $reg['anestesista'] . "</td>";
            echo "<td class='border px-2 py-1'>" . $reg['instrumentador'] . "</td>";
            echo "<td class='border px-2 py-1'>" . $reg['tipo_anestesia'] . "</td>";
            echo "<td class='border px-2 py-1 text-center'>";
            // Botón con icono SVG de lápiz (Heroicons - Pencil)
            echo "<button class='text-green-600 hover:text-green-800 transition' name='boton' value='$botton_name' title='Editar'>";
            echo "<svg xmlns='http://www.w3.org/2000/svg' class='h-6 w-6 inline-block' fill='none' viewBox='0 0 24 24' stroke='currentColor' stroke-width='2'>";
            echo "<path stroke-linecap='round' stroke-linejoin='round' d='M15.232 5.232l3.536 3.536M9 11l6-6 3 3-6 6H9v-3z'/>";
            echo "</svg>";
            echo "</button>";
            echo "</td>";
            echo "</tr>";
          }
          ?>
        </tbody>
      </table>
    </div>

    <!-- Botones -->
    <div class="mt-6 flex flex-col md:flex-row justify-center md:justify-end gap-4 max-w-md mx-auto md:max-w-none">
      <button
        onclick="window.location.href='formulario.php'"
        class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-6 rounded-full shadow transition w-full md:w-auto">
        + Agregar paciente
      </button>
      <button
        onclick="window.print()"
        class="bg-green-400 hover:bg-green-500 text-white font-semibold py-2 px-6 rounded-full shadow transition w-full md:w-auto">
        🖨️ Imprimir tabla
      </button>
    </div>

  </main>

  <!-- FOOTER -->
  <footer class="bg-green-200 text-green-900 text-center py-4 mt-auto shadow-inner">
    <p>®️ 2024 Medical Stats. Todos los derechos reservados.</p>
  </footer>

</body>

</html>

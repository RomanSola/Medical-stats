<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Agregar Paciente - Medical Stats</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body::before {
      content: "";
      position: fixed;
      top: 35%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 500px;
      height: 500px;
      background: url('images/logo.png') no-repeat center center;
      background-size: contain;
      opacity: 0.25;
      filter: blur(5px);
      z-index: 0;
      pointer-events: none;
    }
    body {
      position: relative;
      z-index: 1;
    }
  </style>
</head>
<body class="text-gray-800 bg-white">

<header class="py-4 px-6 shadow-md bg-white bg-opacity-90">
  <div class="flex justify-between items-center">
    <div class="text-sm flex gap-4">
      <span class="font-bold">LOGIN</span>
      <span>Usuario Conectado</span>
      <span>Configuraciones</span>
    </div>
    <div class="relative inline-block text-left">
      <button id="menuBtn" class="bg-green-600 text-white px-3 py-1 rounded-md hover:bg-green-700 transition">
        MENÚ
      </button>
      <div id="dropdownMenu" class="hidden absolute right-0 mt-2 w-48 bg-white border border-gray-300 rounded-md shadow-lg z-50">
        <a href="index.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-100">Inicio</a>
        <a href="libro_paciente.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-100">Libro Pacientes</a>
        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-100">Insumos Médicos</a>
        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-100">Estadísticas</a>
        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-100">Configuraciones</a>
        <a href="#" class="block px-4 py-2 text-sm text-red-600 hover:bg-red-100">Cerrar Sesión</a>
      </div>
    </div>
  </div>
  <div class="text-center mt-6">
    <h1 class="text-3xl font-bold text-green-700">Agregar Paciente</h1>
  </div>
</header>

<main class="py-10 px-4 md:px-10 bg-white bg-opacity-90">
  <div class="max-w-3xl mx-auto bg-white p-6 rounded-xl shadow-lg">
    <form action="guardar_paciente.php" method="POST" class="space-y-6">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <label class="block mb-1 text-sm font-medium text-gray-700">Fecha</label>
          <input type="date" name="fecha" required class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
        </div>
        <div>
          <label class="block mb-1 text-sm font-medium text-gray-700">Quirófano</label>
          <input type="number" name="quirofano" required class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
        </div>
        <div>
          <label class="block mb-1 text-sm font-medium text-gray-700">Edad</label>
          <input type="number" name="edad" required class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
        </div>
        <div>
          <label class="block mb-1 text-sm font-medium text-gray-700">DNI</label>
          <input type="text" name="dni" required class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
        </div>
        <div>
          <label class="block mb-1 text-sm font-medium text-gray-700">Localidad</label>
          <input type="text" name="localidad" required class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
        </div>
        <div>
          <label class="block mb-1 text-sm font-medium text-gray-700">Nombre del Paciente</label>
          <input type="text" name="nombre" required class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
        </div>
        <div>
          <label class="block mb-1 text-sm font-medium text-gray-700">Cirugía</label>
          <input type="text" name="cirugia" required class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
        </div>
        <div>
          <label class="block mb-1 text-sm font-medium text-gray-700">Cirujano</label>
          <input type="text" name="cirujano" required class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
        </div>
      </div>

      <div class="flex justify-end space-x-4">
        <a href="libro_paciente.php" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-400 transition">Cancelar</a>
        <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-md hover:bg-green-700 transition">Guardar</button>
      </div>
    </form>
  </div>
</main>

<footer class="text-center py-6 text-sm text-gray-600">
  Medical Stats © 2025
</footer>

<script>
  const menuBtn = document.getElementById('menuBtn');
  const dropdown = document.getElementById('dropdownMenu');
  menuBtn.addEventListener('click', () => dropdown.classList.toggle('hidden'));
  window.addEventListener('click', (e) => {
    if (!menuBtn.contains(e.target) && !dropdown.contains(e.target)) {
      dropdown.classList.add('hidden');
    }
  });
</script>

</body>
</html>

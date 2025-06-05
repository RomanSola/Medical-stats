<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Medical Stats</title>
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
      opacity: 0.1;
      filter: blur(5px);
      z-index: 0;
      pointer-events: none;
    }
    body {
      position: relative;
      z-index: 1;
      background-color: #e6f4ea; /* verde muy suave */
    }
  </style>
</head>
<body class="text-gray-800">

  <header class="bg-green-100 bg-opacity-90 shadow-md py-6 px-6 flex items-center justify-between">
    <!-- Izquierda: Usuario -->
    <button class="flex items-center gap-2 text-green-900 text-sm font-medium hover:text-green-700 transition">
      <!-- Icono usuario -->
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A9 9 0 1118.88 6.195 9 9 0 015.12 17.804z" />
        <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
      </svg>
      Usuario Conectado
    </button>

    <!-- Centro logo -->
    <div class="flex justify-center flex-grow">
      <h1 class="text-4xl font-extrabold text-green-800 select-none">Medical Stats</h1>
    </div>

    <!-- Derecha: Menú -->
    <div class="relative inline-block text-left">
      <button id="menuBtn" class="flex items-center gap-2 bg-green-600 text-white px-4 py-1 rounded-md hover:bg-green-700 transition">
        <!-- Icono menú (hamburguesa) -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
        MENÚ
      </button>
      <div id="dropdownMenu" class="hidden absolute right-0 mt-2 w-48 bg-white border border-green-200 rounded-md shadow-lg z-50">
        <a href="#" class="block px-4 py-2 text-sm text-green-900 hover:bg-green-100">Inicio</a>
        <a href="libro_paciente.php" class="block px-4 py-2 text-sm text-green-900 hover:bg-green-100">Libro Pacientes</a>
        <a href="#" class="block px-4 py-2 text-sm text-green-900 hover:bg-green-100">Insumos Médicos</a>
        <a href="#" class="block px-4 py-2 text-sm text-green-900 hover:bg-green-100">Estadísticas</a>
        <a href="#" class="block px-4 py-2 text-sm text-green-900 hover:bg-green-100">Configuraciones</a>
        <a href="#" class="block px-4 py-2 text-sm text-red-600 hover:bg-red-100">Cerrar Sesión</a>
      </div>
    </div>
  </header>

  <main class="max-w-7xl mx-auto px-6 py-8">
    <!-- Buscador -->
    <div class="mb-8 flex justify-center">
      <input
        type="text"
        placeholder="Buscar paciente"
        class="w-full md:w-1/2 border border-green-300 rounded-full py-2 px-4 shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500"
      />
    </div>

    <!-- Tarjetas -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
      <a href="libro_paciente.php"
         class="bg-white rounded-xl shadow-md p-6 max-w-xs mx-auto transform transition hover:scale-105 duration-300">
        <img src="images/card_pacientes.jpg" alt="Libro Pacientes" class="rounded-md mb-4 w-full h-40 object-cover" />
        <h2 class="text-xl font-semibold text-green-800 text-center">LIBRO PACIENTES</h2>
      </a>

      <a href="#"
         class="bg-white rounded-xl shadow-md p-6 max-w-xs mx-auto transform transition hover:scale-105 duration-300">
        <img src="images/card_insumos.jpg" alt="Insumos Médicos" class="rounded-md mb-4 w-full h-40 object-cover" />
        <h2 class="text-xl font-semibold text-green-800 text-center">INSUMOS MÉDICOS</h2>
      </a>

            <a href="gestion_cama.php"
         class="bg-white rounded-xl shadow-md p-6 max-w-xs mx-auto transform transition hover:scale-105 duration-300">
        <img src="images/card_insumos.jpg" alt="Gestion Camas" class="rounded-md mb-4 w-full h-40 object-cover" />
        <h2 class="text-xl font-semibold text-green-800 text-center">GESTIÓN CAMAS</h2>
      </a>

      <a href="#"
         class="bg-white rounded-xl shadow-md p-6 max-w-xs mx-auto transform transition hover:scale-105 duration-300">
        <img src="images/card_estadisticas.jpg" alt="Estadísticas" class="rounded-md mb-4 w-full h-40 object-cover" />
        <h2 class="text-xl font-semibold text-green-800 text-center">ESTADÍSTICAS</h2>
      </a>
    </div>
  </main>

  <footer class="text-center py-6 text-green-700 text-sm select-none">
    Medical Stats © 2025
  </footer>

  <script>
    const menuBtn = document.getElementById('menuBtn');
    const dropdown = document.getElementById('dropdownMenu');

    menuBtn.addEventListener('click', () => {
      dropdown.classList.toggle('hidden');
    });

    window.addEventListener('click', (e) => {
      if (!menuBtn.contains(e.target) && !dropdown.contains(e.target)) {
        dropdown.classList.add('hidden');
      }
    });
  </script>
</body>
</html>

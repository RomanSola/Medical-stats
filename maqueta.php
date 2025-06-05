<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Medical Stat</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      background-image: url('images/logo.png');
      background-repeat: no-repeat;
      background-position: center 100px;
      background-size: 400px;
      background-attachment: fixed;
      filter: opacity(0.1);
    }
    .overlay {
      backdrop-filter: blur(6px);
      background-color: rgba(255, 255, 255, 0.8);
    }
  </style>
</head>
<body class="text-gray-800">

  <header class="overlay py-4 px-6 shadow-md">
    <div class="flex justify-between items-center">
      <div class="text-sm flex gap-4">
        <span class="font-bold">LOGIN</span>
        <span>Moviendo ▼</span>
        <span>2020.0</span>
        <span>Configuraciones</span>
      </div>
      <div>
        <button class="text-sm bg-green-600 text-white px-4 py-1 rounded hover:bg-green-700">MENU</button>
      </div>
    </div>
    <div class="text-center mt-6">
      <h1 class="text-3xl font-bold text-green-700">Medical Stat</h1>
      <div class="mt-4">
        <input type="text" placeholder="Liberador Región"
               class="w-full md:w-1/2 border rounded-full py-2 px-4 shadow focus:outline-none focus:ring-2 focus:ring-green-500">
      </div>
    </div>
  </header>

  <main class="overlay py-10 px-4 md:px-10">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      <div class="bg-white rounded-xl shadow-md p-4 transform transition hover:scale-105 duration-300">
        <img src="images/card_pacientes.jpg" alt="Libro Pacientes" class="rounded-md mb-4">
        <h2 class="text-xl font-semibold text-green-700">LIBRO PACIENTES</h2>
        <p class="text-sm text-gray-600">Imagen relacionada</p>
      </div>

      <div class="bg-white rounded-xl shadow-md p-4 transform transition hover:scale-105 duration-300">
        <img src="images/card_insumos.jpg" alt="Insumos Médicos" class="rounded-md mb-4">
        <h2 class="text-xl font-semibold text-green-700">INSUMOS MÉDICOS</h2>
        <p class="text-sm text-gray-600">Imagen relacionada</p>
      </div>

      <div class="bg-white rounded-xl shadow-md p-4 transform transition hover:scale-105 duration-300">
        <img src="images/card_estadisticas.jpg" alt="Estadísticas" class="rounded-md mb-4">
        <h2 class="text-xl font-semibold text-green-700">ESTADÍSTICAS</h2>
        <p class="text-sm text-gray-600">Imagen relacionada</p>
      </div>
    </div>
  </main>

  <footer class="text-center py-6 text-sm text-gray-600">
    Medical Stat © 2025 - Pie de Página
  </footer>

  <script>
    window.addEventListener('load', () => {
      document.body.classList.add('opacity-0');
      setTimeout(() => document.body.classList.remove('opacity-0'), 100);
    });
  </script>

</body>
</html>
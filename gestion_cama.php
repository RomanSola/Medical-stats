<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Medical Stats - Gestión de Camas</title>
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
      background-color: #e6f4ea;
    }
    .modal-form label {
      display: block;
      margin-bottom: 0.25rem;
      font-weight: 600;
    }
    .modal-form input, .modal-form textarea, .modal-form select {
      width: 100%;
      padding: 0.5rem;
      border: 1px solid #ccc;
      border-radius: 0.375rem;
      margin-bottom: 1rem;
    }
    /* Para evitar scroll atrás cuando el modal esté abierto */
    body.modal-open {
      overflow: hidden;
    }
    /* Cursor solo cambia en modo eliminar */
    .modo-eliminar .cama {
      cursor: pointer;
      border: 4px solid #dc2626; /* rojo */
      border-radius: 0.75rem;
    }
  </style>
</head>
<body class="text-gray-800">
  <main class="max-w-6xl mx-auto p-4">
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-3xl font-bold text-green-800">Gestión de Camas Hospitalarias</h1>
      <div class="space-x-2">
        <button onclick="agregarCama()" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ Agregar Cama</button>
        <button onclick="toggleModoEliminar()" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700" id="btnModoEliminar">- Eliminar Cama</button>
        <button onclick="mostrarAltas()" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Ver Altas</button>
      </div>
    </div>

    <!-- Selector de sala -->
    <div class="mb-6">
      <label for="selectorSala" class="block mb-2 font-semibold text-green-800">Sala actual:</label>
      <select id="selectorSala" onchange="cambiarSala(this.value)" class="p-2 border border-gray-300 rounded">
        <option value="0">Sala 1</option>
        <option value="1">Sala 2</option>
        <option value="2">Sala 3</option>
      </select>
    </div>

    <!-- Campo de búsqueda -->
    <div class="mb-6">
      <input type="text" id="busqueda" oninput="buscarPaciente()" placeholder="Buscar por nombre, DNI, motivo, etc." class="w-full p-2 border border-gray-300 rounded" />
    </div>

    <!-- Contenedor de camas -->
    <div id="camasContainer" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4"></div>
  </main>

  <!-- Modal formulario para asignar/editar paciente -->
<div id="formularioModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
  <div class="bg-white rounded-lg p-6 w-full max-w-sm max-h-[80vh] overflow-y-auto relative">
    <h2 class="text-xl font-bold mb-4 text-green-800">Asignar / Editar Paciente</h2>
    <form id="formPaciente" class="modal-form">
        <label for="nombre">Nombre completo*</label>
        <input type="text" id="nombre" name="nombre" required />

        <label for="dni">DNI*</label>
        <input type="text" id="dni" name="dni" required />

        <label for="alergias">Alergias</label>
        <input type="text" id="alergias" name="alergias" />

        <label for="motivo">Motivo*</label>
        <input type="text" id="motivo" name="motivo" required />

        <label>Medicamentos*</label>
        <div id="checkboxMedicamentos" class="mb-4 flex flex-col space-y-1"></div>

        <div class="flex justify-end space-x-4">
          <button type="button" onclick="cerrarFormulario()" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">Cancelar</button>
          <button type="submit" class="bg-green-700 text-white px-4 py-2 rounded hover:bg-green-800">Guardar</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Modal para mostrar altas -->
  <div id="modalAltas" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white rounded-lg p-6 w-full max-w-lg max-h-[80vh] overflow-y-auto relative">
      <h2 class="text-xl font-bold mb-4 text-green-800">Listado de Altas</h2>
      <ul id="listaAltas" class="space-y-4"></ul>
      <button onclick="cerrarAltas()" class="mt-4 bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Cerrar</button>
    </div>
  </div>

  <script>
    // Datos iniciales: 3 salas, 10 camas cada una libres
    const salas = [
      Array.from({ length: 10 }, () => ({ estado: 'libre', paciente: null })),
      Array.from({ length: 10 }, () => ({ estado: 'libre', paciente: null })),
      Array.from({ length: 10 }, () => ({ estado: 'libre', paciente: null })),
    ];

    let salaActual = 0;
    const medicamentosDisponibles = ['Paracetamol', 'Ibuprofeno', 'Amoxicilina', 'Omeprazol', 'Salbutamol'];
    const altas = [];
    let camaActual = null;
    let modoEliminar = false;

    const camasContainer = document.getElementById('camasContainer');
    const body = document.body;
    const btnModoEliminar = document.getElementById('btnModoEliminar');

    function renderCamas(filtro = '') {
      const camas = salas[salaActual];
      camasContainer.innerHTML = '';

      camas.forEach((cama, index) => {
        if (filtro) {
          // Texto a buscar: paciente nombre, dni, motivo, alergias, y también estado cama
          const texto = [
            cama.estado,
            cama.paciente?.nombre,
            cama.paciente?.dni,
            cama.paciente?.motivo,
            cama.paciente?.alergias
          ].filter(Boolean).join(' ').toLowerCase();

          if (!texto.includes(filtro.toLowerCase())) return;
        }

        const div = document.createElement('div');
        div.classList.add('cama');

        let bgClass =
          cama.estado === 'ocupada' ? 'bg-red-400' :
          cama.estado === 'fuera' ? 'bg-gray-400' : 'bg-green-400';

        div.className += ` ${bgClass} text-white p-4 rounded-xl shadow-md relative`;

        // Agregar clase y cursor si modo eliminar activo
        if (modoEliminar) {
          div.classList.add('modo-eliminar');
        }

        // Icono según estado
        const icono = cama.estado === 'ocupada' ? '❌' : cama.estado === 'fuera' ? '🚫' : '🛏️';

        let content = `<div class='text-lg font-bold mb-2 flex items-center justify-between'>${icono} Cama ${index + 1}</div>`;
        content += `<div class='uppercase text-sm font-semibold mb-6'>${cama.estado}</div>`;

        // Botón cambiar estado
        content += `<button onclick="event.stopPropagation(); cambiarEstado(${index});" class='absolute top-2 right-2 bg-white text-black text-xs px-2 py-1 rounded'>Estado</button>`;

        if (cama.estado !== 'fuera') {
          if (cama.paciente) {
            const p = cama.paciente;
            content += `<div><strong>${p.nombre}</strong><br>DNI: ${p.dni}<br>Alergias: ${p.alergias || 'Ninguna'}<br>Motivo: ${p.motivo}<br><u>Medicamentos:</u><ul class='list-disc ml-5'>${p.medicamentos.map(m => `<li>${m}</li>`).join('')}</ul></div>`;

            // Botones editar y dar alta
            content += `<button onclick="event.stopPropagation(); editarPaciente(${index});" class='absolute bottom-2 left-2 bg-white text-black text-sm px-2 py-1 rounded'>Editar</button>`;
            content += `<button onclick="event.stopPropagation(); darAlta(${index});" class='absolute bottom-2 right-2 bg-green-900 text-white text-sm px-2 py-1 rounded'>Alta</button>`;
          } else {
            // Botón asignar paciente
            content += `<button onclick="event.stopPropagation(); abrirFormulario(${index});" class='absolute bottom-2 left-2 right-2 bg-green-700 text-white text-sm py-1 rounded'>Asignar Paciente</button>`;
          }
        } else {
          content += `<div class="italic">Cama fuera de servicio</div>`;
        }

        div.innerHTML = content;

        // Si está en modo eliminar, al hacer click en la cama eliminarla
        if (modoEliminar) {
          div.style.cursor = 'pointer';
          div.onclick = () => {
            if (confirm(`¿Eliminar cama ${index + 1} de la sala ${salaActual + 1}?`)) {
              salas[salaActual].splice(index, 1);
              renderCamas();
            }
          };
        } else {
          div.onclick = null;
        }

        camasContainer.appendChild(div);
      });
    }

    // Cambiar sala
    function cambiarSala(nuevaSala) {
      salaActual = parseInt(nuevaSala);
      renderCamas();
    }

    // Cambiar estado de cama (libre, ocupada, fuera)
    function cambiarEstado(index) {
      const cama = salas[salaActual][index];
      if (cama.estado === 'libre') cama.estado = 'ocupada';
      else if (cama.estado === 'ocupada') cama.estado = 'fuera';
      else cama.estado = 'libre';
      renderCamas();
    }

    // Abrir formulario para asignar o editar paciente
    function abrirFormulario(index) {
      camaActual = index;
      const cama = salas[salaActual][index];
      const form = document.getElementById('formPaciente');
      form.reset();

      // Limpiar checkboxes medicamentos
      const contMed = document.getElementById('checkboxMedicamentos');
      contMed.innerHTML = '';
      medicamentosDisponibles.forEach(m => {
        const id = `med-${m.replace(/\s+/g, '')}`;
        const checkbox = document.createElement('div');
        checkbox.innerHTML = `<label><input type="checkbox" name="medicamentos" value="${m}" id="${id}"> ${m}</label>`;
        contMed.appendChild(checkbox);
      });

      if (cama.paciente) {
        // Cargar datos paciente
        form.nombre.value = cama.paciente.nombre;
        form.dni.value = cama.paciente.dni;
        form.alergias.value = cama.paciente.alergias || '';
        form.motivo.value = cama.paciente.motivo;
        cama.paciente.medicamentos.forEach(med => {
          const checkbox = document.querySelector(`#checkboxMedicamentos input[value="${med}"]`);
          if (checkbox) checkbox.checked = true;
        });
      }

      document.getElementById('formularioModal').classList.remove('hidden');
      body.classList.add('modal-open');
    }

    // Cerrar formulario modal
    function cerrarFormulario() {
      document.getElementById('formularioModal').classList.add('hidden');
      body.classList.remove('modal-open');
    }

    // Guardar datos del formulario (asignar o editar paciente)
    document.getElementById('formPaciente').onsubmit = function (e) {
      e.preventDefault();

      const form = e.target;
      const nombre = form.nombre.value.trim();
      const dni = form.dni.value.trim();
      const alergias = form.alergias.value.trim();
      const motivo = form.motivo.value.trim();
      const medicamentos = Array.from(form.querySelectorAll('input[name="medicamentos"]:checked')).map(el => el.value);

      if (!nombre || !dni || !motivo) {
        alert('Por favor, completa los campos obligatorios.');
        return;
      }

      // Guardar paciente en cama actual
      salas[salaActual][camaActual] = {
        estado: 'ocupada',
        paciente: {
          nombre,
          dni,
          alergias,
          motivo,
          medicamentos,
        },
      };

      cerrarFormulario();
      renderCamas();
    };

    // Dar alta a paciente
    function darAlta(index) {
      const cama = salas[salaActual][index];
      if (!cama.paciente) {
        alert('La cama está libre.');
        return;
      }
      if (confirm(`¿Dar alta a ${cama.paciente.nombre}?`)) {
        altas.push(cama.paciente);
        // Liberar cama
        salas[salaActual][index] = { estado: 'libre', paciente: null };
        renderCamas();
      }
    }

    // Mostrar modal altas
    function mostrarAltas() {
      const listaAltas = document.getElementById('listaAltas');
      listaAltas.innerHTML = '';
      if (altas.length === 0) {
        listaAltas.innerHTML = '<li>No hay altas registradas.</li>';
      } else {
        altas.forEach((paciente, i) => {
          listaAltas.innerHTML += `<li class="border p-2 rounded mb-2 bg-green-50">
            <strong>${paciente.nombre}</strong> - DNI: ${paciente.dni} - Motivo: ${paciente.motivo}
          </li>`;
        });
      }
      document.getElementById('modalAltas').classList.remove('hidden');
      body.classList.add('modal-open');
    }

    function cerrarAltas() {
      document.getElementById('modalAltas').classList.add('hidden');
      body.classList.remove('modal-open');
    }

    // Buscar paciente filtrando por texto en camas
    function buscarPaciente() {
      const texto = document.getElementById('busqueda').value;
      renderCamas(texto);
    }

    // Agregar nueva cama libre al final de la sala actual
    function agregarCama() {
      salas[salaActual].push({ estado: 'libre', paciente: null });
      renderCamas();
    }

    // Editar paciente (abre formulario)
    function editarPaciente(index) {
      abrirFormulario(index);
    }

    // Alternar modo eliminar camas
    function toggleModoEliminar() {
      modoEliminar = !modoEliminar;
      if (modoEliminar) {
        btnModoEliminar.textContent = 'Cancelar Eliminar';
        body.classList.add('modo-eliminar');
      } else {
        btnModoEliminar.textContent = '- Eliminar Cama';
        body.classList.remove('modo-eliminar');
      }
      renderCamas(document.getElementById('busqueda').value);
    }

    // Renderizar inicial
    renderCamas();
  </script>
</body>
</html>
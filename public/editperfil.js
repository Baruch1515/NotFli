function calcularDiasRestantes() {
    // Obtén la fecha actual
    var fechaActual = new Date();
    fechaActual.setUTCHours(0, 0, 0, 0);

    // Obtén el valor del campo de entrada de fecha de cumpleaños
    var fechaCumpleanos = new Date(document.getElementById('fechaCumpleanos').value);

    // Establece la fecha del cumpleaños del usuario al año actual
    fechaCumpleanos.setFullYear(fechaActual.getFullYear());

    // Compara las fechas para determinar si es el cumpleaños o calcular los días restantes
    if (fechaCumpleanos > fechaActual) {
      // Calcula la diferencia en milisegundos entre las fechas
      var diferenciaTiempo = fechaCumpleanos.getTime() - fechaActual.getTime();

      // Convierte la diferencia de tiempo a días
      var diasRestantes = Math.ceil(diferenciaTiempo / (1000 * 60 * 60 * 24));

      document.getElementById('resultado').textContent = "Faltan " + diasRestantes + " días para tu próximo cumpleaños.";
    } else if (
      fechaCumpleanos.getDate() === fechaActual.getDate() &&
      fechaCumpleanos.getMonth() === fechaActual.getMonth()
    ) {
        document.getElementById('resultado').textContent = "¡Feliz cumpleaños!";

        const duration = 15 * 1000,
  animationEnd = Date.now() + duration,
  defaults = { startVelocity: 30, spread: 360, ticks: 60, zIndex: 0 };

function randomInRange(min, max) {
  return Math.random() * (max - min) + min;
}

const interval = setInterval(function() {
  const timeLeft = animationEnd - Date.now();

  if (timeLeft <= 0) {
    return clearInterval(interval);
  }

  const particleCount = 50 * (timeLeft / duration);

  // since particles fall down, start a bit higher than random
  confetti(
    Object.assign({}, defaults, {
      particleCount,
      origin: { x: randomInRange(0.1, 0.3), y: Math.random() - 0.2 },
    })
  );
  confetti(
    Object.assign({}, defaults, {
      particleCount,
      origin: { x: randomInRange(0.7, 0.9), y: Math.random() - 0.2 },
    })
  );
}, 250);
    } else {
      // Si la fecha de cumpleaños ya pasó en el año actual, calcula los días restantes para el próximo año
      fechaCumpleanos.setFullYear(fechaActual.getFullYear() + 1);

      var diferenciaTiempo = fechaCumpleanos.getTime() - fechaActual.getTime();
      var diasRestantes = Math.ceil(diferenciaTiempo / (1000 * 60 * 60 * 24));

      document.getElementById('resultado').textContent = "Faltan " + diasRestantes + " días para tu próximo cumpleaños.";
    }
  }

  // Calcular los días restantes al cargar la página
  calcularDiasRestantes();

  function removeSpaces(input) {
    var value = input.value;
    value = value.replace(/\s/g, ''); // Eliminar todos los espacios en blanco

    input.value = value;
  }

  // Validar antes de enviar el formulario
  document.getElementById('ots').form.addEventListener('submit', function(event) {
    var value = document.getElementById('ots').value;
    if (value.includes(' ')) {
      document.getElementById('error-msg').textContent = 'No se permiten espacios';
      event.preventDefault(); // Evitar el envío del formulario
    }
  });
// Importar Bootstrap y sus dependencias
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap-icons/font/bootstrap-icons.css';
import * as bootstrap from 'bootstrap';

// Importar estilos propios
import '../css/app.css';
import '../css/style.css';

// Importar y configurar Flatpickr
import flatpickr from "flatpickr";
import "flatpickr/dist/flatpickr.min.css";
import { Spanish } from "flatpickr/dist/l10n/es.js"; // Importar el idioma español

// Alpine.js
import Alpine from 'alpinejs';

// Hacer bootstrap disponible globalmente
window.bootstrap = bootstrap;
window.Alpine = Alpine;

Alpine.start();

// Inicializar Flatpickr
document.addEventListener('DOMContentLoaded', function () {
    flatpickr("#birth_date", {
        dateFormat: "Y-m-d", // Puedes cambiar el formato si lo prefieres
        altInput: true, // Muestra una entrada alternativa (opcional)
        altFormat: "F j, Y", // Formato alternativo
        locale: Spanish, // Establecer el idioma a español
        minDate: "1900-01-01", // Establecer una fecha mínima si es necesario
        maxDate: "today", // Establecer la fecha máxima a hoy
        yearSelectorType: "static", // Mostrar siempre el selector de años
        disableMobile: true, // Desactivar el calendario móvil para una mejor experiencia de escritorio
        position: "below", // Colocar el calendario debajo del campo de fecha
        prevArrow: "<i class='bi bi-chevron-left'></i>", // Icono de flecha izquierda
        nextArrow: "<i class='bi bi-chevron-right'></i>", // Icono de flecha derecha
        onChange: function(selectedDates, dateStr, instance) {
            console.log(`Fecha seleccionada: ${dateStr}`);
        },
    });
});

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
import { Spanish } from "flatpickr/dist/l10n/es.js";

// Alpine.js
import Alpine from 'alpinejs';

// Hacer bootstrap disponible globalmente
window.bootstrap = bootstrap;
window.Alpine = Alpine;

Alpine.start();

// Configuración de Flatpickr
const initializeFlatpickr = (element) => {
    if (!element._flatpickr) {
        return flatpickr(element, {
            dateFormat: "Y-m-d",
            altInput: true,
            altFormat: "d/m/Y",
            locale: Spanish,
            minDate: "1900-01-01",
            maxDate: "today",
            allowInput: false,
            disableMobile: true,
            onChange: function(selectedDates, dateStr, instance) {
                const livewireComponent = window.Livewire.find(
                    element.closest('[wire\\:id]').getAttribute('wire:id')
                );
                if (livewireComponent) {
                    livewireComponent.set('birth_date', dateStr);
                }
            }
        });
    }
};

// Función para inicializar todos los campos de fecha
const initAllDateFields = () => {
    document.querySelectorAll('input[type="text"][wire\\:model="birth_date"]').forEach(element => {
        initializeFlatpickr(element);
    });
};

// Inicializar en la carga inicial
document.addEventListener('DOMContentLoaded', initAllDateFields);

// Reinicializar después de las actualizaciones de Livewire
document.addEventListener('livewire:initialized', initAllDateFields);
document.addEventListener('livewire:navigated', initAllDateFields);

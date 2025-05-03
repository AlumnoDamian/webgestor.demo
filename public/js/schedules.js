// Funciones para el modal de leyenda
function showLegend() {
    document.getElementById('legendModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function hideLegend() {
    document.getElementById('legendModal').classList.add('hidden');
    document.body.style.overflow = 'auto';
}

// Función para mostrar/ocultar semanas
function showWeek(weekIndex) {
    // Ocultar todas las tablas
    document.querySelectorAll('.week-table').forEach(table => {
        table.classList.add('hidden');
    });
    
    // Mostrar la tabla seleccionada
    document.querySelector(`.week-table[data-week="${weekIndex}"]`).classList.remove('hidden');
    
    // Actualizar los botones
    document.querySelectorAll('.week-selector').forEach(button => {
        // Remover estilos activos
        button.classList.remove('from-blue-50', 'to-blue-100', 'border-blue-300', 'shadow-inner');
        button.classList.add('from-white', 'to-gray-50', 'border-gray-200', 'hover:-translate-y-0.5', 'hover:shadow-md');
        
        // Actualizar textos y elementos internos
        const dateText = button.querySelector('span:last-child');
        const arrow = button.querySelector('svg:last-child');
        if (dateText) dateText.classList.remove('text-blue-800');
        if (arrow) arrow.classList.remove('text-blue-600');
        
        // Manejar la barra de progreso
        const existingBar = button.querySelector('.absolute.bottom-0');
        if (existingBar) existingBar.remove();
        
        if (button.dataset.week == weekIndex) {
            // Aplicar estilos activos
            button.classList.remove('from-white', 'to-gray-50', 'border-gray-200', 'hover:-translate-y-0.5', 'hover:shadow-md');
            button.classList.add('from-blue-50', 'to-blue-100', 'border-blue-300', 'shadow-inner');
            
            // Actualizar textos y elementos internos
            if (dateText) dateText.classList.add('text-blue-800');
            if (arrow) arrow.classList.add('text-blue-600');
            
            // Agregar barra de progreso
            const progressBar = document.createElement('div');
            progressBar.className = 'absolute left-0 right-0 bottom-0 h-0.5 overflow-hidden rounded-b-lg';
            progressBar.innerHTML = `
                <div class="absolute inset-0 bg-gradient-to-r from-blue-500 to-blue-600
                    transform origin-left scale-x-100
                    transition-transform duration-500 ease-out"></div>
            `;
            button.appendChild(progressBar);
        }
    });
}

// Inicializar cuando el DOM esté cargado
document.addEventListener('DOMContentLoaded', function() {
    showWeek(0);

    // Añadir event listener para el formulario (solo para guardar horarios)
    document.getElementById('scheduleForm').addEventListener('submit', function(e) {
        // Solo prevenir el submit si el botón presionado es el de guardar
        if (e.submitter && e.submitter.type === 'submit') {
            e.preventDefault();
            
            // Enviar el formulario usando fetch
            fetch(this.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': new FormData(this).get('_token'),
                    'Accept': 'application/json',
                },
                body: new FormData(this)
            })
            .then(response => response.text())
            .then(data => {
                // Recargar la página después de guardar
                window.location.reload();
            })
            .catch(error => {
                alert('Error al guardar los cambios. Por favor, inténtelo de nuevo.');
            });
        }
    });

    // Añadir event listeners para los selects
    document.querySelectorAll('select[name^="schedules"]').forEach(select => {
        select.addEventListener('change', function() {
            // El select cambió, pero no necesitamos hacer nada específico aquí
        });
    });

    // Añadir event listeners para los botones de semana
    document.querySelectorAll('.week-selector').forEach(button => {
        button.addEventListener('click', function() {
            showWeek(this.dataset.week);
        });
    });
});

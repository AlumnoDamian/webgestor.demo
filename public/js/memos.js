function openModal(id = null) {
    document.getElementById('form_method').value = 'POST';
    document.getElementById('memo_id').value = '';
    document.getElementById('title').value = '';
    document.getElementById('content').value = '';
    document.getElementById('type').value = '';
    document.getElementById('department_id').value = '';
    document.getElementById('modalTitle').textContent = 'Nuevo Comunicado';
    document.getElementById('published_at').required = true;
    
    // Establecer fecha y hora actual
    const now = new Date();
    const year = now.getFullYear();
    const month = String(now.getMonth() + 1).padStart(2, '0');
    const day = String(now.getDate()).padStart(2, '0');
    const hours = String(now.getHours()).padStart(2, '0');
    const minutes = String(now.getMinutes()).padStart(2, '0');
    document.getElementById('published_at').value = `${year}-${month}-${day}T${hours}:${minutes}`;
    
    document.getElementById('memoModal').classList.remove('hidden');
    document.body.classList.add('overflow-hidden');
}

function closeModal() {
    document.getElementById('memoModal').classList.add('hidden');
    document.body.classList.remove('overflow-hidden');
}

function openEditModal(id, title, type, content, department_id, published_at) {
    document.getElementById('memo_id').value = id;
    document.getElementById('modalTitle').textContent = 'Editar Comunicado';
    document.getElementById('title').value = title;
    document.getElementById('type').value = type;
    document.getElementById('content').value = content;
    document.getElementById('department_id').value = department_id;
    
    // Ocultar y quitar requerido del campo de fecha
    document.getElementById('published_at_field').style.display = 'none';
    document.getElementById('published_at').required = false;
    
    document.getElementById('form_method').value = 'PUT';
    document.getElementById('memoForm').action = `/memos/${id}`;
    
    document.getElementById('submitButton').textContent = 'Actualizar Comunicado';
    
    document.getElementById('memoModal').classList.remove('hidden');
    document.body.classList.add('overflow-hidden');
}
function deleteMemo(id) {
    if (confirm('¿Está seguro de que desea eliminar este comunicado?')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/memos/${id}`;
        
        const methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'DELETE';
        
        const tokenInput = document.createElement('input');
        tokenInput.type = 'hidden';
        tokenInput.name = '_token';
        tokenInput.value = document.querySelector('meta[name="csrf-token"]').content;
        
        form.appendChild(methodInput);
        form.appendChild(tokenInput);
        document.body.appendChild(form);
        form.submit();
    }
}

// Event Listeners
document.addEventListener('DOMContentLoaded', function() {
    const memoForm = document.getElementById('memoForm');
    if (memoForm) {
        memoForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const method = document.getElementById('form_method').value;
            const memoId = document.getElementById('memo_id').value;
            const url = method === 'PUT' ? `/memos/${memoId}` : '/memos';
            
            fetch(url, {
                method: method === 'PUT' ? 'POST' : method,
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error en la respuesta del servidor');
                }
                return response.json();
            })
            .then(data => {
                closeModal();
                // Mostrar mensaje de éxito
                const toast = document.createElement('div');
                toast.className = 'fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg';
                toast.textContent = data.message || 'Operación realizada con éxito';
                document.body.appendChild(toast);
                setTimeout(() => toast.remove(), 3000);
                
                // Recargar la página después de un breve retraso
                setTimeout(() => window.location.reload(), 1000);
            })
            .catch(error => {
                console.error('Error:', error);
                // Mostrar mensaje de error
                const toast = document.createElement('div');
                toast.className = 'fixed bottom-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg';
                toast.textContent = 'Error al procesar la solicitud';
                document.body.appendChild(toast);
                setTimeout(() => toast.remove(), 3000);
            });
        });
    }
});

// Close modal when clicking outside
document.getElementById('memoModal').addEventListener('click', function(event) {
    if (event.target === this) {
        closeModal();
    }
});

// Close modal with ESC key
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape' && !document.getElementById('memoModal').classList.contains('hidden')) {
        closeModal();
    }
});
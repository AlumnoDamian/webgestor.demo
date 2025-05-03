function openModal() {
    document.getElementById('memo_id').value = '';
    document.getElementById('modalTitle').textContent = 'Nuevo Comunicado';
    document.getElementById('memoForm').reset();
    document.getElementById('form_method').value = 'POST';
    document.getElementById('memoForm').action = '/memos'; // La ruta para crear
    
    // Mostrar y hacer requerido el campo de fecha
    document.getElementById('published_at_field').style.display = 'block';
    document.getElementById('published_at').required = true;
    
    // Establecer fecha y hora actual
    const now = new Date();
    const year = now.getFullYear();
    const month = String(now.getMonth() + 1).padStart(2, '0');
    const day = String(now.getDate()).padStart(2, '0');
    const hours = String(now.getHours()).padStart(2, '0');
    const minutes = String(now.getMinutes()).padStart(2, '0');
    document.getElementById('published_at').value = `${year}-${month}-${day}T${hours}:${minutes}`;
    
    document.getElementById('submitButton').textContent = 'Crear Comunicado';
    
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

function showSpinner() {
    document.getElementById('spinner-overlay').style.display = 'flex'; // Mostrar el spinner
}

function hideSpinner() {
    document.getElementById('spinner-overlay').style.display = 'none'; // Ocultar el spinner
}

// Retrasar el envío del formulario y mostrar el spinner durante 2 segundos
function handleSubmit(event) {
    event.preventDefault(); // Evitar que el formulario se envíe inmediatamente
    showSpinner(); // Mostrar el spinner

    // Retrasar el envío del formulario 2 segundos (2000ms)
    setTimeout(function() {
        document.getElementById('myForm').submit(); // Enviar el formulario después de 2 segundos
    }, 2000);
}

// Añadir un listener al formulario para que llame a handleSubmit al enviarlo
document.getElementById('myForm').addEventListener('submit', handleSubmit);

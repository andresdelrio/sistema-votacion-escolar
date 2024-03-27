const boton = document.querySelector('#btnVotar');
const radioButtons = document.querySelectorAll('input[name="vote"]');

// Ocultar el botón inicialmente
boton.style.display = 'none';

// Escuchar cambios en los botones de radio
for (const radioButton of radioButtons) {
    radioButton.addEventListener('change', function() {
        // Mostrar el botón cuando se selecciona un candidato
        boton.style.display = 'block';
        
        // Obtener la tarjeta del candidato seleccionado
        const selectedCard = this.closest('.card');
        
        // Remover la clase 'selected' de todas las tarjetas
        document.querySelectorAll('.card').forEach(card => {
            card.classList.remove('selected');
            // Ocultar el elemento .selection de todas las tarjetas
            card.querySelector('.selection').style.opacity = 0;
        });
        
        // Si el botón de radio está seleccionado, agregar la clase 'selected' a la tarjeta del candidato
        if (this.checked) {
            selectedCard.classList.add('selected');
            // Mostrar el elemento .selection en la tarjeta del candidato seleccionado
            selectedCard.querySelector('.selection').style.opacity = 1;
        }
    });
}

document.addEventListener('DOMContentLoaded', () => {
    const fechaCierre = document.getElementById('fechaCierre').dataset.fecha;
    const countDownDate = new Date(fechaCierre).getTime();
    const demoElement = document.getElementById("demo");

    function updateCountdown() {
        const now = new Date().getTime();
        const distance = countDownDate - now;
        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        if (days === 0) {
            demoElement.textContent = `${hours}:${minutes}:${seconds}`;
        }else if (days === 1) {
            demoElement.textContent = `${days} Día, ${hours}:${minutes}:${seconds}`;
        }else {
            demoElement.textContent = `${days} Días, ${hours}:${minutes}:${seconds}`;
        }

        

        if (distance < 0) {
            clearInterval(countdownTimer);
            demoElement.textContent = "Actualiza esta página para que puedas votar";
        }
    }

    // Update the countdown every 1 second
    const countdownTimer = setInterval(updateCountdown, 1000);
});

// Set the date we're counting down to
//var countDownDate = new Date('{{ fecha_cierre }}').getTime();


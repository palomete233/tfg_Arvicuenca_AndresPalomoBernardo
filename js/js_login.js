function mostrarConfeti(event) {
    event.preventDefault(); // Evita el envío inmediato del formulario

    confetti({
        particleCount: 100,
        spread: 70,
        origin: { y: 0.6 }
    });

        // Retraso para enviar el formulario después del confeti
    setTimeout(() => {
        event.target.closest("form").submit();
    }, 1000);
}
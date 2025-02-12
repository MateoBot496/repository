document.getElementById('change-color-btn').addEventListener('click', function() {
    const messages = [
        "¡Tu amor ilumina mi vida!",
        "Eres lo mejor que me ha pasado, te amo.",
        "Siempre estaré aquí para ti, Sofía.",
        "Gracias por ser la mejor compañera de vida.",
        "Te deseo todo lo mejor, hoy y siempre."
    ];
    
    const randomMessage = messages[Math.floor(Math.random() * messages.length)];
    
    document.getElementById('wish-message').textContent = randomMessage;
});
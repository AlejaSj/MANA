const items = document.querySelectorAll('.accordion-item');

items.forEach(item => {

    const header = item.querySelector('.accordion-header');
    header.addEventListener('click', () => {
        const openItem = document.querySelector('.accordion-item.active');

        if (openItem && openItem !== item) {
            openItem.classList.remove('active');
        }

        item.classList.toggle('active');
    });
});

document.getElementById('contactForm').addEventListener('submit', function(event) {

    const nombre = document.getElementById('nombre').value.trim();
    const edad = document.getElementById('edad').value.trim();
    const profesion = document.getElementById('profesion').value.trim();
    const correo = document.getElementById('correo').value.trim();
    const frecuencia = document.getElementById('frecuencia').value.trim();
    const importancia = document.getElementById('importancia').value.trim();
    const conocimiento = document.getElementById('conocimiento').value.trim();
    const objetivos = document.getElementById('objetivos').value.trim();

    let errores = [];

    if (!nombre) errores.push("El campo 'Nombre Completo' es obligatorio.");
    if (!edad || isNaN(edad)) errores.push("El campo 'Edad' debe ser un número válido.");
    if (!profesion) errores.push("El campo 'Profesión / Actividad Principal' es obligatorio.");
    if (!correo || !validateEmail(correo)) errores.push("El campo 'Correo Electrónico' debe ser un correo válido.");
    if (!frecuencia) errores.push("Debes seleccionar una opción para la frecuencia con que visitas áreas naturales.");
    if (!importancia || isNaN(importancia) || importancia < 1 || importancia > 10) {
        errores.push("El campo 'Importancia de la conservación' debe ser un número entre 1 y 10.");
    }
    if (!conocimiento || isNaN(conocimiento) || conocimiento < 1 || conocimiento > 10) {
        errores.push("El campo 'Conocimiento sobre biodiversidad' debe ser un número entre 1 y 10.");
    }
    if (!objetivos) errores.push("El campo 'Objetivos personales' es obligatorio.");

    if (errores.length > 0) {
        alert("Por favor, corrige los siguientes errores:\n\n" + errores.join("\n"));
        event.preventDefault(); 
    }
});

function validateEmail(email) {
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return regex.test(email);
}

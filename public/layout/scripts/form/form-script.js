const items = document.querySelectorAll('.accordion-item');

items.forEach(item => {

    const header = item.querySelector('.accordion-header');
    header.addEventListener('click', () => {
        const openItem = document.querySelector('.accordion-item.active');

        // Cierra el acordeón abierto, si hay uno
        if (openItem && openItem !== item) {
            openItem.classList.remove('active');
        }

        // Activa el nuevo acordeón o cierra el actual si se vuelve a hacer clic
        item.classList.toggle('active');
    });
});
document.addEventListener("DOMContentLoaded", () => {
    document.getElementById("getTips").addEventListener("click", () => {
        fetch("http://localhost/MANA/api/getTips")  // Ajusta la ruta aquí
            .then(response => response.json())
            .then(data => {
                const tipsContainer = document.getElementById("tipsContainer");
                tipsContainer.innerHTML = data.tips.map(tip => `<p>${tip}</p>`).join("");
            })
            .catch(error => console.error("Error:", error));
    });
});

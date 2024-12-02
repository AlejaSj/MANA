$(document).ready(function () {
    loadCharts();
});

function loadCharts() {
    loadFrecuenciasChart();
    loadVoluntariadoChart();
    loadImportanciaChart();
    loadEdadImportanciaChart();
    loadHorasPorFrecuenciaChart();
    loadProfesionesChart();
    loadHorasArbolesChart();
}

function fetchData(type, callback) {
    $.ajax({
        url: 'fetch_data.php',
        method: 'GET',
        data: { type },
        dataType: 'json',
        success: callback,
        error: function (xhr, status, error) {
            console.error(`Error al obtener datos para ${type}:`, error);
        },
    });
}

function loadFrecuenciasChart() {
    fetchData('frecuencias', function (data) {
        const labels = data.map(item => item.frecuencia);
        const values = data.map(item => item.count);

        const ctx = document.getElementById('frecuenciasChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels,
                datasets: [{
                    label: 'Distribución de Frecuencias',
                    data: values,
                    backgroundColor: 'rgba(75, 192, 192, 0.6)',
                }]
            },
            options: { responsive: true, scales: { y: { beginAtZero: true } } }
        });
    });
}

function loadVoluntariadoChart() {
    fetchData('voluntariado', function (data) {
        const labels = data.map(item => item.voluntariado);
        const values = data.map(item => item.count);

        const ctx = document.getElementById('voluntariadoChart').getContext('2d');
        new Chart(ctx, {
            type: 'pie',
            data: {
                labels,
                datasets: [{
                    data: values,
                    backgroundColor: ['rgba(255, 99, 132, 0.6)', 'rgba(54, 162, 235, 0.6)', 'rgba(255, 206, 86, 0.6)']
                }]
            },
            options: { responsive: true }
        });
    });
}

function loadImportanciaChart() {
    fetchData('importancia', function (data) {
        const labels = data.map(item => item.frecuencia);
        const values = data.map(item => item.promedio);

        const ctx = document.getElementById('importanciaChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels,
                datasets: [{
                    label: 'Promedio de Importancia por Frecuencia',
                    data: values,
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 2,
                    fill: false
                }]
            },
            options: { responsive: true, scales: { y: { beginAtZero: true } } }
        });
    });
}

function loadEdadImportanciaChart() {
    fetchData('edad_importancia', function (data) {
        const ctx = document.getElementById('edadImportanciaChart').getContext('2d');
        new Chart(ctx, {
            type: 'scatter',
            data: {
                datasets: [{
                    label: 'Relación entre Edad e Importancia',
                    data: data.map(item => ({ x: item.edad, y: item.importancia })),
                    backgroundColor: 'rgba(255, 159, 64, 0.6)',
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: { type: 'linear', title: { display: true, text: 'Edad' } },
                    y: { title: { display: true, text: 'Importancia' } }
                }
            }
        });
    });
}

function loadHorasPorFrecuenciaChart() {
    fetchData('horas_por_frecuencia', function (data) {
        const labels = data.map(item => item.frecuencia);
        const values = data.map(item => item.total_horas);

        const ctx = document.getElementById('horasPorFrecuenciaChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels,
                datasets: [{
                    label: 'Horas Dedicadas por Frecuencia',
                    data: values,
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                }]
            },
            options: { responsive: true, scales: { y: { beginAtZero: true } } }
        });
    });
}

function loadProfesionesChart() {
    fetchData('profesiones', function (data) {
        const labels = data.map(item => item.profesion);
        const values = data.map(item => item.count);

        const ctx = document.getElementById('profesionesChart').getContext('2d');
        new Chart(ctx, {
            type: 'pie',
            data: {
                labels,
                datasets: [{
                    data: values,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.6)', 'rgba(54, 162, 235, 0.6)', 'rgba(255, 206, 86, 0.6)', 'rgba(75, 192, 192, 0.6)'
                    ]
                }]
            },
            options: { responsive: true }
        });
    });
}

function loadHorasArbolesChart() {
    fetchData('horas_arboles', function (data) {
        const labels = data.map(item => item.profesion);
        const horas = data.map(item => item.total_horas);
        const arboles = data.map(item => item.total_arboles);

        const ctx = document.getElementById('horasArbolesChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels,
                datasets: [
                    { label: 'Horas Dedicadas', data: horas, backgroundColor: 'rgba(75, 192, 192, 0.6)' },
                    { label: 'Árboles Plantados', data: arboles, backgroundColor: 'rgba(153, 102, 255, 0.6)' }
                ]
            },
            options: { responsive: true, scales: { y: { beginAtZero: true } } }
        });
    });
}

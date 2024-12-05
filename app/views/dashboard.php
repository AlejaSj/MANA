
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Visualización de Datos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="icon" href="/MANA/public/images/favicon-16x16.png" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .container{padding:30px 0;}
        .card {
            min-height: 300px;
            
        }
        
        .titulo {
        font-family: 'Poppins', sans-serif; 
        font-size: 4.5rem; 
        color: #2c3e50; 
        text-align: center; 
        margin: 20px 0; 
        text-transform: uppercase; 
        letter-spacing: 2px; 
        background: linear-gradient(90deg, #3498db, #9b59b6); 
        -webkit-background-clip: text; 
        -webkit-text-fill-color: transparent; 
        }
    </style>

<link rel="stylesheet" href="/MANA/public/layout/styles/landing/layout.css">
</head>
<body class="bg-light">
<div class="wrapper row1">
  <header id="header" class="hoc clear">
    <div id="logo" class="fl_left"> 
      
      <h1 class="logoname"><a href="/MANA/app/views/home.php"><span>M</span><span>A</span><span>N</span><span>A</span></a></h1>
     
    </div>
    <nav id="mainav" class="fl_right"> 
      
      <ul class="clear">
        <li class="active"><a href="/mana/">Inicio</a></li>
        <li><a href="http://localhost/MANA/app/views/AboutUs.php">Acerca de nosotros</a></li>
        <li><a href="/mana/#ContactUs">Contáctanos</a></li> 
        <li><a href="/mana/#Objective">Objetivos</a></li>
        <li><a href="https://github.com/AlejaSj/MANA/">Repositorio</a></li>
        <li><a href="http://localhost/MANA/app/views/dashboard.php">Estadísticas</a></li>
      </ul>
     
    </nav>
  </header>
</div>

<div class="container">
    <h1 class="titulo text-center mb-4">Dashboard </h1>
    <p class="text-center">
        Este dashboard presenta una serie de gráficos interactivos basados en los datos extraídos de la base de datos.
        Utiliza tecnologías modernas como Chart.js y Bootstrap para la visualización y diseño responsivo. Explora los
        paneles a continuación para obtener una perspectiva de los datos clave.
    </p>

    <div class="row g-4">
        
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Frecuencia que realizan actividades ecologicas</h5>
                    <canvas id="chartFrecuencias"></canvas>
                </div>
            </div>
        </div>

          
          <div class="col-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Importancia de tomar medidas sobre el medio ambiente</h5>
                    <canvas id="chartImportancia"></canvas>
                </div>
            </div>
        </div>
       
        <div class="col-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Horas Dedicadas vs. Árboles Plantados</h5>
                    <canvas id="horasArbolesChart"></canvas>
                </div>
            </div>
        </div>


        

       
        <div class="col-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Edad vs. Importancia</h5>
                    <canvas id="chartEdadImportancia"></canvas>
                </div>
            </div>
        </div>

       
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Realizan Voluntariado</h5>
                    <canvas id="chartVoluntariado"></canvas>
                </div>
            </div>
        </div>


        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body m-5">
                    <h5 class="card-title">¿Sabias que...</h5>
                    <br> <br> 
                    <p>...los bosques producen el 40% del oxígeno que respiramos?</p>
                    <p>...1 millón de especies están en peligro de extinción por la pérdida de hábitats?</p>
                    <p>...restaurar suelos degradados puede alimentar a 200 millones de personas?</p>
                    <p>...más del 25% de los medicamentos provienen de plantas de bosques?</p>
                    <p>...el 15% de las emisiones de CO₂ son causadas por la deforestación?</p>
                    <p>...el 75% de los cultivos alimenticios dependen de la polinización de insectos?</p>
                    <p>...proteger los ecosistemas terrestres ayuda a mitigar desastres naturales?</p>
                    <p>...las montañas proporcionan el 60-80% del agua dulce del mundo?</p>
                    <p>...cada minuto se pierden 27 campos de fútbol de bosque?*</p>
                    <p>...los humedales son uno de los ecosistemas más amenazados del planeta?</p>
                    <p>...los ecosistemas saludables pueden reducir enfermedades como el dengue y la malaria?</p>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
   
    function fetchDataAndRenderChart(type, chartId, chartType, labelsKey, dataKey, options = {}) {
        $.get(`http://localhost/MANA/app/models/fetch_data.php?type=${type}`, function(data) {
            const parsedData = JSON.parse(data);
            const labels = parsedData.map(item => item[labelsKey]);
            const values = parsedData.map(item => item[dataKey]);

            new Chart(document.getElementById(chartId), {
                type: chartType,
                data: {
                    labels: labels,
                    datasets: [{
                        label: type,
                        data: values,
                        borderWidth: 1,
                    }]
                },
                options: options
            });
        });
    }

    
    fetchDataAndRenderChart('frecuencias', 'chartFrecuencias', 'bar', 'frecuencia', 'count');
    fetchDataAndRenderChart('voluntariado', 'chartVoluntariado', 'pie', 'voluntariado', 'count');
    fetchDataAndRenderChart('importancia', 'chartImportancia', 'line', 'frecuencia', 'promedio', { tension: 0.4 });
    fetchDataAndRenderChart('edad_importancia', 'chartEdadImportancia', 'scatter', 'edad', 'importancia', {
        scales: {
            x: { title: { display: true, text: 'Edad' } },
            y: { title: { display: true, text: 'Importancia' } }
        }
    });

    

function loadHorasArbolesChart() {
    $.get('http://localhost/MANA/app/models/fetch_data.php?type=horas_arboles', function (data) {
        const parsedData = JSON.parse(data);
        const labels = parsedData.map(item => item.profesion);
        const horas = parsedData.map(item => item.total_horas);
        const arboles = parsedData.map(item => item.total_arboles);

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
            options: {
                responsive: true,
                scales: {
                    x: {
                        title: { display: true, text: 'Profesion' }
                    },
                    y: {
                        beginAtZero: true,
                        title: { display: true, text: 'Cantidad' }
                    }
                }
            }
        });
    });
}


loadHorasArbolesChart();

</script>

</body>
</html>

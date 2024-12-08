<?php
session_start();

if (!isset($_SESSION['logueado']) || $_SESSION['logueado'] !== true) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>ProductApp</title>
    <link rel="stylesheet" href="https://bootswatch.com/4/superhero/bootstrap.min.css">
  </head>
  <body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href=".">Gestion de Encuestados</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto"></ul>
          <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" name="search" id="search" type="search" placeholder="ID, nombre, correo" aria-label="Search">
            <button class="btn btn-success my-2 my-sm-0" type="submit">Buscar</button>
          </form>
      </div>
      <div>
        <a href="logout.php" class="btn btn-danger">Cerrar sesión</a>
      </div>
    </nav>

    <div class="container">
      <div class="row p-4">
        <div class="col-md-5">
          <div class="card">
            <div class="card-body">
              <form id="product-form">
                <input type="text" id="name" placeholder="Nombre" required>
                <input type="number" id="edad" placeholder="Edad" required>
                <input type="text" id="profesion" placeholder="Profesión" required>
                <input type="email" id="correo" placeholder="Correo" required>
                <input type="text" id="frecuencia" placeholder="Frecuencia" required>
                <input type="text" id="actividades" placeholder="Actividades" required>
                <input type="text" id="importancia" placeholder="Importancia" required>
                <input type="text" id="acciones" placeholder="Acciones" required>
                <input type="text" id="voluntariado" placeholder="Voluntariado" required>
                <input type="number" id="arboles" placeholder="Árboles" required>
                <input type="number" id="horas" placeholder="Horas" required>
                <input type="text" id="areas" placeholder="Áreas" required>
                <input type="text" id="conocimiento" placeholder="Conocimiento" required>
                <input type="text" id="apreder" placeholder="Aprender" required>
                <input type="text" id="informacion" placeholder="Información" required>
                <input type="text" id="objetivos" placeholder="Objetivos" required>
                <input type="text" id="cambios" placeholder="Cambios" required>
                <input type="text" id="mejorar" placeholder="Mejorar" required>
                <textarea id="comentarios" placeholder="Comentarios"></textarea>
                <button type="submit">Guardar</button>
            </form>
            
            </div>
          </div>
        </div>

        <div class="col-md-7">
          <div class="card my-4" id="product-result">
            <div class="card-body">
              <ul id="container"></ul>
            </div>
          </div>

          <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Edad</th>
                    <th>Profesión</th>
                    <th>Correo</th>
                    <th>Frecuencia</th>
                    <th>Actividades</th>
                    <th>Importancia</th>
                    <th>Acciones</th>
                    <th>Voluntariado</th>
                    <th>Árboles</th>
                    <th>Horas</th>
                    <th>Áreas</th>
                    <th>Conocimiento</th>
                    <th>Aprender</th>
                    <th>Información</th>
                    <th>Objetivos</th>
                    <th>Cambios</th>
                    <th>Mejorar</th>
                    <th>Comentarios</th>
                    <th>Creado</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody id="products">
            </tbody>
        </table>
        
        </div>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
      integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
      crossorigin="anonymous"></script>
    <script src="app.js"></script>
  </body>
</html>
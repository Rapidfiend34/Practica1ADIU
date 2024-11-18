<?php
    include "conexion.php";
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
            //devuelve las canciones con mayor popularidad de cada tipo de llaves, perfecto para meter en un grafico de barras
      $query = "SELECT c.nombre, c.popularity, c.llave
                FROM cancion c
                JOIN (
                    SELECT llave, MAX(popularity) AS max_popularity
                    FROM cancion
                    GROUP BY llave
                ) AS max_cancion ON c.llave = max_cancion.llave AND c.popularity = max_cancion.max_popularity
                ORDER by llave;";
      $res = mysqli_query($con, $query);
    ?>
    <script>
      document.addEventListener('DOMContentLoaded', function () {
    const chart = Highcharts.chart('container2', {
      chart: {
        type: 'bar',
        backgroundColor: 'rgb(52, 52, 49)'
      },
      title: {
        text: 'Canción más popular de cada tipo llave',
        style: {
          color:  'white' // Color del texto del eje Y
        }
      },
      yAxis: {
        title: {
          text: 'Popularidad [0-10]',
          style: {
          color: 'white' // Color del texto del eje Y
        }
        }
      },
      xAxis: {
        categories: ['llave 0', 'llave 1', 'llave 2', 'llave 3', 'llave 4', 'llave 5', 'llave 6', 'llave 7', 'llave 7', 'llave 8', 'llave 9', 'llave 10', 'llave 11'],
        labels: {
        style: {
          color: 'white' // Color de las etiquetas del eje X
        }
      }
    },
    legend: {
      itemStyle: {
        color: '#FFFFFF' // Cambia el color de las palabras en la leyenda a blanco

      }
    },
      series: [
        <?php
      $idx = 0;
      while ($r = mysqli_fetch_array($res)){
        // Inicializamos el array de datos para cada serie
        $data = array_fill(0, 12, 0);
        // Asignamos la popularidad a la posición correspondiente
        $data[$idx++] = $r['popularity']/10;
        
          echo "{";
        echo "name: '" . $r['nombre'] . "',";
        echo "data: " . json_encode($data) . ",";
        echo "},";
      }
      ?>]
    });
  });
    </script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <title>Bootstrap demo</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous">
    <link rel="stylesheet" href="estilos.css">
  </head>
  <body>
    <header>
      <nav id="cabecera" class="navbar navbar-expand-lg   navbar-dark bg-dark" style="position:relative height:10px">
        <div class="container-fluid" >
          <a class="navbar-brand" href="#">
            <img src="logo.png" alt="Logo enterprise"width="200" height="100">
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" style="color:white" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="https://ad.uib.es">UIB</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="https://www.kaggle.com/datasets/thebumpkin/spotify-top-100-country-9124-w-audio-features">DataLink</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button"
                  data-bs-toggle="dropdown" aria-expanded="false">
                  More
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="https://open.spotify.com/intl-es">Our official page</a></li>
                  <li><a class="dropdown-item" href="#">Another action</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="#">Something else
                      here</a></li>
                </ul>
              </li>
              <li class="nav-item">
                <a class="nav-link disabled" style="color:white"aria-disabled="true">Disabled</a>
              </li>
            </ul>
            <form class="d-flex" role="search">
              <input class="form-control me-2" id="buscador" type="search"
                placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success"
                type="submit">Search</button>
            </form>
          </div>
        </div>
      </nav>
    </header>
    <script src="index.js"></script>
    
      <div class="content-left">
        
      </div>
      <div id="contenedor" class="container text-center">
        <div  class="row .row-cols-auto">
          <!-- <div class="col"><img src="Cats_Test0.png" alt="Gato" width="auto" height="auto"></div>
          <d iv class="col"><img src="Cats_Test0.png" alt="Gato" width="auto" height="auto"></div>
          <div class="col"><img src="Cats_Test0.png" alt="Gato" width="auto" height="auto"></div>
          <div class="col"><img src="Cats_Test0.png" alt="Gato" width="auto" height="auto"></div> -->
          <div class="row">
              <div id="container2" class="col-12"></div>
              <!--<div id="container3" class="col-6"><img src="Cats_Test0.png" alt="Gato" width="auto" height="auto"></div>
              <div id="column" class="col-3"><img src="Cats_Test0.png" alt="Gato" width="auto" height="auto"></div>
              <div id="column" class="col-3"><img src="Cats_Test0.png" alt="Gato" width="auto" height="auto"></div>-->
              </div>
              <div class="row">
                <div id="column" class="col-4"><img src="Cats_Test0.png" alt="Gato" width="auto" height="auto"></div>
                <div id="column" class="col-8"><img src="Cats_Test0.png" alt="Gato" width="auto" height="auto"></div>
              </div>
              <div class="row">
                <div id="column" class="col-6"><img src="Cats_Test0.png" alt="Gato" width="auto" height="auto"></div>
                <div id="column" class="col-6"><img src="Cats_Test0.png" alt="Gato" width="auto" height="auto"></div>
          </div>
        </div>
      </div>
    
    <footer class="bg-dark text-light py-4">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <p>&copy; 2023 Your Website. All rights reserved.</p>
          </div>
          <div class="col-md-6 text-md-end">
            <a href="#" class="text-light me-3">Privacy Policy</a>
            <a href="#" class="text-light me-3">Terms of Service</a>
            <a href="#" class="text-light">Contact Us</a>
          </div>
        </div>
      </div>
    </footer>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"></script>
      
  </body>
  
</html>
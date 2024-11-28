<?php
include "conexion.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Top100CancionesSpotify</title>
  <link rel="stylesheet" href="estilos.css">
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
  $res1 = mysqli_query($con, $query);
  ?>
  <script src="https://code.highcharts.com/modules/exporting.js"></script>
  <script src="https://code.highcharts.com/modules/export-data.js"></script>
  <script src="https://code.highcharts.com/modules/accessibility.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      Grafica1();
    }); //Generacion graficas utilizando charts

    function Grafica1() {
      const chart = Highcharts.chart('container2', {
        accessibility: {
        enabled: true,
        describeSingleSeries: true, // Añade una descripción a las series si solo hay una
        description: 'Este gráfico muestra la Canción más popular de cada tipo llave',
        landmarkVerbosity: 'all', // Incluye descripciones completas en los puntos de referencia
      },
        chart: {
          type: 'bar',
          backgroundColor: 'rgb(52, 52, 49)'
        },
        title: {
          text: 'Canción más popular de cada tipo llave',
          style: {
            color: 'white' // Color del texto del eje Y
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
          while ($r = mysqli_fetch_array($res1)) {
            // Inicializamos el array de datos para cada serie
            $data = array_fill(0, 12, 0);
            // Asignamos la popularidad a la posición correspondiente
            $data[$idx++] = $r['popularity'] / 10;

            echo "{";
            echo "name: '" . $r['nombre'] . "',";
            echo "data: " . json_encode($data) . ",";
            echo "},";
          }
          ?>
        ]
      });
    }
  </script>

  <?php
  //Comando para sql donde se clasifican los albuumes en 3 categorias dependiendod e la duracion
  $query = "SELECT 
    categoria,
    COUNT(*) AS cantidad_albumes
FROM (
    SELECT 
        CASE 
            WHEN AVG(c.duration / 60000.0) > 3.75 THEN 'Alta duración'
            WHEN AVG(c.duration / 60000.0) BETWEEN 3 AND 4 THEN 'Duración intermedia'
            ELSE 'Baja duración'
        END AS categoria
    FROM 
        album a
    JOIN 
        cancion c ON a.id = c.id_album
    GROUP BY 
        a.id, a.nombre
) AS subconsulta
GROUP BY 
    categoria;";
  $res2 = mysqli_query($con, $query);

  // Inicializamos arrays para las categorías y las series
  $categories = [];
  $series_data = [];

  while ($r = mysqli_fetch_assoc($res2)) {
    $categories[] = $r['categoria']; // Agregamos el nombre de la categoría
    $series_data[] = (float) $r['cantidad_albumes']; // Agregamos la cantidad de álbumes
  }
  ?>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      Grafica2();
    });

    function Grafica2() {
      const chart = Highcharts.chart('container3', {
        accessibility: {
        enabled: true,
        describeSingleSeries: true, // Añade una descripción a las series si solo hay una
        description: 'Este gráfico muestra los álbumes clasificados por duración',
        landmarkVerbosity: 'all', // Incluye descripciones completas en los puntos de referencia
      },
        chart: {
          type: 'pie',
          backgroundColor: 'rgb(52, 52, 49)'
        },
        title: {
          text: 'Álbumes clasificados por duración',
          style: {
            color: 'white'
          }
        },
        plotOptions: {
          pie: {
            dataLabels: {
              enabled: true, // Habilitar etiquetas de datos
              format: '{point.name}: {point.y}', // Aquí se muestra el nombre de la categoría y la cantidad de álbumes
              style: {
                color: 'white', // Color del texto de las etiquetas
                fontSize: '14px' // Tamaño de fuente
              }
            }
          }
        },
        legend: {
          itemStyle: {
            color: '#FFFFFF'
          }
        },
        series: [{
          name: 'Cantidad álbumes por duración',
          data: <?php
                // Crea un array con los datos y las categorías correspondientes
                $formatted_data = [];
                foreach ($categories as $index => $category) {
                  $formatted_data[] = ['name' => $category, 'y' => $series_data[$index]];
                }
                echo json_encode($formatted_data);  // Usa json_encode para pasar el array a JavaScript
                ?>,
        }]
      });
    }
  </script>
  <?php
  //devuelve las canciones con mayor popularidad de cada tipo de llaves, perfecto para meter en un grafico de barras
  $query = "SELECT c.id, c.nombre AS cancion, c.popularity, c.rank FROM cancion c ORDER BY rank DESC;";
  $res3 = mysqli_query($con, $query);
  $rank = [];
  $popularity = [];
  $name = [];

  while ($r = mysqli_fetch_assoc($res3)) {
    $rank[] = $r['rank']; // Agregamos el nombre de la categoría
    $popularity[] = (float) $r['popularity']; // Agregamos la cantidad de álbumes
    $name[] = $r['cancion'];
  }
  ?>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      Grafica3();
    });

    function Grafica3() {
      const nameValues = <?php echo json_encode($name); ?>;
      const xValues = <?php echo json_encode($rank); ?>;
      const yValues = <?php echo json_encode($popularity); ?>;
      const chart = Highcharts.chart('container4', {
        accessibility: {
        enabled: true,
        describeSingleSeries: true, // Añade una descripción a las series si solo hay una
        description: 'Este gráfico muestra la Popularidad del Top 100 canciones del momento',
        landmarkVerbosity: 'all', // Incluye descripciones completas en los puntos de referencia
      },
        chart: {
          type: 'line',
          backgroundColor: 'rgb(52, 52, 49)'
        },
        title: {
          text: 'Popularidad del Top 100 canciones del momento',
          style: {
            color: 'white' // Color del texto del eje Y
          }
        },
        yAxis: {
          title: {
            text: 'Popularidad [0-100]',
            style: {
              color: 'white' // Color del texto del eje Y
            }
          }
        },
        xAxis: {
          categories: xValues,
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
        series: [{
          name: 'Popularidad de Canciones',
          data: yValues,
          color: '#FF5733' // Color de la línea
        }]
      });
    }
    //Utilizamos scripts de bootstrap
  </script>

  <script src="https://code.highcharts.com/highcharts.js"></script>
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
    crossorigin="anonymous">

</head>

<body>
  <header>
    <nav id="cabecera" class="navbar navbar-expand-lg   navbar-dark bg-dark" style="position:relative height:5px">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">
          <img src="images/logo.png" alt="Logo de Spotify" width="200" height="100">
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
              <a class="nav-link" id="home-link" aria-current="page" href="#">Home</a>
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
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="#">Something else
                    here</a></li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" style="color:white" aria-disabled="true">Disabled</a>
            </li>
            <li class="nav-item">
              <h1 id="titulo"><a href="#"> Top 100 canciones </a> </h1>
            </li>
          </ul>
          <form class="d-flex" role="search">
            <input class="form-control me-2" id="buscador" type="search"
              placeholder="Search" aria-label="Barra navegadora">
            <button class="btn btn-outline-success"
              type="submit">Search</button>
          </form>
        </div>
      </div>
    </nav>
  </header>
  <main>
    <div class="popup">
      <div class="tabs">
        <input type="radio" id="tab1" name="tab" value="Home" alt="Inicio" checked="true" />
        <label for="tab1" style="color: #1DB954">Home</label>
        <input type="radio" id="tab2" name="tab" value="TopS" />
        <label for="tab2" style="color: #1DB954" alt="Top 5 canciones">Top Songs</label>
        <input type="radio" id="tab3" name="tab" value="TopSI" />
        <label for="tab3" style="color: #1DB954" alt="Top 5 artistas">Top Singers</label>
        <input type="radio" id="tab4" name="tab" value="TopA" />
        <label for="tab4" style="color: #1DB954" alt="Top 5 albums">Top Albums</label>
        <div class="marker">
          <div id="top"></div>
          <div id="bottom"></div>
        </div>
      </div>
      <div id="right-panel">
        <script>
          document.querySelector('#right-panel').focus();
        </script>
        <div class="row .row-cols-auto">
          <div class="row">
            <div id="container2" class="col-12" alt="Gráfica de barras de canción más popular de cada tipo de llave"></div>
          </div>
          <div class="row">
            <div id="container3" class="col-4" alt="Gráfica de quesos de los albumes clasificados por duración"></div>
            <div id="container4" class="col-8" alt="Gráfica de línea de la popularidad de las canciones en el momento"></div>
          </div>
        </div>
      </div>
    </div>
    <script> 
    document.getElementById('home-link').addEventListener('click', function(event) {
      document.getElementById('right-panel').innerHTML = `<div  class="row .row-cols-auto">
          <div class="row">
              <div id="container2" class="col-12"></div>
              </div>
              <div class="row">
                <div id="container3" class="col-4"></div>
                <div id="container4" class="col-8"></div>
              </div>
              
          </div>`;
            Grafica1();
            Grafica2();
            Grafica3();
            radios.forEach(radio => {
        // Comprobar si el radio está seleccionado
        if (radio.checked) {
          // Desmarcar el radio seleccionado
          radio.checked = false;
        }
        if(radio.value==='Home'){
          radio.checked= true;
        }
      });
          
    });
    </script>
    <script>
      // Obtener los elementos de los botones de radio y el contenedor
      const radios = document.querySelectorAll('input[name="tab"]');
      const content = document.getElementById('right-panel');

      // Añadir un evento de cambio a cada botón de radio
      radios.forEach(radio => {
        radio.addEventListener('change', () => {
          document.getElementById('right-panel').innerHTML = '';
          // Actualizar el contenido del contenedor con el valor seleccionado
          if (radio.value === 'TopSI') {
            content.style.backgroundColor = "rgb(24, 24, 24)";
            // Actualizar contenido del panel derecho
            document.getElementById('right-panel').innerHTML = `
                      <div class = "container" id = "panel-Imagenes">
                        <span style = "--i:1"><a href="https://open.spotify.com/intl-es/artist/6M2wZ9GZgrQXHCFfjv46we" target="_blank"><img src="images/retrato1.png" alt="Dua Lipa" id = "foto"></a></span>
                        <span style = "--i:2"><a href="https://open.spotify.com/intl-es/artist/471C5Rq1AJAT1Y1Epd56XF" target="_blank"><img src="images/retrato2.png" alt="Martin Urrutia" id = "foto"></a></span>
                        <span style = "--i:3"><a href="https://open.spotify.com/intl-es/artist/4q3ewBCX7sLwd24euuV69X" target="_blank"><img src="images/retrato3.png" alt="Bad Bunny" id = "foto"></a></span>
                        <span style = "--i:4"><a href="https://open.spotify.com/intl-es/artist/790FomKkXshlbRYZFtlgla" target="_blank"><img src="images/retrato4.png" alt="Karol G" id = "foto"></a></span>
                        <span style = "--i:5"><a href="https://open.spotify.com/intl-es/artist/0TnOYISbd1XYRBk9myaseg" target="_blank"><img src="images/retrato5.png" alt="Pitbull" id = "foto"></a></span>
                      </div>
                        `;

          } else if (radio.value === 'Home') {
            content.style.backgroundColor = "rgb(24, 24, 24)";
            document.getElementById('right-panel').innerHTML = `<div  class="row .row-cols-auto">
          <div class="row">
              <div id="container2" class="col-12"></div>
              </div>
              <div class="row">
                <div id="container3" class="col-4"></div>
                <div id="container4" class="col-8"></div>
              </div>
              
          </div>`;
            Grafica1();
            Grafica2();
            Grafica3();
          } else if (radio.value === 'TopA') {
            content.style.backgroundColor = "rgb(24, 24, 24)";
            document.getElementById('right-panel').innerHTML = `
                      <div class = "container" id = "panel-Imagenes">
                        <span style = "--i:1"><a href="https://open.spotify.com/intl-es/album/0FqAaUEyKCyUNFE1uQPZ7i" target="_blank"><img src="images/album1.png" alt="album mañana será bonito" id = "foto"></a></span>
                        <span style = "--i:2"><a href="https://open.spotify.com/intl-es/album/0JeyP8r2hBxYIoxXv11XiX" target="_blank"><img src="images/album2.png" alt="album the moonlight edition" id = "foto"></a></span>
                        <span style = "--i:3"><a href="https://open.spotify.com/intl-es/album/3JfSxDfmwS5OeHPwLSkrfr" target="_blank"><img src="images/album3.png" alt="album heavy weight" id = "foto"></a></span>
                        <span style = "--i:4"><a href="https://open.spotify.com/intl-es/album/1xn54DMo2qIqBuMqHtUsFd" target="_blank"><img src="images/album4.png" alt="album Wembley edition" id = "foto"></a></span>
                        <span style = "--i:5"><a href="https://open.spotify.com/intl-es/album/7GX66xKJUvjRf0q4ldNiI5" target="_blank"><img src="images/album5.png" alt="album lo mejor de Juanjo Bona" id = "foto"></a></span>
                      </div>
                        `;
          } else {
            content.style.backgroundColor = "rgb(24, 24, 24)";
            document.getElementById('right-panel').innerHTML = `
                      <div class = "container" id = "panel-Imagenes">
                        <span style = "--i:1"><a href="https://open.spotify.com/intl-es/track/0j9azcT9Rj85v2PKLulWfs" target="_blank"><img src="images/cancion1.png" alt="cancion mis vidas" id = "foto"></a></span>
                        <span style = "--i:2"><a href="https://open.spotify.com/intl-es/track/1YwgKoqzARPFZuOPlvFEhL" target="_blank"><img src="images/cancion2.png" alt="cancion genesis" id = "foto"></a></span>
                        <span style = "--i:3"><a href="https://open.spotify.com/intl-es/track/23d8v6tU6lR77pFKsApMtF" target="_blank"><img src="images/cancion3.png" alt="cancion nadie sabe lo que va a pasar mañana" id = "foto"></a></span>
                        <span style = "--i:4"><a href="https://open.spotify.com/intl-es/track/6b8Be6ljOzmkOmFslEb23P" target="_blank"><img src="images/cancion4.png" alt="cancion 24k magic" id = "foto"></a></span>
                        <span style = "--i:5"><a href="https://open.spotify.com/intl-es/track/017PF4Q3l4DBUiWoXk4OWT" target="_blank"><img src="images/cancion5.png" alt="cancion don't start now" id = "foto"></a></span>
                      </div>
                        `;
          }

          // Enfocar el panel derecho
          document.querySelector('#right-panel').focus();
        });
      });
    </script>
  </main>
  <footer class="bg-dark text-light py-4">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <p>&copy; 2024 Your Website. All rights reserved.</p>
        </div>
        <div class="col-md-6 text-md-end">
          <a href="#" class="text-light me-3">Privacy Policy</a>
          <a href="#" class="text-light me-3">Terms of Service</a>
          <a href="#" class="text-light">Contact Us</a>
        </div>
      </div>
    </div>
  </footer>
</body>

</html>
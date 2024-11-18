<?php
    include "conexion.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Layout con Panel Izquierdo y Derecho</title>
  
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: Arial, sans-serif;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      overflow-y:hidden;
      background-image: url('fondo_g.jpg');
    }

    header, footer {
      background-color: #333;
      color: white;
      text-align: center;
      padding: 10px 0;
      background-color: #212529;
    }
    footer{
      position: fixed;
    bottom: 0;
    width: 100%;
    background-color: black;
    color: white;
    text-align: left;
    height:60px;
    }
    ::-webkit-scrollbar {
    width: 12px; /* Ancho de la barra */
    height: 12px; /* Alto de la barra en scroll horizontal */
}

/* Cambiar el fondo del track (el carril donde se desplaza) */
::-webkit-scrollbar-track {
    background: #555;
    border-radius: 10px;
}

/* Cambiar el estilo del thumb (la parte que se mueve) */
::-webkit-scrollbar-thumb {
    background: rgb(45, 42, 42);
    border-radius: 10px;
}

/* Cambiar el estilo del thumb cuando el usuario interactúa */
::-webkit-scrollbar-thumb:hover {
    background: #557;
}

/* Cambiar el botón de la scrollbar, si se usa */
::-webkit-scrollbar-button {
    background: #555;
    display: none; /* Ocultar si no quieres que se muestren */
}
    .navbar{
    height:60px;
}
    main {
      display: flex;
      flex: 1;
      overflow-y:hidden;
    }

    .left-panel {
      background-color: #f4f4f4;
      width: 20%;
      padding: 10px;
      border: 5px solid #212529;
    backdrop-filter: blur(10px);
    background-color: rgb(24, 24, 24);
   
    display: flex;
    justify-content: top;
    justify-items: center;
    color:white;
    flex-direction: column;
    overflow-y: auto;
    padding-top: 4px;
    padding-bottom:4px;
    }
    .navigation-List{

    }
    label{
  
  font-size: 24px;
  font-weight: 700; 
  cursor: pointer; 
  color: #FFFFF0; 
  opacity: .4; 
  transition: opacity .4s ease-in-out;
  display: block; 
  width: calc(100% - 48px) ;
  text-align: right; 
  z-index: 100; 
  user-select: none;
}
input[type="radio"]{
  display: none;
  width: 0;
}
label:hover, input[type="radio"]:checked+label {
  opacity: 1; 
}
.popup{
  width: 100%;
  
  min-height: 480px; 
  max-height: 87vh; 
  box-sizing: border-box; 
  border: 16px solid #212529;
  background-color: #f5ebe04f;
  overflow: hidden;
  box-shadow: 16px 16px 48px #2e364330; 
  display: flex;
    justify-content: top;
    justify-items: center;
}
.tabs{
  width: 100%;
  max-width: 240px;
  height: 100%;
  display: flex;
  flex-direction: column; 
  justify-content: space-evenly; 
  position: relative;
}
.marker{
  position: absolute; 
  width: 100%;
  height: 200%;
  display: flex; 
  flex-direction: column;
  top: calc(-100% );
  left: 0;
  transition: transform .2s ease-in-out; 
}
.marker #bottom, .marker #top{
  background-color: #212529;
  box-shadow: 32px 32px 48px #2e364315; 
}
.marker #top{
  height: calc(50%);
  margin-bottom: auto; 
  border-radius: 0 0 32px 0; 
}
.marker #bottom{
  height: calc(50% - 72px);
  border-radius: 0 32px 0 0; 
}
#tab1:checked ~ .marker{transform: translateY(calc(calc(45% / 6) * 1));}
#tab2:checked ~ .marker{transform: translateY(calc(calc(53% / 6) * 2));}
#tab3:checked ~ .marker{transform: translateY(calc(calc(57% / 6) * 3));}
#tab4:checked ~ .marker{transform: translateY(calc(calc(58% / 6) * 4));}
#tab1:hover ~ .marker{transform: translateY(calc(calc(45% / 6) * 1));}
#tab2:hover ~ .marker{transform: translateY(calc(calc(53% / 6) * 2));}
#tab3:hover ~ .marker{transform: translateY(calc(calc(57% / 6) * 3));}
#tab4:hover ~ .marker{transform: translateY(calc(calc(58% / 6) * 4));}
    .menu-Container{
      background-color:red;
      margin-top:1%;
    }

    #right-panel {
      flex: 1;
      padding: 10px;
    border: 5px solid #2e364330;
    backdrop-filter: blur(10px);
    background-color: rgb(24, 24, 24);
    
    height: 84vh;
    display: flex;
    justify-content: center;
    justify-items: center;
    overflow-y: auto;
    overflow-x:hidden;
    padding-top: 4px;
    padding-bottom:4px;
    padding-left:2%;
    }
    #container2{
    background-color: rgb(52, 52, 49);
    border: 2px solid #212529;
    border-radius: 8px;
    /*position:relative;*/
    /*height:25%;*/
    height:400px;
    margin-bottom:0;
    margin-top:1%;
   
}
#container3{
  position: relative;
    background-color: rgb(52, 52, 49);
    border: 2px solid #212529;
    border-radius: 8px;
    margin-right:1%;
    margin-top:0;
    /*position:relative;*/
    /*height:25%;*/
    height:400px;
    width:49%;
    
    
}
#container4{
  position: relative;
    background-color: rgb(52, 52, 49);
    border: 2px solid #212529;
    border-radius: 8px;
    margin-top:0;
    /*position:relative;*/
    /*height:25%;*/
    height:400px;
    width:49%;
    margin-left:1%;
   
    
}
.tittle-container{
  background-color:red;
  left:50%;
}
#titulo{
  color:#FAFDFF;
  font-size: 24px;
  margin-left:400px;
}
    footer {
      background-color: #212529;
    }
    #buscador{
    border-radius: 15px;
    border: none;
    background: white;
    color: #181818;
    padding-left: 30px;
    outline: none;
    background-image: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/7022/ios-search.svg);
    background-repeat: no-repeat;
    background-size: 10%;
    background-position: 5px;
}

#foto{
  height:200px;
  width:200px;
}
#panel-Imagenes{
  margin-top:200px;
  width:200px;
  height:200px;
  position:relative;
  transform-style: preserve-3d;
  transform: perspective(1000px);
  animation: gallery 30s linear infinite;
  cursor:pointer;
}
#panel-Imagenes span{
  position:absolute;
  width:100%;
  height:100%;
  transform-style: preserve-3d;
  transform: rotateY(calc(var(--i)*45deg)) translateZ(500px);
  -webkit-box-reflect: below 2.5px linear-gradient(transparent,transparent,rgba(3,3,3,0.2))
}

#panel-Imagenes span img {
  position: absolute;
  border-radius: 10px;
  border: 6px ridge #ccc;
}


@keyframes gallery {
  0% {
    transform: perspective(1000px) rotateY(0deg);
  }
  100% {
    transform: perspective(1000px) rotateY(360deg);
  }
}
  </style>
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
    <script>
      
      
      document.addEventListener('DOMContentLoaded', function() {
        Grafica1();
    
  });
  function Grafica1(){
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
      while ($r = mysqli_fetch_array($res1)){
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
  }
    </script>

<?php
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
document.addEventListener('DOMContentLoaded', function () {
    Grafica2();
});
function Grafica2 (){
const chart = Highcharts.chart('container3', {
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
                    enabled: true,  // Habilitar etiquetas de datos
                    format: '{point.name}: {point.y}',  // Aquí se muestra el nombre de la categoría y la cantidad de álbumes
                    style: {
                        color: 'white',  // Color del texto de las etiquetas
                        fontSize: '14px'  // Tamaño de fuente
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
    });}
</script>
<?php
            //devuelve las canciones con mayor popularidad de cada tipo de llaves, perfecto para meter en un grafico de barras
      $query = "SELECT c.id, c.nombre AS cancion, c.popularity, c.rank FROM cancion c ORDER BY rank DESC;";
      $res3 = mysqli_query($con, $query);
      $rank = [];
      $popularity = [];
      $name= [];

while ($r = mysqli_fetch_assoc($res3)) {
    $rank[] = $r['rank']; // Agregamos el nombre de la categoría
    $popularity[] = (float) $r['popularity']; // Agregamos la cantidad de álbumes
    $name[]=$r['cancion'];
}
    ?>
    <script>
      document.addEventListener('DOMContentLoaded', function () {
    Grafica3();
  });
  function Grafica3(){
    const nameValues= <?php echo json_encode($name); ?>;
    const xValues = <?php echo json_encode($rank); ?>;
    const yValues = <?php echo json_encode($popularity); ?>;
    const chart = Highcharts.chart('container4', {
      chart: {
        type: 'line',
        backgroundColor: 'rgb(52, 52, 49)'
      },
      title: {
        text: 'Popularidad del Top 100 canciones del momento',
        style: {
          color:  'white' // Color del texto del eje Y
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
      series:[{
            name: 'Popularidad de Canciones',
            data: yValues,
            color: '#FF5733'  // Color de la línea
        }]
    });
  }
    </script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <title>Bootstrap demo</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous">
    
</head>
<body>
<header>
      <nav id="cabecera" class="navbar navbar-expand-lg   navbar-dark bg-dark" style="position:relative height:5px">
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
                <a class="nav-link" aria-current="page" href="#">Home</a>
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
              <li class="nav-item">
              <h1 id="titulo"> Top 100 canciones </h1>
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
  <main>
    <div class="popup">
      <div class="tabs">
        <input type="radio" id="tab1" name="tab" value="Home" checked="true" />
        <label for="tab1">Home</label>
        <input type="radio" id="tab2" name="tab" value="TopS" />
        <label for="tab2">Top Songs</label>
        <input type="radio" id="tab3" name="tab" value="TopSI" />
        <label for="tab3">Top Singers</label>
        <input type="radio" id="tab4" name="tab" value="TopA" />
        <label for="tab4">Top Albums</label>
        <div class="marker">
          <div id="top"></div>
          <div id="bottom"></div>
        </div>
      </div>
      <div id="right-panel">
        <div  class="row .row-cols-auto">
          <div class="row">
              <div id="container2" class="col-12"></div>
              </div>
              <div class="row">
                <div id="container3" class="col-4"></div>
                <div id="container4" class="col-8"></div>
              </div>
              
          </div>
      </div>
    </div>
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
                  content.style.backgroundColor="rgb(24, 24, 24)";
                  document.getElementById('right-panel').innerHTML = `
                      <div class = "container" id = "panel-Imagenes">
                        <span style = "--i:1"><a href="https://open.spotify.com/intl-es/artist/6M2wZ9GZgrQXHCFfjv46we" target="_blank"><img src="retrato1.png" alt="retrato 1" id = "foto"></a></span>
                        <span style = "--i:2"><a href="https://open.spotify.com/intl-es/artist/471C5Rq1AJAT1Y1Epd56XF" target="_blank"><img src="retrato2.png" alt="retrato 2" id = "foto"></a></span>
                        <span style = "--i:3"><a href="https://open.spotify.com/intl-es/artist/4q3ewBCX7sLwd24euuV69X" target="_blank"><img src="retrato3.png" alt="retrato 3" id = "foto"></a></span>
                        <span style = "--i:4"><a href="https://open.spotify.com/intl-es/artist/790FomKkXshlbRYZFtlgla" target="_blank"><img src="retrato4.png" alt="retrato 4" id = "foto"></a></span>
                        <span style = "--i:5"><a href="https://open.spotify.com/intl-es/artist/0TnOYISbd1XYRBk9myaseg" target="_blank"><img src="retrato5.png" alt="retrato 5" id = "foto"></a></span>
                      </div>
                        `;

                } else if (radio.value === 'Home') {
                  content.style.backgroundColor="rgb(24, 24, 24)";
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
                } else if (radio.value === 'TopA'){
                  content.style.backgroundColor="rgb(24, 24, 24)";                 
                    document.getElementById('right-panel').innerHTML = `
                      <div class = "container" id = "panel-Imagenes">
                        <span style = "--i:1"><a href="https://open.spotify.com/intl-es/album/0FqAaUEyKCyUNFE1uQPZ7i" target="_blank"><img src="album1.png" alt="album 1" id = "foto"></a></span>
                        <span style = "--i:2"><a href="https://open.spotify.com/intl-es/album/0JeyP8r2hBxYIoxXv11XiX" target="_blank"><img src="album2.png" alt="album 2" id = "foto"></a></span>
                        <span style = "--i:3"><a href="https://open.spotify.com/intl-es/album/3JfSxDfmwS5OeHPwLSkrfr" target="_blank"><img src="album3.png" alt="album 3" id = "foto"></a></span>
                        <span style = "--i:4"><a href="https://open.spotify.com/intl-es/album/1xn54DMo2qIqBuMqHtUsFd" target="_blank"><img src="album4.png" alt="album 4" id = "foto"></a></span>
                        <span style = "--i:5"><a href="https://open.spotify.com/intl-es/album/7GX66xKJUvjRf0q4ldNiI5" target="_blank"><img src="album5.png" alt="album 5" id = "foto"></a></span>
                      </div>
                        `;
                } else {
                  content.style.backgroundColor="rgb(24, 24, 24)";
                  document.getElementById('right-panel').innerHTML = `
                      <div class = "container" id = "panel-Imagenes">
                        <span style = "--i:1"><a href="https://open.spotify.com/intl-es/track/0j9azcT9Rj85v2PKLulWfs" target="_blank"><img src="cancion1.png" alt="cancion 1" id = "foto"></a></span>
                        <span style = "--i:2"><a href="https://open.spotify.com/intl-es/track/1YwgKoqzARPFZuOPlvFEhL" target="_blank"><img src="cancion2.png" alt="cancion 2" id = "foto"></a></span>
                        <span style = "--i:3"><a href="https://open.spotify.com/intl-es/track/23d8v6tU6lR77pFKsApMtF" target="_blank"><img src="cancion3.png" alt="cancion 3" id = "foto"></a></span>
                        <span style = "--i:4"><a href="https://open.spotify.com/intl-es/track/6b8Be6ljOzmkOmFslEb23P" target="_blank"><img src="cancion4.png" alt="cancion 4" id = "foto"></a></span>
                        <span style = "--i:5"><a href="https://open.spotify.com/intl-es/track/017PF4Q3l4DBUiWoXk4OWT" target="_blank"><img src="cancion5.png" alt="cancion 5" id = "foto"></a></span>
                      </div>
                        `;
                }
            });
        });
    </script>
  </main>
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
</body>
</html>

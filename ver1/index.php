<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Red de investigación</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <link rel="stylesheet" href="styles/main.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css?family=Raleway:400,700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Raleway', Arial, Helvetica, sans-serif;
      background: #f4f6f8;
    }

    .navbar {
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .card {
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.07);
    }

    .carousel-caption {
      background: rgba(0, 0, 0, 0.4);
      border-radius: 8px;
      padding: 1rem;
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
    <div class="container">
      <a class="navbar-brand" href="index.php">
        <img src="img/logos/logo-main.png" height="60" alt="Logo">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link active" href="index.php">Inicio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="investigaciones.php">Investigaciones</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="miembros.php">Miembros</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contacto.php">Contacto</a>
        </ul>
      </div>
    </div>
  </nav>

  <div id="carouselExample" class="carousel slide mt-3" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="0" class="active" aria-current="true"
        aria-label="IA"></button>
      <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="1" aria-label="Computación"></button>
      <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="2" aria-label="Robótica"></button>
    </div>
    <div class="carousel-inner rounded shadow">
      <div class="carousel-item active">
        <img src="img/banners/ia.jpg" class="d-block w-100" alt="Inteligencia Artificial">
        <div class="carousel-caption d-none d-md-block">
          <h5>Inteligencia Artificial</h5>
          <p>Innovando en economía, medicina, ingeniería y más.</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="img/banners/computacion.jpg" class="d-block w-100" alt="Computación">
        <div class="carousel-caption d-none d-md-block">
          <h5>Visión por Computador</h5>
          <p>Soluciones inteligentes y automatizadas para la industria.</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="img/banners/robo.jpg" class="d-block w-100" alt="Robótica">
        <div class="carousel-caption d-none d-md-block">
          <h5>Robótica</h5>
          <p>Diseño y aplicación de autómatas para el futuro.</p>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Anterior</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Siguiente</span>
    </button>
  </div>

  <main class="container my-5">
    <div class="row g-4 justify-content-center">
      <div class="col-md-4">
        <div class="card h-100">
          <img src="img/main/im1.jpg" class="card-img-top" alt="IA">
          <div class="card-body">
            <h5 class="card-title">Inteligencia Artificial</h5>
            <p class="card-text">Los sistemas de IA actualmente son parte de la rutina en campos como economía, medicina,
              ingeniería, el transporte, las comunicaciones y la milicia, y se ha usado en gran variedad de programas
              informáticos, juegos de estrategia, como ajedrez de computador, y otros videojuegos.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card h-100">
          <img src="img/main/im2.jpg" class="card-img-top" alt="Visión por Computador">
          <div class="card-body">
            <h5 class="card-title">Visión por Computador</h5>
            <p class="card-text">La visión por computador abarca toda una disciplina de estudio dentro de la robótica e
              informática y cuyos avances han permitido el diseño de soluciones automatizadas inteligentes, dinámicas y
              versátiles, que están llevando a las marcas de vanguardia a conquistar objetivos cada vez más ambiciosos.
            </p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card h-100">
          <img src="img/main/im3.jpeg" class="card-img-top" alt="Robótica">
          <div class="card-body">
            <h5 class="card-title">Robótica</h5>
            <p class="card-text">La robótica es una disciplina que se ocupa del diseño, operación, manufacturación, estudio y
              aplicación de autómatas o robots. Para ello, combina la ingeniería mecánica, ingeniería eléctrica,
              ingeniería electrónica, ingeniería biomédica y las ciencias de la computación, así como otras disciplinas.
            </p>
          </div>
        </div>
      </div>
    </div>
  </main>

  <footer class="mt-5">
    <div class="container py-4">
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4">
        <div class="col mb-3">
          <h6>Acerca de</h6>
          <ul class="list-unstyled">
            <li><a href="acercade_quienes_somos.php">Quiénes somos</a></li>
            <li><a href="acercade_historia.php">Historia</a></li>
            <li><a href="#">Aviso de privacidad</a></li>
          </ul>
        </div>
        <div class="col mb-3">
          <h6>Ayuda</h6>
          <ul class="list-unstyled">
            <li><a href="#">Preguntas frecuentes</a></li>
            <li><a href="#">Contacto</a></li>
            <li><a href="#">Soporte técnico</a></li>
          </ul>
        </div>
        <div class="col mb-3">
          <h6>Síguenos</h6>
          <ul class="social-sprites">
            <li>
              <a class="facebook" href="#">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <i class="fa fa-facebook" aria-hidden="true"></i>
              </a>
            </li>
            <li>
              <a class="twitter" href="#">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <i class="fa fa-twitter" aria-hidden="true"></i>
              </a>
            </li>
            <li>
              <a class="instagram" href="#">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <i class="fa fa-instagram" aria-hidden="true"></i>
              </a>
            </li>
          </ul>
        </div>
        <div class="col mb-3">
          <h6>Contacto</h6>
          <ul class="list-unstyled">
            <li>Celaya, Guanajuato, México</li>
            <li>contacto@redinvestigacion.com</li>
            <li>+52 461 227 9093</li>
          </ul>
        </div>
      </div>
      <div class="text-center py-3">
        © 2025 Red de investigación. Todos los derechos reservados.
      </div>
    </div>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous"></script>
</body>

</html>
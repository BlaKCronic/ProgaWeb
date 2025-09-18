<?php
include_once("views/header.php");
?>

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

<?php
include_once("views/footer.php");
?>
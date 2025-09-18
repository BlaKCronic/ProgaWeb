<?php
include_once("views/header.php");
?>

  <main class="container my-5">
    <h2 class="mb-4 text-center">Investigaciones destacadas</h2>
    <div class="row g-4">
      <div class="col-md-6">
        <div class="card h-100">
          <img src="img/main/im1.jpg" class="card-img-top" alt="IA">
          <div class="card-body">
            <h5 class="card-title">Inteligencia Artificial en Medicina</h5>
            <p class="card-text">Proyecto enfocado en el diagnóstico asistido por IA para enfermedades raras. Utilizamos redes neuronales profundas para analizar imágenes médicas y mejorar la precisión diagnóstica.</p>
            <hr>
            <h6>¿Tienes dudas sobre este proyecto?</h6>
            <form>
              <div class="mb-2">
                <input type="text" class="form-control" placeholder="Tu nombre">
              </div>
              <div class="mb-2">
                <input type="email" class="form-control" placeholder="Tu correo">
              </div>
              <div class="mb-2">
                <textarea class="form-control" rows="2" placeholder="Escribe tu duda"></textarea>
              </div>
              <button type="submit" class="btn btn-primary btn-sm">Enviar duda</button>
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card h-100">
          <img src="img/main/im2.jpg" class="card-img-top" alt="Visión por Computador">
          <div class="card-body">
            <h5 class="card-title">Visión por Computador en Agricultura</h5>
            <p class="card-text">Desarrollo de sistemas de monitoreo de cultivos mediante drones y procesamiento de imágenes para optimizar el riego y detectar plagas de forma temprana.</p>
            <hr>
            <h6>¿Quieres aportar ideas o colaborar?</h6>
            <form>
              <div class="mb-2">
                <input type="text" class="form-control" placeholder="Tu nombre">
              </div>
              <div class="mb-2">
                <input type="email" class="form-control" placeholder="Tu correo">
              </div>
              <div class="mb-2">
                <textarea class="form-control" rows="2" placeholder="Describe tu aportación"></textarea>
              </div>
              <button type="submit" class="btn btn-success btn-sm">Enviar aportación</button>
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card h-100">
          <img src="img/main/im3.jpeg" class="card-img-top" alt="Robótica">
          <div class="card-body">
            <h5 class="card-title">Robótica en Manufactura</h5>
            <p class="card-text">Implementación de robots colaborativos para automatizar procesos industriales, mejorar la seguridad y aumentar la eficiencia en líneas de producción.</p>
            <hr>
            <h6>¿Tienes alguna queja o sugerencia?</h6>
            <form>
              <div class="mb-2">
                <input type="text" class="form-control" placeholder="Tu nombre">
              </div>
              <div class="mb-2">
                <input type="email" class="form-control" placeholder="Tu correo">
              </div>
              <div class="mb-2">
                <textarea class="form-control" rows="2" placeholder="Escribe tu queja o sugerencia"></textarea>
              </div>
              <button type="submit" class="btn btn-danger btn-sm">Enviar queja</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </main>

<?php
include_once("views/footer.php");
?>
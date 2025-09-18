<?php
include_once("views/header.php");
?>

  <main class="container my-5">
    <h2 class="mb-4 text-center">Contáctanos</h2>
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card shadow">
          <div class="card-body">
            <form>
              <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" placeholder="Tu nombre">
              </div>
              <div class="mb-3">
                <label for="correo" class="form-label">Correo electrónico</label>
                <input type="email" class="form-control" id="correo" placeholder="Tu correo">
              </div>
              <div class="mb-3">
                <label for="tipo" class="form-label">Motivo de contacto</label>
                <select class="form-select" id="tipo">
                  <option value="formarparte">Formar parte de la red</option>
                  <option value="duda">Duda</option>
                  <option value="aportacion">Aportación</option>
                  <option value="queja">Queja</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="mensaje" class="form-label">Mensaje</label>
                <textarea class="form-control" id="mensaje" rows="4" placeholder="Escribe tu mensaje"></textarea>
              </div>
              <button type="submit" class="btn btn-primary">Enviar mensaje</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </main>
<?php
include_once("views/footer.php");
?>
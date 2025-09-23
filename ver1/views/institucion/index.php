<main class="container my-5">
    <h2 class="mb-4 text-center">Instituciones</h2>
    <div class="row g-4 justify-content-center">
      <?php if (isset($data) && is_array($data)): ?>
        <?php foreach ($data as $institucion) : ?>
        <div class="col-md-4">
          <div class="card h-100 text-center">
            <img src="img/institucion/<?php echo htmlspecialchars($institucion['logotipo']);?>" class="card-img-top rounded-circle mx-auto mt-3" style="width:120px;height:120px;object-fit:cover;" alt="<?php echo htmlspecialchars($institucion['institucion']); ?>">
            <div class="card-body">
              <h5 class="card-title"><?php echo htmlspecialchars($institucion['institucion']); ?></h5>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="col-12">
          <div class="alert alert-info text-center">
            <h4>No hay instituciones registradas</h4>
            <p>Aún no se han registrado instituciones en el sistema.</p>
          </div>
        </div>
      <?php endif; ?>
    </div>
</main>
<main class="container my-5">
    <h2 class="mb-4 text-center">Instituciones</h2>
    <div class="row g-4 justify-content-center">
      <?php foreach ($instituciones as $institucion) : ?>
      <div class="col-md-4">
        <div class="card h-100 text-center">
          <img src="img/institucion/<?php echo $institucion['logotipo'];?>" class="card-img-top rounded-circle mx-auto mt-3" style="width:120px;height:120px;object-fit:cover;" alt="Miembro 1">
          <div class="card-body">
            <h5 class="card-title"> <?php echo $institucion['institucion']; ?> </h5>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </main>
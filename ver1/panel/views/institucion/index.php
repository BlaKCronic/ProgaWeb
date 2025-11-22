<h1>Instituciones</h1>
<div class="btn-group" role="group" aria-label="Basic mixed styles example">
    <a href="institucion.php?action=create" class="btn btn-success">Nuevo</a>
    <a href="reportes.php?action=InstitucionesInvestigadores" target="_blank" class="btn btn-primary">Imprimir</a>
</div>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Logotipo</th>
      <th scope="col">Institución</th>
      <th scope="col">Opciones</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data as $institucion): ?>
    <tr>
      <th scope="row"><?php echo $institucion['id_institucion']; ?></th>
      <td>
        <?php 
          $logotipo = $institucion['logotipo'];
          if ($logotipo && strpos($logotipo, 'data:image/') === 0) {
              $srcImagen = $logotipo;
          } else if ($logotipo) {
              $srcImagen = "../img/institucion/" . $logotipo;
          }
        ?>
        <img src="<?php echo $srcImagen; ?>" width="75" height="75" class="rounded-circle" alt="logo" style="object-fit: cover;">
      </td>
      <td><?php echo htmlspecialchars($institucion['institucion']); ?></td>
      <td>
        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
            <a href="institucion.php?action=update&id=<?php echo $institucion['id_institucion']; ?>" class="btn btn-warning">Editar</a>
            <a href="institucion.php?action=delete&id=<?php echo $institucion['id_institucion']; ?>" class="btn btn-danger" onclick="return confirm('¿Está seguro de eliminar esta institución?')">Eliminar</a>
        </div>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
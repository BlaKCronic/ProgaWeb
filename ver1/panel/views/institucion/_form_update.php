<h1>Modificar Institución</h1>
<form method="POST" enctype="multipart/form-data" action="institucion.php?action=update&id=<?php echo $id; ?>">
    <div class="text-center mb-3">
        <?php 
          $logotipo = isset($data['logotipo']) ? $data['logotipo'] : '';
          if ($logotipo && strpos($logotipo, 'data:image/') === 0) {
              $srcImagen = $logotipo;
          } else if ($logotipo) {
              $srcImagen = "../img/institucion/" . $logotipo;
          }
        ?>
        <img src="<?php echo $srcImagen; ?>" width="100" height="100" class="rounded-circle" alt="logo" style="object-fit: cover;" id="preview-logo">
    </div>
    <div class="mb-3">
        <label for="institucion" class="form-label">Nombre de la Institución</label>
        <input type="text" class="form-control" id="institucion" name="institucion" value="<?php echo isset($data['institucion']) ? htmlspecialchars($data['institucion']) : ''; ?>" placeholder="TecNM" required>
    </div>
    <div class="mb-3">
        <label for="logotipo" class="form-label">Logotipo</label>
        <input type="file" class="form-control" id="logotipo" name="logotipo" accept="image/*" onchange="previewImage(this)">
        <small class="form-text text-muted">Deje el campo vacío si no desea cambiar el logotipo. Formatos: JPG, PNG, GIF, WebP, SVG (máx 5MB)</small>
    </div>
    <div class="mb-3">
        <input type="submit" class="btn btn-success" id="enviar" name="enviar" value="Guardar">
        <a href="institucion.php" class="btn btn-secondary">Cancelar</a>
    </div>
</form>
<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview-logo').src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
<h1>Nueva Institución</h1>
<form method="POST" enctype="multipart/form-data" action="institucion.php?action=create">
    <div class="text-center mb-3">
        <img src="../img/institucion/default.png" width="100" height="100" class="rounded-circle" alt="preview" style="object-fit: cover; border: 2px dashed #ccc;" id="preview-logo">
        <p class="text-muted small mt-2">Vista previa del logotipo</p>
    </div>
    <div class="mb-3">
        <label for="institucion" class="form-label">Nombre de la Institución</label>
        <input type="text" class="form-control" id="institucion" name="institucion" placeholder="TecNM" required>
    </div>
    <div class="mb-3">
        <label for="logotipo" class="form-label">Logotipo</label>
        <input type="file" class="form-control" id="logotipo" name="logotipo" accept="image/*" onchange="previewImage(this)" required>
        <small class="form-text text-muted">Formatos permitidos: JPG, PNG, GIF, WebP, SVG (máx 5MB)</small>
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
            document.getElementById('preview-logo').style.border = 'none';
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
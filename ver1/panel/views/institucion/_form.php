<h1>Nueva Institución</h1>
<form method="POST" enctype="multipart/form-data" action="institucion.php?action=create">
    <div class="mb-3">
        <label for="institucion" class="form-label">Nombre de la Institución</label>
        <input type="text" class="form-control" id="institucion" name="institucion" placeholder="TecNM" required>
    </div>
    <div class="mb-3">
        <label for="logotipo" class="form-label">Logotipo</label>
        <input type="file" class="form-control" id="logotipo" name="logotipo" placeholder="logo.png">
    </div>
    <div class="mb-3">
        <input type="submit" class="btn btn-success" id="enviar" name="enviar" value="Guardar">
        <a href="institucion.php" class="btn btn-secondary">Cancelar</a>
    </div>
</form>
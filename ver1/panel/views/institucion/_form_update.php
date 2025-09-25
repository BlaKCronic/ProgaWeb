<h1> Modificar Institución </h1>
<form method = "POST" action = "institucion.php?action=update&id_institucion=<?php echo $id_institucion ?>">
    <div class="mb-3">
        <label for="Institucion" class="form-label">Nombre de la Institución</label>
        <input type="text" class="form-control" id="Institucion" name="institucion" value="<?php echo $data['institucion'] ?>" placeholder="Nombre de la Institución" required>
    </div>
    <div class="mb-3">
        <label for="Logotipo" class="form-label">Logotipo</label>
        <input type="text" class="form-control" id="Logotipo" name="logotipo" value="<?php echo $data['logotipo'] ?>" placeholder="Logotipo" required>
    </div>
    <div class="mb-3">
        <input type="submit" class="btn btn-success" id="Enviar" name="enviar" value="Guardar">
    </div>
</form>
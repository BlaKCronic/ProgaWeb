<h1> Modificar Tratamiento </h1>
<form method = "POST" action = "tratamiento.php?action=update">
    <input type="hidden" name="id_tratamiento" value="<?php echo $data['id_tratamiento']; ?>">
    <div class="mb-3">
        <label for="Tratamiento" class="form-label">Nombre del Tratamiento</label>
        <input type="text" class="form-control" id="Tratamiento" name="tratamiento" value="<?php echo $data['tratamiento']; ?>" placeholder="Nombre del Tratamiento" required>
    </div>
    <div class="mb-3">
        <input type="submit" class="btn btn-success" id="Enviar" name="enviar" value="Guardar">
        <a href="tratamiento.php" class="btn btn-secondary">Cancelar</a>
    </div>
</form>
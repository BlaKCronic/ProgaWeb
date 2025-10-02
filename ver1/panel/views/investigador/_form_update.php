<h1> Modificar Investigador </h1>
<form method = "POST" action = "investigador.php?action=update">
    <input type="hidden" name="id_investigador" value="<?php echo $data['id_investigador']; ?>">
    <div class="mb-3">
        <label for="PrimerApellido" class="form-label">Primer Apellido</label>
        <input type="text" class="form-control" id="PrimerApellido" name="primer_apellido" value="<?php echo $data['primer_apellido']; ?>" placeholder="Primer Apellido" required>
    </div>
    <div class="mb-3">
        <label for="SegundoApellido" class="form-label">Segundo Apellido</label>
        <input type="text" class="form-control" id="SegundoApellido" name="segundo_apellido" value="<?php echo $data['segundo_apellido']; ?>" placeholder="Segundo Apellido" required>
    </div>
    <div class="mb-3">
        <label for="Nombre" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="Nombre" name="nombre" value="<?php echo $data['nombre']; ?>" placeholder="Nombre" required>
    </div>
    <div class="mb-3">
        <label for="Fotografia" class="form-label">Fotografía</label>
        <input type="text" class="form-control" id="Fotografia" name="fotografia" value="<?php echo $data['fotografia']; ?>" placeholder="Fotografía" required>
    </div>
    <div class="mb-3">
        <label for="Institucion" class="form-label">Institución</label>
        <input type="text" class="form-control" id="Institucion" name="institucion" value="<?php echo $data['institucion']; ?>" placeholder="Institución" required>
    </div>
    <div class="mb-3">
        <label for="Semblanza" class="form-label">Semblanza</label>
        <textarea class="form-control" id="Semblanza" name="semblanza" placeholder="Semblanza" required><?php echo $data['semblanza']; ?></textarea>
    </div>
    <div class="mb-3">
        <label for="Tratamiento" class="form-label">Tratamiento</label>
        <input type="text" class="form-control" id="Tratamiento" name="tratamiento" value="<?php echo $data['tratamiento']; ?>" placeholder="Tratamiento" required>
    </div>
    <div class="mb-3">
        <input type="submit" class="btn btn-success" id="Enviar" name="enviar" value="Guardar">
        <a href="investigador.php" class="btn btn-secondary">Cancelar</a>
    </div>
</form>
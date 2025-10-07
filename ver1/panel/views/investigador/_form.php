<h1> Nuevo Investigador </h1>
<form method = "POST" action = "investigador.php?action=create">
    <div class="mb-3">
        <label for="PrimerApellido" class="form-label">Primer Apellido</label>
        <input type="text" class="form-control" id="PrimerApellido" name="primer_apellido" placeholder="Primer Apellido" required>
    </div>
    <div class="mb-3">
        <label for="SegundoApellido" class="form-label">Segundo Apellido</label>
        <input type="text" class="form-control" id="SegundoApellido" name="segundo_apellido" placeholder="Segundo Apellido" required>
    </div>
    <div class="mb-3">
        <label for="Nombre" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="Nombre" name="nombre" placeholder="Nombre" required>
    </div>
    <div class="mb-3">
        <label for="Fotografia" class="form-label">Fotografía</label>
        <input type="text" class="form-control" id="Fotografia" name="fotografia" placeholder="Fotografía" required>
    </div>
    <div class="mb-3">
        <label for="Semblanza" class="form-label">Semblanza</label>
        <textarea class="form-control" id="Semblanza" name="semblanza" placeholder="Semblanza" required></textarea>
    </div>
    <div class="mb-3">
        <label for="Institucion" class="form-label">Institución</label>
        <select class="form-select" id="Institucion" name="id_institucion" required>
            <option value="">Seleccione una institución</option>
            <?php foreach ($instituciones as $institucion): ?>
                <option value="<?php echo $institucion['id_institucion']; ?>"><?php echo $institucion['institucion']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="Tratamiento" class="form-label">Tratamiento</label>
        <select class="form-select" id="Tratamiento" name="id_tratamiento" required>
            <option value="">Seleccione un tratamiento</option>
            <?php foreach ($tratamientos as $tratamiento): ?>
                <option value="<?php echo $tratamiento['id_tratamiento']; ?>"><?php echo $tratamiento['tratamiento']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <input type="submit" class="btn btn-success" id="Enviar" name="enviar" value="Guardar">
        <a href="investigador.php" class="btn btn-secondary">Cancelar</a>
    </div>
</form>
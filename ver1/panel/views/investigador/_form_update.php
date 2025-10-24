<h1>Modificar Investigador</h1>
<form method="POST" enctype="multipart/form-data" action="investigador.php?action=update&id=<?php echo $id; ?>">
    <div class="text-center mb-3">
        <img src="../img/investigadores/<?php echo $data['fotografia'];?>" width="120" height="120" class="rounded-circle" alt="foto">
    </div>
    <div class="mb-3">
        <label for="primer_apellido" class="form-label">Primer apellido</label>
        <input type="text" class="form-control" id="primer_apellido" name="primer_apellido" value="<?php echo isset($data['primer_apellido']) ? $data['primer_apellido'] : ''; ?>" placeholder="Primer apellido" required>
    </div>
    <div class="mb-3">
        <label for="segundo_apellido" class="form-label">Segundo apellido</label>
        <input type="text" class="form-control" id="segundo_apellido" name="segundo_apellido" value="<?php echo isset($data['segundo_apellido']) ? $data['segundo_apellido'] : ''; ?>" placeholder="Segundo apellido" required>
    </div>
    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo isset($data['nombre']) ? $data['nombre'] : ''; ?>" placeholder="Nombre" required>
    </div>
    <div class="mb-3">
        <label for="fotografia" class="form-label">Fotografía</label>
        <input type="file" class="form-control" id="fotografia" name="fotografia">
        <small class="form-text text-muted">Deje el campo vacío si no desea cambiar la fotografía</small>
    </div>
    <div class="mb-3">
        <label for="semblanza" class="form-label">Semblanza</label>
        <textarea class="form-control" id="semblanza" name="semblanza" rows="3"><?php echo isset($data['semblanza']) ? $data['semblanza'] : ''; ?></textarea>
    </div>
    <div class="mb-3">
        <label for="id_institucion" class="form-label">Institución</label>
        <select name="id_institucion" id="id_institucion" class="form-select" required>
            <option value="" disabled>Seleccione una institución</option>
            <?php foreach ($instituciones as $institucion): ?>
                <option value="<?php echo($institucion['id_institucion']) ?>" 
                    <?php echo (isset($data['id_institucion']) && $data['id_institucion'] == $institucion['id_institucion']) ? 'selected' : ''; ?>>
                    <?php echo($institucion['institucion']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="id_tratamiento" class="form-label">Tratamiento</label>
        <select name="id_tratamiento" id="id_tratamiento" class="form-select" required>
            <option value="" disabled>Seleccione un tratamiento</option>
            <?php foreach ($tratamientos as $tratamiento): ?>
                <option value="<?php echo($tratamiento['id_tratamiento']) ?>" 
                    <?php echo (isset($data['id_tratamiento']) && $data['id_tratamiento'] == $tratamiento['id_tratamiento']) ? 'selected' : ''; ?>>
                    <?php echo($tratamiento['tratamiento']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <input type="submit" class="btn btn-success" id="enviar" name="enviar" value="Guardar">
        <a href="investigador.php" class="btn btn-secondary">Cancelar</a>
    </div>
</form>
<h1>Modificar Usuario</h1>
<form method="POST" action="usuario.php?action=update&id=<?php echo $id; ?>">
    <div class="mb-3">
        <label for="correo" class="form-label">Correo electrónico</label>
        <input type="email" class="form-control" id="correo" name="correo" value="<?php echo isset($data['correo']) ? $data['correo'] : ''; ?>" placeholder="usuario@ejemplo.com" required>
    </div>
    <div class="mb-3">
        <label for="contrasena" class="form-label">Nueva Contraseña</label>
        <input type="password" class="form-control" id="contrasena" name="contrasena" placeholder="Dejar en blanco para mantener la actual">
        <small class="form-text text-muted">Deje el campo vacío si no desea cambiar la contraseña</small>
    </div>
    <div class="mb-3">
        <input type="submit" class="btn btn-success" id="enviar" name="enviar" value="Guardar">
        <a href="usuario.php" class="btn btn-secondary">Cancelar</a>
    </div>
</form>
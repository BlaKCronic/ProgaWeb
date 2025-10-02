<h1> Nuevo Tratamiento </h1>
<form method = "POST" action = "tratamiento.php?action=create">
    <div class="mb-3">
        <label for="Tratamiento" class="form-label">Nombre del Tratamiento</label>
        <input type="text" class="form-control" id="Tratamiento" name="tratamiento" placeholder="Nombre del Tratamiento" required>
    </div>
    <div class="mb-3">
        <input type="submit" class="btn btn-success" id="Enviar" name="enviar" value="Guardar">
        <a href="tratamiento.php" class="btn btn-secondary">Cancelar</a>
    </div>
</form>
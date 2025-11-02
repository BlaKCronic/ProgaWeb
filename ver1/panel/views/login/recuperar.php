<div class="login-container">
    <div class="login-header">
        <h2>Recuperar Contraseña</h2>
        <p>Ingrese su correo electrónico</p>
    </div>

    <form action="login.php?action=cambio" method="post">
        <div class="mb-3">
            <label for="correo" class="form-label">Correo Electrónico</label>
            <input name="correo" type="email" class="form-control" id="correo" placeholder="correo@ejemplo.com" required>
            <small class="form-text text-muted">
                Se enviará un enlace de recuperación a este correo
            </small>
        </div>
        
        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary btn-lg" name="enviar">Enviar enlace de recuperación</button>
        </div>
        
        <div class="text-center mt-3">
            <a href="login.php" class="text-decoration-none">Volver al inicio de sesión</a>
        </div>
    </form>
</div>
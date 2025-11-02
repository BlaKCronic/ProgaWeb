<div class="login-container">
    <div class="login-header">
        <h2>Iniciar Sesión</h2>
        <p>Panel de Administración</p>
    </div>

    <form action="login.php?action=login" method="post">
        <div class="mb-3">
            <label for="correo" class="form-label">Correo Electrónico</label>
            <input name="correo" type="email" class="form-control" id="correo" placeholder="correo@ejemplo.com" required>
        </div>
        
        <div class="mb-3">
            <label for="contrasena" class="form-label">Contraseña</label>
            <input name="contrasena" type="password" class="form-control" id="contrasena" placeholder="••••••••" required>
        </div>
        
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="recordar">
            <label class="form-check-label" for="recordar">
                Recordar sesión
            </label>
        </div>
        
        <div class="d-grid">
            <button type="submit" class="btn btn-primary btn-lg" name="enviar">Entrar</button>
        </div>
        
        <div class="text-center mt-3">
            <a href="login.php?action=recuperar" class="text-decoration-none d-block mb-2">¿Olvidaste tu contraseña?</a>
            <a href="../index.php" class="text-decoration-none">Volver al sitio principal</a>
        </div>
    </form>
</div>
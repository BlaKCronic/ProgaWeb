<div class="login-container">
    <div class="login-header">
        <h2>Nueva Contraseña</h2>
        <p>Ingrese su nueva contraseña</p>
    </div>

    <form action="login.php?action=reestablecer" method="post">
        <input name="token" type="hidden" value="<?php echo isset($_GET['token']) ? $_GET['token'] : ''; ?>">
        <input name="correo" type="hidden" value="<?php echo isset($_GET['correo']) ? $_GET['correo'] : ''; ?>">
        
        <div class="mb-3">
            <label for="contrasena" class="form-label">Nueva Contraseña</label>
            <input name="contrasena" type="password" class="form-control" id="contrasena" placeholder="••••••••" required minlength="6">
            <small class="form-text text-muted">
                Mínimo 6 caracteres
            </small>
        </div>
        
        <div class="mb-3">
            <label for="contrasena_confirm" class="form-label">Confirmar Contraseña</label>
            <input type="password" class="form-control" id="contrasena_confirm" placeholder="••••••••" required minlength="6">
        </div>
        
        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary btn-lg" name="enviar">Cambiar Contraseña</button>
        </div>
        
        <div class="text-center mt-3">
            <a href="login.php" class="text-decoration-none">Volver al inicio de sesión</a>
        </div>
    </form>
</div>

<script>
document.querySelector('form').addEventListener('submit', function(e) {
    const pass = document.getElementById('contrasena').value;
    const passConfirm = document.getElementById('contrasena_confirm').value;
    
    if (pass !== passConfirm) {
        e.preventDefault();
        alert('Las contraseñas no coinciden');
        return false;
    }
});
</script>
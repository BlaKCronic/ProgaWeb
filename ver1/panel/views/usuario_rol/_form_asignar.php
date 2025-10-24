<div class="row">
  <div class="col-lg-8 mx-auto">
    <div class="card shadow">
      <div class="card-header bg-primary text-white">
        <h4 class="mb-0">
          <i class="fas fa-user-shield me-2"></i>
          Gestionar Roles de Usuario
        </h4>
      </div>
      <div class="card-body">
        <div class="alert alert-info">
          <div class="row align-items-center">
            <div class="col-auto">
              <i class="fas fa-user-circle fa-3x"></i>
            </div>
            <div class="col">
              <h5 class="mb-1">
                <strong>Usuario:</strong> <?php echo $usuario['correo']; ?>
              </h5>
              <p class="mb-0 small">
                <strong>ID:</strong> <?php echo $usuario['id_usuario']; ?>
              </p>
            </div>
          </div>
        </div>

        <form method="POST" action="usuario_rol.php?action=asignar">
          <input type="hidden" name="id_usuario" value="<?php echo $usuario['id_usuario']; ?>">
          
          <div class="mb-4">
            <label class="form-label">
              <strong><i class="fas fa-list-check me-2"></i>Selecciona los roles para este usuario:</strong>
            </label>
            
            <div class="card">
              <div class="card-body">
                <?php 
                $rolesActuales = array();
                foreach($rolesUsuario as $rolU){
                  $rolesActuales[] = $rolU['id_rol'];
                }
                
                foreach($todosRoles as $rol): 
                  $checked = in_array($rol['id_rol'], $rolesActuales) ? 'checked' : '';
                  $badge_class = '';
                  $icon = '';
                  
                  switch($rol['rol']){
                    case 'Administrador':
                      $badge_class = 'danger';
                      $icon = 'fa-crown';
                      break;
                    case 'Investigador':
                      $badge_class = 'primary';
                      $icon = 'fa-microscope';
                      break;
                    default:
                      $badge_class = 'secondary';
                      $icon = 'fa-user';
                  }
                ?>
                <div class="form-check form-switch mb-3 p-3 border rounded">
                  <input class="form-check-input" 
                         type="checkbox" 
                         name="roles[]" 
                         value="<?php echo $rol['id_rol']; ?>" 
                         id="rol_<?php echo $rol['id_rol']; ?>"
                         <?php echo $checked; ?>
                         style="width: 3em; height: 1.5em;">
                  <label class="form-check-label ms-2" for="rol_<?php echo $rol['id_rol']; ?>">
                    <h5 class="mb-1">
                      <span class="badge bg-<?php echo $badge_class; ?>">
                        <i class="fas <?php echo $icon; ?> me-2"></i>
                        <?php echo $rol['rol']; ?>
                      </span>
                    </h5>
                    <p class="text-muted small mb-0">
                      <?php 
                      switch($rol['rol']){
                        case 'Administrador':
                          echo 'Acceso completo al sistema y gestión de todos los módulos';
                          break;
                        case 'Investigador':
                          echo 'Acceso a módulos de investigación y gestión de proyectos';
                          break;
                        default:
                          echo 'Rol personalizado del sistema';
                      }
                      ?>
                    </p>
                  </label>
                </div>
                <?php endforeach; ?>
              </div>
            </div>
          </div>

          <div class="alert alert-warning">
            <i class="fas fa-info-circle me-2"></i>
          </div>

          <div class="d-flex justify-content-between">
            <a href="usuario_rol.php" class="btn btn-secondary">
              <i class="fas fa-arrow-left me-2"></i>Cancelar
            </a>
            <button type="submit" class="btn btn-success" name="enviar">
              <i class="fas fa-save me-2"></i>Guardar Cambios
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<style>
.form-check-input:checked {
  background-color: #0d6efd;
  border-color: #0d6efd;
}
.form-check {
  cursor: pointer;
  transition: background-color 0.2s;
}
.form-check:hover {
  background-color: #f8f9fa;
}
</style>
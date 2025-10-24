<h1><i class="fas fa-user-shield me-2"></i>Gestión de Roles de Usuarios</h1>
<p class="lead">Asigna o modifica los roles de acceso de cada usuario del sistema</p>

<div class="card shadow mb-4">
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-hover">
        <thead class="table-dark">
          <tr>
            <th scope="col" width="80">#</th>
            <th scope="col">Correo Electrónico</th>
            <th scope="col">Roles Asignados</th>
            <th scope="col" width="200">Opciones</th>
          </tr>
        </thead>
        <tbody>
          <?php if(count($data) > 0): ?>
            <?php foreach ($data as $usuario): ?>
            <tr>
              <th scope="row"><?php echo $usuario['id_usuario']; ?></th>
              <td>
                <i class="fas fa-envelope text-muted me-2"></i>
                <?php echo $usuario['correo']; ?>
              </td>
              <td>
                <?php 
                if($usuario['roles']): 
                  $roles = explode(', ', $usuario['roles']);
                  foreach($roles as $rol):
                    $badge_class = '';
                    switch($rol){
                      case 'Administrador':
                        $badge_class = 'bg-danger';
                        break;
                      case 'Investigador':
                        $badge_class = 'bg-primary';
                        break;
                      default:
                        $badge_class = 'bg-secondary';
                    }
                ?>
                  <span class="badge <?php echo $badge_class; ?> me-1">
                    <i class="fas fa-user-tag me-1"></i><?php echo $rol; ?>
                  </span>
                <?php 
                  endforeach;
                else: 
                ?>
                  <span class="badge bg-warning text-dark">
                    <i class="fas fa-exclamation-triangle me-1"></i>Sin roles asignados
                  </span>
                <?php endif; ?>
              </td>
              <td>
                <div class="btn-group" role="group">
                  <a href="usuario_rol.php?action=asignar&id=<?php echo $usuario['id_usuario']; ?>" 
                     class="btn btn-primary btn-sm" 
                     title="Gestionar roles">
                    <i class="fas fa-user-cog"></i> Gestionar
                  </a>
                </div>
              </td>
            </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="4" class="text-center py-4">
                <i class="fas fa-inbox fa-3x text-muted mb-3 d-block"></i>
                <p class="text-muted">No hay usuarios registrados en el sistema</p>
              </td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<style>
.badge {
  padding: 0.5em 0.75em;
  font-size: 0.875rem;
}
</style>
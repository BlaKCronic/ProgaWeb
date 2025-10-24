<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-4">
                <i class="fas fa-chart-line me-2"></i>Panel de Administración
            </h1>
            <p class="lead">Bienvenido, <?php echo isset($_SESSION['correo']) ? $_SESSION['correo'] : 'Usuario'; ?></p>
        </div>
    </div>

    <!-- Tarjetas de estadísticas -->
    <div class="row g-4 mb-4">
        <?php
        // Obtener estadísticas
        require_once("../models/investigador.php");
        require_once("../models/institucion.php");
        require_once("../models/tratamiento.php");
        require_once("../models/usuario.php");
        
        $appInvestigador = new Investigador();
        $appInstitucion = new Institucion();
        $appTratamiento = new Tratamiento();
        $appUsuario = new Usuario();
        
        $totalInvestigadores = count($appInvestigador->read());
        $totalInstituciones = count($appInstitucion->read());
        $totalTratamientos = count($appTratamiento->read());
        $totalUsuarios = count($appUsuario->read());
        ?>

        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-white-75 small">Investigadores</div>
                            <div class="h2 mb-0"><?php echo $totalInvestigadores; ?></div>
                        </div>
                        <div class="opacity-75">
                            <i class="fas fa-users fa-3x"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between small">
                    <a class="text-white text-decoration-none" href="investigador.php">Ver detalles</a>
                    <div class="text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-white-75 small">Instituciones</div>
                            <div class="h2 mb-0"><?php echo $totalInstituciones; ?></div>
                        </div>
                        <div class="opacity-75">
                            <i class="fas fa-university fa-3x"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between small">
                    <a class="text-white text-decoration-none" href="institucion.php">Ver detalles</a>
                    <div class="text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-white-75 small">Tratamientos</div>
                            <div class="h2 mb-0"><?php echo $totalTratamientos; ?></div>
                        </div>
                        <div class="opacity-75">
                            <i class="fas fa-user-tie fa-3x"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between small">
                    <a class="text-white text-decoration-none" href="tratamiento.php">Ver detalles</a>
                    <div class="text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card bg-info text-white shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-white-75 small">Usuarios</div>
                            <div class="h2 mb-0"><?php echo $totalUsuarios; ?></div>
                        </div>
                        <div class="opacity-75">
                            <i class="fas fa-user-cog fa-3x"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between small">
                    <a class="text-white text-decoration-none" href="usuario.php">Ver detalles</a>
                    <div class="text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Información de Roles -->
    <div class="row g-4 mb-4">
        <div class="col-lg-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-user-shield me-2"></i>Información de Sesión</h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless mb-0">
                        <tbody>
                            <tr>
                                <th width="140">Usuario:</th>
                                <td><?php echo isset($_SESSION['correo']) ? $_SESSION['correo'] : 'N/A'; ?></td>
                            </tr>
                            <tr>
                                <th>ID de Usuario:</th>
                                <td><?php echo isset($_SESSION['usuario_id']) ? $_SESSION['usuario_id'] : 'N/A'; ?></td>
                            </tr>
                            <tr>
                                <th>Roles:</th>
                                <td>
                                    <?php 
                                    if(isset($_SESSION['roles']) && count($_SESSION['roles']) > 0){
                                        foreach($_SESSION['roles'] as $rol){
                                            echo '<span class="badge bg-primary me-1">'.$rol.'</span>';
                                        }
                                    } else {
                                        echo '<span class="badge bg-secondary">Sin roles asignados</span>';
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Permisos:</th>
                                <td>
                                    <?php 
                                    if(isset($_SESSION['permisos']) && count($_SESSION['permisos']) > 0){
                                        foreach($_SESSION['permisos'] as $permiso){
                                            echo '<span class="badge bg-success me-1 mb-1">'.$permiso.'</span>';
                                        }
                                    } else {
                                        echo '<span class="badge bg-secondary">Sin permisos asignados</span>';
                                    }
                                    ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="fas fa-tasks me-2"></i>Acciones Rápidas</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="investigador.php?action=create" class="btn btn-outline-primary">
                            <i class="fas fa-plus me-2"></i>Nuevo Investigador
                        </a>
                        <a href="institucion.php?action=create" class="btn btn-outline-success">
                            <i class="fas fa-plus me-2"></i>Nueva Institución
                        </a>
                        <a href="tratamiento.php?action=create" class="btn btn-outline-warning">
                            <i class="fas fa-plus me-2"></i>Nuevo Tratamiento
                        </a>
                        <a href="usuario.php?action=create" class="btn btn-outline-info">
                            <i class="fas fa-plus me-2"></i>Nuevo Usuario
                        </a>
                        <hr>
                        <a href="../index.php" target="_blank" class="btn btn-outline-secondary">
                            <i class="fas fa-external-link-alt me-2"></i>Ver Sitio Público
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Últimos investigadores -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0"><i class="fas fa-list me-2"></i>Últimos Investigadores Registrados</h5>
                </div>
                <div class="card-body">
                    <?php
                    $investigadores = $appInvestigador->read();
                    if(count($investigadores) > 0):
                        $ultimosInvestigadores = array_slice(array_reverse($investigadores), 0, 5);
                    ?>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Foto</th>
                                    <th>Nombre Completo</th>
                                    <th>Institución</th>
                                    <th>Tratamiento</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($ultimosInvestigadores as $inv): ?>
                                <tr>
                                    <td><?php echo $inv['id_investigador']; ?></td>
                                    <td>
                                        <img src="../img/investigadores/<?php echo $inv['fotografia']; ?>" 
                                             width="40" height="40" class="rounded-circle" alt="foto">
                                    </td>
                                    <td>
                                        <?php echo $inv['tratamiento'].' '.$inv['nombre'].' '.$inv['primer_apellido'].' '.$inv['segundo_apellido']; ?>
                                    </td>
                                    <td><?php echo $inv['institucion']; ?></td>
                                    <td><?php echo $inv['tratamiento']; ?></td>
                                    <td>
                                        <a href="investigador.php?action=update&id=<?php echo $inv['id_investigador']; ?>" 
                                           class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center mt-3">
                        <a href="investigador.php" class="btn btn-primary">Ver Todos los Investigadores</a>
                    </div>
                    <?php else: ?>
                    <div class="alert alert-info mb-0">
                        <i class="fas fa-info-circle me-2"></i>
                        No hay investigadores registrados aún.
                        <a href="investigador.php?action=create" class="alert-link">Crear el primero</a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.card {
    transition: transform 0.2s;
}
.card:hover {
    transform: translateY(-5px);
}
.opacity-75 {
    opacity: 0.75;
}
</style>
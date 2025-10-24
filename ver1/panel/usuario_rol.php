<?php
require_once("../models/usuario_rol.php");
require_once("../models/usuario.php");
$app = new UsuarioRol();
$appUsuario = new Usuario();
$app->checarRol('Administrador');

$action = isset($_GET['action']) ? $_GET['action'] : 'read';
$data = array();

include_once("./views/header.php");

switch ($action) {
    case 'asignar':
        if (isset($_POST['enviar'])) {
            $id_usuario = $_POST['id_usuario'];
            $roles = isset($_POST['roles']) ? $_POST['roles'] : array();
            
            $resultado = $app->actualizarRoles($id_usuario, $roles);
            
            if ($resultado) {
                $alerta['mensaje'] = "Roles actualizados correctamente";
                $alerta['tipo'] = "success";
                include_once("./views/alert.php");
            } else {
                $alerta['mensaje'] = "Error al actualizar los roles";
                $alerta['tipo'] = "danger";
                include_once("./views/alert.php");
            }
            $data = $app->getUsuariosConRoles();
            include_once("./views/usuario_rol/index.php");
        } else {
            $id_usuario = isset($_GET['id']) ? $_GET['id'] : null;
            if ($id_usuario) {
                $usuario = $app->getUsuarioConRoles($id_usuario);
                
                if (method_exists($app, 'getTodosRoles')) {
                    $todosRoles = $app->getTodosRoles();
                } else {
                    $app->connect();
                    $stmt = $app->_DB->prepare("SELECT * FROM rol");
                    $stmt->execute();
                    $todosRoles = $stmt->fetchAll(PDO::FETCH_ASSOC);
                }

                $rolesUsuario = $app->getRolesByUsuario($id_usuario);
                include_once("./views/usuario_rol/_form_asignar.php");
            } else {
                $alerta['mensaje'] = "ID de usuario no válido";
                $alerta['tipo'] = "danger";
                include_once("./views/alert.php");
                $data = $app->getUsuariosConRoles();
                include_once("./views/usuario_rol/index.php");
            }
        }
        break;
    
    case 'agregar_rol':
        if (isset($_GET['id_usuario']) && isset($_GET['id_rol'])) {
            $id_usuario = $_GET['id_usuario'];
            $id_rol = $_GET['id_rol'];
            $row = $app->asignarRol($id_usuario, $id_rol);
            
            if ($row === 0) {
                $alerta['mensaje'] = "El usuario ya tiene ese rol asignado";
                $alerta['tipo'] = "warning";
                include_once("./views/alert.php");
            } else if ($row) {
                $alerta['mensaje'] = "Rol asignado correctamente";
                $alerta['tipo'] = "success";
                include_once("./views/alert.php");
            } else {
                $alerta['mensaje'] = "Error al asignar el rol";
                $alerta['tipo'] = "danger";
                include_once("./views/alert.php");
            }
        }
        $data = $app->getUsuariosConRoles();
        include_once("./views/usuario_rol/index.php");
        break;
    
    case 'quitar_rol':
        if (isset($_GET['id_usuario']) && isset($_GET['id_rol'])) {
            $id_usuario = $_GET['id_usuario'];
            $id_rol = $_GET['id_rol'];
            $row = $app->quitarRol($id_usuario, $id_rol);
            
            if ($row) {
                $alerta['mensaje'] = "Rol removido correctamente";
                $alerta['tipo'] = "success";
                include_once("./views/alert.php");
            } else {
                $alerta['mensaje'] = "Error al remover el rol";
                $alerta['tipo'] = "danger";
                include_once("./views/alert.php");
            }
        }
        $data = $app->getUsuariosConRoles();
        include_once("./views/usuario_rol/index.php");
        break;
    
    case 'read':
    default:
        $data = $app->getUsuariosConRoles();
        include_once("./views/usuario_rol/index.php");
        break;
}

include_once("./views/footer.php");
?>

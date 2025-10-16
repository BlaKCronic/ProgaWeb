<?php
require_once "../models/investigador.php";
include_once "../models/institucion.php";
include_once "../models/tratamiento.php";

$app = new Investigador();
$appInstitucion = new Institucion();
$appTratamiento = new Tratamiento();
$instituciones = $appInstitucion->read();
$tratamientos = $appTratamiento->read();
$action = isset($_GET['action']) ? $_GET['action'] : 'read';
$data = array();

include_once "./views/header.php";

switch ($action) {
    case 'create':
        if (isset($_POST['enviar'])) {
            $data['primer_apellido'] = $_POST['primer_apellido'];
            $data['segundo_apellido'] = $_POST['segundo_apellido'];
            $data['nombre'] = $_POST['nombre'];
            $data['id_institucion'] = $_POST['id_institucion'];
            $data['semblanza'] = $_POST['semblanza'];
            $data['id_tratamiento'] = $_POST['id_tratamiento'];
            
            $filas = $app->create($data);
            
            if ($filas > 0) {
                header("Location: investigador.php?success=created");
                exit();
            } else {
                header("Location: investigador.php?action=create&error=insert");
                exit();
            }
        } else {
            include_once "views/investigador/_form.php";
        }
        break;
    
    case 'update':
        if (isset($_POST['enviar'])) {
            $id = $_POST['id_investigador'];
            $data['primer_apellido'] = $_POST['primer_apellido'];
            $data['segundo_apellido'] = $_POST['segundo_apellido'];
            $data['nombre'] = $_POST['nombre'];
            $data['id_institucion'] = $_POST['id_institucion'];
            $data['semblanza'] = $_POST['semblanza'];
            $data['id_tratamiento'] = $_POST['id_tratamiento'];
            
            $row = $app->update($data, $id);
            
            if ($row > 0) {
                header("Location: investigador.php?success=updated");
                exit();
            } else {
                header("Location: investigador.php?action=update&id=$id&error=update");
                exit();
            }
        } else {
            $id_investigador = $_GET['id'];
            $data = $app->readOne($id_investigador);
            include_once "views/investigador/_form_update.php";
        }
        break;

    case 'delete':
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $filas = $app->delete($id);
            
            if ($filas > 0) {
                header("Location: investigador.php?success=deleted");
                exit();
            } else {
                header("Location: investigador.php?error=delete");
                exit();
            }
        }
        break;
    
    case 'read':
    default:
        if (isset($_GET['success'])) {
            $messages = [
                'created' => 'Investigador creado exitosamente',
                'updated' => 'Investigador actualizado exitosamente',
                'deleted' => 'Investigador eliminado exitosamente'
            ];
            if (isset($messages[$_GET['success']])) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
                echo $messages[$_GET['success']];
                echo '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
                echo '</div>';
            }
        }
        
        if (isset($_GET['error'])) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
            echo 'Ocurrió un error al procesar la operación';
            echo '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
            echo '</div>';
        }
        
        $data = $app->read();
        include_once "views/investigador/index.php";
        break;
}

include_once "views/footer.php";
?>
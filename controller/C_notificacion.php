<?php
class C_notificacion {
    private $notificacionModel;

    public function __construct() {
        $this->notificacionModel = new M_notificacion();
    }

    public function crearNotificacion($paciente_id, $mensaje, $programado_para) {
        return $this->notificacionModel->insertarNotificacion($paciente_id, $mensaje, $programado_para);
    }

    public function eliminarNotificacion($idnotificacion){
        return $this->notificacionModel->eliminarNotificacion($idnotificacion);
    }

    public function editarNotificacion($idnotificacion,$mensaje,$programado_para){
        return $this->notificacionModel->editarNotificacion($idnotificacion,$mensaje,$programado_para);
    }

    public function manejarSolicitud() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Verifica si la acción es "editar"
            if (isset($_POST['accion']) && $_POST['accion'] === 'editar') {
                $idnotificacion = $_POST['idnotificacion'];
                $mensaje = $_POST['mensaje'];
                $programado_para = $_POST['programado_para'];
    
                // Llama al método de edición
                $resultado = $this->notificacionModel->editarNotificacion($idnotificacion, $mensaje, $programado_para);
                header("Location: index.php?mensaje=" . urlencode($resultado));
                exit; // Finaliza la ejecución después de la redirección
            } else {
                // Asume que si no es "editar", entonces es "crear"
                $paciente_id = $_POST['paciente_id'];
                $mensaje = $_POST['mensaje'];
                $programado_para = $_POST['programado_para'];
    
                // Llama al método de creación
                $resultado = $this->crearNotificacion($paciente_id, $mensaje, $programado_para);
                header("Location: index.php?mensaje=" . urlencode($resultado));
                exit; // Finaliza la ejecución después de la redirección
            }
        } elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['accion']) && $_GET['accion'] === 'eliminar') {
            $idnotificacion = $_GET['idnotificacion'];
    
            // Llama al método de eliminación
            $resultado = $this->eliminarNotificacion($idnotificacion);
            header("Location: index.php?mensaje=" . urlencode($resultado));
            exit; // Finaliza la ejecución después de la redirección
        }
    }
    
    
}

?>
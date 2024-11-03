<?php
class C_notificacion {
    private $notificacionModel;

    public function __construct() {
        $this->notificacionModel = new M_notificacion();
    }

    public function crearNotificacion($medico_id,$paciente_id, $motivo,$mensaje, $programado_para) {
        return $this->notificacionModel->insertarNotificacion($medico_id,$paciente_id, $motivo,$mensaje, $programado_para);
    }

    public function eliminarNotificacion($idnotificacion){
        return $this->notificacionModel->eliminarNotificacion($idnotificacion);
    }

    public function editarNotificacion($idnotificacion, $medico_id, $motivo, $mensaje, $programado_para) {
        return $this->notificacionModel->editarNotificacion($idnotificacion, $medico_id, $motivo, $mensaje, $programado_para);
    }
    

    public function manejarSolicitud() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['accion']) && $_POST['accion'] === 'editar') {
                $idnotificacion = $_POST['idnotificacion'];
                $medico_id = $_POST['medico_id'];
                $motivo = $_POST['motivo'];
                $mensaje = $_POST['mensaje'];
                $programado_para = $_POST['programado_para'];
            
                $resultado = $this->notificacionModel->editarNotificacion($idnotificacion, $medico_id, $motivo, $mensaje, $programado_para);
                header("Location: index.php?mensaje=" . urlencode($resultado));
                exit;
            } else {
                $medico_id = $_POST['medico_id'];
                $paciente_id = $_POST['paciente_id'];
                $motivo = $_POST['motivo'];
                $mensaje = $_POST['mensaje'];
                $programado_para = $_POST['programado_para'];
    
                $resultado = $this->crearNotificacion($medico_id,$paciente_id, $motivo,$mensaje, $programado_para);
                header("Location: index.php?mensaje=" . urlencode($resultado));
                exit;
            }
        } elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['accion']) && $_GET['accion'] === 'eliminar') {
            $idnotificacion = $_GET['idnotificacion'];
    
            $resultado = $this->eliminarNotificacion($idnotificacion);
            header("Location: index.php?mensaje=" . urlencode($resultado));
            exit; 
        }
    }
    
    
}

?>
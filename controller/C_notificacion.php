<?php
class C_notificacion {
    private $notificacionModel;

    public function __construct() {
        $this->notificacionModel = new M_notificacion();
    }

    public function crearNotificacion($paciente_id, $mensaje, $programado_para) {
        return $this->notificacionModel->insertarNotificacion($paciente_id, $mensaje, $programado_para);
    }

    public function manejarSolicitud() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $paciente_id = $_POST['paciente_id'];
            $mensaje = $_POST['mensaje'];
            $programado_para = $_POST['programado_para']; 

            $resultado = $this->crearNotificacion($paciente_id, $mensaje, $programado_para);

            header("Location: index.php?mensaje=" . urlencode($resultado));
        }
    }
}

?>
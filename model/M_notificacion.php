<?php
require_once "model/Conexion.php";

class M_notificacion {
    private $conexion;

    public function __construct() {
        $this->conexion = Conexion::getConexion();
    }

    public function obtenerNotificaciones() {
        try {
            $sql = $this->conexion->query("SELECT * FROM notificacion");

            if ($sql) {
                $notificaciones = [];
                while ($datos = $sql->fetch(PDO::FETCH_OBJ)) {
                    $notificaciones[] = $datos;
                }
                return $notificaciones;
            } else {
                return [];
            }
        } catch (PDOException $e) {
            echo "Error en la consulta: " . $e->getMessage();
            return [];
        }
    }

    public function insertarNotificacion($medico_id,$paciente_id,$motivo, $mensaje, $programado_para) {
        $query = "INSERT INTO notificacion (medico_id,paciente_id,motivo, mensaje, programado_para, creado_en, leido) 
                  VALUES (:medico_id ,:paciente_id, :motivo ,:mensaje, :programado_para, NOW(), 0)";
        $stmt = $this->conexion->prepare($query);
    
        $stmt->bindParam(':medico_id', $medico_id, PDO::PARAM_INT);
        $stmt->bindParam(':paciente_id', $paciente_id, PDO::PARAM_INT);
        $stmt->bindParam(':motivo', $motivo, PDO::PARAM_STR);
        $stmt->bindParam(':mensaje', $mensaje, PDO::PARAM_STR);
        $stmt->bindParam(':programado_para', $programado_para, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "Notificación insertada exitosamente.";
        } else {
            return "Error en la inserción de la notificación: " . $stmt->errorInfo()[2];
        }
    }

    public function eliminarNotificacion($idnotificacion){
        $query = "DELETE FROM notificacion WHERE idnotificacion = :idnotificacion";
        $stmt = $this->conexion->prepare($query);
    
        $stmt->bindParam(':idnotificacion', $idnotificacion, PDO::PARAM_INT);
    
        if ($stmt->execute()) {
            return "Notificacion Eliminada Correctamente";
        } else {
            return "Error en la eliminacion de la notificacion: " . $stmt->errorInfo()[2];
        }
    }

    public function editarNotificacion($idnotificacion, $medico_id, $motivo, $mensaje, $programado_para) {
        $query = "UPDATE notificacion 
                  SET medico_id = :medico_id, motivo = :motivo, mensaje = :mensaje, programado_para = :programado_para 
                  WHERE idnotificacion = :idnotificacion";
        $stmt = $this->conexion->prepare($query);
    
        $stmt->bindParam(':idnotificacion', $idnotificacion, PDO::PARAM_INT);
        $stmt->bindParam(':medico_id', $medico_id, PDO::PARAM_INT);
        $stmt->bindParam(':motivo', $motivo, PDO::PARAM_STR);
        $stmt->bindParam(':mensaje', $mensaje, PDO::PARAM_STR);
        $stmt->bindParam(':programado_para', $programado_para, PDO::PARAM_STR);
    
        if ($stmt->execute()) {
            return "Notificación actualizada correctamente";
        } else {
            return "Error al actualizar la notificación: " . $stmt->errorInfo()[2];
        }
    }
    
    
    
}
?>

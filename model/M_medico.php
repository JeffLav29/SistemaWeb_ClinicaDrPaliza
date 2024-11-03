<?php
require_once "model/Conexion.php";

class M_medico {
    private $conexion;

    public function __construct() {
        $this->conexion = Conexion::getConexion();
    }

    public function obtenerMedicos() {
        try {
            $sql = $this->conexion->query("SELECT idmedico, nombre, apellido FROM medico");

            if ($sql) {
                $medicos = [];
                while ($datos = $sql->fetch(PDO::FETCH_OBJ)) {
                    $medicos[] = $datos;
                }
                return $medicos;
            } else {
                return [];
            }
        } catch (PDOException $e) {
            error_log("Error en la consulta: " . $e->getMessage());
            return [];
        }
    }
}
?>

<?php

class Conexion{

    const host = "localhost";
    const usuario = "root";
    const password = "sistemas";
    const nombreBaseDatos = "clinica_notificaciones";

    public static function getConexion(){
        try{
            $conexion = new PDO("mysql:host=".self::host.";dbname=".self::nombreBaseDatos.";charset=utf8",self::usuario,self::password);
            $conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            return $conexion;
        }catch(PDOException $e){
            return "Error en la conexion: ".$e->getMessage();
        }
    }
}
?>
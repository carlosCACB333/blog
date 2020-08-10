<?php
class conexion
{
    function conectar()
    {
        try {
            $conexion = new PDO('mysql: host=localhost ; dbname=registro', 'root', 'mysql');
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conexion;
        } catch (Exception $e) {
            echo 'se produjo un error en la conexion a la base de datos ' . $e->getMessage();
            exit();
        }
    }
}

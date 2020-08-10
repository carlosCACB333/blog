<?php
require_once '../conexion.php';
class consultas extends conexion
{
    function getDatos($sql)
    {
        $conexion = parent::conectar();
        $res = $conexion->query($sql);
        return $res->fetchAll(PDO::FETCH_OBJ);
    }
}


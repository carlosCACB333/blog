<?php
include_once 'conexion.php';
class sesion extends conexion
{
    var $email;
    var $clave;
    function __construct()
    {
        $this->email = $_POST['email'];
        $this->clave = $_POST['clave'];
    }

    function validar()
    {
        $conexion = parent::conectar();

        $st = $conexion->prepare('select * from usuarios where email=?');
        $st->execute(array($this->email));
        if ($st->rowCount() != 0) {
            while ($fila = $st->fetch()) {
                if (password_verify($this->clave, $fila['clave'])) {
                    session_start();
                    $_SESSION['email'] = $_POST['email'];
                    header('location:blog/blog.php');
                } else {
                    header('location:login.html');
                }
            }
        } else {
            header('location:login.html');
        }
        /*  $st = $conexion->prepare('select * from usuarios where email=? and clave=?');
        $st->execute(array($this->email, $this->clave));

        if ($st->rowCount() > 0) {
            session_start();
            $_SESSION['email'] = $_POST['email'];
            header('location:portafolios/portafolio.php');
        } else {
            header('location:login.html');
        }
*/
    }
}

$con = new sesion();
$con->validar();

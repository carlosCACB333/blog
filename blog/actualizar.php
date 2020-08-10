<?php
include_once '../conexion.php';
class actualizar extends conexion
{
    function __construct()
    {
        $nombre = trim($_POST['nombre']);
        $email = trim($_POST['email']);
        $clave = password_hash(trim($_POST['clave']), PASSWORD_DEFAULT, array('cost' => 15));



        if ($nombre != '' && $email != '' && $clave != '') {

            session_start();
            $ruta = $_SERVER['DOCUMENT_ROOT'] . '/ejemplos/login/blog/im/perfil/' . $_SESSION['email'] . '_' . $_FILES['selector_foto']['name'];

            $sql='';
            $this->borrar_imagen_servidor();
            if (move_uploaded_file($_FILES['selector_foto']['tmp_name'], $ruta)) {
                $perfil = $_SESSION['email'] . '_' . $_FILES['selector_foto']['name'];

                $sql='update usuarios set nombre=? , email=? , clave=?, perfil=? where email=?';

                try {
                    $conexion = parent::conectar();
                    $st = $conexion->prepare($sql);
    
                    $st->execute(array($nombre, $email, $clave, $perfil, $_SESSION['email']));
    
                    if ($st->rowCount() != 0) {
                        echo 'se actualizo correctamente';
                        header('location:blog.php');
                    } else {
                        echo ' no se actualizo';
                    }
    
                    $st->closeCursor();
                } catch (Exception $e) {
                    echo $e->getLine() . '---' . $e->getMessage();
                }

               
            } else {
                $sql='update usuarios set nombre=? , email=? , clave=? where email=?';
                try {
                    $conexion = parent::conectar();
                    $st = $conexion->prepare($sql);
    
                    $st->execute(array($nombre, $email, $clave, $_SESSION['email']));
    
                    if ($st->rowCount() != 0) {
                        echo 'se actualizo correctamente';
                    } else {
                        echo ' no se actualizo';
                    }
    
                    $st->closeCursor();
                } catch (Exception $e) {
                    echo $e->getLine() . '---' . $e->getMessage();
                }
            }

           
        } else {
            header('location:blog.php');
        }
    }

    function borrar_imagen_servidor()

    {
        try{
        $con = parent::conectar();
        $st = $con->prepare('select perfil from usuarios where email=?');
        $st->execute(array($_SESSION['email']));

        $fila = $st->fetch();
        
        if($fila[0] !=null&&$_FILES['selector_foto']['size']>0){
            unlink( $_SERVER['DOCUMENT_ROOT'] . '/ejemplos/login/blog/im/perfil/' . $fila[0]);
        }
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }

    
}
new actualizar();  



<?php
include_once('../conexion.php');

class publicar extends conexion
{
    var $nombre;
    function __construct()
    {
        $this->subir_al_servidor();
        $this->subir_ala_bbdd();
    }

    function subir_al_servidor()
    {
        echo 'holaaaaa   ';
        echo $_FILES['foto']['type'];
        if ($_FILES['foto']['type'] == 'image/png' || $_FILES['foto']['type'] == 'image/jpg' || $_FILES['foto']['type'] == 'image/gif' || $_FILES['foto']['type'] == 'image/jpeg' ||$_FILES['foto']['type']=='image/x-iconno'){

            $carpeta_fotos = $_SERVER['DOCUMENT_ROOT'] . '/ejemplos/login/blog/im/'; //ruta de la carpeta que contendra las imagenes en el servidor

            session_start();
            $this->nombre = $_SESSION['email'] . '_' . $_FILES['foto']['name']; // le agregamos el correo antes del nombre de la foto
            move_uploaded_file($_FILES['foto']['tmp_name'], $carpeta_fotos . $this->nombre); //movemos de la carpeta temporal a la ruta escogida
        } else {
            echo 'no es una imagen';
            exit();
        }
    }

    function subir_ala_bbdd()

    {
        $email = $_SESSION['email'];
        $contenido = $_POST['area'];
        $privacidad = $this->get_privacidad();
        $fecha = date("Y-m-d H:i:s");
        $query = "insert into posts values(null,?,? ,?,(select id from usuarios where email=?),(select id from privacidades where privacidad=?))";
        try {
            $conexion = parent::conectar();
           $res= $conexion->prepare($query);
           $res->execute(array($contenido,$fecha,$this->nombre,$email,$privacidad));

           if( $res->rowCount()>=1){
               header('location:blog.php');
               echo 'se ingreso correctamente';

           }else{
               echo 'no se pudo ingresar';
           }
           $res->closeCursor();
           
        } catch (Exception $e) {
            if ($e->getCode() == '42S02') {
                echo 'tabla no se encuentra en la base de datos';
            } elseif ($e->getCode() == '42000') {
                echo 'sintaxis sql incorrecto';
            } else {
                echo $e->getCode();
                echo $e->getMessage();
            }
        }
    }

    function get_privacidad()
    {
        if ($_POST['privacidad'] == 1) {
            return 'público';
        } else if ($_POST['privacidad'] == 2) {
            return 'seguidores';
        } else if ($_POST['privacidad'] == 3) {
            return 'privado';
        }
    }
}

new publicar();

<?php
include_once 'conexion.php';
class registrarse extends conexion

{
    var $nombre;
    var $email;
    var $clave_cifrada;

    function __construct(){
        $this->nombre=$_POST['nombre'];
        $this->email=$_POST['email'];
        $this->clave_cifrada= password_hash($_POST['clave'], PASSWORD_DEFAULT,array('cost'=>15));
        //clave--tipo de algoritmo de cifrado--nivel de cifrado
    }

  

    function insertar()
    {
        try {
           
            $conexion = parent::conectar();
            $st = $conexion->prepare('insert into usuarios values (null,?,?,?,null)');
            $st->execute(array($this->nombre,$this->email,$this->clave_cifrada));
          if($st->rowCount()!=0){
              echo 'se ingreso correctamente';

          }else{
              echo ' no se ingreso';

          }

            $st->closeCursor();
        } catch (Exception $e) {
            if ($e->getCode() == '42S02') {
                echo 'tabla no se encuentra en la base de datos';
            } elseif ($e->getCode() == '42000') {
                echo 'sintaxis sql incorrecto';
            } elseif ($e->getCode()=='23000'){
                echo 'el correo ya esta en uso';
            }else {
                echo $e->getCode();
                echo $e->getMessage();
            }
        }
    }
}
$con=new registrarse();             
$con->insertar();
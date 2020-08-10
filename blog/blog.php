<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>blog</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="blog.css">
</head>

<body>
    <?php
    session_start();
    if (!isset($_SESSION['email'])) {
        header('location:../login.html');
    }

    ?>




    <header>

        <figure>
            <img src="im/perfil/hoja.png" alt="no hay foto de perfil">

        </figure>
        <div>

            <?php
            include_once 'consultas.php';
            $datos = (new consultas)->getDatos('select nombre,email,perfil from usuarios where email="' . $_SESSION['email'] . '"');
            ?>

            <img class='redondear' src="
            
            <?php
            global $datos;
            if ($datos[0]->perfil == null) {
                echo 'im/perfil/usuario.png';
            } else {
                echo 'im/perfil/' . $datos[0]->perfil;
            }

            ?>
            
            " alt="" width="50px" height="50px">

            <h3 id="datos">
                <?php echo $_SESSION['email'] ?>
            </h3>

            <div id="desplegar">


                <form action="actualizar.php" id='actualizar' method="POST" enctype="multipart/form-data">

                    <table>
                        <tr>
                            <td colspan="2">
                                seleccione su foto de perfil<br><br>
                                <input type="file" id="selector_foto" accept="image/*" name="selector_foto">
                                <img class='redondear' id="perfil" src='
                                <?php
                                global $datos;
                                if ($datos[0]->perfil == null) {
                                    echo 'im/perfil/usuario.png';
                                } else {
                                    echo 'im/perfil/' . $datos[0]->perfil;
                                }

                                ?>
    
                                ' width="100px" height="100px">

                            </td>

                        </tr>

                        <tr>
                            <td>nombre : </td>
                            <td><input type="text" require name="nombre" value="<?php echo $datos[0]->nombre; ?>"> </td>
                        </tr>

                        <tr>
                            <td>email :</td>
                            <td><input type="email" require name="email" value="
                            
                            <?php echo $datos[0]->email; ?>
                            
                            "></td>
                        </tr>

                        <tr>
                            <td>contraseña:</td>
                            <td> <input type="password" require name="clave"></td>
                        </tr>

                        <tr>
                            <td colspan="2"><input type="submit" value="actualizar datos"></td>
                        </tr>

                        <tr>
                            <td colspan="2">
                                <a href="cerrar.php">cerrar sesion</a>
                            </td>
                        </tr>
                    </table>

                </form>
            </div>


        </div>


    </header>
    <div class="contenedor">

        <div class="publicar">
            <form action="publicar.php" id="formulario" method="POST" enctype="multipart/form-data">
                <div>
                    <img class='redondear' width="50px" height="50px" src="
                    <?php
                    if ($datos[0]->perfil == null) {
                        echo 'im/perfil/usuario.png';
                    } else {
                        echo 'im/perfil/' . $datos[0]->perfil;
                    }

                    ?>">
                    <h3>¿que estas pensando?</h3>
                    <select name="privacidad" id="">
                        <option value="1">publico</option>
                        <option value="2">mis seguidores
                        </option>
                        <option value="3">solo yo</option>
                    </select>
                </div>
                <textarea name="area" id="" cols="" rows="5" placeholder="agrega un comentario aqui"></textarea>
                <figure>
                    <input type="reset" value="x" id="salir">
                    <img alt="" id="previsualizar" width="100%">
                </figure>
                <div id="seleccionar"> seleccionar imagen</div>
                <input type="file" id="foto" accept="image/*" name="foto">

                <input type="submit" value="publicar" id="enviar">
            </form>
        </div>

        <?php
        include_once 'consultas.php';
        $u=$_SESSION['email'];
        $sql = "select nombre,email, fecha,post,imagen,perfil from usuarios inner join
        posts on usuarios.id=posts.usuario_id where privacidades_id=1 or email='$u' order by fecha desc;";
        
        $datos = (new consultas())->getDatos($sql);
        foreach ($datos as $fila) :
        ?>



            <div class="usuario">
                <div class="cabecera">
                    <img class="foto" src="<?php

                                            if ($fila->perfil == null) {
                                                echo 'im/perfil/usuario.png';
                                            } else {
                                                echo 'im/perfil/' . $fila->perfil;
                                            }

                                            ?> "alt="no se encontro" width="50px" height="50px">
                    <div>
                        <p class="nombre"> <strong><?php echo $fila->nombre;  ?></strong></p>
                        <small><?php echo $fila->email;  ?></small>
                        <small> <br> <?php echo $fila->fecha; ?></small>
                    </div>

                </div>
                <p class="comentario"><?php echo $fila->post ?></p>

                <img src="<?php echo  'im/' . $fila->imagen ?>" alt="no se encontro" width="100%">



            </div>



        <?php
        endforeach;

        ?>




    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="blog.js"></script>

</body>



</html>
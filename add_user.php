<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        session_start();
        //Se lo cambie
        if (!isset($lista)) {
            $lista = array();
        }
        if (isset($_POST["add"])) {

            if (!isset($_SESSION["Variable"])) {
                $lista = "";
                $User = array("ced" => $_POST["cedula"], "nom" => $_POST["nombre"], "ape" => $_POST["apellido"],
                    "gen" => $_POST["genero"], "ema" => $_POST["email"], "cel" => $_POST["celular"]);
                $lista [] = $User;
                $_SESSION["Variable"] = $lista;
            } else {
                $lista = $_SESSION["Variable"];
                $User = array("ced" => $_POST["cedula"], "nom" => $_POST["nombre"], "ape" => $_POST["apellido"],
                    "gen" => $_POST["genero"], "ema" => $_POST["email"], "cel" => $_POST["celular"]);
                $lista [] = $User;
                $_SESSION["Variable"] = $lista;
            }
        }
        ?>
        <?php

        function callList() {
            echo "list_user.php";
        }
        ?>

        <form action="<?php $_SERVER['PHP_SELF']; ?>"  method="POST">

            <label><p>Cédula: <input type="text" name="cedula" /></p></label>
            <label><p>Nombre: <input type="text" name="nombre" /></p></label>
            <label><p>Apellido: <input type="text" name="apellido" /></p></label>
            <label><p>Email: <input type="text" name="email"></p></label>
            <p>Género:
                <input type="radio" name="genero" value="V"/> Hombre
                <input type="radio" name="genero" value="M" checked="checked"/> Mujer<br/></p>
            <label><p>Celular: <input type="text" name="celular" /></p></label>
            <p><input type="submit" name="add" value="Add user" /></p>            
        </form>

        <form action="<?php callList(); ?>" method="POST">

            <input type='hidden' name='lisa' value="<?php echo htmlentities(serialize($lista)); ?>" />
            <input type="submit" name="lista" value="List users"/>
        </form>
    </body>
</html>

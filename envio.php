<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="./CSS/style.css" type="text/css">
        <title>Enviar información de cuenta</title>
    </head>
    <body class="cuerpo">
        <?php
        if (isset($_GET["list"])) {
            $userSelected = $_GET["id"];
            $usersList = unserialize($_GET["list"]);
            $registro;

            foreach ($usersList as $key => $user) {
                if ($userSelected == $user["ced"]) {
                    $registro = $user;
                    break;
                }
            }

//escribe en el archivo el usuario seleccionado en la pantalla anterior
            $File = "user.txt";
            $Handle = fopen($File, "w");
            foreach ($registro as $key => $dates) {
                $data = $key . ": " . $dates . "\r\n";
                fwrite($Handle, $data);
            }
            fclose($Handle);
            $count = 1;
            $file = fopen("user.txt", "r");
            rewind($file);
            $message="";
            while (!feof($file)) {
                if ($count == 5) {
                    $email = split("\:", fgets($file));
                    $message .= $email[0].": ".$email[1];
                }
                $count ++;
                
                $message .= fgets($file);
            }
            fclose($file);
        }

//se ejecuta cuando se desea guaradar todos los usuarios
        if (isset($_POST["save"])) {
            $File = "userList.txt";
            $Handle = fopen($File, "w");
            foreach ($usersList as $key => $data) {
                foreach ($data as $key1 => $subjects) {
                    $datas = $key1 . ": " . $subjects . "\r\n";
                    fwrite($Handle, $datas);
                }
            }
            fclose($Handle);
        }

//se ejecuta cuando se presiona el boton de enviar email
        if (isset($_POST["send"])) {


//            mail("jesusst4@gmail.com", "Testing", $message, $headers) or die("no sirve");
        }
        ?>

        <form action="<?php $_SERVER['PHP_SELF']; ?>"  method="POST">    
            <label><p>To: <input type="text" name="to" value="<?php echo $email[1]; ?>"/></p></label>
            <label><p>Subject: <input type="text" name="sub" /></p></label>
            <label><p>Message: <textarea type="text" name="mes"  rows="5" cols="40"><?php echo $message; ?></textarea></p></label>

            <input type="hidden" name="l" value="<?php $usersList; ?>"/>
            <p><input type="submit" name="send" value="Send email" /></p>            
        </form>

        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">

            <input type="hidden" name="l" value="<?php $usersList; ?>"/>
            <input type="submit" name="save" value="Save users"/>
        </form>

    </body>
</html>

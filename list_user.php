
<link rel="stylesheet" href="./CSS/style.css" type="text/css">
<?php
//Se lo cambie
session_start();
session_destroy();
echo
"<table>
    <tr>
        <th><label >Cedula</label>
        <th><label >Nombre</label>
        <th><label >Apellido</label>
        <th><label >Genero</label>
        <th><label >Email</label>
        <th><label >Celular</label>
    </tr>";

$counter = 1;
echo "<tr>";
if (isset($_POST['lisa'])) {
    $ListUsers = unserialize($_POST['lisa']);
    foreach ($ListUsers as $key => $user) {
        foreach ($user as $key1 => $dates) {
            if ($counter % 6 == 1) {
                echo "</tr><tr>";
                echo "<td><a href='envio.php?id=" . $dates . "&list=" . htmlentities(serialize($ListUsers)) . "'>$dates </a></td>";
            } else {
                echo "<td>$dates </td>";
            }
            $counter++;
        }
    }
}
echo "</tr>";
?>
</table>
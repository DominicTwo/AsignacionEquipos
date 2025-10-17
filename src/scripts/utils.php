<?php
function getUsers($db) {
    $sql = "SELECT id, nombre, apellidos, correo, area, rol FROM usuarios";
    return $db->query($sql);
}
?>


<?php
function getUsers($db) {
    $sql = "SELECT id, nombre, apellidos, correo, area, rol FROM usuarios";
    return $db->query($sql);
}

function getUsersValidate($db, $name, $password) {
    $sql = "SELECT id_usuario, nombre, apellidos, correo, password, area, rol FROM usuarios WHERE $name";
}
?>


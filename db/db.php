<?php
$host = "localhost";
$usuario = "root";
$password = "12345678";
$baseDatos = "saage";

$db = new mysqli($host, $usuario, $password, $baseDatos);

if ($db->connect_error) {
    die("Error de conexión: " . $db->connect_error);
} else {
    echo 'si';
}

$db->set_charset("utf8");

?>

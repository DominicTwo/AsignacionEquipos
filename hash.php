<?php
// crear_hash.php
$password_plano = "1234"; // Cambia esto por la contraseña que quieras hashear

$hash = password_hash($password_plano, PASSWORD_DEFAULT);

echo "Copia este hash en tu columna 'password' de la BD:<br><br>";
echo "<strong>" . $hash . "</strong>";
?>
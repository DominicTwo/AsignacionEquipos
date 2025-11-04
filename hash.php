<?php
$password_plano = "1234";

$hash = password_hash($password_plano, PASSWORD_DEFAULT);

echo "<strong>" . $hash . "</strong>";
?>
<?php
$servername = "localhost";
$username = "REDCUCEI";
$password = "REDCUCEI123";
$dbname = "REDCUCEI";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
echo "Conexión exitosa";
?>

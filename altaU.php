<?php
require "/home/conectared.php";
$con = conecta();
$name = $_POST['name'];
$lastname = $_POST['lastname'];
$mail = $_POST['mail'];
$pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
$codigo = $_POST['codigo'];
$date = $_POST['date'];
$carrera = $_POST['carrera'];

$sql = $con->prepare("INSERT INTO Usuario (nombre, apellidos, correo, password, codigo, fecha_nacimiento, carrera) VALUES (?, ?, ?, ?, ?, ?, ?)");
$sql->bind_param("sssssss", $name, $lastname, $mail, $pass, $codigo, $date, $carrera);

if ($sql->execute()) {
    echo "Registro exitoso";
} else {
    echo "Error en el registro: " . $sql->error;
}

$con->close();
?>

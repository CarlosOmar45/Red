<?php
require "/home/conectared.php";
$con = conecta();
$correo = $_POST['correo'];

$sql = $con->prepare("SELECT * FROM Usuario WHERE correo = ?");
$sql->bind_param("s", $correo);
$sql->execute();
$res = $sql->get_result();

if ($res->num_rows > 0) {
    echo 'exists';
} else {
    echo 'not_exists';
}

$con->close();
?>

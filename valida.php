<?php
session_start();
require "/home/conectared.php";
$con = conecta();
$correo=$_POST['correo'];
$password=$_REQUEST['pass'];
$pass=md5($password);
$pass=$password;


// Consulta para verificar el usuario
$sql = "SELECT * FROM Usuario WHERE correo = '$correo' AND pass = '$pass' AND status = 1 AND eliminado = 0";
$res = $con->query($sql);

if ($res->num_rows == 0) {
    $a = 0;
} else {
$row = $res->fetch_array();
    $a = 1;
    $id = $row["id"];

    // Guarda datos del usuario en la sesión
    $_SESSION['idu'] = $id;

// Si existe un pedido, cargar los productos en el carrito
if (isset($_SESSION['idp'])) {
    $idp = $_SESSION['idp'];
    $sqlProductos = "SELECT id_producto, cantidad FROM pedidos_poductos WHERE id_pedido = '$idp'";
    $resProductos = $con->query($sqlProductos);

    while ($producto = $resProductos->fetch_assoc()) {
        $_SESSION['carrito'][$producto['id_producto']] = $producto['cantidad'];
    }
}
}


echo $a;
?>
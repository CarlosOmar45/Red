<?php
session_start(); // Iniciar la sesión
require "/home/conectared.php";
$con = conecta();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener el user_id de la sesión
    $user_id = $_SESSION['id'];

    // Obtener los datos del formulario
    $nombre = $_POST['name'];
    $distancia = $_POST['ditan'];
    $calle = $_POST['calle'];
    $noext = $_POST['noext'];
    $tipoEstablecimiento = $_POST['tipo'];
    $descripcion = $_POST['desc'];


    // Insertar los datos en la tabla Lugar
    $sql = "INSERT INTO Lugar (user_id, nombre, calle, no_exterior, tipo_establecimiento, descripcion, estrellas_prom) VALUES (?, ?, ?, ?, ?, ?, 0)";

    $stmt = $con->prepare($sql);
    $stmt->bind_param("ississ", $user_id, $nombre, $calle, $noext, $tipoEstablecimiento, $descripcion);

    if ($stmt->execute()) {
        echo "Lugar registrado con éxito.";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Cerrar la conexión
    $stmt->close();
    $con->close();
}
?>

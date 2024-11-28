<?php
session_start();
require "/home/conectared.php";
$con = conecta();
$tipo = $_POST['tipo'];
$id = $_POST['id'];
$user_id = $_SESSION['id'];

if ($tipo == 1) {
    $sql = $con->prepare("SELECT like_value, like_id FROM Likes WHERE user_id = ? AND item_type = ? AND lugar_id = ?");
    $sql->bind_param("iii", $user_id, $tipo, $id);
    $sql->execute();
    $res = $sql->get_result();

    if ($res->num_rows === 0) {
        // Insertar nuevo like
        $like_value = 1;
        $sql = $con->prepare("INSERT INTO Likes (user_id, lugar_id, item_type, like_value) VALUES (?, ?, ?, ?)");
        $sql->bind_param("iiii", $user_id, $id, $tipo, $like_value);
        if ($sql->execute()) {
            echo "Registro exitoso";
        } else {
            echo "Error en el registro: " . $sql->error;
        }
    } else {
        // Alternar valor de like
        $row = $res->fetch_assoc();
        $like_value = $row["like_value"] ? 0 : 1;
        $like_id = $row["like_id"];
        $sql = $con->prepare("UPDATE Likes SET like_value = ? WHERE like_id = ?");
        $sql->bind_param("ii", $like_value, $like_id);
        if ($sql->execute()) {
            echo "Actualización exitosa";
        } else {
            echo "Error en la actualización: " . $sql->error;
        }
    }
} else {
    $sql = $con->prepare("SELECT like_value, like_id FROM Likes WHERE user_id = ? AND item_type = ? AND comentario_id = ?");
    $sql->bind_param("iii", $user_id, $tipo, $id);
    $sql->execute();
    $res = $sql->get_result();

    if ($res->num_rows === 0) {
        // Insertar nuevo like
        $like_value = 1;
        $sql = $con->prepare("INSERT INTO Likes (user_id, comentario_id, item_type, like_value) VALUES (?, ?, ?, ?)");
        $sql->bind_param("iiii", $user_id, $id, $tipo, $like_value);
        if ($sql->execute()) {
            echo "Registro exitoso";
        } else {
            echo "Error en el registro: " . $sql->error;
        }
    } else {
        // Alternar valor de like
        $row = $res->fetch_assoc();
        $like_value = $row["like_value"] ? 0 : 1;
        $like_id = $row["like_id"];
        $sql = $con->prepare("UPDATE Likes SET like_value = ? WHERE like_id = ?");
        $sql->bind_param("ii", $like_value, $like_id);
        if ($sql->execute()) {
            echo "Actualización exitosa";
        } else {
            echo "Error en la actualización: " . $sql->error;
        }
    }
}
?>
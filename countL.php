<?php
session_start();
require "conecta.php";
$con = conecta();
$tipo = $_POST['tipo'];
$id = $_POST['id'];
$user_id = $_SESSION['id'];

if ($tipo == 1) {
    $sql = $con->prepare("SELECT like_value, like_id FROM Likes WHERE user_id = ? AND item_type = ? AND lugar_id = ?");
    $sql->bind_param("iii", $user_id, $tipo, $id);
    $sql->execute();
    $res = $sql->get_result();

    if ($res->num_rows == 0) {
        $like = TRUE;
        $sql = $con->prepare("INSERT INTO Likes (user_id, lugar_id, item_type, like_value) VALUES (?, ?, ?, ?)");
        $sql->bind_param("iiii", $user_id, $id, $tipo, $like);
        if ($sql->execute()) {
            echo "Registro exitoso";
        } else {
            echo "Error en el registro: " . $sql->error;
        }
    } else {
        $row = $res->fetch_array();
        $like = $row["like_value"];
        $like_id = $row["like_id"];
        $sql = $con->prepare("UPDATE Likes SET like_value = ? WHERE like_id = ?");
        $like = !$like;
        $sql->bind_param("ii", $like, $like_id);
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

    if ($res->num_rows == 0) {
        $like = TRUE;
        $sql = $con->prepare("INSERT INTO Likes (user_id, comentario_id, item_type, like_value) VALUES (?, ?, ?, ?)");
        $sql->bind_param("iiii", $user_id, $id, $tipo, $like);
        if ($sql->execute()) {
            echo "Registro exitoso";
        } else {
            echo "Error en el registro: " . $sql->error;
        }
    } else {
        $row = $res->fetch_array();
        $like = $row["like_value"];
        $like_id = $row["like_id"];
        $sql = $con->prepare("UPDATE Likes SET like_value = ? WHERE like_id = ?");
        $like = !$like;
        $sql->bind_param("ii", $like, $like_id);
        if ($sql->execute()) {
            echo "Actualización exitosa";
        } else {
            echo "Error en la actualización: " . $sql->error;
        }
    }
}

$con->close();
?>

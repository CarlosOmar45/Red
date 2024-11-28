<?php
session_start();
require "/home/conectared.php";
$con = conecta();
$tipo = $_POST['tipo'];
$id = $_POST['id'];
$user_id = $_SESSION['id'];
if ($tipo == 1) {
    $sql = "SELECT like_value, like_id FROM Likes WHERE user_id= $user_id AND item_type = $tipo AND lugar_id = $id";
    $res = $con->query($sql);
    if (mysqli_num_rows($res) > 0) {
        $like = FALSE;
        $sql = $con->prepare("INSERT INTO Likes (user_id, lugar_id, item_type, like_value) VALUES (?, ?, ?, ?)");
        $sql->bind_param($user_id, $id, $tipo, !$like);
        if ($sql->execute()) {
            echo "Registro exitoso";
        } else {
            echo "Error en el registro: " . $sql->error;
        }
    } else {
        $row = $res->fetch_array();
        $like = $row["like_value"];
        $like_id = $row["like_id"];
        $sql = "UPDATE Likes SET like_value=!$like WHERE like_id=$like_id";
        $query = mysqli_query($con, $sql);
    }
} else {

    $sql = "SELECT like_value, like_id FROM Likes WHERE user_id= $user_id AND item_type = $tipo AND comentario_id = $id";
    $res = $con->query($sql);
    if (mysqli_num_rows($res) > 0) {
        $like = FALSE;
        $sql = $con->prepare("INSERT INTO Likes (user_id, comentario_id, item_type, like_value) VALUES (?, ?, ?, ?)");
        $sql->bind_param($user_id, $id, $tipo, !$like);
        if ($sql->execute()) {
            echo "Registro exitoso";
        } else {
            echo "Error en el registro: " . $sql->error;
        }
    } else {
        $row = $res->fetch_array();
        $like = $row["like_value"];
        $like_id = $row["like_id"];
        $sql = "UPDATE Likes SET like_value=!$like WHERE like_id=$like_id";
        $query = mysqli_query($con, $sql);
    }
}

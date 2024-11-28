<?php
session_start();
require "conecta.php";
$con = conecta();
$tipo = $_POST['tipo'];
$id = $_POST['id'];
$user_id = $_SESSION['id'];
if ($tipo == 1) {
    $sql = "SELECT like_value, like_id FROM Likes WHERE user_id= $user_id AND item_type = 'lugar' AND lugar_id = $id";
    $res = $con->query($sql);
    if (mysqli_num_rows($res) > 0) {
        $like = FALSE;
        $sql = $con->prepare("INSERT INTO Likes (user_id, lugar_id, item_type, like_value) VALUES (?, ?, ?, ?)");
        $sql->bind_param($user_id, $id, $tipo, !$like);
        if ($sql->execute()) {
        } else {
            echo "Error en el registro: ";
        }
    } else {
        $row = $res->fetch_array();
        $like = $row["like_value"];
        $like_id = $row["like_id"];
        $sql = "UPDATE Likes SET like_value=!$like WHERE like_id=$like_id";
        $query = mysqli_query($con, $sql);
    }
    $sql = "SELECT COUNT(*) AS count_likes FROM Likes WHERE lugar_id = $lugar_id AND item_type = 'lugar' AND like_value = TRUE";
                $res = $con->query($sql);
                $row = $res->fetch_array();
                $count_likes = $row['count_likes'];
} else {

    $sql = "SELECT like_value, like_id FROM Likes WHERE user_id= $user_id AND item_type = 'comentario' AND comentario_id = $id";
    $res = $con->query($sql);
    if (mysqli_num_rows($res) > 0) {
        $like = FALSE;
        $sql = $con->prepare("INSERT INTO Likes (user_id, comentario_id, item_type, like_value) VALUES (?, ?, ?, ?)");
        $sql->bind_param($user_id, $id, $tipo, !$like);
        if ($sql->execute()) {
            
        } else {
            echo "Error en el registro: ";
        }
    } else {
        $row = $res->fetch_array();
        $like = $row["like_value"];
        $like_id = $row["like_id"];
        $sql = "UPDATE Likes SET like_value=!$like WHERE like_id=$like_id";
        $query = mysqli_query($con, $sql);
    }
    $sql_likes = "SELECT COUNT(*) AS total_likes FROM Likes WHERE comentario_id =$comentario_id AND item_type = 'comentario' AND like_value = TRUE";
            $res_likes = $con->query($sql_likes);
            $row_likes = $res_likes->fetch_array();
            $count_likes = $row_likes['total_likes'];
}

            echo $count_likes;
?>
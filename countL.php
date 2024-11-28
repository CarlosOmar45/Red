<?php
session_start();
require "/home/conectared.php";
$con = conecta();
$tipo = $_POST['tipo'];
$lugar_id = $_POST['lugar_id'];
$id = $_POST['id'];
$user_id = $_SESSION['id'];
$response = array('success' => false, 'total_likes' => 0);

if ($tipo == 1) {
    $sql = $con->prepare("SELECT like_value, like_id FROM Likes WHERE user_id = ? AND item_type = ? AND lugar_id = ?");
    $sql->bind_param("iii", $user_id, $tipo, $lugar_id);
    $sql->execute();
    $res = $sql->get_result();

    if ($res->num_rows === 0) {
        // Insertar nuevo like
        $like_value = 1;
        $sql = $con->prepare("INSERT INTO Likes (user_id, lugar_id, item_type, like_value) VALUES (?, ?, ?, ?)");
        $sql->bind_param("iiii", $user_id, $lugar_id, $tipo, $like_value);
        if ($sql->execute()) {
            $response['success'] = true;
        } else {
            $response['success'] = false;
        }
    } else {
        // Alternar valor de like
        $row = $res->fetch_assoc();
        $like_value = $row["like_value"] ? 0 : 1;
        $like_id = $row["like_id"];
        $sql = $con->prepare("UPDATE Likes SET like_value = ? WHERE like_id = ?");
        $sql->bind_param("ii", $like_value, $like_id);
        if ($sql->execute()) {
            $response['success'] = true;
        } else {
            $response['success'] = false;
        }
    }

    // Obtener el total de likes
    $sql = $con->prepare("SELECT COUNT(*) AS total_likes FROM Likes WHERE lugar_id = ? AND item_type = ? AND like_value = TRUE");
    $sql->bind_param("ii", $lugar_id, $tipo);
    $sql->execute();
    $res = $sql->get_result();
    $row = $res->fetch_assoc();
    $response['total_likes'] = $row['total_likes'];
} else { 
    //comentario 
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
            $response['success'] = true;
        } else {
            $response['success'] = false;
        }
    } else {
        // Alternar valor de like
        $row = $res->fetch_assoc();
        $like_value = $row["like_value"] ? 0 : 1;
        $like_id = $row["like_id"];
        $sql = $con->prepare("UPDATE Likes SET like_value = ? WHERE like_id = ?");
        $sql->bind_param("ii", $like_value, $like_id);
        if ($sql->execute()) {
            $response['success'] = true;
        } else {
            $response['success'] = false;
        }
    }

    // Obtener el total de likes
    $sql = $con->prepare("SELECT COUNT(*) AS total_likes FROM Likes WHERE comentario_id = ? AND item_type = ? AND like_value = TRUE");
    $sql->bind_param("ii", $id, $tipo);
    $sql->execute();
    $res = $sql->get_result();
    $row = $res->fetch_assoc();
    $response['total_likes'] = $row['total_likes'];
}
$con->autocommit(TRUE);
echo json_encode($response);
$con->close();
?>
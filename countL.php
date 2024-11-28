<?php
session_start();
require "/home/conectared.php";
$con = conecta();
$tipo = $_POST['tipo'];
$id = $_POST['id'];
$user_id = $_SESSION['id'];
$response = array('success' => false, 'total_likes' => 0);

if ($tipo == 2) {
    $sql = $con->prepare("SELECT like_value, like_id FROM Likes WHERE user_id = ? AND item_type = ? AND comentario_id = ?");
    $sql->bind_param("iii", $user_id, $tipo, $id);
    $sql->execute();
    $res = $sql->get_result();

    if ($res->num_rows == 0) {
        $like = TRUE;
        $sql = $con->prepare("INSERT INTO Likes (user_id, comentario_id, item_type, like_value) VALUES (?, ?, ?, ?)");
        $sql->bind_param("iiii", $user_id, $id, $tipo, $like);
        if ($sql->execute()) {
            $response['success'] = true;
        } else {
            $response['success'] = false;
        }
    } else {
        $row = $res->fetch_array();
        $like = $row["like_value"];
        $like_id = $row["like_id"];
        $sql = $con->prepare("UPDATE Likes SET like_value = ? WHERE like_id = ?");
        $like = !$like;
        $sql->bind_param("ii", $like, $like_id);
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
    $row = $res->fetch_array();
    $response['total_likes'] = $row['total_likes'];
}

echo json_encode($response);
$con->close();
?>


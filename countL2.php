<?php 
session_start();
require "/home/conectared.php";
$con = conecta();
$lugar_id = $_POST['lugar_id'];
$id = $_POST['id'];
$user_id = $_SESSION['id'];
$response = array('success' => false, 'total_likes' => 0);
 
    // Comentario
    $sql = $con->prepare("SELECT like_value, like_id FROM Likes WHERE user_id = ? AND item_type = ? AND comentario_id = ? AND lugar_id = ?");
    $sql->bind_param("iiii", $user_id, 'comentario', $id, $lugar_id);
    $sql->execute();
    $res = $sql->get_result();

    if ($res->num_rows === 0) {
        // Insertar nuevo like para comentario
        $like_value = 1;
        $sql = $con->prepare("INSERT INTO Likes (user_id, comentario_id, item_type, like_value, lugar_id) VALUES (?, ?, ?, ?, ?)");
        $sql->bind_param("iiiii", $user_id, $id, 'comentario', $like_value, $lugar_id);
        if ($sql->execute()) {
            $response['success'] = true;
        } else {
            $response['success'] = false;
        }
    } else {
        // Alternar valor de like para comentario
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

    // Obtener el total de likes para el comentario
    $sql = $con->prepare("SELECT COUNT(*) AS total_likes FROM Likes WHERE comentario_id = ? AND item_type = ? AND like_value = TRUE");
    $sql->bind_param("ii", $id, 'comentario');
    $sql->execute();
    $res = $sql->get_result();
    $row = $res->fetch_assoc();
    $response['total_likes'] = $row['total_likes'];

    $con->autocommit(TRUE);
    echo json_encode($response);
    $con->close();
    ?>
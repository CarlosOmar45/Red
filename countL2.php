<?php  
session_start();
require "/home/conectared.php"; // Asegúrate de que esta ruta es correcta.
$con = conecta(); // Revisa que esta función devuelva una conexión válida.
if (!$con) {
    die("Error al conectar con la base de datos");
}

$lugar_id = $_POST['lugar_id'] ?? null;
$id = $_POST['id'] ?? null;
$user_id = $_SESSION['id'] ?? null;

// Respuesta inicial
$response = array('success' => false, 'total_likes' => 0);

// Validación de datos
if (is_null($lugar_id) || is_null($id) || is_null($user_id)) {
    echo json_encode($response);
    exit;
}

$item_type = 2;

// Verificar si ya existe un like
$sql = $con->prepare("SELECT like_value, like_id FROM Likes WHERE user_id = ? AND item_type = ? AND comentario_id = ? AND lugar_id = ?");
$sql->bind_param("isii", $user_id, $item_type, $id, $lugar_id);
$sql->execute();
$res = $sql->get_result();

if ($res->num_rows === 0) {
    // Insertar nuevo like
    $like_value = 1;
    $sql = $con->prepare("INSERT INTO Likes (user_id, comentario_id, item_type, like_value, lugar_id) VALUES (?, ?, ?, ?, ?)");
    $sql->bind_param("iisii", $user_id, $id, $item_type, $like_value, $lugar_id);
    $response['success'] = $sql->execute();
} else {
    // Alternar valor de like
    $row = $res->fetch_assoc();
    $like_value = $row["like_value"] ? 0 : 1;
    $like_id = $row["like_id"];
    $sql = $con->prepare("UPDATE Likes SET like_value = ? WHERE like_id = ?");
    $sql->bind_param("ii", $like_value, $like_id);
    $response['success'] = $sql->execute();
}

// Obtener el total de likes
$sql = $con->prepare("SELECT COUNT(*) AS total_likes FROM Likes WHERE comentario_id = ? AND item_type = ? AND like_value = 1");
$sql->bind_param("is", $id, $item_type);
$sql->execute();
$res = $sql->get_result();
if ($row = $res->fetch_assoc()) {
    $response['total_likes'] = $row['total_likes'];
}

// Liberar recursos
$sql->close();
$con->close();

// Devolver respuesta en formato JSON
echo json_encode($response);
?>

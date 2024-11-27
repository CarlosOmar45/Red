<?php 
require "/home/conectared.php";
$con = conecta();
#if(empty($_SESSION['id'])){
#    header('Location: ./login.php');
#    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header class="header">
        <a href="./home.php"><div class="logo">REDCUCEI</div></a>
        <nav>
            <a href="./home.php">INICIO</a>
            <a href="./perfil.php">PERFIL</a>
            <button class="./cerrar.php">Salir</button>
        </nav>
    </header>
        
    <main class="container">
        <h2>PUBLICACIONES</h2>
        <div class="user-info">
            <div class="avatar"></div>
            <span>Juan Perez</span>
            <button class="add-post">Añadir lugar</button>
        </div>
<?php
$sql_pedidos = "SELECT * FROM Lugar WHERE lugar_id=1";
$res_lugar = $con->query($sql_pedidos);

// Verificar si el usuario tiene pedidos
if (mysqli_num_rows($res_lugar) > 0) {
    // Recorrer todos los pedidos
    while ($lugar = $res_lugar->fetch_array()) {
        $lugar_id = $lugar["lugar_id"]; // ID del lugar
        $nombrel = $lugar["nombre"]; // nombre
        $descripcion = $lugar["descripcion"]; // Descripción
        $estrellas = $lugar["estrellas_prom"];
        $dist = $lugar["distancia"];
        $user_id=$lugar["user_id"];
        $sql = "SELECT * FROM Usuario WHERE user_id=$user_id";
           $res = $con->query($sql);
           $row = $res->fetch_array();
           $nombre = $row["nombre"];
           $apellidos = $row["apellidos"];
           $carrera = $row["carrera"];
        $ra = 5;

        echo "<h3>ID Publicación: $lugar_id</h3>";
        // Publicación
        echo "
        <div class=\"post\">
            <div class=\"post-header\">
                <div class=\"avatar\">
                <img class=\"foto\" src=\"./foto.png\" alt=\"fotoperfil\">
                </div>
                <div>
                    <strong>$nombre $apellidos</strong>
                    <p>$carrera</p>
                </div>
            </div>
            <h2>$nombrel</h2>
            <p>
                A una distancia de: $dist minutos
            </p>
            <p>
                $descripcion
            </p>
            <div class=\"post-image\"></div>
            <div class=\"post-footer\">
                <div class=\"rating\">";
                $testre = ''; // Inicializar la variable 
                while ($ra > 0) { // Cambiar la condición para evitar un bucle infinito 
                    if ($estrellas > 0) { // Cambiar la condición para evitar agregar más estrellas de las necesarias 
                        $testre .= '★'; 
                        $estrellas--; 
                    } else { 
                        $testre .= '☆';
                    } 
                    $ra--;
                }
                $sql = "SELECT COUNT(*) AS total_likes FROM Likes WHERE lugar_id = $lugar_id AND item_type = 'lugar' AND like_value = TRUE";
                $res = $con->query($sql);
                $row = $res->fetch_array();
                $likes = $row['total_likes']; 
                echo"
                $testre
                </div>
                <div>
                    <span class=\"likes\">$likes</span>
                    <button class=\"like-button\">👍</button>
                </div>
            </div>
        </div>

        <div class=\"comment-section\">
            <input type=\"text\" placeholder=\"Escribe un comentario aquí...\">
            <button class=\"comment-button\">COMENTAR</button>
        </div>
        ";
    }
    $sql_coment = "SELECT * FROM Comentario WHERE lugar_id=1";
    $res_com = $con->query($sql_coment);

    // Verificar si la publicación tiene comentarios
    if (mysqli_num_rows($res_com) > 0) {
        while ($comentario = $res_com->fetch_array()) {
            $user_id = $comentario["user_id"];
            $txtcom = $comentario["comentario"];
            $sql_uc = "SELECT * FROM Usuario WHERE user_id=$user_id";
            $res_uc = $con->query($sql_uc);
            $row = $res_uc->fetch_array();
            $nombre = $row["nombre"];
            $apellidos = $row["apellidos"];
            $carrera = $row["carrera"];
            $sql_likes = "SELECT COUNT(*) AS total_likes FROM Likes WHERE comentario_id = " . $comentario["comentario_id"] . " AND item_type = 'comentario' AND like_value = TRUE";
            $res_likes = $con->query($sql_likes);
            $row_likes = $res_likes->fetch_array();
            $coment_likes = $row_likes['total_likes'];
            echo "
            <div class=\"comment\">
                <div class=\"comment-header\">
                    <div class=\"avatar\">
                        <img class=\"foto\" src=\"./foto.png\" alt=\"fotoperfil\">
                    </div>
                    <div>
                        <strong>$nombre $apellidos</strong>
                        <p>$carrera</p>
                    </div>
                </div>
                <p>$txtcom</p>
                <div class=\"comment-footer\">
                    <span class=\"likes\">$coment_likes</span>
                    <button class=\"like-button\">👍</button>
                </div>
            </div>
            ";
        }
    } else {
        echo "<p>No hay comentarios disponibles aún.</p>";
    }
} else {
    echo "<p>Esta publicación no está disponible aún.</p>";
}
?> 
    </main>
</body>
</html>


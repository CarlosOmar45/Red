<?php 
session_start();
if(empty($_SESSION['id'])){
    header('Location: ./login.php');
    exit();
}
require "/home/conectared.php";
$con = conecta();
$nombre = $_SESSION['nombre'];
$apellidos = $_SESSION["apellidos"];
$user_id = $_SESSION['id'];
$carrera = $_SESSION['carrera'];
$lugar_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script>
        function LikeLugar(id) {
            var tipo = 1;
            $.ajax({
                url: './countL.php',
                type: 'post',
                dataType: 'json',
                data: { tipo: tipo, id: id },
                success: function(res) {
                    if (res.success) {
                        $('#likes-' + id).html(res.total_likes + ' 👍');
                    } else {
                        alert('Error al actualizar el like');
                    }
                },
                error: function() {
                    alert('Error archivo no encontrado');
                }
            });
        }

        function LikeComentario(comentario_id, lugar_id) {
            var tipo = 2;
            $.ajax({
                url: './countL.php',
                type: 'post',
                dataType: 'json',
                data: { tipo: tipo, id: comentario_id },
                success: function(res) {
                    if (res.success) {
                        $('#likes-com' + comentario_id).html(res.total_likes + ' 👍');
                    } else {
                        alert('Error al actualizar el like');
                    }
                },
                error: function() {
                    alert('Error archivo no encontrado');
                }
            });
        }
    </script>
</head>
<body>
    <header class="header">
        <a href="./home.php"><div class="logo">REDCUCEI</div></a>
        <nav>
            <a href="./home.php">INICIO</a>
            <a href="./perfil.php">PERFIL</a>
            <button class="logout-btn" onclick="logout()">Salir</button>
        </nav>
    </header>
        
    <main class="container">
        <h2>PUBLICACIONES</h2>
        <div class="user-info">
            <div class="avatar"></div>
            <span><?php echo "$nombre $apellidos <br> $carrera";?></span>
            <button class="add-post" onclick="alta()">Añadir lugar</button>
        </div>
<?php
$sql_pedidos = "SELECT * FROM Lugar WHERE lugar_id=$lugar_id";
$res_lugar = $con->query($sql_pedidos);

// Verificar si el usuario tiene pedidos
if ($res_lugar->num_rows > 0) {
    // Recorrer todos los pedidos
    while ($lugar = $res_lugar->fetch_array()) {
        $nombrel = $lugar["nombre"]; // nombre
        $descripcion = $lugar["descripcion"]; // Descripción
        $estrellas = $lugar["estrellas_prom"];
        $dist = $lugar["distancia"];
        $user_id = $lugar["user_id"];
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
                    <span class=\"likes\" id=\"likes-$lugar_id\">$likes</span>
                    <a class=\"like-button\" href=\"javascript:void(0);\" onclick=\"LikeLugar($lugar_id);\" type=\"submit\">&nbsp;👍&nbsp;</a>
                </div>
            </div>
        </div>

        <div class=\"comment-section\">
            <input type=\"text\" placeholder=\"Escribe un comentario aquí...\">
            <button class=\"comment-button\">COMENTAR</button>
        </div>
        ";
    }
    $sql_coment = "SELECT * FROM Comentario WHERE lugar_id=$lugar_id";
    $res_com = $con->query($sql_coment);

    // Verificar si la publicación tiene comentarios
    if ($res_com->num_rows > 0) {
        while ($comentario = $res_com->fetch_array()) {
            $user_id = $comentario["user_id"];
            $txtcom = $comentario["comentario"];
            $comentario_id = $comentario["comentario_id"];
            $sql_uc = "SELECT * FROM Usuario WHERE user_id=$user_id";
            $res_uc = $con->query($sql_uc);
            $row = $res_uc->fetch_array();
            $nombre = $row["nombre"];
            $apellidos = $row["apellidos"];
            $carrera = $row["carrera"];
            $sql = $con->prepare("SELECT COUNT(*) AS total_likes FROM Likes WHERE comentario_id = ? AND item_type = 2 AND like_value = 1"); 
            $sql->bind_param("i", $comentario_id); 
            $sql->execute();  
            $res_likes = $sql->get_result();
            $row_likes = $res_likes->fetch_assoc();
            $coment_likes = $row_likes['total_likes'];
            echo "
            <div class=\"comment\">
                <div class=\"post-header\">
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
                   <span class=\"likes\" id=\"likes-com$comentario_id\">$coment_likes 👍</span>
                    <a class=\"like-button\" href=\"javascript:void(0);\" onclick=\"LikeComentario($comentario_id, $lugar_id);\" type=\"submit\">&nbsp;👍&nbsp;</a>
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
$con->close();
?> 
    </main>
    <script src="a.js"></script>
</body>
</html>
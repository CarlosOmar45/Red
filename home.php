<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require "/home/conectared.php";
$con = conecta();
session_start();
if(empty($_SESSION['id'])){
    header('Location: ./login.php');
    exit();
}
    $nombre=$_SESSION['nombre'];
    $apellidos=$_SESSION['apellidos'];
$carrera=$_SESSION['carrera'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publicaciones</title>
    <link rel="stylesheet" href="styles.css"> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
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
            <div class="avatar">
                <img class="foto" src="./foto.png" alt="fotoperfil">
                    </div>
                <strong><?php echo "$nombre $apellidos <br> $carrera";?></strong>
                <button class="add-post" onclick="alta()">Añadir lugar</button>
            </div>
<?php
$sql_pedidos = "SELECT * FROM Lugar ";
$res_lugar = $con->query($sql_pedidos);

// Verificar si el usuario tiene pedidos
if (mysqli_num_rows($res_lugar) > 0) {
    // Recorrer todos los pedidos
    while ($lugar = $res_lugar->fetch_array()) {
        $lugar_id = $lugar["lugar_id"]; // ID del lugar
        $nombrel = $lugar["nombre"]; // nombre
        $descripcion = $lugar["descripcion"]; // Descripción
        $estrellas = $lugar["estrellas_prom"];
        $user_id=$lugar['user_id'];
        $ra = 5;
        $sql = "SELECT * FROM Usuario WHERE user_id=$user_id";
        $res = $con->query($sql);
        $row = $res->fetch_array();
        $nombre = $row["nombre"];
        $apellidos = $row["apellidos"];
        $carrera = $row["carrera"];

        echo "<h3>Lugar ID: $lugar_id</h3>";
        // Publicación
        echo "
        <div class=\"post\">
        <a href=\"./post.php?id=$lugar_id\">
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
                $descripcion
            </p>
            <div class=\"post-image\"></div>
            </a>
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
                    <span class=\"likes\" id =\"$lugar_id\">$likes</span>
                                <a class=\"like-button\" href=\"javascript:void(0);\"  onclick=\"LikeLugar($lugar_id);\" type=\"submit\">&nbsp;👍&nbsp;</pre></a>
                </div>
            </div>
        </div>
        

        <div class=\"comment-section\">
            <input type=\"text\" placeholder=\"Escribe un comentario aquí...\">
            <button class=\"comment-button\">COMENTAR</button>
        </div>
        ";
    }
} else {
    echo "<p>No hay ninguna publicación aún.</p>";
}
?> 
    </main>
    <script src="a.js"></script>
</body>
</html>
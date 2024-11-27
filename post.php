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
    <header>
        <div class="logo">REDCUCEI</div>
        <nav>
            <a href="/home">INICIO</a>
            <a href="/profile">PERFIL</a>
            <button class="logout">Salir</button>
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
$sql_pedidos = "SELECT * FROM Lugar";
$res_lugar = $con->query($sql_pedidos);

// Verificar si el usuario tiene pedidos
if (mysqli_num_rows($res_lugar) > 0) {
    // Recorrer todos los pedidos
    while ($lugar = $res_lugar->fetch_array()) {
        $lugar_id = $lugar["lugar_id"]; // ID del lugar
        $nombrel = $lugar["nombre"]; // nombre
        $descripcion = $lugar["descripcion"]; // Costo de envío

        echo "<h3>Lugar ID: $lugar_id</h3>";
        //publicacion
        echo "
        <div class=\"post\">
            <div class=\"post-header\">
                <div class=\"avatar\"></div>
                <div>
                    <strong>Raul</strong>
                    <p>Ingeniería Bioquímica</p>
                </div>
            </div>
            <h2>$nombrel</h2>
            <p>
                $descripcion
            </p>
            <div class=\"post-image\"></div>
            <div class=\"post-footer\">
                <div class=\"rating\">
                    ★★★★☆
                </div>
                <div>
                    <span class=\"likes\">180</span>
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
} else {
    echo "<p>No has realizado ningúna publicacion aún.</p>";
}
?> 
    </main>
</body>
</html>

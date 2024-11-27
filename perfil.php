<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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
    <title>Perfil</title>
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
        <?php
           #$id =$_SESSION['idu'];
           $sql = "SELECT * FROM Usuario WHERE user_id='1'";
           $res = $con->query($sql);
           $row = $res->fetch_array();
           $nombre = $row["nombre"];
           $apellidos = $row["apellidos"];
           $correo = $row["correo"];
           $carrera = $row["carrera"];
           $codigo = $row["codigo"];
           $nacimiento = $row["fecha_nacimiento"];
        ?>
        <!-- Sección de Información del Usuario -->
        <section class="profile-info">
            <div class="user-card">
                <div class="avatar">
                <img class="foto" src="./foto.png" alt="fotoperfil">
                </div>
                <div class="user-details">
                    <p><strong>NOMBRE</strong>: <?php echo $nombre . " " . $apellidos; ?></p>
                    <p><strong>CARRERA</strong>: <?php echo $carrera; ?></p>
                    <p><strong>FECHA DE NACIMIENTO</strong>: <?php echo $nacimiento; ?></p>
                    <?php  
                    $sql = "SELECT count(*) AS coment FROM Comentario WHERE user_id='1'";
                    $res = $con->query($sql);
                    $row = $res->fetch_array();
                    $comentarios = $row['coment']; 
                    $sql = "SELECT count(*) AS post FROM Lugar WHERE user_id='1'";
                    $res = $con->query($sql);
                    $row = $res->fetch_array();
                    $post = $row['post']; 
                    ?>
                    <p><strong>NÚMERO DE PUBLICACIONES</strong>: <?php echo $post; ?></p>
                    <p><strong>NÚMERO DE COMENTARIOS</strong>: <?php echo $comentarios; ?></p>
                </div>
            </div>
        </section>

        <!-- Título Publicaciones -->
        <h2>PUBLICACIONES</h2>
        <?php
        $sql_pedidos = "SELECT * FROM Lugar WHERE user_id='1'";
        $res_lugar = $con->query($sql_pedidos);

        // Verificar si el usuario tiene pedidos
        if (mysqli_num_rows($res_lugar) > 0) {
            // Recorrer todos los pedidos
            while ($lugar = $res_lugar->fetch_array()) {
                $lugar_id = $lugar["lugar_id"]; // ID del lugar
                $nombrel = $lugar["nombre"]; // nombre
                $descripcion = $lugar["descripcion"]; // Descripción
                $estrellas = $lugar["estrellas_prom"];
                $ra = 5;

                echo "<h3>Lugar ID: $lugar_id</h3>";
                // Publicación
                echo "
                <a href=\"./post.php?id=$lugar_id\">
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
                        $sql = "SELECT COUNT(*) AS total_likes FROM Likes WHERE lugar_id = 1 AND item_type = 'lugar' AND like_value = TRUE";
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
                </a>
                <div class=\"comment-section\">
                    <input type=\"text\" placeholder=\"Escribe un comentario aquí...\">
                    <button class=\"comment-button\">COMENTAR</button>
                </div>
                ";
            }
        } else {
            echo "<p>No has realizado ninguna publicación aún.</p>";
        }
        ?>
    </main>
</body>
</html>


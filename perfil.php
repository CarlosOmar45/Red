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
    <header>
        <div class="logo">REDCUCEI</div>
        <nav>
            <a href="/home">INICIO</a>
            <a href="/profile">PERFIL</a>
            <button class="logout">Salir</button>
        </nav>
    </header>
    <main class="container">
        <?php
           #$id =$_SESSION['idu'];
           $sql = "SELECT * FROM Usuario WHERE user_id='1'";
           $res = $con->query($sql);
           $row = $res->fetch_array();
           $id = $row["user_id"];
           $nombre = $row["nombre"];
           $apellidos = $row["apellidos"];
           $correo = $row["correo"];
           $rol = $row["carrera"];
           $codigo = $row["codigo"];
           $nacimiento = $row["fecha_nacimiento"];
        ?>
        <!-- Sección de Información del Usuario -->
        <section class="profile-info">
            <div class="user-card">
                <div class="avatar"></div>
                <div class="user-details">
                    <p><strong>NOMBRE</strong>: <?php echo $nombre . " " . $apellidos; ?></p>
                    <p><strong>CARRERA</strong>: Ingeniería Bioquímica</p>
                    <p><strong>FECHA DE NACIMIENTO</strong>: <?php echo $nacimiento; ?></p>
                    <p><strong>NÚMERO DE PUBLICACIONES</strong>: 10</p>
                    <p><strong>NÚMERO DE COMENTARIOS</strong>: 34</p>
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

                echo "<h3>Lugar ID: $lugar_id</h3>";
                // Publicación
                echo "
                <div class=\"post\">
                    <div class=\"post-header\">
                        <div class=\"avatar\"></div>
                        <div>
                            <strong>$nombre</strong>
                            <p>Ingeniería Bioquímica</p>
                        </div>
                    </div>
                    <h2>$nombrel</h2>
                    <p>
                        Body text for your whole article or post. We'll put in some lorem ipsum to show how a filled-out page might look:
                        Excepteur efficient emerging, minim veniam anim aute carefully curated Ginza conversation exquisite...
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
            echo "<p>No has realizado ninguna publicación aún.</p>";
        }
        ?>
    </main>
</body>
</html>

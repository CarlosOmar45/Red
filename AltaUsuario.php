<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#registerForm').on('submit', function(e) {
                e.preventDefault();
                var name = $('#name').val();
                var lastname = $('#lastname').val();
                var mail = $('#mail').val();
                var pass = $('#pass').val();
                var pass2 = $('#pass2').val();
                var codigo = $('#codigo').val();
                var date = $('#date').val();
                var carrera = $('#carrera').val();

                if (name === "" || lastname === "" || mail === "" || pass === "" || pass2 === "" || codigo === "" || date === "" || carrera === "") {
                    alert("Todos los campos son obligatorios.");
                    return;
                }

                if (pass !== pass2) {
                    alert("Las contraseñas no coinciden.");
                    return;
                }

                if (!validateEmail(mail)) {
                    alert("Correo no válido.");
                    return;
                }

                $.ajax({
                    url: 'check_email.php',
                    type: 'POST',
                    data: { correo: mail },
                    success: function(response) {
                        if (response === 'exists') {
                            alert("El correo ya está registrado.");
                        } else {
                            $.ajax({
                                url: 'altaU.php',
                                type: 'POST',
                                data: {
                                    name: name,
                                    lastname: lastname,
                                    mail: mail,
                                    pass: pass,
                                    codigo: codigo,
                                    date: date,
                                    carrera: carrera
                                },
                                success: function(response) {
                                    alert(response);
                                }
                            });
                        }
                    }
                });
            });

            function validateEmail(email) {
                var re = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
                return re.test(email);
            }
        });
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
<main class="main">
    <div class="form-container">
        <h1>REGISTRO</h1>
        <form id="registerForm">
            <div class="name-group">
                <input id="name" type="text" placeholder="NOMBRE" required style="width: 49.25%;">
                <input id="lastname" type="text" placeholder="APELLIDOS" required style="width: 49.25%;">
            </div>
            <input id="mail" type="email" placeholder="CORREO" required>
            <input id="pass" type="password" placeholder="CONTRASEÑA" required>
            <input id="pass2" type="password" placeholder="CONFIRMAR CONTRASEÑA" required>
            <input id="codigo" type="text" placeholder="CÓDIGO" required>
            <label for="fecha">FECHA DE NACIMIENTO</label>
            <input id="date" type="date" id="fecha" required>
            <select id="carrera" required>
                <option value="" disabled selected>SELECCIONA TU CARRERA</option>
                <option value="1">Licenciatura en Física</option>
                <option value="2">Licenciatura en Matemáticas</option>
                <option value="3">Licenciatura en Química</option>
                <option value="4">Químico Farmacéutico Biólogo</option>
                <option value="5">Ingeniería en Ciencia de Materiales</option>
                <option value="6">Ingeniería Civil</option>
                <option value="7">Ingeniería en Alimentos y Biotecnología</option>
                <option value="8">Ingeniería en Topografía Geomática</option>
                <option value="9">Ingeniería Industrial</option>
                <option value="10">Ingeniería Mecánica Eléctrica</option>
                <option value="11">Ingeniería Química</option>
                <option value="12">Ingeniería en Logística y Transporte</option>
                <option value="13">Ingeniería Informática</option>
                <option value="14">Ingeniería Biomédica</option>
                <option value="15">Ingeniería en Computación</option>
                <option value="16">Ingeniería en Electromovilidad y Autotrónica</option>
                <option value="17">Ingeniería en Electrónica y Sistemas Inteligentes</option>
                <option value="18">Ingeniería Fotónica</option>
                <option value="19">Ingeniería en Mecatrónica Inteligente</option>
                <option value="20">Ingeniería Robótica</option>
            </select>
            <button type="submit">REGÍSTRATE</button>
            <p class="login-link">¿Ya tienes cuenta? <a href="./login.php">LOG IN</a></p>
        </form>
    </div>
</main>
</body>
</html>
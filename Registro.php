<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta Lugar</title>
    
    <link rel="stylesheet" href="styles.css">
    <script> function validarFormulario(event) { event.preventDefault(); // Evitar el envío del formulario 
    // Obtener los valores de los campos 
    var nombre = document.getElementById('name').value; 
    var distancia = document.getElementById('ditan').value; 
    var calle = document.getElementById('calle').value; 
    var noext = document.getElementById('noext').value; 
    var tipoEstablecimiento = document.getElementById('tipo').value; 
    var descripcion = document.getElementById('desc').value; // Validar que todos los campos estén llenos 
    if (!nombre || !distancia || !calle || !noext || !tipoEstablecimiento || !descripcion) { 
        alert('Por favor, completa todos los campos.'); 
        return; 
    } // Enviar los datos mediante AJAX 
    var xhr = new XMLHttpRequest(); 
    xhr.open('POST', 'postcrea.php', true); 
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded'); 
    xhr.onreadystatechange = function () { 
        if (xhr.readyState === 4 && xhr.status === 200) { 
            alert('Lugar registrado con éxito.'); 
            } 
    }; 
    xhr.send('name=' + encodeURIComponent(nombre) +  
       '&ditan=' + encodeURIComponent(distancia) +
       '&calle=' + encodeURIComponent(calle) +
       '&noext=' + encodeURIComponent(noext) + 
       '&carrera=' + encodeURIComponent(tipoEstablecimiento) + 
       '&desc=' + encodeURIComponent(descripcion)); 
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
    <main class="main">
        <div class="form-container">
            <h1>ALTA LUGAR</h1>
            <form onsubmit="validarFormulario(event)">
                <input id="name" type="text" placeholder="NOMBRE" required>
                <input id="ditan" type="number" placeholder="DISTANCIA EN MINUTOS" required>
                <div class="address">
                    <input id="calle" type="text" placeholder="CALLE" required style="width: 49.25%;">
                    <input id="noext" type="text" placeholder="No EXTERIOR" required style="width: 49.25%;">
                </div>
                <select id='tipo' required>
                    <option value="" disabled selected>SELECCIONA EL TIPO DE ESTABLECIMIENTO</option> 
                    <option value="Cafetería">Cafetería</option> 
                    <option value="Biblioteca">Biblioteca</option> 
                    <option value="Parque">Parque</option> 
                    <option value="Gimnasio">Gimnasio</option> 
                    <option value="Restaurante">Restaurante</option> 
                    <option value="Sala de Estudio">Sala de Estudio</option> 
                    <option value="Centro Comercial">Centro Comercial</option> 
                    <option value="Cine">Cine</option> 
                    <option value="Museo">Museo</option> 
                    <option value="Teatro">Teatro</option>
                    <option value="Otro">Otro</option>      
                </select>
                <textarea id="desc" placeholder="Descripción" required></textarea>
                <button type="submit" >REGÍSTRAR</button>
            </form>
        </div>
    </main>
    <script src="a.js"></script>
</body>
</html>

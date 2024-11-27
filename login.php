<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require "/home/conectared.php";
$con = conecta();
if(!empty($_SESSION['id'])){
    header('Location: ./home.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"integrity="sha512-qzrZqY/kMVCEYeu/gCm8U2800Wz++LTGK4pitW/iswpCbjwxhsmUwleL1YXaHImptCHG0vJwU7Ly7ROw3ZQoww==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="styles.css">
<script>$(document).ready(function(){
	var correo = $("#correo");
	var pass = $("#pass"); 

	correo.blur(validateCorreo);
	pass.blur(validatePass);
	function validateCorreo(){
		var a = correo.val();
		var filter = /^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+[a-zA-Z0-9_-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-z]{2,4}$/;
		if(filter.test(a)){
            correo.removeClass("error");
			return true;
		}
		else{
			correo.addClass("error");
            $('#mensaje').html('Debe introducir un correo valido!')
            setTimeout("$('#mensaje').html('');",5000)
			return false;
		}
	}
	function validatePass(){
		if(pass.val().length < 1){
			pass.addClass("error");
            $('#mensaje').html('Ingresa la contraseña')
            setTimeout("$('#mensaje').html('');",5000)
			return false;
		}
		else{			
			pass.removeClass("error");
			return true;
		}
	}
});
function iniciaSesion(){
    var correo = $('#correo').val();
    var pass = $('#pass').val();
        if(validateCorreo()& validatePass()){
            $.ajax({
                url:'./valida.php?',
                type:'post',
                dataType:'text',
                data:'correo='+correo+'&'+'pass='+pass,
                success:function(res){
                    if(res==1){
                        location.href ="./home.php";
                    }
                    else{
                        $('#mensaje').html('Correo o contraseña erroneos!!');
                    }
                    setTimeout("$('#mensaje').html('');",5000);

                },error:function(){
                    alert('Error archivo no encontrado');
                }})
                }else{
            $('#mensaje').html('Faltan campos por llenar!!')
            setTimeout("$('#mensaje').html('');",5000)
        }
        function validateCorreo(){
            var a = correo;
            var filter = /^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+[a-zA-Z0-9_-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-z]{2,4}$/;
            if(filter.test(a)){
                
                return true;
            }
            else{
                $('#mensaje').html('Debe introducir un correo valido!')
                setTimeout("$('#mensaje').html('');",5000)
                return false;
            }
        }
        function validatePass(){
            if(pass.length < 1){
                $('#mensaje').html('Ingresa la contraseña')
                setTimeout("$('#mensaje').html('');",5000)
                return false;
            }
            else{			
                return true;
            }
        }
    }
</script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar secion</title>
    <style>

.forma02 {
  margin: 40px auto;
  width: 350px;
  display: flex;
  flex-direction: column;
  gap: 10px;
  padding-left: 2em;
  padding-right: 2em;
  padding-bottom: 0.4em;
  background-color: #171717;
  border-radius: 25px;
  transition: .4s ease-in-out;
}

.forma02:hover {
  transform: scale(1.05);
  border: 1px solid black;
}

#heading {
  text-align: center;
  margin: 2em;
  color: rgb(255, 255, 255);
  font-size: 1.2em;
}

.field {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 0.5em;
  border-radius: 25px;
  padding: 0.6em;
  border: none;
  outline: none;
  color: white;
  background-color: #171717;
  box-shadow: inset 2px 5px 10px rgb(5, 5, 5);
}

.input-icon {
  height: 1.3em;
  width: 1.3em;
  fill: white;
}

.input-field {
  background: none;
  border: none;
  outline: none;
  width: 100%;
  color: #d3d3d3;
}

.forma02 .btn1 {
  text-align: center !important;
  display: flex;
  justify-content: center;
  flex-direction: row;
  margin-top: 2.5em;
}

.button1 {
  width:50% !important;
  padding: 0.5em;
  padding-left: 1.1em;
  padding-right: 1.1em;
  border-radius: 5px;
  margin-right: 0.5em;
  border: none;
  outline: none;
  transition: .4s ease-in-out;
  background-color: #252525;
  color: white;
}

.button1:hover {
  background-color: black;
  color: white;
}

.button2 {
  width:50% !important;
  padding: 0.5em;
  padding-left: 2.3em;
  padding-right: 2.3em;
  border-radius: 5px;
  border: none;
  outline: none;
  transition: .4s ease-in-out;
  background-color: #252525;
  color: white;
}

.button2:hover {
  background-color: black;
  color: white;
}

.button3 {
  margin-bottom: 3em;
  padding: 0.5em;
  border-radius: 5px;
  border: none;
  outline: none;
  transition: .4s ease-in-out;
  background-color: #252525;
  color: white;
}

.button3:hover {
  background-color: red;
  color: white;
}
    </style>
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
    <form class="forma02" name="forma02" id="forma02" method="post">
        <p id="heading">Login</p>
        <div class="field">
        <img  style="filter: invert(100%);" src="./arroba.png" class="input-icon"  width="16" fill="currentColor" viewBox="0 0 16 16" >
          <input class="input-field" autocomplete="off" placeholder="Username" id="correo" name="correo" type="text">
        </div>
        <div class="field">
        <img  style="filter: invert(100%);" src="./pass.png" class="input-icon"  width="16" fill="currentColor" viewBox="0 0 16 16">
          <input id="pass" name="pass" placeholder="Password" class="input-field" type="password">
        </div>
        <div class="btn1">
        <a class="button1" href="javascript:void(0);"  onclick="iniciaSesion();" type="submit">Login</pre></a>
        <a class="button2" href="./registro.html"  type="submit">Sing Up</pre></a>
        </div>
        <button class="button3">Forgot Password</button>
    </form>
      <div class="seccion" id="mensaje">
    </div>
    <script src="a.js"></script>
</body>
</html>
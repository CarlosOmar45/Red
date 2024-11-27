<?php
session_start();
require "/home/conectared.php";
$con = conecta();
$correo=$_POST['correo'];
$password=$_REQUEST['pass'];
$pass=md5($password);
$pass=$password;


// Consulta para verificar el usuario
$sql = "SELECT * FROM Usuario WHERE correo = '$correo' AND password = '$pass'";
$res = $con->query($sql);

if ($res->num_rows == 0) {
    $a=0;
    }
    else{
        $row=$res->fetch_array();
        $rol =$row["rol"];
        $a=1;
        $id =$row["id"];
        $nombre =$row["nombre"];
        $apellidos =$row["apellidos"];
        $_SESSION['id']=$id;
        $_SESSION['nombre']=$nombre;
        $_SESSION['apellidos']=$apellidos;
        $_SESSION['correo']=$correo;
        $_SESSION['rol']=$rol_txt;

    }
    echo $a;
    
?>
<?php

$alert = '';

session_start();

if (!empty($_SESSION['active'])) {
    
    header('location: sistema/');
}else{

    if (!empty($_POST)) {

     if (empty($_POST['usuario'])  || empty($_POST['clave'])){
        $alert = "ingrese su usuario y clave";
    }else{
        require_once "conexion.php";

        $user = ($_POST['usuario']);
        $pass = ($_POST['clave']);

        $query = mysqli_query($conection,"SELECT * FROM usuario WHERE usuario= '$user' 
        AND clave= '$pass'");
        $result = mysqli_num_rows($query);

        if ($result > 0) {
            $data = mysqli_fetch_array($query);
            $_SESSION['active'] = true;
            $_SESSION['idUser'] = $data['idusuario'];
            $_SESSION['nombre'] = $data['nombre'];
            $_SESSION['email']  = $data['email'];
            $_SESSION['user']   = $data['usuario'];
            $_SESSION['rol']    = $data['rol'];

            header('location: sistema/');
            
        }else {
            $alert = "Usuario o contraseña son incorrectos";

            session_destroy();
        }
    }

}
}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Sistema facturacion</title>
    <link rel="stylesheet" href="'https://fonts.googleapis.com/css2? family= Montserrat:ital,wght@0,400;0,500;0,600;0,700;1,300 & display=swap'">
    <link rel="stylesheet" href="css/stilo.css">
</head>
<body>
    <section id="container">
        <form action="" method="post">
            <h3>Iniciar Sesion</h3>
            <img src="img/iniciosesion.png" alt="Login">
            <input type="text" name="usuario" placeholder="Usuario">
            <input type="password" name="clave" placeholder="Contraseña">
            <p class="alert"><?php echo isset($alert) ? $alert : '';?></p>
            <input type="submit" value="INGRESAR">

        </form>
    </section>
</body>
</html>
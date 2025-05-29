<?php
session_start();

// Verificar si el usuario ya está logueado
if (isset($_SESSION['usuario'])) {
    header('Location: inicio.php'); // Redirigir a la página de inicio u otra página
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/registros.css">
    <link rel="icon" href="favicon.ico">
    <title>Registro</title>
</head>
<body>
    <h1 style="text-align: center; font-size: 90px; color: rgb(150, 6, 6); font-family: italic;">RAMBET STORE</h1>
    <nav>
        <a href="inicio.php">INICIO</a>
        <a href="productos.php">PRODUCTOS</a>
        <a href="consejos.php">CONSEJOS</a>
        <a href="contacto.php">CONTACTO</a>
        <a href="registro.php">REGISTRO</a>
        <a href="iniciarsession.php">LOGIN</a>
    </nav>
        
        <form method="post" autocomplete="off" action="">
    <section class="form-register">
        <h4>FORMULARIO REGISTRO</h4>
        <input class="controls" type="text" name="nombre" id="nombre" placeholder="Ingresa su Nombre">
        <input class="controls" type="text" name="apellidos" placeholder="Ingresa sus apellidos">
        <input class="controls" type="email" name="correo" id="correo" placeholder="Ingresa su correo">
        <input class="controls"  type="password" name="contrasena" id="contrasena" placeholder="Ingresa su contraseña">
        <p>Estoy de acuerdo con <a href="#">Terminos y condiciones</a></p>
        <input class="botons" type="submit" value="Registrar" name="send">
        <p><a href="iniciarsession.php">Ya tengo una cuenta</a></p>
    </section>
</form>

    <?php
    include("./include/send.php");
    ?>
</body>
</html>
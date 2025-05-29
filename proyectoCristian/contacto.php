<?php
session_start();

// Verificar si hay sesión activa
$usuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/contacto.css">
    <link rel="icon" href="favicon.ico">
    <title>Formulario Contacto</title>
</head>
<body>
<h1 style="text-align: center; font-size: 90px; color: rgb(150, 6, 6); font-family: italic;">RAMBET STORE</h1>

<nav>
    <nav>
        <?php if ($usuario): // Mostrar solo si hay sesión activa ?>
            <?php if (isset($usuario['nombre']) && isset($usuario['apellidos'])): ?>
                <a>¡Hola, <?php echo $usuario['nombre'] . ' ' . $usuario['apellidos']; ?>!</a>
            <?php endif; ?>
        <?php endif; ?>
    </nav>
</nav>

<nav>
    <nav>
            <a href="inicio.php">INICIO</a>
            <a href="productos.php">PRODUCTOS</a>
            <a href="consejos.php">CONSEJOS</a>
            <a href="contacto.php">CONTACTO</a>
            <?php if (!$usuario): // Mostrar solo si no hay sesión activa ?>
                <a href="registro.php">REGISTRO</a>
                <a href="iniciarsession.php">LOGIN</a>
            <?php endif; ?>
            <?php if ($usuario && isset($usuario['role_id']) && $usuario['role_id'] == 1): ?>
                <a href="./modules/users/user.php">ADMINISTRACIÓN</a>
                <?php elseif ($usuario && isset($usuario['role_id']) && $usuario['role_id'] == 2): ?>
                <a href="./modules/users/user.php">MI PERFIL</a>
            <?php endif; ?>
            <?php if ($usuario): // Mostrar solo si hay sesión activa ?>
            <a href="./include/close.php">CERRAR SESSION</a>
            <?php endif; ?>
    </nav>
</nav>
        
    <form class="form" action="https://formsubmit.co/lizrhernandez08@gmail.com" method="POST" > 
        <h2>Contacto</h2>
        <div class="input-group">
            <label for="name">Nombre</label>
            <input type="text" name="name" placeholder="Nombre">
            <label for="phone">Télefono</label>
            <input type="tel" name="phone" id="phone" placeholder="Teléfono">
            <label for="email">E-mail</label>
            <input type="email" name="email" id="email" placeholder="E-mail">
            <label for="message">Mensaje</label>
            <textarea name="message" id="message" cols="30" rows="5" 
            placeholder="Mensaje"></textarea>
            <div class="form-txt">
                <a href="#">Politica de privacidad</a>
                <a href="#">Términos y condiciones</a>
            </div>
            <input type="submit" class="btn" value="Enviar">
            <input type="hidden" name="_next" value="http://127.0.0.1:5500/index.html">
            <input type="hidden" name="_captcha" value="false">
        </div>
    </form>
</body>
</html>
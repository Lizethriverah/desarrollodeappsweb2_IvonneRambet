<?php
session_start();

// Verificar si hay sesión activa
$usuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : null;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/consejos.css">
    <link rel="icon" href="favicon.ico">
    <title>Consejos</title>
</head>
<body>
    <h1 style="text-align: center; font-size: 90px; color: rgb(150, 6, 6); font-family: italic;">RAMBET STORE</h1>

    <nav>
            <?php if ($usuario): // Mostrar solo si hay sesión activa ?>
                <?php if (isset($usuario['nombre']) && isset($usuario['apellidos'])): ?>
                    <a>¡Hola, <?php echo $usuario['nombre'] . ' ' . $usuario['apellidos']; ?>!</a>
                <?php endif; ?>
            <?php endif; ?>
    </nav>

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

    <h1>Guía de tallas</h1>
    <div class="container">
        <div class="content">
            <img src="img/medidas.webp" alt="Ilustración de medidas" width="200">
            <div class="text">
                <div class="section">
                    <strong>A - Busto</strong>
                    <p>Mide tu pecho por la parte más llena del busto llevando un sostén que te quede bien.</p>
                    <div class="line"></div>
                </div>
                <div class="section">
                    <strong>B - Cintura</strong>
                    <p>Mide la parte más estrecha de tu cintura.</p>
                    <div class="line"></div>
                </div>
                <div class="section">
                    <strong>C - Caderas</strong>
                    <p>Mide la parte más ancha de tus caderas.</p>
                    <div class="line"></div>
                </div>
            </div>
        </div>
    </div>
    <footer>Medidas en pulgadas</footer>
</body>
</html>

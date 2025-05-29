<?php
session_start();

// Verificar si hay sesión activa
$usuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=">
    <link rel="icon" href="favicon.ico">
    <title>PRODUCTOS RAMBET</title>
    <link rel="stylesheet" href="./styles/productos.css">
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

    <div class="container">
        <link rel="stylesheet" href="productos.css">
        <h2 >NUESTROS PRODUCTOS</h2>
        <hr>
        <div class="products">
            <!-- Producto 1 -->
            <div class="product"> 
                <a href="inicio.html" target="_parent"><img src="img/COLECCION 2024.jpg" width="300px" height="400px" title="modelo 2024 Coleccion 2024" alt="Vestido de novia"></a>
                <div class="product-title">Wedding dress</div>
                <div class="product-price">$15,275.00</div>
                <a href="#" class="buy-button">Comprar</a>
            </div>
            
            <!-- Producto 2 -->
            <div class="product">
                <img src="img/BLACKRAMBET.jpg"  width="300px" height="400px" alt="Dress, COLECCION 2024">
                <div class="product-title">Vestido negro elegante</div>
                <div class="product-price">$3,185.00</div>
                <a href="#" class="buy-button">Comprar</a>
            </div>
    
            <!-- Producto 3 -->
            <div class="product">
                <img src="img/BLUE DRESS.jpg"  width="300px" height="400px" alt="COLECCION 2024">
                <div class="product-title">Vestido azul</div>
                <div class="product-price">$5,190.00</div>
                <a href="#" class="buy-button">Comprar</a>
            </div>
    
            <!-- Producto 4 -->
            <div class="product">
                <img src="img/IVONEEEE.jpg"  width="300px" height="400px" alt="Sensual COLECCION 2024">
                <div class="product-title">Sensual red</div>
                <div class="product-price">$2,195.00</div>
                <a href="#" class="buy-button">Comprar</a>
            </div>
    
             <!-- Producto 5 -->
             <div class="product">
                <img src="img/RAMB.jpg"  width="300px" height="400px" alt="COLECCION 2024">
                <div class="product-title">Duo elegant</div>
                <div class="product-price">$4,185.00</div>
                <a href="#" class="buy-button">Comprar</a>
            </div>
            
        </div>
    </div>
    
</body>
</html>
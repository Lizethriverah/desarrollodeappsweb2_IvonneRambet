<?php
session_start();

// Verificar si el usuario ya está logueado
if (isset($_SESSION['usuario'])) {
    header('Location: inicio.php'); // Redirigir a la página de inicio u otra página
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>LOGIN ACCOUNT</title>
    <link rel="stylesheet" href="./styles/sesion.css">
    <style>
        .session-box {
            width: 400px;
            margin: 40px auto;
            padding: 20px;
            border: 2px solid #900;
            border-radius: 10px;
            background-color: #f9f9f9;
            text-align: center;
        }
        .session-box h3 {
            color: #900;
        }
        .session-box p {
            margin: 8px 0;
        }
        .session-buttons {
            margin-top: 20px;
        }
        .session-buttons form,
        .session-buttons a {
            display: inline-block;
            margin: 0 10px;
        }
        .session-buttons button,
        .session-buttons a {
            padding: 8px 16px;
            background-color: #900;
            color: white;
            border: none;
            border-radius: 5px;
            text-decoration: none;
        }
        .session-buttons button:hover,
        .session-buttons a:hover {
            background-color: #700;
        }
    </style>
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
        <div class="login-container">
            <div class="login-box">
                <h2>LOGIN ACCOUNT</h2>
                <a href="registro.php">¿No tienes una cuenta?</a>
                <div class="input-group">
                    <input type="text" name="email" placeholder="CORREO:" required>
                </div>
                <div class="input-group">
                    <input type="password" name="password" placeholder="CONTRASEÑA:" required>
                </div>
                <div class="options">
                    <label><input type="checkbox" name="remember" id="remember"> Acepto los términos y condiciones</label>
                </div>
                <button type="submit" class="login-btn">LOGIN</button>
            </div>
        </div>
    </form>

    <?php include("./include/auth.php"); ?>

</body>
</html>



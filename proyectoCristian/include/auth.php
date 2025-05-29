<?php
session_start();
include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Consulta para obtener los datos del usuario junto con su rol
    $query = "SELECT rambet.*, roles.name AS role_name 
              FROM rambet 
              LEFT JOIN roles ON rambet.role_id = roles.id 
              WHERE rambet.email='$email'";
    $result = mysqli_query($conex, $query);

    if (mysqli_num_rows($result) > 0) {
        $usuario = mysqli_fetch_assoc($result);

        // Verificar la contraseña
        if ($password == $usuario['contraseña']) {
            // Guardar los datos del usuario en la sesión, incluyendo el rol
            $_SESSION['usuario'] = [
                'id'       => $usuario['id'],
                'nombre'   => $usuario['nombre'],
                'apellidos'=> $usuario['apellidos'],
                'correo'   => $usuario['email'],
                'role_id'  => $usuario['role_id'], // ID del rol
                'fecha'     => $usuario['fecha'],
            ];

            // Redirigir al inicio
            header("Location: inicio.php");
            exit();
        } else {
            echo "<p style='color:red; text-align:center;'>Contraseña incorrecta</p>";
        }
    } else {
        echo "<p style='color:red; text-align:center;'>Correo no encontrado</p>";
    }
}
?>



<?php

include("conexion.php");

if (isset($_POST['send'])) {
    if (
        !empty($_POST['nombre']) &&
        !empty($_POST['apellidos']) &&
        !empty($_POST['correo']) &&
        !empty($_POST['contrasena'])
    ) {
        $nombre = mysqli_real_escape_string($conex, trim($_POST['nombre']));
        $apellidos = mysqli_real_escape_string($conex, trim($_POST['apellidos']));
        $correo = mysqli_real_escape_string($conex, trim($_POST['correo']));
        $contraseña = mysqli_real_escape_string($conex, trim($_POST['contrasena']));

        // Consulta preparada para evitar inyecciones SQL
        $consulta = "INSERT INTO rambet (nombre, apellidos, email, contraseña) VALUES (?, ?, ?, ?)";
        $stmt = $conex->prepare($consulta);
        $stmt->bind_param("ssss", $nombre, $apellidos, $correo, $contraseña);

        if ($stmt->execute()) {
            echo '<h3 class="success">Tu registro se ha completado</h3>';
        } else {
            echo '<h3 class="error">Ocurrió un error: ' . $stmt->error . '</h3>';
        }

        $stmt->close();
    } else {
        echo '<h3 class="error">Llena todos los campos</h3>';
    }
}
?>

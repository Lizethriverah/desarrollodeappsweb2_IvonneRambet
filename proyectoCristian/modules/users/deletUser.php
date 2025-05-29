<?php
session_start(); // Iniciar la sesión

include '../../include/conexion.php'; // Asegúrate de que la conexión sea correcta

// Verificar si el usuario está autenticado
if (!isset($_SESSION['usuario'])) {
    header('Location: ../../iniciarsession.php'); // Redirigir al inicio de sesión si no está autenticado
    exit();
}

// Verificar si hay sesión activa
$usuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : null;

// Redirigir a la página de usuarios si el usuario tiene role_id = 2
if ($usuario['role_id'] == 2) {
    header('Location: user.php');
    exit();
}

// Obtener el ID del usuario logueado
$usuarioLogueadoId = isset($_SESSION['usuario']['id']) ? intval($_SESSION['usuario']['id']) : 0;

// Verificar si se recibió un ID válido para eliminar
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $idEliminar = intval($_GET['id']); // Sanitizar el ID recibido

    // Verificar si el usuario logueado es el mismo que se intenta eliminar
    if ($usuarioLogueadoId === $idEliminar) {
        echo "<script>alert('No puedes eliminar el usuario con el que estás logueado.'); window.location.href='user.php';</script>";
        exit();
    }

    // Consulta para eliminar el usuario
    $sql = "DELETE FROM rambet WHERE id = ?";
    $stmt = $conex->prepare($sql);
    $stmt->bind_param("i", $idEliminar);

    if ($stmt->execute()) {
        echo "<script>alert('Usuario eliminado correctamente.'); window.location.href='user.php';</script>";
    } else {
        echo "<script>alert('Error al eliminar el usuario: " . $stmt->error . "'); window.location.href='user.php';</script>";
    }

    $stmt->close();
} else {
    echo "<script>alert('ID de usuario no válido.'); window.location.href='user.php';</script>";
}

// Cerrar la conexión
$conex->close();
?>
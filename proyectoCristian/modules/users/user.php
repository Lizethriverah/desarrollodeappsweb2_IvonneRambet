<?php
session_start();

// Verificar si hay sesión activa
$usuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : null;

// Redirigir al index si no hay sesión activa
if (!$usuario) {
    header("Location: ../../inicio.php");
    exit;
}

include '../../include/conexion.php'; // Asegúrate de que la conexión sea correcta

// Consulta para obtener los datos de los usuarios
if ($usuario['role_id'] == 2) {
    // Si el usuario es Admin (role_id = 1), solo mostrar su propio registro
    $sql = "SELECT rambet.id, rambet.nombre, rambet.apellidos, rambet.email, rambet.contraseña, roles.name AS rol, rambet.fecha 
            FROM rambet 
            JOIN roles ON rambet.role_id = roles.id
            WHERE rambet.id = ?";
    $stmt = $conex->prepare($sql);
    $stmt->bind_param("i", $usuario['id']);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    // Si el usuario es Usuario (role_id = 2), mostrar todos los usuarios
    $sql = "SELECT rambet.id, rambet.nombre, rambet.apellidos, rambet.email, rambet.contraseña, roles.name AS rol, rambet.fecha 
            FROM rambet 
            JOIN roles ON rambet.role_id = roles.id";
    $result = $conex->query($sql);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styles/panel.css">
    <link rel="stylesheet" href="../../styles/module.css    ">
    <link rel="icon" href="favicon.ico">
    <title>Usuarios</title>
</head>
<body>
    <h1 style="text-align: center; font-size: 90px; color: rgb(150, 6, 6); font-family: italic;">RAMBET STORE</h1>

    <nav>
        <?php if ($usuario): // Mostrar solo si hay sesión activa ?>
            <?php if (isset($usuario['nombre']) && isset($usuario['apellidos'])): ?>
                <a>¡Hola, <?php echo htmlspecialchars($usuario['nombre'] . ' ' . $usuario['apellidos'], ENT_QUOTES, 'UTF-8'); ?>!</a>
            <?php endif; ?>
        <?php endif; ?>
    </nav>

    <nav>
        <a href="../../inicio.php">INICIO</a>
        <a href="../../productos.php">PRODUCTOS</a>
        <a href="../../consejos.php">CONSEJOS</a>
        <a href="../../contacto.php">CONTACTO</a>
        <?php if (!$usuario): // Mostrar solo si no hay sesión activa ?>
            <a href="../../registro.php">REGISTRO</a>
            <a href="../../iniciarsession.php">LOGIN</a>
        <?php endif; ?>
        <?php if ($usuario['role_id'] == 1): // Mostrar solo si el rol es Admin ?>
            <a href="user.php">ADMINISTRACIÓN</a>
        <?php elseif ($usuario['role_id'] == 2): // Mostrar solo si el rol es Usuario ?>
            <a href="user.php">MI PERFIL</a>
        <?php endif; ?>
        <?php if ($usuario): // Mostrar solo si hay sesión activa ?>
            <a href="../../include/close.php">CERRAR SESIÓN</a>
        <?php endif; ?>
    </nav>
            
    <!-- Tabla de usuarios -->
    <div class="content-column">
    <h1>Lista de Usuarios</h1>
    <?php if ($usuario['role_id'] == 1): // Mostrar botón solo si es Usuario ?>
        <button onclick="window.location.href='addUser.php'" class="add-user-button">Agregar Usuario</button>
    <?php endif; ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Email</th>
                        <th>Contraseña</th>
                        <th>Rol</th>
                        <th>Fecha de Registro</th>
                        <?php if ($usuario['role_id'] == 1): // Mostrar acciones solo si es Usuario ?>
                            <th>Acciones</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                <?php
                    if ($result->num_rows > 0) {
                        // Mostrar cada fila de la tabla
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";                                
                                echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['nombre']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['apellidos']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                                // Mostrar la contraseña como asteriscos
                                echo "<td>" . str_repeat('*', strlen($row['contraseña'])) . "</td>";
                                echo "<td>" . htmlspecialchars($row['rol']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['fecha']) . "</td>";
                                if ($usuario['role_id'] == 1) { // Mostrar acciones solo si es Usuario
                                    echo "<td>";
                                    echo "<button onclick=\"window.location.href='updateUser.php?id=" . $row['id'] . "'\" class='edit-button'>Actualizar</button>";
                                    echo "<button onclick=\"window.location.href='deletUser.php?id=" . $row['id'] . "'\" class='delete-button'>Eliminar</button>";
                                    echo "</td>";
                                }
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='8'>No hay usuarios registrados.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
    </div>
</body>
</html>

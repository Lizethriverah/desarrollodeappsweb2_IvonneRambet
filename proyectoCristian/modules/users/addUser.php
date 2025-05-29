<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start(); // Iniciar la sesión

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

include '../../include/conexion.php'; // Asegúrate de que la conexión sea correcta

// Manejar la creación del usuario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $email = trim($_POST['email']);
    $role_id = intval($_POST['role_id']); // Convertir el rol a un número entero
    $password = trim($_POST['password']); // Guardar la contraseña sin hash

    // Consulta para insertar un nuevo usuario
    $insertSql = "INSERT INTO rambet (nombre, apellidos, email, role_id, contraseña) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conex->prepare($insertSql);
    $stmt->bind_param("ssssi", $nombre, $apellido, $email, $role_id, $password);

    if ($stmt->execute()) {
        echo "<script>alert('Usuario creado correctamente.'); window.location.href='user.php';</script>";
    } else {
        echo "<script>alert('Error al crear el usuario: " . $stmt->error . "');</script>";
    }

    $stmt->close();
}

// Consulta para obtener los roles
$rolesSql = "SELECT id, name FROM roles";
$rolesResult = $conex->query($rolesSql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styles/panel.css">
    <link rel="stylesheet" href="../../styles/module.css">
    <link rel="icon" href="favicon.ico">
    <title>Crear Usuario</title>
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

    <!-- Columna de contenido -->
    <div class="content-column">
        <h1>Crear Usuario</h1>
        <form method="POST" action="">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>
            <br>
            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" required>
            <br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <br>
            <label for="role_id">Rol:</label>
            <select id="role_id" name="role_id" required>
                <?php
                if ($rolesResult->num_rows > 0) {
                    while ($role = $rolesResult->fetch_assoc()) {
                        echo "<option value='" . $role['id'] . "'>" . htmlspecialchars($role['name']) . "</option>";
                    }
                } else {
                    echo "<option value=''>No hay roles disponibles</option>";
                }
                ?>
            </select>
            <br>
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>
            <br>
            <button type="submit" class="add-user-button">Crear Usuario</button>
        </form>
    </div>
</body>
</html>

<?php
// Cerrar conexión
$conex->close();
?>
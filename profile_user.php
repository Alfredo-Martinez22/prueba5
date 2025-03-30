<?php
// Iniciar sesión
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['id'])) {
    // Redirigir al login si no está autenticado
    header("Location: login.html");
    exit();
}

// Configuración de la base de datos
$host = "music-lolfredy5-6409.l.aivencloud.com"; // Cambia esto si tu base de datos está en otro servidor
$usuario = "avnadmin";   // Cambia esto con tu nombre de usuario de la base de datos
$contraseña = "AVNS_lDWAK6H25vo4OU9IpoH";    // Cambia esto con la contraseña de tu base de datos
$nombre_bd = "music"; // Nombre de tu base de datos


try {
    // Crear conexión PDO
    $conn = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
    
    // Configurar el modo de error de PDO a excepción
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Obtener el id del usuario desde la sesión
    $user_id = $_SESSION['id'];

    // Preparar consulta SQL para obtener los detalles del usuario
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE id = :id");
    $stmt->bindParam(':id', $user_id);
    $stmt->execute();

    // Verificar si se encontró el usuario
    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        // Si no se encuentra el usuario, redirigir a la página de login
        header("Location: login.html");
        exit();
    }
} catch(PDOException $e) {
    // Manejar errores de conexión
    echo "Error de conexión: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Perfil de usuario en Music-Match" />
    <meta name="author" content="Music-Match" />
    <title>Music-Match | Perfil de Usuario</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <style>
        .profile-header {
            background-color: #343a40;
            color: white;
            padding: 20px 0;
        }

        .profile-img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            border: 4px solid white;
            margin-top: -75px;
        }

        .profile-content {
            padding: 20px;
        }

        .social-icons a {
            margin-right: 15px;
            color: #343a40;
        }

        .social-icons a:hover {
            color: #007bff;
        }
        .action-buttons a {
            margin: 10px;
            font-size: 18px;
        }
    </style>
</head>
<body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="index.html">Music-Match</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.html">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.html">Contactanos</a></li>
                    <li class="nav-item"><a class="nav-link" href="catalog_all.html">Musicos</a></li>
                </ul>

                <!-- Barra de búsqueda simple -->
                <form class="d-flex me-3" action="search.html" method="GET">
                    <input class="form-control me-2" type="search" name="query" placeholder="Buscar músicos..." aria-label="Search" />
                    <button class="btn btn-outline-dark" type="submit">Buscar</button>
                </form>

                <!-- Botón de carrito -->
                <a class="btn btn-outline-dark" href="cart.html">
                    <i class="bi-cart-fill me-1"></i>
                    Carrito
                    <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
                </a>

                <!-- Icono de inicio de sesión -->
                <div class="d-flex ms-auto">
                    <a href="logout.php" class="btn btn-outline-dark">
                        <i class="bi bi-person-circle me-1"></i>
                        Cerrar Sesión
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Header -->
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">Music-Match</h1>
                <p class="lead fw-normal text-white-50 mb-0">Encuentra talento musical con solo un clic</p>
            </div>
        </div>
    </header>

    <!-- Sección de perfil de usuario -->
    <div class="container text-center">
        <!-- Foto de perfil -->
        <img src="https://via.placeholder.com/150" alt="Foto de perfil" class="profile-img shadow-lg">

        <!-- Información del perfil -->
        <div class="profile-content">
            <h2 class="my-3"><?php echo htmlspecialchars($user['nombre']); ?></h2>
            <p class="text-muted">Ciudad: <?php echo htmlspecialchars($user['ciudad']); ?></p>
            <p class="text-muted">Correo electrónico: <?php echo htmlspecialchars($user['email']); ?></p>
            <p class="text-muted">Teléfono: <?php echo htmlspecialchars($user['telefono']); ?></p>
        </div>

        <!-- Botones de navegación -->
        <div class="action-buttons">
            <a href="musician_form.html" class="btn btn-secondary">Informacion Músical</a>
            <a href="purchase_history.html" class="btn btn-info">Historial de Compras</a>
        </div>

        <!-- Redes sociales -->
        <div class="social-icons my-4">
            <a href="#"><i class="fab fa-twitter"></i> Twitter</a>
            <a href="#"><i class="fab fa-linkedin"></i> Facebook</a>
            <a href="#"><i class="fab fa-github"></i> Youtube</a>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

<?php
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

    // Verificar si el formulario fue enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtener datos del formulario
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Preparar consulta SQL para buscar usuario
        $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        // Verificar si se encontró el usuario
        if ($stmt->rowCount() > 0) {
            // Obtener los datos del usuario
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Verificar si la contraseña coincide usando password_verify
            if (password_verify($password, $user['contrasena'])) {
                // Inicio de sesión exitoso
                session_start();
                $_SESSION['id'] = $user['id'];  // Guardamos el id del usuario en la sesión
                $_SESSION['email'] = $user['email'];  // Guardamos el email del usuario en la sesión
                $_SESSION['nombre'] = $user['nombre'];  // Guardamos el nombre del usuario en la sesión
                $_SESSION['tipo_usuario'] = $user['tipo_usuario'];  // Guardamos el tipo de usuario en la sesión
                
                // Redirigir a página de perfil o dashboard
                header("Location: profile_user.php");
                exit();
            } else {
                // Contraseña incorrecta, redirigir con mensaje de error
                header("Location: login.html?error=incorrect");
                exit();
            }
        } else {
            // No se encontró el usuario, redirigir con mensaje de error
            header("Location: login.html?error=incorrect");
            exit();
        }
    }
} catch(PDOException $e) {
    // Manejar errores de conexión
    echo "Error de conexión: " . $e->getMessage();
}
?>

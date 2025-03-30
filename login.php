<?php
// Incluir el archivo de conexión
include 'conexion.php';

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar que los campos email y password estén definidos en el POST
    if (isset($_POST['email_login']) && isset($_POST['password_login'])) {
        // Obtener datos del formulario
        $email = $_POST['email_login'];
        $password = $_POST['password_login'];

        // Preparar consulta SQL para buscar usuario
        $stmt = $conexion->prepare("SELECT * FROM usuario WHERE email = ?");
        $stmt->bind_param("s", $email); // 's' indica que estamos pasando una cadena
        $stmt->execute();
        $result = $stmt->get_result();

        // Verificar si se encontró el usuario
        if ($result->num_rows > 0) {
            // Obtener los datos del usuario
            $user = $result->fetch_assoc();

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
    } else {
        // Si no se recibieron los campos email y password
        echo "Por favor, complete ambos campos.";
    }
} else {
    echo "Método de solicitud no válido.";
}
?>

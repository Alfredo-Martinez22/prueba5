<?php
// Datos de conexión a la base de datos
$host = "music-lolfredy5-6409.l.aivencloud.com";  // Host de la base de datos
$usuario = "avnadmin";                            // Usuario de la base de datos
$contraseña = "AVNS_lDWAK6H25vo4OU9IpoH";         // Contraseña de la base de datos
$nombre_bd = "music";                         // Nombre de la base de datos
$puerto = 20662;                                 // Puerto de la base de datos
$ssl = true;                                     // Conexión SSL requerida

// Crear la conexión
$conexion = new mysqli($host, $usuario, $contraseña, $nombre_bd, $puerto);

// Verificar si la conexión fue exitosa
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
} else {
    // echo "Conexión exitosa"; // Puedes dejar esto para verificar que la conexión funcione
}

// Si necesitas habilitar SSL, puedes configurarlo en la conexión MySQL:
if ($ssl) {
    $conexion->ssl_set(NULL, NULL, "/path/to/your/client-cert.pem", "/path/to/your/client-key.pem", "/path/to/your/ca-cert.pem");
    $conexion->real_connect($host, $usuario, $contraseña, $nombre_bd, $puerto);
}

?>

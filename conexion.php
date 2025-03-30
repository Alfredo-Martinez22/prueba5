<?php
// Datos de conexión a la base de datos
$host = "music-lolfredy5-6409.l.aivencloud.com";  // Host de la base de datos
$usuario = "avnadmin";                            // Usuario de la base de datos
$contraseña = "AVNS_lDWAK6H25vo4OU9IpoH";         // Contraseña de la base de datos
$nombre_bd = "music";                         // Nombre de la base de datos
$puerto = 20662;                                 // Puerto de la base de datos

// Crear la conexión usando mysqli
$conexion = new mysqli($host, $usuario, $contraseña, $nombre_bd, $puerto);

// Verificar si la conexión fue exitosa
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}
?>

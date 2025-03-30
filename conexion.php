<?php
// Datos de conexión a la base de datos
$host = "localhost"; // Cambia esto si tu base de datos está en otro servidor
$usuario = "root";   // Cambia esto con tu nombre de usuario de la base de datos
$contraseña = "";    // Cambia esto con la contraseña de tu base de datos
$nombre_bd = "music"; // Nombre de tu base de datos

// Crear la conexión
$conexion = new mysqli($host, $usuario, $contraseña, $nombre_bd);

// Verificar si la conexión fue exitosa
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
} else {
    // echo "Conexión exitosa"; // Puedes dejar esto para verificar que la conexión funcione
}
?>

<?php
// Aquí debería estar la conexión a la base de datos
include('conexion.php');

// Verificar si el formulario se ha enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los valores del formulario
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $pais = $_POST['pais'];
    $estado = $_POST['estado'];
    $ciudad = $_POST['ciudad'];
    $tipo_usuario = $_POST['tipo_usuario'];
    $password = $_POST['password']; // Solo tomamos la contraseña

    // Hashear la contraseña antes de guardarla en la base de datos
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insertar los datos en la base de datos
    $query = "INSERT INTO usuarios (nombre, email, telefono, pais, estado, ciudad, tipo_usuario, contrasena, fecha_registro)
              VALUES ('$nombre', '$email', '$telefono', '$pais', '$estado', '$ciudad', '$tipo_usuario', '$hashedPassword', NOW())";
    
    // Ejecutar la consulta
    if (mysqli_query($conexion, $query)) {
        echo "¡Registro exitoso!";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conexion);
    }
}
?>

<!-- Formulario HTML -->
<form action="registro.php" method="POST">
    <div class="mb-3">
        <label for="registerName" class="form-label">Nombre Completo</label>
        <input type="text" class="form-control" id="registerName" name="nombre" placeholder="Tu nombre completo" required>
    </div>
    <div class="mb-3">
        <label for="registerEmail" class="form-label">Correo Electrónico</label>
        <input type="email" class="form-control" id="registerEmail" name="email" placeholder="nombre@ejemplo.com" required>
    </div>
    <div class="mb-3">
        <label for="registerNumber" class="form-label">Número de Teléfono</label>
        <input type="text" class="form-control" id="registerNumber" name="telefono" placeholder="Teléfono" required>
        <small class="text-muted">Debe tener 10 dígitos.</small>
    </div>
    <div class="mb-3">
        <label for="registerCountry" class="form-label">País</label>
        <input type="text" class="form-control" id="registerCountry" name="pais" placeholder="País" required>
    </div>
    <div class="mb-3">
        <label for="registerState" class="form-label">Estado</label>
        <input type="text" class="form-control" id="registerState" name="estado" placeholder="Estado" required>
    </div>
    <div class="mb-3">
        <label for="registerCity" class="form-label">Ciudad</label>
        <input type="text" class="form-control" id="registerCity" name="ciudad" placeholder="Ciudad" required>
    </div>
    <div class="mb-3">
        <label for="registerUserType" class="form-label">Tipo de Usuario</label>
        <select class="form-select" id="registerUserType" name="tipo_usuario" required>
            <option value="" disabled selected>Selecciona una opción</option>
            <option value="Cliente">Cliente</option>
            <option value="Músico">Músico</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="registerPassword" class="form-label">Contraseña</label>
        <input type="password" class="form-control" id="registerPassword" name="password" placeholder="Contraseña" required>
    </div>
    <button type="submit" class="btn btn-dark w-100">Registrarse</button>
</form>

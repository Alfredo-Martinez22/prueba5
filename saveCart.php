<?php
header('Content-Type: application/json');

// Establece la conexión con la base de datos
$host = 'localhost';  // Cambia esto por tu host de la base de datos
$dbname = 'music';  // Cambia esto por el nombre de tu base de datos
$username = 'root';  // Tu nombre de usuario de la base de datos
$password = '';  // Tu contraseña de la base de datos

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(["error" => "Error de conexión: " . $e->getMessage()]);
    exit();
}

// Recibe los datos del cuerpo de la solicitud
$data = json_decode(file_get_contents('php://input'), true);

// Asegúrate de que los datos estén presentes
if (isset($data['userId'], $data['items'], $data['eventDate'], $data['address'], $data['total'])) {
    $userId = $data['userId'];
    $items = $data['items'];
    $eventDate = $data['eventDate'];
    $address = $data['address'];
    $total = $data['total'];
    $createdAt = $data['createdAt'];

    // Inserta la compra en la base de datos
    $sql = "INSERT INTO purchases (user_id, event_date, address, total, created_at) VALUES (:userId, :eventDate, :address, :total, :createdAt)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':userId' => $userId,
        ':eventDate' => $eventDate,
        ':address' => $address,
        ':total' => $total,
        ':createdAt' => $createdAt
    ]);

    // Obtén el ID de la compra insertada
    $purchaseId = $pdo->lastInsertId();

    // Inserta los detalles de la compra (los items)
    foreach ($items as $item) {
        $sql = "INSERT INTO purchase_items (purchase_id, product_name, price, quantity) VALUES (:purchaseId, :productName, :price, :quantity)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':purchaseId' => $purchaseId,
            ':productName' => $item['name'],
            ':price' => $item['price'],
            ':quantity' => $item['quantity']
        ]);
    }

    // Devuelve una respuesta exitosa
    echo json_encode(["success" => "Compra guardada correctamente"]);
} else {
    // Si los datos no están completos
    echo json_encode(["error" => "Faltan datos en la solicitud"]);
}
?>

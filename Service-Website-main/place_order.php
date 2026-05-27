<?php
header("Content-Type: application/json");

// Adatbázis kapcsolat (módosítsd a saját adataidra!)
$host = "localhost";
$user = "root";
$pass = "";
$db   = "forge_hardware"; // Az adatbázisod neve

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Adatbázis hiba."]);
    exit;
}

// A küldött JSON adatok beolvasása
$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['cart']) || empty($data['cart'])) {
    echo json_encode(["success" => false, "message" => "Üres a kosár."]);
    exit;
}

$cart = $data['cart'];
$conn->begin_transaction(); // Tranzakció indítása a biztonság érdekében

try {
    foreach ($cart as $item) {
        $id = intval($item['id']);
        $quantity = intval($item['quantity']);

        // 1. Készlet csökkentése az adatbázisban
        $updateQuery = "UPDATE products SET stock_count = stock_count - ? WHERE id = ? AND stock_count >= ?";
        $stmt = $conn->prepare($updateQuery);
        $stmt->bind_param("iii", $quantity, $id, $quantity);
        $stmt->execute();

        if ($stmt->affected_rows === 0) {
            // Ha nem változott sor, vagy nincs elég raktáron
            throw new Exception("Nincs elég raktárkészlet a következő termékből: ID " . $id);
        }

        // 2. Ellenőrizzük, hogy 0 lett-e a készlet, ha igen, módosítjuk a státuszt
        $statusQuery = "UPDATE products SET stock_status = 'Out of Stock' WHERE id = ? AND stock_count <= 0";
        $stmtStatus = $conn->prepare($statusQuery);
        $stmtStatus->bind_param("i", $id);
        $stmtStatus->execute();
    }

    $conn->commit(); // Ha minden sikeres, mentjük a változtatásokat
    echo json_encode(["success" => true, "message" => "Rendelés sikeresen feldolgozva!"]);

} catch (Exception $e) {
    $conn->rollback(); // Hiba esetén visszaállítunk mindent
    echo json_encode(["success" => false, "message" => $e->getMessage()]);
}

$conn->close();
?>
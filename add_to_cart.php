<?php
include 'config.php';

header('Content-Type: application/json');

if (isset($_GET['id'])) {
    $productId = intval($_GET['id']);

    // Fetch current stock value
    $query = "SELECT quantity FROM products WHERE id = $productId";
    $result = mysqli_query($conn, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);
        $currentQuantity = intval($product['quantity']);

        // Prevent adding to cart if it's hit zero
        if ($currentQuantity > 0) {
            $newQuantity = $currentQuantity - 1;
            
            // -1 item from database inventory
            $updateQuery = "UPDATE products SET quantity = $newQuantity WHERE id = $productId";
            if (mysqli_query($conn, $updateQuery)) {
                echo json_encode([
                    "success" => true,
                    "new_quantity" => $newQuantity
                ]);
            } else {
                echo json_encode([
                    "success" => false,
                    "message" => "Database update failed."
                ]);
            }
        } else {
            echo json_encode([
                "success" => false,
                "message" => "This item is out of stock!"
            ]);
        }
    } else {
        echo json_encode([
            "success" => false,
            "message" => "Product not found."
        ]);
    }
} else {
    echo json_encode([
        "success" => false,
        "message" => "Missing item parameters."
    ]);
}
?>
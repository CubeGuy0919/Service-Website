<?php
include 'config.php';

header('Content-Type: application/json');

if (isset($_GET['id'])) {
    $productId = intval($_GET['id']);
    // If a specific quantity isn't passed (e.g. removing one single item), default to 1
    $returnQuantity = isset($_GET['qty']) ? intval($_GET['qty']) : 1;

    if ($returnQuantity > 0) {
        // Increment the database stock counter back to its previous state
        $updateQuery = "UPDATE products SET quantity = quantity + $returnQuantity WHERE id = $productId";
        
        if (mysqli_query($conn, $updateQuery)) {
            // Fetch the freshly updated quantity to sync with the frontend UI
            $query = "SELECT quantity FROM products WHERE id = $productId";
            $result = mysqli_query($conn, $query);
            $product = mysqli_fetch_assoc($result);

            echo json_encode([
                "success" => true,
                "new_quantity" => intval($product['quantity'])
            ]);
        } else {
            echo json_encode([
                "success" => false,
                "message" => "Failed to update database inventory on removal."
            ]);
        }
    } else {
        echo json_encode([
            "success" => false,
            "message" => "Invalid return quantity."
        ]);
    }
} else {
    echo json_encode([
        "success" => false,
        "message" => "Missing item parameters for removal."
    ]);
}
?>
<?php

include 'config.php';

$sql = "SELECT * FROM products";

$result = mysqli_query($conn, $sql);

$products = [];

while($row = mysqli_fetch_assoc($result)){
    $products[] = $row;
}

header('Content-Type: application/json');

echo json_encode($products);
?>
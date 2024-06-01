<?php
session_start();
include 'header.php';
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $paymentMethod = $_POST['payment_method'];

    // Process each item in the cart
    foreach ($_SESSION['cart'] as $item) {
        $productId = $item['product_id'];
        $size = $item['size'];
        $color = $item['color'];
        $category = $item['category'];
        $price = $item['price'];
        $orderQuantity = $item['order_quantity'];

        // Fetch available quantity from the database
        $sql = "SELECT quantity FROM products WHERE id = '$productId'";
        $result = $conn->query($sql);
        $product = $result->fetch_assoc();
        $availableQuantity = $product['quantity'];

        if ($orderQuantity <= $availableQuantity) {
            // Insert order into the database
            $sql = "INSERT INTO orders (product_id, size, color, category, price, quantity, payment_method) 
                    VALUES ('$productId', '$size', '$color', '$category', '$price', '$orderQuantity', '$paymentMethod')";
            if ($conn->query($sql) === TRUE) {
                // Update product quantity
                $newQuantity = $availableQuantity - $orderQuantity;
                $sql = "UPDATE products SET quantity = '$newQuantity' WHERE id = '$productId'";
                $conn->query($sql);
            } else {
                echo "<p class='error'>Error placing order: " . $conn->error . "</p>";
            }
        } else {
            echo "<p class='error'>Cannot order more than available quantity for product ID $productId!</p>";
        }
    }

    // Clear the cart after successful order
    $_SESSION['cart'] = [];

    echo "<p>Order placed successfully!</p>";
    echo "<a href='index.php'>Go back to search</a>";
}

include '.footer.php';
?>

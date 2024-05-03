<?php
session_start();
include 'db_connection.php';
// Add product to cart
if(isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    // Add product to session cart array
    $_SESSION['cart'][] = $product_id;
    echo "Product added to cart!";
}

// Checkout process
if(isset($_POST['checkout'])) {
    // Create order for each product in cart
    foreach($_SESSION['cart'] as $product_id) {
        $user_id = $_SESSION['user_id']; // assuming you have user session
        // Insert order into database
        $query = "INSERT INTO orders (user_id, product_id) VALUES ('$user_id', '$product_id')";
        if ($conn->query($query) !== TRUE) {
            echo "Error: " . $query . "<br>" . $conn->error;
        }
    }
    // Clear cart after checkout
    unset($_SESSION['cart']);
    echo "Checkout successful!";
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Order Tracking System</title>
</head>
<body>

<!-- Product listing -->
<h2>Products</h2>
<form method="post">
    <input type="hidden" name="product_id" value="1">
    <button type="submit" name="add_to_cart">Add Product 1 to Cart</button>
</form>

<!-- Cart -->
<h2>Cart</h2>
<?php
if(isset($_SESSION['cart'])) {
    foreach($_SESSION['cart'] as $product_id) {
        echo "Product ID: $product_id <br>";
    }
} else {
    echo "Cart is empty";
}
?>

<!-- Checkout -->
<form method="post">
    <button type="submit" name="checkout">Checkout</button>
</form>

<!-- Admin Interface -->
<?php
if(isset($_SESSION['isAdmin'])) {
    echo "<h2>Admin Interface</h2>";
    // Query to fetch pending orders
    $query = "SELECT * FROM orders WHERE status = 'pending'";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        echo "<h3>Pending Orders</h3>";
        while($row = $result->fetch_assoc()) {
            echo "Order ID: " . $row["id"] . " - Product ID: " . $row["product_id"] . "<br>";
        }
    } else {
        echo "No pending orders";
    }
}
?>
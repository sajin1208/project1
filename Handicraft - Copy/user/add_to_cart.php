<?php
// Start the session
session_start();
// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect the user to the login page or handle unauthorized access
    header("Location: login.php");
    exit;
}

// Include the database connection file
include 'db_connection.php';

// Check if the product_id is set and not empty
if (isset($_POST['product_id']) && !empty($_POST['product_id'])) {
    // Retrieve product_id from the POST data
    $product_id = $_POST['product_id'];

    // Retrieve user_id from the session
    $user_id = $_SESSION['user_id'];

    // Fetch product details from the database
    $sql_product = "SELECT * FROM products WHERE product_id = $product_id";
    $result_product = $conn->query($sql_product);

    if ($result_product->num_rows > 0) {
        // Product found, fetch its details
        $product_row = $result_product->fetch_assoc();
        $productName = $product_row["productName"];
        $price = $product_row["price"];
        $name = $product_row["productName"];
        $quantity = 1; // Default quantity
        $imageUrl = $product_row["imageUrl"];
        $imagePath =  $imageUrl;

        $created_at = date("Y-m-d H:i:s"); // Current datetime

        $select_cart = mysqli_query($conn,"Select * from `cart` where name=' $productName' ");
        if(mysqli_num_rows($select_cart) > 0) {
            $display_message[]='Product already added to cart';
        }
        else {
        // Insert product into cart table
        $sql_insert = "INSERT INTO cart (user_id, product_id, name, image, quantity, price, created_at) 
                       VALUES ('$user_id', '$product_id', '$name', '$imagePath' ,'$quantity', '$price', '$created_at')";

        if ($conn->query($sql_insert) === TRUE) {
            // Product successfully added to cart
            echo "Product added to cart successfully.";
        } else {
            // Error inserting product into cart
            echo "Error: " . $sql_insert . "<br>" . $conn->error;
        }}
    } else {
        // Product not found in the database
        echo "Product not found.";
    }
} else {
    // Product ID not provided or invalid
    echo "Invalid product ID.";
}
// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>  
</body>
</html>
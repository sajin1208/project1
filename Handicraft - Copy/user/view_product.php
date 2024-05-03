<?php
require_once('db_connection.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Product</title>
    <style>
        /* Product details container */
        .product-details {
            border: 1px solid #ccc;
            padding: 20px;
            margin-bottom: 20px;
            background-color: #f9f9f9;
        }

        /* Product name */
        .product-name {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        /* Product image */
        .product-image {
            max-width: 100%;
            height: auto;
            margin-bottom: 10px;
        }

        /* Product price */
        .product-price {
            font-size: 18px;
            color: #007bff;
            margin-bottom: 10px;
        }

        /* Product description */
        .product-description {
            margin-bottom: 20px;
        }

        /* Add to Cart button */
        .add-to-cart-btn {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }

        .add-to-cart-btn:hover {
            background-color: #0056b3;
        }

    </style>
</head>
<body>
    <header>
        <?php
        require_once('header.php');
        ?>
    </header>
    <?php
        // Check if product_id is set and valid
if (isset($_GET['product_id']) && is_numeric($_GET['product_id'])) {
    // Sanitize the input to prevent SQL injection
    $product_id = mysqli_real_escape_string($conn, $_GET['product_id']);

    // Query to fetch product details based on product_id
    $query = "SELECT * FROM products WHERE product_id = '$product_id'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        // Fetch and display product details
        $row = mysqli_fetch_assoc($result);
        echo "<h2>" . $row["productName"] . "</h2>";
        echo "<img src='images/" . $row["imageUrl"] . "' alt='" . $row["productName"] . "'>";
        echo "<p><strong>Price:</strong> Rs" . $row["price"] . "</p>";
        echo "<p>" . $row["description"] . "</p>";

        // Add "Add to Cart" form
        echo "<form action='add_to_cart.php' method='POST'>";
        echo "<input type='hidden' name='product_id' value='" . $row["product_id"] . "'>";
        echo "<input type='submit' class='add-to-cart-btn' value='Add to Cart'>";
        echo "</form>";
    } else {
        echo "Product not found.";
    }
} else {
    echo "Invalid product ID.";
}
    ?>
    
</body>
</html>

<?php
require_once('db_connection.php');
// Retrieve the search query from URL parameter
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .card {
                border: 1px solid lightslategray;
                border-radius: 5px;
                padding: 20px;
                margin: 10px;
                width: 250px; 
                height: 350px; 
                box-sizing: border-box;
                display: inline-block;
                vertical-align: top; /* Align cards at the top */
            }

            .card h3 {
                margin-top: 0;
            }

            .card img {
                width: 100%; /* Ensure image fills its container */
                height: 200px; /*  image */
                object-fit: cover; /* Maintain aspect ratio and cover container */
                display: block;
                margin-bottom: 10px;
            }
            .card {
                border: 1px solid lightslategray;
                border-radius: 5px;
                padding: 20px;
                margin: 10px;
                width: 250px;
                height: 400px;
                box-sizing: border-box;
                display: inline-block;
                
            }

            .card h3 {
                margin-top: 0;
            }

            .card img {
                width: 100%;
                height: 200px;
                object-fit: contain;
                display: block;
                margin-bottom: 10px;
            }
            .button-container{
                display: flex;
            }
            .view-details-btn,
            .add-to-cart-btn {
                background-color: mediumblue;
                color: #fff;
                border: none;
                padding: 8px;
                /* border-radius: 4px; */
                cursor: pointer;
            }

            .view-details-btn:hover,
            .add-to-cart-btn:hover {
                background-color: mediumblue;
            }
        
    </style>
</head>
<body>
<?php
require_once('db_connection.php');

// Retrieve the search query from URL parameter
if (isset($_GET['q'])) {
    $search_query = $_GET['q'];

    // Sanitize search query to prevent SQL injection
    $search_query = mysqli_real_escape_string($conn, $search_query);

    // Perform search in your database based on $search_query
    // For example:
    $search_result = mysqli_query($conn, "SELECT * FROM products WHERE productName LIKE '%$search_query%'");

    if (mysqli_num_rows($search_result) > 0) {
        // Output data of each row
        while ($row = mysqli_fetch_assoc($search_result)) {
            // Construct image URL using the relative path
            $imageUrl = $row["imageUrl"];
            $imagePath = "images/" . $imageUrl;
            // Display product information in a card
            echo "<div class='card'>";
            echo "<img src='" . $imagePath . "' alt='" . $row["productName"] . "'>";
            echo "<h3>" . $row["productName"] . "</h3>";
            echo "<p><strong>Price:</strong> Rs" . $row["price"] . "</p>";
            echo "<p>" . $row["description"] . "</p>";
            // Add "View" button
            echo "<div class='button-container'>";
            echo "<form action='view_product.php' method='GET'>";
            echo "<input type='hidden' name='product_id' value='" . $row["product_id"] . "'>";
            echo "<input type='submit' class='view-details-btn' value='View Details'>";
            echo "</form>";
            // Add "Add to Cart" button with product id as data attribute
            echo "<form action='add_to_cart.php' method='POST'>";
            echo "<input type='hidden' name='product_id' value='" . $row["product_id"] . "'>";
            echo "<input type='submit' class='add-to-cart-btn' value='Add to Cart'>";
            echo "</form>";
            echo "</div>";
            echo "</div>";
        }
    } else {
        echo "No products found.";
    }
} else {
    echo "No search query provided.";
}

// Close database connection
mysqli_close($conn);
?>
</body>
</html>
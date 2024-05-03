<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid whitesmoke;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: white;
        }
    </style>
</head>
<body>

<h2>Shopping Cart</h2>

<?php
require_once('db_connection.php');

// Fetching cart items from the database
$query = "SELECT * FROM cart";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($connection));
}

// Displaying cart items in a table
echo "<table>";
echo "<tr><th>Cart ID</th><th>User ID</th><th>Product ID</th><th>Quantity</th><th>Price</th></tr>";

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $row['cart_id'] . "</td>";
    echo "<td>" . $row['user_id'] . "</td>";
    echo "<td>" . $row['product_id'] . "</td>";
    echo "<td>" . $row['quantity'] . "</td>";
    echo "<td>" . $row['price'] . "</td>";
    
    echo "</tr>";
}

echo "</table>";

// Free result set
mysqli_free_result($result);

// Close connection
mysqli_close($conn);
?>

</body>
</html>

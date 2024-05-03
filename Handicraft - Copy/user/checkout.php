<?php
session_start();

include 'db_connection.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect the user to the login page if not logged in
    header("Location: login.php");
    exit; // Stop further execution
}

// Retrieve user ID from the session
$user_id = $_SESSION['user_id'];

// Fetch products from the user's cart
$sql_cart = "SELECT * FROM cart WHERE user_id = $user_id";
$result_cart = $conn->query($sql_cart);

// Define an array to store cart items
$cart_items = array();

// Check if cart is not empty
if ($result_cart->num_rows > 0) {
    // Add each cart item to the array
    while ($row_cart = $result_cart->fetch_assoc()) {
        $cart_items[] = $row_cart;
    }
}

// Function to calculate total price
function calculateTotalPrice($cart_items) {
    $total_price = 0;
    foreach ($cart_items as $item) {
        $total_price += $item['price'] * $item['quantity'];
    }
    return $total_price;
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user information from the form
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $payment_mode = $_POST['payment_mode'];

    // Check if cart is not empty
    if (!empty($cart_items)) {
         // Get product names
         $product_names = array();
         foreach ($cart_items as $item) {
             $product_names[] = $item['name'];
         }
         $product_names_string = implode(", ", $product_names);
        // Insert order details into orders table
        $sql_insert_order = "INSERT INTO orders (user_id, name, address, phone_number, payment_mode, status, productnames) 
        VALUES ('$user_id', '$name', '$address', '$phone', '$payment_mode', 'pending', '$product_names_string')";
        if ($conn->query($sql_insert_order) === TRUE) {
            // Retrieve the order ID
            $order_id = $conn->insert_id;

            // Insert each product from the cart into order_details table
            foreach ($cart_items as $item) {
                $product_id = $item['product_id'];
                $quantity = $item['quantity'];
                $price = $item['price'];

                $sql_insert_details = "INSERT INTO order_items (order_id, product_id, quantity, price) 
                                       VALUES ('$order_id', '$product_id', '$quantity', '$price')";
                $conn->query($sql_insert_details);
            }

            // Clear the user's cart after placing the order
            $sql_clear_cart = "DELETE FROM cart WHERE user_id = $user_id";
            $conn->query($sql_clear_cart);

            echo "Order placed successfully. Please wait for confirmation from admin.";
        } else {
            echo "Error: " . $sql_insert_order . "<br>" . $conn->error;
        }
    } else {
        echo "Your cart is empty.";
    }

    // Close the database connection
    $conn->close();
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
</head>
<style>
    /* Basic Styling */
body {
    font-family: Arial, sans-serif;
    font-size: 16px;
    color: #333;
    background-color: #f2f2f2;
    margin: 0;
    padding: 0;
}

fieldset form {
    margin: 10px; 
    width: 65%; 
    text-align: center; 
}

label {
    display: block;
    margin-bottom: 10px;
}

input[type="submit"] {
    background-color: yellowgreen;
}
  

input[type="submit"]:hover {
    background-color: #555;
}

/* Cart Styling */
h2 {
    margin-top: 40px;
    text-align: center;
}

table {
    width: 50%;
    margin: 20px auto;
    border-collapse: collapse;
}

table th, table td {
    padding: 10px;
    border: 1px solid #ccc;
}

table th {
    background-color: aquamarine;
    font-weight: bold;
    text-align: left;
}
fieldset {
    margin: 0 auto;
    width: 20%; 
}

.fieldset-container {
    text-align: center; /* Center align the content */
}



</style>
<body>
<header>
    <?php
        include 'header.php';
    ?>
</header>

<h2>Checkout</h2>
<fieldset>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label for="name">Name:</label><br>
    <input type="text" id="name" name="name" required><br><br>
    
    <label for="address">Address:</label><br>
    <textarea id="address" name="address" required></textarea><br><br>
    
    <label for="phone">Phone Number:</label><br>
    <input type="text" id="phone" name="phone" required><br><br>
    
    <label for="payment_mode">Payment Mode:</label><br>
    <select id="payment_mode" name="payment_mode">
        <option value="cash_on_delivery">Cash on Delivery</option>
        <!-- Add more payment options if needed -->
    </select><br><br>
    
    <input type="submit" value="Place Order">
</form>
</fieldset>

<h2>Cart</h2>
<table>
    <thead>
        <tr>
            <th>Product</th>
            <th>Quantity</th>
            <th>Price</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($cart_items as $item): ?>
        <tr>
            <td><?php echo $item['name']; ?></td>
            <td><?php echo $item['quantity']; ?></td>
            <td><?php echo $item['price']; ?></td>
        </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="2">Total</td>
            <td><?php echo calculateTotalPrice($cart_items); ?></td>
        </tr>
    </tbody>
</table>

</body>
<footer>
<?php
        include 'footer.php';
    ?>
</footer>
</html>

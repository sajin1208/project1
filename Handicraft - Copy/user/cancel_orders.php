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

// Check if the form is submitted for canceling an order
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cancel_order'])) {
    // Get the order ID to be canceled
    $order_id_to_cancel = $_POST['order_id'];

    // Check if the order belongs to the logged-in user
    $check_order_sql = "SELECT * FROM orders WHERE order_id = $order_id_to_cancel AND user_id = $user_id";
    $check_order_result = $conn->query($check_order_sql);

    if ($check_order_result->num_rows > 0) {
        // Delete associated records from the order_items table
        $delete_order_items_sql = "DELETE FROM order_items WHERE order_id = $order_id_to_cancel";
        if ($conn->query($delete_order_items_sql) === TRUE) {
            // Delete the order from the orders table
            $delete_order_sql = "DELETE FROM orders WHERE order_id = $order_id_to_cancel";
            if ($conn->query($delete_order_sql) === TRUE) {
                echo "Order cancelled successfully.";
            } else {
                echo "Error cancelling order: " . $conn->error;
            }
        } else {
            echo "Error cancelling order: " . $conn->error;
        }
    } else {
        echo "Order does not belong to the logged-in user.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cancel Order</title>
</head>
<style>
    body {
    font-family: Arial;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
}

h2 {
    text-align: center;
    margin-bottom: 20px;
}

table {
    width: 100%;
    border-collapse: collapse;
}

table th,
table td {
    padding: 10px;
    text-align: left;
    border: 2px solid #000;
}

table th {
    background-color: lightgreen;
}

table tbody tr:nth-child(even) {
    background-color: #f9f9f9;
}

table tbody tr:hover {
    background-color: #f0f0f0;
}

button {
    padding: 8px 12px;
    background-color: red;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

button:hover {
    background-color: darkred; 
}

</style>
<body>

<h2>Cancel Order</h2>
<header>
    <?php
    include 'header.php';
    ?>
</header>

<?php
// Fetch user's orders that are not cancelled
$sql_orders = "SELECT * FROM orders WHERE user_id = $user_id AND status != 'Cancelled' ORDER BY order_id DESC";
$result_orders = $conn->query($sql_orders);

if ($result_orders->num_rows > 0): ?>
    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Name</th>
                <th>Address</th>
                <th>Phone Number</th>
                <th>Payment Mode</th>
                <th>Product Names</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result_orders->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['order_id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['address']; ?></td>
                    <td><?php echo $row['phone_number']; ?></td>
                    <td><?php echo $row['payment_mode']; ?></td>
                    <td><?php echo $row['productnames']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                    <td>
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <input type="hidden" name="order_id" value="<?php echo $row['order_id']; ?>">
                            <button type="submit" name="cancel_order">Cancel Order</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No orders found.</p>
<?php endif; ?>

</body>
<footer>
<?php
    include 'footer.php';
    ?>
</footer>
</html>

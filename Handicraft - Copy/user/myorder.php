<?php
session_start();

// Include the database connection file
include 'db_connection.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect the user to the login page if not logged in
    header("Location: login.php");
    exit; // Stop further execution
}

// Retrieve user ID from the session
$user_id = $_SESSION['user_id'];

// Fetch user's order history from the orders table
$sql_orders = "SELECT * FROM orders WHERE user_id = $user_id ORDER BY order_id ASC";
$result_orders = $conn->query($sql_orders);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders</title>
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
    border: 2px solid #000; /* Bold border */
}

table th {
    background-color: lightgreen; /* Light green background color */
}

table tbody tr:nth-child(even) {
    background-color: lightgrey;
}

table tbody tr:hover {
    background-color: lightgray;
}

    
</style>
<body>
<header>
    <?php
    include 'header.php';
    ?>
</header>

<h2>My Orders</h2>

<?php if ($result_orders->num_rows > 0): ?>
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

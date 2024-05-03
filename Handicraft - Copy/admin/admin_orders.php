<?php
session_start();

include 'db_connection.php';

// Function to update order status
function updateOrderStatus($order_id, $status) {
    global $conn;
    $sql_update_status = "UPDATE orders SET status = '$status' WHERE order_id = '$order_id'";
    return $conn->query($sql_update_status);
}

// Function to fetch product names for an order ID
function getProductNames($order_id) {
    global $conn;
    $product_names = array();
    $sql_product_names = "SELECT products.productName 
                          FROM order_items 
                          INNER JOIN products ON order_items.product_id = products.product_id 
                          WHERE order_items.order_id = '$order_id'";
    $result_product_names = $conn->query($sql_product_names);
    if ($result_product_names->num_rows > 0) {
        while ($row = $result_product_names->fetch_assoc()) {
            $product_names[] = $row['productName'];
        }
    }
    return implode(", ", $product_names);
}

// Process action if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['order_id']) && isset($_POST['action'])) {
        $order_id = $_POST['order_id'];
        $action = $_POST['action'];

        // Update order status based on action
        switch ($action) {
            case 'accept':
                if (updateOrderStatus($order_id, 'Approved')) {
                    echo "Order #$order_id has been accepted.";
                } else {
                    echo "Error updating order status.";
                }
                break;
            case 'reject':
                if (updateOrderStatus($order_id, 'Rejected')) {
                    echo "Order #$order_id has been rejected.";
                } else {
                    echo "Error updating order status.";
                }
                break;
            case 'pending':
                if (updateOrderStatus($order_id, 'Pending')) {
                    echo "Order #$order_id status set to pending.";
                } else {
                    echo "Error updating order status.";
                }
                break;
            default:
                echo "Invalid action.";
        }
    }
}

// Fetch orders
$sql_orders = "SELECT * FROM orders";
$result_orders = $conn->query($sql_orders);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Orders</title>
</head>
<style>
    /* Basic Styling */
body {
    font-family: Arial;
    font-size: 16px;
    color: black;
    background-color: whitesmoke;
    margin: 0;
    padding: 20px;
}

/* Table Styling */
table {
    width: 100%;
    border-collapse: collapse;
    background-color: white;
}

table th, table td {
    padding: 10px;
    border: 1px solid whitesmoke;
}

table th {
    background-color: aqua;
}

table tr:hover {
    background-color: aquamarine;
}

/* Form Styling */
form {
    margin-bottom: 20px;
}

select, input[type="submit"] {
    padding: 8px;
    margin-right: 10px;
    border: 1px solid whitesmoke;
    border-radius: 4px;
}

input[type="submit"] {
    background-color: green;
    color: white;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: lightgreen;
}

/* Header and Title Styling */
h2 {
    color: #333;
    margin-bottom: 20px;
}

/* Message Styling */
.message {
    padding: 10px;
    margin-bottom: 10px;
    border-radius: 4px;
}

.success {
    background-color: green;
}

.error {
    background-color: red;
}

</style>
<body>
    <h2>Admin Orders</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>User ID</th>
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
            <?php
            if ($result_orders->num_rows > 0) {
                while ($row = $result_orders->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>".$row['order_id']."</td>";
                    echo "<td>".$row['user_id']."</td>";
                    echo "<td>".$row['name']."</td>";
                    echo "<td>".$row['address']."</td>";
                    echo "<td>".$row['phone_number']."</td>";
                    echo "<td>".$row['payment_mode']."</td>";
                    echo "<td>".getProductNames($row['order_id'])."</td>";
                    echo "<td>".$row['status']."</td>";
                    echo "<td>";
                    echo "<form method='post' action='".$_SERVER['PHP_SELF']."'>";
                    echo "<input type='hidden' name='order_id' value='".$row['order_id']."'>";
                    echo "<select name='action'>";
                    echo "<option value='accept'>Accept</option>";
                    echo "<option value='reject'>Reject</option>";
                    echo "<option value='pending'>Pending</option>";
                    echo "</select>";
                    echo "<input type='submit' value='Update'>";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='9'>No orders found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>

<?php
session_start();

include 'db_connection.php';

// Fetch order status for the logged-in user
$user_id = $_SESSION['user_id'];
$order_status_query = "SELECT status FROM orders WHERE user_id = '$user_id' ORDER BY order_id DESC LIMIT 1";
$order_status_result = $conn->query($order_status_query);
if ($order_status_result->num_rows > 0) {
    $row = $order_status_result->fetch_assoc();
    $order_status = $row['status'];
} else {
    $order_status = 'checkout'; // Set default status if no orders found
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Tracking</title>
    <link rel="stylesheet" href="styles.css">
</head>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f4;
    }

    .container {
        max-width: 800px;
        margin: 50px auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .progress-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .progress-step {
        flex: 1;
        text-align: center;
    }

    .progress-step span {
        display: block;
        font-weight: bold;
        margin-bottom: 10px;
        color: #555;
    }

    .progress-step .circle {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: #ccc;
        margin: 0 auto;
        line-height: 40px;
        font-size: 20px;
    }

    .progress-step.completed .circle {
        background-color: green;
        color: white;
    }

    .progress-step.completed .circle::before {
        content: '✔';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .progress-step.completed .circle span {
        visibility: hidden;
    }

    .progress-step.completed .circle span::before {
        content: '✔';
        visibility: visible;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: white;
    }

    .progress-step.completed .circle::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 20px;
        height: 20px;
        border: 2px solid white;
        border-radius: 50%;
    }

    .progress-step.active .circle {
        background-color: blue;
    }

    .progress-step.rejected .circle {
        background-color: red;
    }

    .progress-bar .line {
        flex: 1;
        height: 4px;
        background-color: #ccc;
        position: relative;
        top: 18px;
    }

    .progress-bar .line.completed {
        background-color: green;
    }
</style>
<body>
    <div class="container">
        <h1>Order Tracking</h1>
        <div class="progress-bar">
            <div class="progress-step <?php echo ($order_status == 'checkout') ? 'completed' : ''; ?>">
                <div class="circle"><?php echo ($order_status == 'checkout') ? '✔' : ''; ?></div>
                <span>Checkout</span>
            </div>
            <div class="line <?php echo ($order_status == 'checkout') ? 'completed' : ''; ?>"></div>
            <div class="progress-step <?php echo ($order_status == 'admin_approval') ? 'completed' : ''; ?>">
                <div class="circle"><?php echo ($order_status == 'admin_approval') ? '✔' : ($order_status == 'admin_rejected' ? '✘' : ''); ?></div>
                <span>Admin Approval</span>
            </div>
            <div class="line <?php echo ($order_status == 'admin_approval' || $order_status == 'admin_rejected') ? 'completed' : ''; ?>"></div>
            <div class="progress-step <?php echo ($order_status == 'order_placed') ? 'completed' : ''; ?>">
                <div class="circle"><?php echo ($order_status == 'order_placed') ? '✔' : ''; ?></div>
                <span>Order Placed</span>
            </div>
            <!-- Add more steps as needed -->
        </div>
    </div>
</body>
</html>

<?php
// session_start();
// if(!isset($_SESSION['user_id'])) {
//     // If not logged in, redirect to login page
//     header("Location: login.php");
//     exit();
// }

$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$database = "college_project";

$con = mysqli_connect($servername, $username, $password, $database);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if(isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    // Query to count the number of items in the user's cart
    $count_query = mysqli_query($con, "SELECT COUNT(*) as total_items FROM cart WHERE user_id = $user_id");
    $row = mysqli_fetch_assoc($count_query);
    $row_count = $row['total_items'];
} else {
    // If user is not logged in, set row count to 0
    $row_count = 0;
}

if(isset($_GET['remove'])){
    $remove_id = $_GET['remove'];
    mysqli_query($con,"DELETE FROM `cart` WHERE cart_id=$remove_id");
    header('location:mycart.php');
}

if(isset($_GET['delete_all'])){
    mysqli_query($con,"DELETE FROM `cart` WHERE user_id = {$_SESSION['user_id']}");
    header('location:mycart.php');
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CART</title>
</head>
<style>
    /* Resetting default margin and padding */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Basic styling for the body */
body {
    font-family: Arial;
    background-color: whitesmoke;
    color: black;
}

.menu {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.menu a {
    color: white;
    text-decoration: none;
    margin-right: 10px;
}

.cart1 {
    display: flex;
    align-items: center;
}

.cart1 a {
    color: white;
    text-decoration: none;
    margin-right: 10px;
}

/* Container styling */
.container {
    margin: 20px auto;
    max-width: 800px;
    padding: 0 20px;
}

/* Shopping cart section styling */
.shopping_cart {
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
}

.heading {
    margin-bottom: 20px;
}

table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    padding: 10px;
    text-align: left;
}
/* Image styling */
td img {
    width: 100px;
    height: 100px;
    object-fit: cover; /* Maintain aspect ratio and cover container */
    border-radius: 5px;
}

thead {
    background-color: gray;
    color: white;
}

tbody tr:nth-child(even) {
    background-color: gray;
}

/* Quantity box styling */
.quantity_box {
    display: flex;
    align-items: center;
}

.quantity_box input[type="number"] {
    width: 60px;
    padding: 5px;
    margin-right: 10px;
}

.update_quantity {
    padding: 5px 10px;
    background-color: gray;
    color: white;
    border: none;
    cursor: pointer;
}

.update_quantity:hover {
    background-color: gray;
}

/* Bottom section styling */
.table_bottom {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 20px;
}

.bottom_btn {
    padding: 10px 20px;
    background-color: gray;
    color: white;
    text-decoration: none;
    border-radius: 5px;
}

.bottom_btn:hover {
    background-color:  gray;
}

.delete_all_btn {
    margin-top: 10px;
    display: block;
    text-align: center;
    color: gray;
    text-decoration: none;
}

.delete_all_btn:hover {
    color:  gray;
}
td img {
    max-width: 150px;
    max-height: 150px; 
    width: auto;
    height: auto; 
}
</style>

<body>
<header>
    <?php require_once('header.php'); ?>
</header>
<br/>
<?php
// Check if the update form is submitted
if(isset($_POST['update_product_quantity'])){
    // Get the update quantity and cart ID from the form
    $update_value = $_POST['update_quantity'];
    $update_id = $_POST['update_quantity_id'];

    // Get product details from the cart
    $cart_product_query = mysqli_query($con, "SELECT cart.*, products.productName, products.category_name
                                              FROM cart
                                              INNER JOIN products ON cart.product_id = products.product_id
                                              WHERE cart.cart_id = $update_id");
    $cart_product_row = mysqli_fetch_assoc($cart_product_query);
    $product_name = $cart_product_row['productName'];
    $category_name = $cart_product_row['category_name'];

    // Get available quantity from the products table
    $available_quantity_query = mysqli_query($con, "SELECT quantity FROM products
                                                    WHERE productName = '$product_name' AND category_name = '$category_name'");
    $available_quantity_row = mysqli_fetch_assoc($available_quantity_query);
    $available_quantity = $available_quantity_row['quantity'];

    // Check if the requested quantity exceeds the available quantity
    if($update_value > $available_quantity) {
        // Notify the user about the limited availability
        echo "Sorry, only $available_quantity units of $product_name are available. Please contact admin if you need more.";
    } else {
        // Proceed with updating the quantity in the cart
        $update_quantity_query = mysqli_query($con,"UPDATE cart SET quantity = $update_value WHERE cart_id = $update_id");
        if($update_quantity_query){
            // Redirect the user back to the cart page after successful update
            header('location: mycart.php');
        }
    }
}
?>
<div class="container">
    <section class="shopping_cart">
        <h1 class="heading">MY CART</h1>
        <table>
            <!-- Your table headers and rows here -->
        </table>

        <!-- Your PHP code for fetching cart items based on user session -->
        <?php
        if(isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
            // Proceed with your code that uses $user_id
        } else {
            // Handle the case where 'user_id' is not set in the session
            // For example, you could redirect the user to the login page or display an error message
            echo "User ID not found in session.";
        }
       $sql = "SELECT cart.*, products.productName AS product_name, products.price AS product_price 
               FROM cart
               INNER JOIN products ON cart.product_id = products.product_id
               WHERE cart.user_id = ?";
       $stmt = $con->prepare($sql);
       $stmt->bind_param("i", $user_id);
       $stmt->execute();
       $result = $stmt->get_result();
       $stmt->close();
       

        $grand_total = 0;

        if($result->num_rows > 0){
            // Output cart items
            echo "<table>";
            echo "<thead>
                    <th>S.N</th>
                    <th>Product name</th>
                    <th>Product image</th>
                    <th>Product price</th>
                    <th>Product quantity</th>
                    <th>Total Price</th>
                    <th>Action</th>
                </thead>
                <tbody>";

            while($row = $result->fetch_assoc()){
                // Output rows
                $imagePath = "images/" . $row['image']; 
                echo "<tr>
                        <td>{$row['cart_id']}</td>
                        <td>{$row['product_name']}</td>
                        <td><img src='$imagePath' alt='Product Image'></td>
                        <td>{$row['product_price']} /-</td>
                        <td>
                            <form action='' method='post'>
                                <input type='hidden' value='{$row['cart_id']}' name='update_quantity_id'>
                                <div class='quantity_box'>
                                    <input type='number' min='1' value='{$row['quantity']}' name='update_quantity'>
                                    <input type='submit' class='update_quantity' value='update' name='update_product_quantity'>
                                </div>
                            </form>
                        </td>
                        <td>".($row['product_price'] * $row['quantity'])." /-</td>
                        <td>
                            <a href='mycart.php?remove={$row['cart_id']}' onclick='return confirm('Are you sure to delete')'>
                                <i class='fas fa-trash'></i> Remove
                            </a>
                        </td>
                    </tr>";

                $grand_total += ($row['product_price'] * $row['quantity']); // Calculate grand total
            }

            echo "</tbody></table>";

            // Output bottom section
            echo "<div class='table_bottom'>
                    <a href='index.php' class='bottom_btn'>Continue shopping</a>
                    <h3 class='bottom_btn'>Grand Total: <span>{$grand_total} /-</span></h3>
                    <a href='checkout.php' class='bottom_btn'>Proceed to checkout</a>
                </div>";
        } else {
            echo "<div class='empty_text'>Cart is empty</div>";
        }

        ?>

        <!-- Delete all button -->
        <a href="mycart.php?delete_all" class="delete_all_btn" onclick="return confirm('Are you sure to delete')">
            <i class="fas fa-trash"></i> Delete All
        </a>
    </section>
</div>
<footer>
    <?php
        require_once('footer.php');
    ?>
</footer>

</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        /* Resetting default browser styles */
body, h1, h2, h3, p, ul, li, table {
    margin: 0;
    padding: 0;
}

/* Basic styles */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    color: #333;
}

header {
    background-color: #333;
    color: #fff;
    padding: 10px;
}

.menu {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.menu a {
    color: #fff;
    text-decoration: none;
    margin-right: 10px;
}

.cart {
    position: relative;
}

.cart i {
    color: #fff;
    font-size: 24px;
}

.cart1 a {
    color: #fff;
    text-decoration: none;
    margin-left: 10px;
}

.main--content {
    padding: 20px;
}

.user--list {
    margin-top: 20px;
}

table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    padding: 10px;
    border-bottom: 1px solid #ccc;
}

th {
    background-color: #333;
    color: #fff;
}

.user-actions {
    display: flex;
}

/* .delete {
    background-color: #ff3333;
    color: #fff;
    border: none;
    padding: 5px 10px;
    cursor: pointer;
} */

    </style>
</head>
<body>

<header>
    <div class="menu">
        <a href="home.php">Home</a>
        <a href="Aboutus.php">About Us</a>
        <a href="contact.php">Contact Us</a>
        <a href="Review.php">Reviews</a>
        <a href="FAQ.php">FAQ</a>
        <div class="cart">
            <i class="fa-light fa-cart-shopping"></i>
        </div>

        <div class="cart1">
            <a href="cart.php"><u>Cart</u></a>
            <a href="login.php"><u>Log In</u></a>
        </div>
    </div>
</header>

<div class="main--content">
    <h2>Product List</h2>
    <div class="user--list">
        <table>
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Location</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
            <?php
            // Handle Delete Action
            if(isset($_POST['btnDelete'])) {
                $id = $_POST['id'];
                $connection = mysqli_connect('localhost', 'root', '', 'handicraft_db');
                $deleteQuery = "DELETE FROM product_list WHERE id = $id";
                if(mysqli_query($connection, $deleteQuery)) {
                    // Data deleted successfully
                    echo "Product deleted successfully!";
                    // You may choose to redirect or refresh the page after deletion
                    // header("Location: admin_dashboard.php");
                    // exit();
                } else {
                    echo "Error deleting product: " . mysqli_error($connection);
                }
            }

            // Display Product List
            try {
                $connection = mysqli_connect('localhost', 'root', '', 'handicraft_db');
                $select = "SELECT * FROM product_list";
                $result = mysqli_query($connection, $select);
                if(mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>
                                <td>'.$row['id'].'</td>
                                <td>'.$row['name'].'</td>
                                <td>'.$row['price'].'</td>
                                <td>'.$row['location'].'</td>
                                <td>'.$row['description'].'</td>
                                <td>
                                    <span class="user-actions">
                                        <a href="edit_list.php?id='.$row['id'].'">Edit</a>
                                        <form action="" method="POST">
                                        
                                            <input type="hidden" name="id" value="' . $row['id'] . '" />
                                            <input type="submit" name="btnDelete" value="Delete" class="delete"/>
                                        </form>
                                    </span>
                                </td>
                              </tr>';
                    }
                }
            } catch(Exception $ex) {
                die('Database Error'.$ex->getMessage());
            }
            ?>
        </table>
    </div>
</div>

</body>
</html>

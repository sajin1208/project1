<?
// include_once('db_connection.php');
?>

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
    font-family: Arial;
    background-color: white;
    color: black;
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
    border-bottom: 1px solid whitesmoke;
}

th {
    background-color: black;
    color: white;
}

.user-actions {
    display: flex;
}

.delete {
    background-color: red;
    color: whitesmoke;
    border: none;
    padding: 5px 10px;
    cursor: pointer;
}
.delete:hover{
    background-color: lightcoral;
}

.edit {
    background-color: green;
    color: whitesmoke;
    border: none;
    padding: 5px 10px;
    cursor: pointer;
}
.edit:hover{
    background-color: lightgreen;
}
img {
    max-width: 150px;
    max-height: 150px; 
    width: auto;
    height: auto; 
}

    </style>
</head>
<body>

<header>
    <?php
    require_once('header.php');
    ?>
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
                <th>Category</th>
                <th>Action</th>
            </tr>
            <?php
            // Handle Delete Action
            if (isset($_POST['btnDelete'])) {
                $id = $_POST['id'];
                $connection = mysqli_connect('localhost', 'root', '', 'college_project');
            
                // Delete related records from the cart table
                $deleteCartQuery = "DELETE FROM cart WHERE product_id = $id";
                if (mysqli_query($connection, $deleteCartQuery)) {
                    // Related records deleted successfully
                } else {
                    echo "Error deleting related records from cart table: " . mysqli_error($connection);
                    // Handle the error as needed
                }
            
                // Now delete the product from the products table
                $deleteQuery = "DELETE FROM products WHERE product_id = $id";
                if (mysqli_query($connection, $deleteQuery)) {
                    // Product deleted successfully
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
                $connection = mysqli_connect('localhost', 'root', '', 'college_project');
                $select = "SELECT * FROM products";
                $result = mysqli_query($connection, $select);
                if(mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        $imageUrl = $row["imageUrl"];
                        $imagePath = "images/" . $imageUrl;
                        echo '<tr>
                                <td>'.$row['product_id'].'</td>
                                <td>'.$row['productName'].'</td>
                                <td>'.$row['price'].'</td>
                                <td><img src="'.$imagePath.'" alt="'.$row['productName'].'"></td>
                                <td>'.$row['description'].'</td>
                                <td>'.$row['category_name'].'</td>
                                <td>
                                    <span class="user-actions">
                                        <form action="edit_list.php" method="GET">
                                        <button type="submit" class="edit">Edit</button>
                                        </form>

                                        <form action="" method="POST">
                                        <input type="hidden" name="id" value="' . $row['product_id'] . '" />
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
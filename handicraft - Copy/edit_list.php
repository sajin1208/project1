<?php
// Check if user ID is provided in the URL
if(isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Fetch user data from the database
    $connection = mysqli_connect('localhost', 'root', '', 'handicraft_db');
    $select = "SELECT * FROM product_list WHERE id = $userId"; // Changed $id to $userId
    $result = mysqli_query($connection, $select);
    
    if(mysqli_num_rows($result) == 1) {
        $product_list = mysqli_fetch_assoc($result); // Changed $userData to $product_list
    } else {
        echo "Product not found.";
        exit(); // Exit if user not found
    }
} else {
    echo "Product ID not provided."; // Changed "Product_info" to "Product ID"
    exit(); // Exit if product ID not provided
}


// Check if form is submitted for updating user data
if(isset($_POST['updateUser'])) {
    // Retrieve form data
    $id = $_POST['id']; // Assuming there's an input field for product ID
    $name = $_POST['name'];
    $price = $_POST['price'];
    $location = $_POST['location'];
    $description = $_POST['description'];

    // Update user data in the database
    $updateQuery = "UPDATE product_list SET name = '$name', price = '$price', location = '$location', description = '$description' WHERE id = $id"; // Removed id = '$id'
    
    if(mysqli_query($connection, $updateQuery)) {
        echo "Product data updated successfully!";
        // You may choose to redirect back to the admin dashboard after updating
        header("Location: admindash.php");
        exit();
    } else {
        echo "Error updating product data: " . mysqli_error($connection);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit ProductList</title>
</head>
<style>
    body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.container {
    width: 50%;
    margin: 50px auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

h2 {
    text-align: center;
    color: #333;
}

form {
    margin-top: 20px;
}

label {
    display: block;
    margin-bottom: 5px;
    color: #333;
}

input[type="text"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

input[type="submit"] {
    width: 100%;
    background-color: #4caf50;
    color: white;
    padding: 14px 20px;
    margin-top: 10px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #45a049;
}


</style>

<body>
    <h2>Edit ProductList</h2>
    <form method="POST">
        <!-- Assuming there's an input field for product ID -->
        <label for="id">Id:</label>
        <input type="text" name="id" id="id" value="<?php echo $product_list['id']; ?>"><br>
        
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="<?php echo $product_list['name']; ?>"><br>
        
        <label for="price">Price:</label>
        <input type="text" name="price" id="price" value="<?php echo $product_list['price']; ?>"><br>
        
        <label for="img">Image Upload</label>
        <input type="file" name="img">
        <?php echo isset($errors['location']) ? $errors['location'] : ''; ?>
        
        <label for="description">Description:</label>
        <input type="text" name="description" id="description" value="<?php echo $product_list['description']; ?>"><br>
        
        <input type="submit" name="updateUser" value="Update">
    </form>
</body>

</html>

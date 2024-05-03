<?php
// Database connection details
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'college_project';

// Connect to the database
$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Error connecting to database: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize form data
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $price = floatval($_POST['price']);
    $description = $_POST['description'];
    $category_id = $_POST['category_id'];

    // Handle image upload
    $image_path = ''; // Initialize image path variable
    if (isset($_FILES['image_url']) && $_FILES['image_url']['error'] === UPLOAD_ERR_OK) {
        $image_temp = $_FILES['image_url']['tmp_name'];
        $image_name = $_FILES['image_url']['name'];
        $image_path = $image_name; // Adjust this path as needed
        
        // Validate file type and move uploaded file
        $allowed_extensions = array('jpg', 'jpeg', 'png', 'gif');
        $file_extension = pathinfo($image_name, PATHINFO_EXTENSION);
        if (in_array(strtolower($file_extension), $allowed_extensions)) {
            if (move_uploaded_file($image_temp, $image_path)) {
                // Update product details if image upload is successful
                $sql = "UPDATE products SET productName = '$product_name', price = $price, imageUrl = '$image_path', description = '$description', category_name = '$category_id' WHERE product_id = '$product_id'";
                if ($conn->query($sql) === TRUE) {
                    echo "Product details updated successfully.";
                } else {
                    echo "Error updating product details: " . $conn->error;
                }
            } else {
                echo "Error: Failed to move uploaded file.";
            }
        } else {
            echo "Error: Invalid file type. Only JPG, JPEG, PNG, GIF files are allowed.";
        }
    } else {
        echo "Error: File upload error.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Product Details</title>
    <style>
        body {
    font-family: Arial;
    background-color: whitesmoke;
    margin: 0;
    padding: 0;
}

h2 {
    text-align: center;
}

form {
    width: 50%;
    margin: 0 auto;
    background-color: whitesmoke;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0.5, 0.5, 0.5, 0.2);
}

label {
    display: block;
    margin-bottom: 5px;
}

input[type="text"],
input[type="file"],
textarea {
    width: 100%;
    padding: 8px;
    margin-bottom: 15px;
    border: 1px solid grey;
    border-radius: 3px;
    box-sizing: border-box;
}

input[type="submit"] {
    width: 100%;
    padding: 10px;
    background-color: mediumspringgreen;
    color: white;
    border: none;
    border-radius: 3px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: lightgreen;
}

    </style>
</head>
<body>
    <h2>Update Product Details</h2>
    <form action="edit_list.php" method="post" enctype="multipart/form-data">
        <label for="product_id">Product ID:</label>
        <input type="text" id="product_id" name="product_id" required><br><br>
        
        <label for="product_name">New Product Name:</label>
        <input type="text" id="product_name" name="product_name" required><br><br>
        
        <label for="price">New Price:</label>
        <input type="text" id="price" name="price" required><br><br>
        
        <label for="image_url">New Image:</label>
        <input type="file" id="image_url" name="image_url" required accept="image/*"><br><br>
        
        <label for="description">New Description:</label>
        <textarea id="description" name="description" required></textarea><br><br>
        
        <label for="category_id">New Category ID:</label>
        <input type="text" id="category_id" name="category_id" required><br><br>
        
        <input type="submit" value="Update">
    </form>
</body>
</html>

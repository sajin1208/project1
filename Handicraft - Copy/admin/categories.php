<?php
session_start();

// Database connection parameters
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$database = "college_project";

// Create connection
$con = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
   
// Check if the form is submitted
  if(isset($_POST['btnadd'])){
    $error = 0;
    if(isset($_POST['category']) && !empty($_POST['category']) && trim($_POST['category'])){
      $category =  $_POST['category'];
    } else {
        $error++;
        $errCategory =  "Enter category";
    }

    // Check if both username and password are not empty
    if (!empty($category)) {
        // Create the SQL query to insert data into the 'register' table
        $query = "INSERT INTO categories (category_name) VALUES ('$category')";

        // Perform the database query using the $con connection
        $result = mysqli_query($con, $query);

        // Check if the query was successful
        if ($result) {
            // Display success message
            echo "<script type='text/javascript'> alert('New category inserted')</script>";
        } else {
            // Display error message if the query fails
            echo "Error: " . mysqli_error($con);
        }
    } else {
        // Display error message if username or password is empty
        echo "<script type='text/javascript'> alert('Can't insert new category')</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category</title>
</head>
<style>
     body {
            font-family: Arial;
            margin: 0;
            padding: 0;
        }
        .categories {
            width: 50%;
            margin: 50px auto;
            background-color: whitesmoke;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            color: black;
        }
        form {
            margin-top: 20px;
        }
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid whitesmoke;
            border-radius: 3px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: aqua;
            border: none;
            color: whitesmoke;
            cursor: pointer;
            border-radius: 3px;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color: green;
        }
        .error {
            color: red;
            margin-top: 5px;
        }
    </style>
<body>
    <div class="categories">
        <h1>Add Categories</h1>
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
        <label for="category">Category</label>
        <input type="text" name="category" id="category" placeholder="Enter category" />
        <?php echo (isset($errCategory))?$errCategory:''; ?>
        <br/>
        <input type="submit" name="btnadd" id="Add" value="Add Category">
        </form>
    </div>
</body>
</html>
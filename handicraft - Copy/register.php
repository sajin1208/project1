<?php
session_start();

// Database connection parameters
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$database = "handicraft_db";

// Create connection
$con = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Retrieve username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password=md5($password);

    // Check if both username and password are not empty
    if (!empty($username) && !empty($password)) {
        // Create the SQL query to insert data into the 'register' table
        $query = "INSERT INTO register (username, password) VALUES ('$username', '$password')";

        // Perform the database query using the $con connection
        $result = mysqli_query($con, $query);

        // Check if the query was successful
        if ($result) {
            // Display success message
            echo "<script type='text/javascript'> alert('Successfully Registered')</script>";
        } else {
            // Display error message if the query fails
            echo "Error: " . mysqli_error($con);
        }
    } else {
        // Display error message if username or password is empty
        echo "<script type='text/javascript'> alert('Enter valid username and password')</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="cs.css">
</head>
<body>
    <div class="signup">
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
            <label for="username">Username</label>
            <input type="text" name="username">
            <br/>
            <label for="password">Password</label>
            <input type="password" name="password"> <!-- Change input type to password for security -->
            <br/>
            <input type="submit" name="btnsubmit">
        </form>
        <p>Already have an account?<a href="login.php">Login Here</a></p>
    </div>
</body>
</html>

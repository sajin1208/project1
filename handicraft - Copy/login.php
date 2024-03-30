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
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Retrieve username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if both username and password are not empty
    if (!empty($username) && !empty($password)) {
        // Create the SQL query to insert data into the 'register' table
        $query = "select * from register where username = '$username'";


        // Perform the database query using the $con connection
        $result = mysqli_query($con, $query);

        // Check if the query was successful
        if ($result)
        {
            if($result && mysqli_num_rows($result) > 0)
            {
                $user_data = mysqli_fetch_assoc($result);
                if($user_data['password'] == $password)
                {
                    header("location:main.php");
                    die;
                }
            }
        }
        else {
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
    <title>Login</title>
</head>
<style>
    body{
        background-color: aqua;
    }
    .first{
        display: flex;
        justify-content: center; /* Horizontally centers the content */
        align-items: center; /* Vertically centers the content */
        height: 100vh;
    }
    form{
        background: white;
    }

</style>
<body>
    <div class="first">
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">

        <label for="username">Username</label>
        <input type="text" name="username" id="username">
        <?php echo(isset($errUsername))?$errUsername:'';?>
        <br/>
        <label for="password">Password</label>
        <input type="text" name="password" id="password">
        <?php echo(isset($errPassword))?$errPassword:'';?>
        <br/>
        <input type="checkbox" name="remember" id="remember" value="remember" />Remember me<br />
        <input type="submit" id="btnLogin" value="login"><br/>
        <p>Account?<a href="register.php">Register</p>

    </form>
    
    </div>  

    
</body>
</html>
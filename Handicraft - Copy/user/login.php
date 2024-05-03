<?php
session_start();

include 'db_connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Perform any necessary validation here

    // SQL to check if the user exists using prepared statement
    $stmt = $conn->prepare("SELECT * FROM users WHERE username=? AND password=?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // User found, fetch the row
        $row = $result->fetch_assoc();

        // Set session variables
        $_SESSION["user_id"] = $row["user_id"];
        $_SESSION["username"] = $row["username"];

        // Close the statement
        $stmt->close();

        // Redirect to a welcome page or any other page you want
        header("Location:index.php");
        session_write_close(); // Ensure session data is saved before redirecting
        exit();
    } else {
        // User not found, display an error message
        echo "Invalid username or password";
    }
    // Close the statement if not closed
    if ($stmt) {
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        .container {
            width: 300px;
            margin: auto;
            margin-top: 50px;
            padding: 20px;
            border: 1px solid lightgrey;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        /* Style for the form */
        form {
            display: flex;
            flex-direction: column;
        }

        /* Style for the input fields */
        input[type="text"],
        input[type="password"],
        input[type="submit"] {
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid lightgrey;
            border-radius: 3px;
        }

        /* Style for the submit button */
        input[type="submit"] {
            background-color: mediumblue;
            color: white;
            cursor: pointer;
        }

        /* Style for the register link */
        .register-link {
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Login Form</h2>
        <form action="login.php" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <input type="submit" value="Login">

            <div class="register-link">
                <a href="register.php">New? Register here</a>
            </div>
        </form>
    </div>
</body>

</html>

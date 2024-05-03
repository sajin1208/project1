<?php
session_start();
require_once('db_connection.php');
if(isset($_SESSION['username'])) {
    echo 'Welcome, ' . $_SESSION['username'];}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>header</title>
    <link rel="stylesheet" href="css/fontawesome.min.css">

    <style>
        *{
    margin: 0px;
        }
        /*navbar*/
        .menu{
            background-color: aqua;
            overflow: hidden;
            display: flex;
        }
        header{
            width: 100%;
            justify-content: space-between;
            top: 100;
        }
        .menu a{
            float: inline-start;
            color: black;
            text-align: center;
            padding: 14px;
        }
        .form{
            float: inline-start;
            color: black
            text-align: center;
            padding: 14px;
        }
        .menu a:hover{
            background-color: lightgreen;
        }
        .menu1{
            width: 15%;
            height: 80%;
        }
        .cart1 {
            display: flex;
            align-items: center;
            margin-left: auto;
        }

        .cart1 a {
            margin-left: 10px;
        }
        .cart1 li{
            list-style: none ;
        }
        .dropdown {
            /* position: relative; */
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            /* position: absolute; */
            background-color: aqua;
            min-width: 160px;
            box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            text-align: left;
        }
        .dropdown a{
            color: white;
        }

        .dropdown-content a:hover {
            background-color: lawngreen;
        }

        .dropdown:hover .dropdown-content {
            display: flex;
        }

    </style>
</head>
<body>
<header>
        <div class="menu">
            <a href="index.php">Home</a>
            <a href="Aboutus.php">About Us</a>
            <a href="contact.php">Contact Us</a>
            <a href="FAQ.php">FAQ</a>
            <?php
                $select_product=mysqli_query($conn, "Select * from `cart`") or die('query failed');
                $row_count=mysqli_num_rows($select_product)            
            ?>

            <div class="cart1">
                <a href="mycart.php"><u>Cart</u></a> <!-- cart: <php echo $row_count ?><-->
                <?php 
                    if(isset($_SESSION['username'])) {
                        // echo '<li class="welcome">Welcome, ' . $_SESSION['username'] . '</li>';
                        echo '<li><a href="userlogout.php" class="logout">Logout</a></li>';
                    } else {
                        echo '<li><a href="login.php" class="login">Login</a></li>';
                        echo '<li><a href="register.php" class="register">Register</a></li>';
                    }
                ?>

            </div>
        </div>
    </header>

    
</body>
</html>
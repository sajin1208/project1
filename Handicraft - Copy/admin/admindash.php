<?
session_start();
// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    // Redirect the user to the login page or handle unauthorized access
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<style>
        *{
            margin: 0px;
        }
        body {
        font-family: Arial;
        background-color: whitesmoke;
        margin: 0;
        padding: 0;
        }

        h2 {
            color: gainsboro;
            text-align: center;
        }

        .container {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .topnavbar {
            background-color: lightgray;
            color: white;
            padding: 20px;
        }

        .content {
            flex: 1;
            display: flex;
        }

        .left {
            background-color: lawngreen;
            width: 20%;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .left a {
            color: white;
            text-decoration: none;
            margin-bottom: 10px;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .left a:hover {
            background-color: lightblue;
        }

        .right {
            background-color: white;
            width: 80%;
            padding: 20px;
        }
        .dropdown {
            /* position: relative; */
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            /* position: absolute; */
            background-color: lawngreen;
            min-width: 160px;
            box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
            /* z-index: 1; */
        }

        .dropdown-content a {
            color: whitesmoke;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            text-align: left;
        }

        .dropdown-content a:hover {
            background-color: whitesmoke;
        }

        .dropdown:hover .dropdown-content {
            display: flex;
        }

    
</style>
<body>

<header>
    <?php
     include_once('header.php');
    ?>   
</header>

    <div class="container">
        <div class="topnavbar"><p>Welcome Admin!</p></div>
        <div class="content">
            <div class="left">
                <a href="productlist.php">Check Lists</a><br/><br/>
                <a href="addproduct.php">Add product</a><br/><br/>
                <a href="categories.php">Add Categories</a><br/><br/>
                <a href="admin_orders.php">Check requests</a><br/><br/>
                <div class="dropdown">
                <a href="#">Order</a>
                <div class="dropdown-content">
                    <a href="track_orders.php">Track Orders</a>
                </div>
                </div>
                <!-- <button><a href="addadmin.php">Add admin </a> </button> -->
            </div>
            <div class="right">content</div>
        </div>
    </div>

    <!--<img src="<#?php echo $imagePath;?>" alt="">-->
    <!--footer-->
    <footer>
        <?php
            include_once('footer.php');
        ?>   
    </footer>
</body>
</html>
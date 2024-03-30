
<?php
$pname = $desc = $price = $fName= '';

if(isset($_POST['btnsubmit'])){
    $errors = [];

    // Validation for Product Name
    if(isset($_POST['pname']) && !empty($_POST['pname'])){
        $pname = $_POST['pname'];
    } else {
        $errors['pname'] = 'Please enter product name';
    }

    // Validation for Product Description
    if(isset($_POST['desc']) && !empty($_POST['desc'])){
        $desc = $_POST['desc'];
    } else {
        $errors['desc'] = 'Please enter product description';
    }

    // for location / images
    /*
    if(isset($_POST['location']) && !empty($_POST['location'])){
        $location = $_POST['location'];
    } else {
        $errors['location'] = 'Please enter image';
    }
    */
    //print_r($_FILES);

    $fName = $_FILES['img']['name'];
    $imagePath = "./img/".$fName;
   // echo $imagePath;
    // Validation for Price
    if(isset($_POST['price']) && !empty($_POST['price'])){
        $price = $_POST['price'];
        if(!is_numeric($price) || $price <= 0){
            $errors['price'] = 'Please enter a valid positive price';
        }
    } else {
        $errors['price'] = 'Please enter product price';
    }

    // If there are no errors, proceed to insert into database
    if(empty($errors)){
        try{
            // Your database connection code here

            // Your SQL query 
            $connection = mysqli_connect('localhost','root','','handicraft_db');
            //sql to insert record for single row
            $sql = "INSERT INTO product_list(name,price,location, description) values ('$pname',$price,'$imagePath','$desc')";
            if(mysqli_query($connection,$sql)){
                echo 'Product insert success';
            } else {
                echo 'Failed to insert data';
            }

            // If insertion is successful, you can redirect or show a success message
        }catch(Exception $ex){
            die('Database Error: ' . $ex->getMessage());
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="cs.css">
</head>
<style>
    *{

    }
    .menu{
    background-color: aqua;
    overflow: hidden;
}
header{
    width: 100%;
    justify-content: space-between;
    top: 100;
}
.menu a,form{
    float: inline-start;
    color: orange;
    text-align: center;
    padding: 14px 16px;
}
.menu a:hover{
    background-color: black;
}
.menu1{
    width: 15%;
    height: 80%;
}
.cart1{
    float: right;
}
</style>
<body>

<header>
        <div class="menu">
            <a href="home.php">list</a>
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

    <div class="one">
        <p>Welcome Admin!</p>
        <div class="adm">
            <div class="sidenav">
            <a href="productlist.php">Check Lists</a>
            <a href="addproduct.php">Add product</a>

            </div>
        </div>     
   
    <!--<img src="<#?php echo $imagePath;?>" alt="">-->
</body>
</html>

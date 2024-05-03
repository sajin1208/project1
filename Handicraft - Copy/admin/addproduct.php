<?php
$pname = $desc = $price = $fName = $category = '';

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

    if(isset($_POST['category']) && !empty($_POST['category'])){
        $category = $_POST['category'];
    } else {
        $errors['category'] = 'Please enter category type';
    }

    if(isset($_POST['quantity']) && !empty($_POST['quantity'])){
        $quantity = $_POST['quantity'];
    } else {
        $errors['quantity'] = 'Please enter quantity';
    }

    $fName = $_FILES['img']['name'];
    $imagePath = $fName;

    // Validation for Price
    if(isset($_POST['price']) && !empty($_POST['price'])){
        $price = $_POST['price'];
        if(!is_numeric($price) || $price <= 0){
            $errors['price'] = 'Please enter a valid positive price';
        }
    } else {
        $errors['price'] = 'Please enter product price';
    }

    // If there are no errors, proceed to insert into or update the database
    if(empty($errors)){
        try{
            // SQL query 
            $connection = mysqli_connect('localhost','root','','college_project');
            
            // Check if the product already exists
            $check_query = "SELECT * FROM products WHERE productName='$pname' AND price=$price AND description='$desc' AND category_name='$category'";
            $result = mysqli_query($connection, $check_query);
            $count = mysqli_num_rows($result);

            if($count > 0) {
                // If product exists, update its quantity
                $row = mysqli_fetch_assoc($result);
                $existing_quantity = $row['quantity'];
                $new_quantity = $existing_quantity + $quantity;
                $update_query = "UPDATE products SET quantity=$new_quantity WHERE productName='$pname' AND price=$price AND description='$desc' AND category_name='$category'";
                mysqli_query($connection, $update_query);
                echo 'Product quantity updated';
            } else {
                // If product does not exist, insert as a new product
                $insert_query = "INSERT INTO products(productName, price, imageUrl, description, category_name, quantity) VALUES ('$pname', $price, '$imagePath', '$desc', '$category', $quantity)";
                if(mysqli_query($connection, $insert_query)){
                    echo 'Product insert success';
                } else {
                    echo 'Failed to insert data';
                }
            }

            mysqli_close($connection);
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
</head>
<style>
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
/* Apply styles to the section */
#first {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh; 
}

.signup form {
    width: 300px; 
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #f9f9f9;
}

.signup label {
    display: block;
    margin-bottom: 5px;
}

.signup input[type="text"],
.signup input[type="number"],
.signup input[type="file"] {
    width: 100%;
    padding: 8px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 3px;
    box-sizing: border-box;
}

.signup input[type="submit"] {
    width: 100%;
    padding: 10px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 3px;
    cursor: pointer;
}

.signup input[type="submit"]:hover {
    background-color: #45a049;
}


</style>
<body>

<header>
    <?php
    include_once('header.php');
    ?>
       
</header>
       
    <section id="first">
    <div class="signup">
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
            <label for="pname">Product Name</label>
            <input type="text" name="pname" value="<?php echo htmlspecialchars($pname); ?>"/>
            <?php echo isset($errors['pname']) ? $errors['pname'] : ''; ?>
            <br/>

            <label for="desc">Product Description</label>
            <input type="text" name="desc" value="<?php echo htmlspecialchars($desc); ?>"/>
            <?php echo isset($errors['desc']) ? $errors['desc'] : ''; ?>
            <br/>
            

            <label for="category">$Category Name</label>
            <input type="text" name="category" value="<?php echo htmlspecialchars($category); ?>"/>
            <?php echo isset($errors['category']) ? $errors['category'] : ''; ?>
            <br/>

            <label for="img">Image Upload</label>
            <input type="file" name="img" required accept = "image/png, image/jpg, image/jpeg">
            <?php echo isset($errors['location']) ? $errors['location'] : ''; ?>
            <br/>

            <label for="quantity">Quantity</label>
            <input type="number" name="quantity" value="<?php echo htmlspecialchars($quantity); ?>"/>
            <?php echo isset($errors['quantity']) ? $errors['quantity'] : ''; ?>
            <br/>

            <label for="price">Price</label>
            <input type="number" name="price" value="<?php echo htmlspecialchars($price); ?>"/>
            <?php echo isset($errors['price']) ? $errors['price'] : ''; ?>
            <br/>
            
            <input type="submit" name="btnsubmit" value="Add Product">
        </form>
    </div>
</section>
    <!--<img src="<#?php echo $imagePath;?>" alt="">-->
</body>
</html>
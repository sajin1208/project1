<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "product";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn) {
    
} else {
    echo "Connection failed";
}

if(isset($_POST["add"]))
{
    $productId = $_GET["id"];
    $productName = $_POST["hidden_name"];
    $productImage = $_POST["hidden_image"];
    $productPrice = $_POST["hidden_price"];
    $productQuantity = $_POST["quantity"];

    $sql = "INSERT INTO `simple1` (`description`, `image`, `price`, `quantity`) VALUES ('$productName', '$productImage', '$productPrice', '$productQuantity', '')";
    mysqli_query($conn, $sql);

}




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>charset</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="menu">
            <a href="Home.php">Home</a>
            <a href="Aboutus.php">About Us</a>
            <a href="Review.php">Reviews</a>
            <a href="contact.php">Contact Us</a>
            <a href="FAQ.php">FAQ</a>
            <form action="/search" method="get">
                <input type="text" name="q" placeholder="Search...">
                <input type="submit" value="Search">
            </form>
        </div> <br/>
    </header>

    <nav>
        <span>Shop </span>
        <div>
            <a href="">Login</a>
            <a href="cart1.php">CART</a>
        </div>
    </nav>

    <main>
        <h2>Product</h2>
        <div class="container">
            <?php
            $query = "SELECT * FROM `simple` ORDER BY id ASC";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
            ?>
                    <div class="product">
                        <form action="cart.php?action=add&id=<?php echo $row["id"]; ?>" method="post">
                            <img src="<?php echo $row["image"]; ?>" alt="">
                            <h3><?php echo $row["description"]; ?></h3>
                            <p>Rs<?php echo $row["price"]; ?></p>
                            <input type="text" id="quantity" name="quantity" value="1">
                            <input type="hidden" name="hidden_image" value="<?php echo $row["image"]; ?>">
                            <input type="hidden" name="hidden_name" value="<?php echo $row["description"]; ?>">
                            <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>">
                            <input type="submit" name="submit" value="Add to Cart">
                        </form>
                    </div>
            <?php
                }
            } else {
                echo "No products found";
            }
            ?>
        </div>
    </main>

    <footer>
    <div class="contact-info">
                <span class="one">
                    <i class='bx bxl-facebook-circle'></i>       
                    <i class='bx bxl-instagram' ></i>
                    <i class='bx bxl-youtube' ></i>
                </span>
                <br/>

                <span class="two">
                    <a href="privacy">PRIVACY</a>
                    <a href="#">TERMS OF SERVICE</a>
                    <a href="#">SHIPPING POLICY</a>
                    <a href="#">RETURN POLICY</a>
                </span>

                <span class="three">
                    <button class="top"><a href="middle.html#top">Back to top of page</a></button>                  
                </span>

                <span class="four">
                    <h5>2024@copyright by Sajin</h5>
                </span>
            </div>
    </footer>

    
</body>
</html>
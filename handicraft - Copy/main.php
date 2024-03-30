
<?php
//database fetch
//assign variable

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <link rel="icon" href="logo.jpg">
    <link rel="stylesheet" href="css/fontawesome.min.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <title>SMS Shopping site</title>
</head>
<body>
    <header>
        <div class="menu">
            <a href="home.php">Home</a>
            <a href="Aboutus.php">About Us</a>
            <a href="contact.php">Contact Us</a>
            <a href="Review.php">Reviews</a>
            <a href="FAQ.php">FAQ</a>
            <a href="#">Total price</a>
            <form action="/search" method="get">
                <input type="text" name="q" placeholder="Search...">
                <input type="submit" value="Search">
            </form>
            <div class="cart">
                <i class="fa-light fa-cart-shopping"></i>
            </div>

            <div class="cart1">
                <a href="cart.php"><u>Cart</u></a>
                <a href="login.php"><u>Log In</u></a>
            </div>
        </div>
    </header>
    <main>
    <div class="sidebar">
            <a href="#">Brass</a>
            <a href="#">Gold</a>
            <a href="#">Silver</a>
            <a href="#">Diamond</a>
        </div>


    
        <div class="products">
            <!-- card start-->
            <?php
                // Database connection
                $servername = "localhost"; // Replace with your server name
                $username = "root"; // Replace with your database username
                $password = ""; // Replace with your database password
                $dbname = "handicraft_db"; // Replace with your database name

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // SQL query to fetch data
                $sql = "SELECT id, name,price, location, description FROM product_list";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                    //  print_r($row);

            ?>

        <div class="card">

            <div class="img"><img src="<?php echo $row['location']; ?>" alt="<?php echo $row['name']; ?>"></div>
            <div class="desc"><?php echo $row['name']; ?></div>
            <div class="title"><?php echo $row['description']; ?></div>
            <div class="box">
            <div class="price"><p>Rs.<?php echo $row['price']; ?></p></div> <!-- Dummy price for demonstration -->
                <button class="btn">Buy Now</button>
            </div>

        </div>
            <?php
            }
        } else {
            echo "0 results";
        }
        $conn->close();
        ?>

    </div>
    </main>

    <br/>
    <!--footer-->
    <footer class="contact">
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
                    <button class="top"><a href="main.php#top">Back to top of page</a></button>                  
                </span>

                <span class="four">
                    <h5>2024@copyright by Sajin</h5>
                </span>
            </div>
        </footer>
         
</body>
</html>
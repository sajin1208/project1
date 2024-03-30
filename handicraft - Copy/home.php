<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="all.css">
    <link rel="icon" href="logo.JPG">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/fontawesome.min.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <title>SMS Shopping site</title>
</head>
<body>
    <header>
        <div class="menu">
            <a href="home.php">Home</a>
            <a href="Aboutus.php">About Us</a>
            <a href="Review.php">Reviews</a>
            <a href="contact.php">Contact Us</a>
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
                <a href="register.php"><u>Log out</u></a>
            </div>
        </div>
    </header>
    <main>
    <div class="main">
    <section>
        <div class="box1">
            <form action="/search" method="get">
                <input type="text" name="q" placeholder="Search...">
                <input type="submit" value="Search">
            </form>
            <ul>
                <li>Brass</li>
                <li>Silver</li>
                <li>Gold</li>
                <li>Gem</li>

            </ul>
        </div>
    </section>

    <div class="sec">
        <div class="products">
            <!-- card start-->
            <div class="card mb-10">
            <div class="img"><img src="img/dalucha.jpg" alt="sSs"></div>
            <div class="desc">silver</div>
            <div class="title">Dalucha</div>
            <div class="box">
                <div class="price">Rs.10000</div>
                <button class="btn">Buy Now</button>
            </div>
            </div>
            <!-- card end-->
            <div class="card mb-10">
            <div class="img"><img src="img/p1.2.jpg" alt="sSs" class="card-image-top"></div>
            <div class="desc">silver</div>
            <div class="title">Dalucha</div>
            <div class="box">
                <div class="price">Rs.10000</div>
                <button class="btn">Buy Now</button>
            </div>
            </div>

            <div class="card mb-10">
            <div class="img"><img src="img/p1.1.jpg" alt="sSs"></div>
            <div class="desc">silver</div>
            <div class="title">Dalucha</div>
            <div class="box">
                <div class="price">Rs.10000</div>
                <button class="btn">Buy Now</button>
            </div>
            </div>

            <div class="card mb-10">
            <div class="img"><img src="img/p1.4.jpg" alt="sSs"></div>
            <div class="desc">silver</div>
            <div class="title">Dalucha</div>
            <div class="box">
                <div class="price">Rs.10000</div>
                <button class="btn">Buy Now</button>
            </div>
            </div>

            <div class="card mb-10">
            <div class="img"><img src="img/p1.5.jpg" alt="sSs"></div>
            <div class="desc">silver</div>
            <div class="title">Dalucha</div>
            <div class="box">
                <div class="price">Rs.10000</div>
                <button class="btn">Buy Now</button>
            </div>
            </div>

        </div>

        
              


        

        

    


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
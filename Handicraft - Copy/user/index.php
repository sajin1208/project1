    <?php
    require_once('db_connection.php');
    ?>
    
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Product Catalog</title>
        <style>
           .card {
                border: 1px solid lightblue;
                border-radius: 5px;
                padding: 20px;
                margin: 10px;
                width: 250px; 
                height: 350px;
                box-sizing: border-box;
                display: inline-block;
                vertical-align: top; /* Align cards at the top */
            }

            .card h3 {
                margin-top: 0;
            }

            .card img {
                width: 100%; 
                height: 200px; /* image */
                object-fit: cover;
                display: block;
                margin-bottom: 10px;
            }
            .card {
                border: 1px solid #ccc;
                border-radius: 5px;
                padding: 20px;
                margin: 10px;
                width: 250px; 
                height: 350px;
                box-sizing: border-box;
                display: inline-block;
                
            }

            .card h3 {
                margin-top: 0;
            }

            .card img {
                width: 100%;
                height: 200px;
                object-fit: contain;
                display: block;
                margin-bottom: 10px;
            }
            .button-container{
                display: flex;
            }
            .add-to-cart-btn {
                background-color: blue;
                color: #fff;
                border: none;
                padding: 8px;
                /* border-radius: 4px; */
                cursor: pointer;
            }
            .view-details-btn{
                background-color: orange;
                border: none;
                padding: 8px;
                cursor: pointer;

            }

            .add-to-cart-btn:hover{
                background-color: lightseagreen;
            }
            .view-details-btn:hover{
                background-color: lightgreen;

            }
        .main {
            display: flex;
        }

        
        .one {
            background-color: lightcyan;
            width: 200px;
            
        }

        .sidebar {
            display: flex;
            flex-direction: column; /* Display categories as a list */
            padding: 10px 50px;
            text-align: center;
            font-size: 20px;
        }
        .sidebar a {
            display: block;
            margin-bottom: 10px;
            text-decoration: none;
        }

        .second {
            flex: 1; /* Take remaining width */
            padding: 10px;
            display: flex;
            flex-wrap: wrap; 
            gap: 10px; 
        }
        .sidebar a:hover {
            background-color: gray;
        }
        
        </style>
    </head>
    <header>
            <?php
            include_once('header.php');
            ?>
    </header>

    <body>
    <section>
    <!-- <h2>Product Catalog</h2> -->
    <div class="main">
        <div class="one">
        <form action="search_results.php" method="GET">
                <input type="text" name="q" placeholder="Search...">
                <input type="submit" value="Search">
            </form> 
            <?php
            // Fetch categories from the database
            $select_categories = mysqli_query($conn, "SELECT category_name FROM categories");

            // Display sidebar with fetched categories
            echo '<div class="sidebar">';
            while ($row = mysqli_fetch_assoc($select_categories)) {
                $categoryName = $row['category_name'];
                // Create links for each category
                echo '<a href="?category=' . urlencode($categoryName) . '">' . $categoryName . '</a>';
            }
            echo '</div>';
            ?>
        </div>

        <div class="second">
            <?php
            // Include the database connection file
            include 'db_connection.php';

            // Check if a category is selected
            if (isset($_GET['category'])) {
                // Fetch products related to the selected category
                $selectedCategory = $_GET['category'];
                $select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE `category_name` = '$selectedCategory'");

            // Display related products
            echo '<section class="products">';
            echo '<div class="product_container">';

            if (mysqli_num_rows($select_products) > 0) {
                while ($fetch_product = mysqli_fetch_assoc($select_products)) {
                    // Construct image URL using the relative path
                    $imageUrl = $fetch_product['imageUrl'];
                    $imagePath = "images/" . $imageUrl;

                    // Display product information in a card
                    echo "<div class='card'>";
                    echo "<img src='" . $imagePath . "' alt='" . $fetch_product['productName'] . "'>";
                    echo "<h3>" . $fetch_product['productName'] . "</h3>";
                    echo "<div class='price'>Price: Rs" . $fetch_product['price'] . "</div>";
                    
                    // Add "View" button
                    echo "<div class='button-container'>";
                    echo "<form action='view_product.php' method='GET'>";
                    echo "<input type='hidden' name='product_id' value='" . $fetch_product["product_id"] . "'>";
                    echo "<input type='submit' class='view-details-btn' value='View Details'>";
                    echo "</form>";
                    
                    // Add "Add to Cart" button with product details as hidden inputs
                    echo "<form action='add_to_cart.php' method='POST'>";
                    echo "<input type='hidden' name='product_id' value='" . $fetch_product["product_id"] . "'>";
                    echo "<input type='submit' class='add-to-cart-btn' value='Add to Cart'>";
                    echo "</form>";
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "No Products";
            }

            echo '</div>';
            echo '</section>';

            }
            
             else {
                // Fetch all products from the database
                $sql = "SELECT * FROM products";
                $result = $conn->query($sql);

                // Check if there are any products
                if ($result->num_rows > 0) {
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        // Construct image URL using the relative path
                        $imageUrl = $row["imageUrl"];
                        $imagePath = "images/" . $imageUrl;

                        // Display product information in a card
                        echo "<div class='card'>";
                        echo "<img src='" . $imagePath . "' alt='" . $row["productName"] . "'>";
                        echo "<h3>" . $row["productName"] . "</h3>";
                        echo "<p><strong>Price:</strong> Rs" . $row["price"] . "</p>";
                        echo "<p>" . $row["description"] . "</p>";
                        // Add "View" button
                        echo "<div class='button-container'>";
                        echo "<form action='view_product.php' method='GET'>";
                        echo "<input type='hidden' name='product_id' value='" . $row["product_id"] . "'>";
                        echo "<input type='submit' class='view-details-btn' value='View Details'>";
                        echo "</form>";

                        // echo "<a href='view_product.php?product_id=" . $row["product_id"] . "' class='view-btn'>View Details</a>";
                        // Add "Add to Cart" button with product id as data attribute
                        echo "<form action='add_to_cart.php' method='POST'>";
                        echo "<input type='hidden' name='product_id' value='" . $row["product_id"] . "'>";
                        echo "<input type='submit' class='add-to-cart-btn' value='Add to Cart'>";
                        echo "</form>";
                        echo "</div>";
                        echo "</div>";

                    }
                } else {
                    echo "No products found.";
                }
            }

            // Close the database connection
            $conn->close();
            ?>
        </div>
    </div>
</section>

    </body>
    <footer>
    <?php
        include_once('footer.php');

        ?>
    </footer>
   

    </html>
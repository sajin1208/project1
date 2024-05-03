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
<style>
        body {
            margin: 0;
            padding: 0;
            background-color: lightcyan;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        input[type="text"], textarea {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: green;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: lightgreen;
        }
    </style>
<body>
    <header>
    <?php
        include_once('header.php');
        ?>
    </header>
    <div class="container">
        <h2>Contact Sajin</h2>
        <form action="contact.php" method="post">
            <label for="name">Your Name:</label>
            <input type="text" id="name" name="name" required>
            <label for="email">Your Email:</label>
            <input type="text" id="email" name="email" required>
            <label for="message">Message:</label>
            <textarea id="message" name="message" rows="4" required></textarea>
            <input type="submit" value="Submit">
        </form>
        <p>Or you can call us at: <strong>986340246</strong></p>
    </div>

    <br/>
    <!--footer-->
    <footer>
        <?php
        include_once('footer.php');
        ?>
    </footer>
  
         
</body>
</html>
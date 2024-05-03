<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>footer</title>
    <link rel="icon" href="logo.JPG">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/fontawesome.min.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }

        .contact {
            margin-top: auto;
            background-color: aqua;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .contact-info {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .contact-info > * {
            margin-bottom: 10px;
        }

        .onee,
        .two,
        .three,
        .four {
            display: flex;
            justify-content: center;
        }

        .one i,
        .two a,
        .three button,
        .four h5 {
            margin-right: 10px;
        }

    </style>
<body>
<footer class="contact">
            <div class="contact-info">
                <span class="onee">
                    <i class='bx bxl-facebook-circle'></i>       
                    <i class='bx bxl-instagram' ></i>
                    <i class='bx bxl-youtube' ></i>
                </span>
                <br/>

                <span class="two">
                    <a href="privacy">PRIVACY</a>
                    <a href="#">TERMS OF SERVICE</a>
                </span>

                <span class="three">
                    <button class="top"><a href="#top">Back to top of page</a></button>                  
                </span>

                <span class="four">
                    <h5>2024@copyright SMS Handicraft Store</h5>
                </span>
            </div>
        </footer> 
</body>
</html>

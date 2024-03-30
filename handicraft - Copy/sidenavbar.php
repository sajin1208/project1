<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Simple Sidebar</title>
<style>
    body, html {
        height: 100%;
        margin: 0;
        font-family: Arial, sans-serif;
    }

    .sidebar {
        height: 100%;
        width: 200px;
        position: fixed;
        top: 0;
        left: 0;
        background-color: #333;
        padding-top: 20px;
    }

    .sidebar a {
        padding: 10px;
        display: block;
        color: white;
        text-decoration: none;
    }

    .sidebar a:hover {
        background-color: #555;
    }

    .content {
        margin-left: 200px;
        padding: 20px;
        height: 100%;
    }
</style>
</head>
<body>

<div class="sidebar">
    <a href="#">Categories</a>
    <a href="#">Products</a>
    <a href="#">Orders</a>
</div>

<div class="content">
    <h2>Main Content</h2>
    <p>This is the main content area.</p>
</div>

</body>
</html>

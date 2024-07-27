<?php
@include 'db_connection.php';

session_start();

if (!isset($_SESSION['Customer_name'])) {
    header('location: login.php');

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Page</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <div class="content">
            <a href="login.php" class="button"> Login</a>
            <a href="register.php" class="button"> Register</a>
            <a href="logout.php" class="button"> Logout</a>

            <!-- Profile section -->
            <a href="read_customer.php" class="button">View Profile</a>
        </div>
    </div>
</body>

</html>
<?php
@include 'db_connection.php';

session_start();

if (!isset($_SESSION['Admin_name'])) {
    header('location: ../User/login.php');

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php @include './admin_nav.php'; ?>
    <div class="container">
        <div class="content">
            <a href="../User/logout.php" class="button"> Logout</a>
        </div>
    </div>
    <?php @include '../Footer/footer.php' ?>
</body>

</html>
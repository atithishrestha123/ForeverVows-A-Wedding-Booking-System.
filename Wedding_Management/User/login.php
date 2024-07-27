<?php
@include 'db_connection.php';

session_start();

if (isset($_POST['submit'])) {
    $Username = mysqli_real_escape_string($conn, $_POST['Username']);
    $Password = mysqli_real_escape_string($conn, $_POST['Password']);

    $select = "SELECT * FROM users WHERE Username = '$Username'";
    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);

        // Verify the password
        if (password_verify($Password, $row['Password'])) {
            // Password is correct, set session and redirect based on user type
            $userID = $row['UsersID']; // Retrieve the user ID

            if ($row['User_type'] == 'Admin') {
                $_SESSION['Admin_name'] = $row['Username'];
                $_SESSION['UserID'] = $userID; // Store the user ID in the session
                header('location: ../Admin/admin_dashboard.php');
                exit();
            } elseif ($row['User_type'] == 'Customer') {
                $_SESSION['Customer_name'] = $row['Username'];
                $_SESSION['UserID'] = $userID; // Store the user ID in the session
                header('location: ../Webpage/dashboard.php');
                exit();
            }
        } else {
            // Password is incorrect
            $error_message = "Incorrect username or password!";
        }
    } else {
        // User not found
        $error_message = "User not found";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        body {
            background-image: url('../Assets/bg-img.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            height: auto;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow-y: hidden;
        }

        .container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            padding-bottom: 60px;
        }

        .container .content {
            text-align: center;
        }

        .container .content h3 {
            font-size: 30px;
            color: #333;
        }

        .container .content h3 span {
            background: #DC143C;
            color: #fff;
            border-radius: 5px;
            padding: 0 15px;
        }

        .container .content h1 {
            font-size: 50px;
            color: #333;
        }

        .container .content h1 span {
            color: #DC143C;
        }

        .container .content p {
            font-size: 25px;
            margin-bottom: 20px;
        }

        .container .content .button {
            display: inline-block;
            padding: 10px 30px;
            font-size: 20px;
            background: #333;
            color: #fff;
            margin: 0 5px;
        }

        .container .content .button:hover {
            background: #DC143C;
        }

        .form-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, .1);
            padding-bottom: 60px;
            width: 100%;
        }

        .form-container .form-button {
            width: 100%;
            padding: 15px;
            font-size: 20px;
            background: #fbd0d9;
            color: #DC143C;
            text-transform: capitalize;
            cursor: pointer;
            border: none;
            border-radius: 5px;
            outline: none;
            transition: background-color 0.3s;
        }

        .form-container form {
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, .1);
            /* background: #fff; */
            text-align: center;
            width: 500px;
        }

        .form-container form h3 {
            font-size: 30px;
            text-transform: uppercase;
            margin-bottom: 10px;
            color: #333;
        }

        .form-container input[type="text"],
        .form-container input[type="password"] {
            width: 100%;
            padding: 15px;
            font-size: 17px;
            margin: 8px 0;
            background: #eee;
            border-radius: 5px;
            border: none;
            outline: none;
            box-sizing: border-box;
            padding-left: 40px;
            background-position: 10px center;
            background-repeat: no-repeat;

            font-family: 'Font Awesome 5 Free';
        }

        .form-container form input,
        .form-container form select {
            width: 100%;
            padding: 10px 15px;
            font-size: 17px;
            margin: 8px 0;
            background: #eee;
            border-radius: 5px;
        }

        .form-container form select option {
            background: #fff;
        }

        .form-container form .form-button {
            background: #fbd0d9;
            color: #DC143C;
            text-transform: capitalize;
            font-size: 20px;
            cursor: pointer;
        }

        .form-container form .form-button:hover {
            background: #DC143C;
            color: #fff;
        }

        .form-container form p {
            margin-top: 10px;
            font-size: 17px;
            color: #333;
        }

        .form-container form p a {
            color: #DC143C;
        }

        .form-container form .error-message {
            margin: 10px 0;
            display: block;
            background: #DC143C;
            color: #fff;
            border-radius: 5px;
            font-size: 20px;
            padding: 10px;
        }

        @media screen and (max-width: 600px) {
            .form-container form {
                width: 95%;
            }
        }
    </style>
</head>

<body>
    <div class="form-container">
        <form action="" method="post">
            <h3>Login Now</h3>
            <?php if (isset($error_message)): ?>
                <span class="error-message">
                    <?php echo $error_message; ?>
                </span>
            <?php endif; ?>
            <input type="text" name="Username" required placeholder="&#xf007; Enter your username"
                style="font-family: 'Font Awesome 5 Free'; padding-left: 40px;" class="fas">
            <input type="password" name="Password" required placeholder="&#xf023; Enter your password"
                style="font-family: 'Font Awesome 5 Free'; padding-left: 40px;" class="fas">

            <input type="submit" name="submit" value="Login Now" class="form-button">
            <p>Don't have an account? <a href="register.php"> Register Now </a></p>
        </form>
    </div>
</body>

</html>
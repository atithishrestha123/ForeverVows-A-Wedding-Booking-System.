<?php

@include 'db_connection.php';

$error = array();

if (isset($_POST['submit'])) {
    $First_name = mysqli_real_escape_string($conn, $_POST['First_name']);
    $Last_name = mysqli_real_escape_string($conn, $_POST['Last_name']);
    $Username = mysqli_real_escape_string($conn, $_POST['Username']);
    $Email_address = mysqli_real_escape_string($conn, $_POST['Email_address']);
    $Password = password_hash($_POST['Password'], PASSWORD_DEFAULT);
    $ConfirmPassword = $_POST['ConfirmPassword'];
    $User_type = isset($_POST['User_type']) ? mysqli_real_escape_string($conn, $_POST['User_type']) : "Customer";
    $select = "SELECT * FROM users WHERE Username = '$Username'";

    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {
        $error[] = "Username already exists!";
    } else {
        if (!password_verify($ConfirmPassword, $Password)) {
            $error[] = "Passwords do not match!";
        } else {
            $insert = "INSERT INTO users (First_name, Last_name, Username, Email_address, Password, User_type) VALUES ('$First_name', '$Last_name', '$Username', '$Email_address', '$Password', '$User_type')";
            if (mysqli_query($conn, $insert)) {
                header('Location: login.php');
                exit();
            } else {
                $error[] = "Error: " . mysqli_error($conn);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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

        .form-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            padding-bottom: 60px;

        }

        .form-container form {
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, .1);
            background: #fff;
            text-align: center;
            width: 500px;
            background-color: rgba(255, 255, 255, 0.1);
        }

        .form-container form h3 {
            font-size: 30px;
            text-transform: uppercase;
            margin-bottom: 10px;
            color: #333;
        }

        .form-container form input[type="text"],
        .form-container form input[type="email"],
        .form-container form input[type="password"] {
            width: calc(100% - 20px);
            padding: 10px;
            font-size: 17px;
            margin: 8px 0;
            background: #eee;
            border-radius: 5px;
            border: none;
            outline: none;
            box-sizing: border-box;
        }

        .form-container form input[type="submit"] {
            width: calc(100% - 20px);
            padding: 10px;
            font-size: 20px;
            margin: 8px 0;
            background: #fbd0d9;
            color: #DC143C;
            text-transform: capitalize;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            outline: none;
            box-sizing: border-box;
        }

        .form-container form input[type="submit"]:hover {
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

        .error-message {
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
                padding: 10px;
                /* Adjusted padding for smaller screens */
            }

            .form-container form input[type="text"],
            .form-container form input[type="email"],
            .form-container form input[type="password"],
            .form-container form input[type="submit"] {
                font-size: 16px;
                /* Adjusted font size for smaller screens */
            }
        }
    </style>
</head>

<body>
    <div class="form-container">
        <form action="" method="post">
            <h3>Your registration starts here!</h3>
            <?php
            if (!empty($error)) {
                foreach ($error as $err) {
                    echo '<span class="error-message">' . $err . '</span>';
                }
            }
            ?>
            <input type="text" name="First_name" required placeholder="&#xf007; Enter your first name"
                style="font-family: 'Font Awesome 5 Free'; padding-left: 40px;" class="fas">

            <input type="text" name="Last_name" required placeholder="&#xf007; Enter your last name"
                style="font-family: 'Font Awesome 5 Free'; padding-left: 40px;" class="fas">

            <input type="text" name="Username" required placeholder="&#xf2bd; Enter your username"
                style="font-family: 'Font Awesome 5 Free'; padding-left: 40px;" class="fas">

            <input type="email" name="Email_address" required placeholder="&#xf0e0; Enter your email"
                style="font-family: 'Font Awesome 5 Free'; padding-left: 40px;" class="fas">

            <input type="password" name="Password" required placeholder="&#xf023; Enter your password"
                style="font-family: 'Font Awesome 5 Free'; padding-left: 40px;" class="fas">

            <input type="password" name="ConfirmPassword" required placeholder="&#xf023; Confirm your password"
                style="font-family: 'Font Awesome 5 Free'; padding-left: 40px;" class="fas">

            <input type="submit" name="submit" value="Register Now" class="form-button">
            <p>Already have an account? <a href="login.php"> Login Now </a></p>
        </form>
    </div>
</body>

</html>
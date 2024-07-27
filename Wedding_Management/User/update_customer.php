<?php
@include './db_connection.php';

function updateCustomerDetails($username, $field, $value)
{
    global $conn;
    $username = mysqli_real_escape_string($conn, $username);
    $field = mysqli_real_escape_string($conn, $field);
    $value = ($field === 'Password') ? password_hash($value, PASSWORD_DEFAULT) : mysqli_real_escape_string($conn, $value);

    $query = "UPDATE Users SET $field = '$value' WHERE Username = '$username'";
    return mysqli_query($conn, $query);
}

function getCustomerData($username)
{
    global $conn;
    $username = mysqli_real_escape_string($conn, $username);

    $query = "SELECT * FROM Users WHERE Username = '$username'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    } else {
        return false;
    }
}

$error_message = "";
$success_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["username"]) && !empty($_POST["username"]) && isset($_POST["field"]) && !empty($_POST["field"]) && isset($_POST["value"]) && !empty($_POST["value"])) {
        $username = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
        $field = filter_var($_POST["field"], FILTER_SANITIZE_STRING);
        $value = filter_var($_POST["value"], FILTER_SANITIZE_STRING);

        $result = updateCustomerDetails($username, $field, $value);

        if ($result) {
            $success_message = "Customer details updated successfully.";
            // Fetch the updated customer data
            $customer_data = getCustomerData($username);
        } else {
            $error_message = "Failed to update customer details. Please try again.";
        }
    } else {
        $error_message = "Error: Username, Field, or Value not provided.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Customer Details</title>
    <link rel="stylesheet" href="../webpage/styles.css">
    <?php @include '../Webpage/navbar.php' ?>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin-top: 150px;
            padding: 0;
            background-image: url('../Assets/bg-img.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            height: 100vh;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            max-width: 500px;
            margin: auto;
            background-color: rgba(255, 255, 255, 0.3);
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }

        form {
            width: 100%;
            margin-bottom: 20px;
        }


        h2 {
            text-align: center;
            margin-top: 0;
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        select {
            margin-bottom: 20px;
        }

        input[type="submit"] {
            background-color: #ffafbd;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #DC143C;
        }

        .message {
            margin-bottom: 20px;
            padding: 10px;
            border-radius: 5px;
        }

        .error {
            background-color: #ffcccc;
            color: #cc0000;
        }

        .success {
            background-color: #d4edda;
            color: #155724;
        }

        .profile {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .profile h3 {
            text-align: center;
        }

        .profile-details {
            margin-top: 20px;
        }

        .profile-details p {
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php if (!empty($error_message)): ?>
            <div class="message error">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>
        <?php if (!empty($success_message)): ?>
            <div class="message success">
                <?php echo $success_message; ?>
            </div>
        <?php endif; ?>

        <h2>Update Customer Details</h2>
        <form method="post" action="">
            <label for="username">Username:</label>
            <input type="text" name="username" required>
            <label for="field">Field to Update:</label>
            <select name="field" required>
                <option value="First_name">First Name</option>
                <option value="Last_name">Last Name</option>
                <option value="Email_address">Email</option>
                <option value="Username">Username</option>
                <option value="Password">Password</option>
            </select>
            <label for="value">New Value:</label>
            <input type="text" name="value" required>
            <input type="submit" value="Update Customer Details">
        </form>
    </div>

    <?php if (!empty($customer_data)): ?>
        <div class="profile container">
            <h3>Updated Profile</h3>
            <div class="profile-details">
                <p><strong>Username:</strong>
                    <?php echo $customer_data['Username']; ?>
                </p>
                <p><strong>First Name:</strong>
                    <?php echo $customer_data['First_name']; ?>
                </p>
                <p><strong>Last Name:</strong>
                    <?php echo $customer_data['Last_name']; ?>
                </p>
                <p><strong>Email:</strong>
                    <?php echo $customer_data['Email_address']; ?>
                </p>
            </div>
        </div>
    <?php endif; ?>
</body>


</html>
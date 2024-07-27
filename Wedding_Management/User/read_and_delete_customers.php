<?php
@include 'db_connection.php';

function getAllUsers()
{
    global $conn;
    $query = "SELECT * FROM users";
    $result = mysqli_query($conn, $query);
    $users = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $users[] = $row;
    }
    return $users;
}

function deleteUser($id)
{
    global $conn;
    $id = mysqli_real_escape_string($conn, $id);

    $query_delete_payments = "DELETE FROM payment WHERE Booking_ID IN (SELECT bookingID FROM booking WHERE Users_Id = '$id')";
    mysqli_query($conn, $query_delete_payments);

    $query_delete_services = "DELETE FROM service WHERE Booking_ID IN (SELECT bookingID FROM booking WHERE Users_Id = '$id')";
    mysqli_query($conn, $query_delete_services);

    $query_delete_decorations = "DELETE FROM decoration WHERE Booking_ID IN (SELECT bookingID FROM booking WHERE Users_Id = '$id')";
    mysqli_query($conn, $query_delete_decorations);

    $query_delete_bookings = "DELETE FROM booking WHERE Users_Id = '$id'";
    mysqli_query($conn, $query_delete_bookings);

    $query = "DELETE FROM users WHERE UsersID = '$id'";
    return mysqli_query($conn, $query);
}

if (isset ($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    if (deleteUser($delete_id)) {
        header("Location: read_and_delete_customers.php");
        exit();
    } else {
        $error_message = "Error deleting user.";
    }
}

$users = getAllUsers();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Read and Update Users</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel=stylesheet href="../webpage/styles.css">
    <?php @include '../Admin/admin_nav.php' ?>
    <style>
        body {
            background-image: url('../Assets/bg-img.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            color: white;
        }

        .container {
            padding: 20px;
        }

        .content {
            background-color: rgba(0, 0, 0, 0.5);
            padding: 20px;
            border-radius: 10px;
        }

        .table th,
        .table td {
            color: white;
            vertical-align: middle;
            border: 2px solid white;
        }

        .table th {
            background-color: #343a40;
            border-color: #454d55;
        }

        .table td {
            background-color: #495057;
            border-color: #454d55;
        }

        .btn {
            color: white;
            background-color: #ffafbd;
            border-color: #ffafbd;
        }

        .btn:hover {
            background-color: #DC143C;
            border-color: #DC143C;
        }

        .alert-danger {
            color: white;
            background-color: rgba(255, 0, 0, 0.7);
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="content">
            <h2>Customers Details</h2>
            <?php if (isset ($error_message)): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $error_message; ?>
                </div>
            <?php endif; ?>
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>User Type</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td>
                                <?php echo $user['UsersID']; ?>
                            </td>
                            <td>
                                <?php echo $user['First_name']; ?>
                            </td>
                            <td>
                                <?php echo $user['Last_name']; ?>
                            </td>
                            <td>
                                <?php echo $user['Username']; ?>
                            </td>
                            <td>
                                <?php echo $user['Email_address']; ?>
                            </td>
                            <td>
                                <?php echo $user['User_type']; ?>
                            </td>
                            <td>
                                <form action="" method="GET">
                                    <input type="hidden" name="delete_id" value="<?php echo $user['UsersID']; ?>">
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
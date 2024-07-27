<?php
include ("../User/db_connection.php");
include ("./common/crud_service.php");

$error_message = "";
$success_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset ($_POST["service_id"]) && !empty ($_POST["service_id"])) {

        $delete_service = filter_var($_POST["service_id"], FILTER_SANITIZE_NUMBER_INT);

        $result = deleteService($delete_service);

        if ($result === true) {
            $success_message = "Service deleted successfully.";
            header("Location: read_service.php");
        } else {
            $error_message = $result;
        }
    } else {
        $error_message = "Error: Service ID not provided.";
    }
}

$services = getServices();

closeConnection();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Service</title>
    <link rel="stylesheet" href="../webpage/styles.css">
    <?php @include '../Admin/admin_nav.php' ?>
    <style>
        body {
            background-image: url('../Assets/servicebg.jpeg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            font-family: 'Poppins', sans-serif;
            color: black;
            padding: 20px;
            margin-top: 30px;
            min-height: 92vh;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: black;
        }

        form {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            margin-right: 10px;
        }

        input[type="number"],
        input[type="submit"] {
            padding: 10px;
            margin: 5px;
            border-radius: 5px;
            border: none;
            background-color: #ffafbd;
            color: black;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #DC143C;
        }

        .styled-table {
            width: 75%;
            max-width: 100%;
            border-collapse: collapse;
            font-size: 0.9em;
            font-family: sans-serif;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            background-color: rgba(245, 245, 220, 0.5);
            color: black;
            border-radius: 10px;
            margin: auto;
        }

        .styled-table th,
        .styled-table td {
            padding: 12px 15px;
            border: 2px solid white;
            text-align: center;
            vertical-align: middle;
        }

        .styled-table thead {
            background-color: rgba(245, 245, 220, 0.5);
        }

        .styled-table tbody tr:nth-child(even) {
            background-color: #e6e6e6;
        }

        .styled-table tbody tr:hover {
            background-color: #cccccc;
        }

        .styled-table tbody tr:last-child {
            border-bottom: 2px solid #009879;
        }
    </style>
</head>

<body>

    <?php if (!empty ($error_message)): ?>
        <p style="color: red;">
            <?php echo $error_message; ?>
        </p>
    <?php endif; ?>
    <?php if (!empty ($success_message)): ?>
        <p style="color: green;">
            <?php echo $success_message; ?>
        </p>
    <?php endif; ?>

    <h2>Delete Service</h2>
    <form method="post" action="">
        <label for="service_id">Service ID:</label>
        <input type="number" name="service_id" required>
        <input type="submit" value="Delete Service">
    </form>
    <h2>Services List</h2>

    <?php if (empty ($services)): ?>
        <p>No services available.</p>
    <?php else: ?>
        <table class="styled-table">
            <thead>
                <tr>
                    <th>Service ID</th>
                    <th>Booking ID</th>
                    <th>Description</th>
                    <th>Service Type</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($services as $service): ?>
                    <tr>
                        <td>
                            <?php echo $service["ServiceID"]; ?>
                        </td>
                        <td>
                            <?php echo $service["Booking_ID"]; ?>
                        </td>
                        <td>
                            <?php echo $service["Description"]; ?>
                        </td>
                        <td>
                            <?php echo $service["service_type"]; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <!-- Include your JavaScript file here if needed -->

</body>

</html>
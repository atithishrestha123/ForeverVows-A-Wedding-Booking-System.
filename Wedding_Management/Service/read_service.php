<?php
include ("../user/db_connection.php");
include ("./common/crud_service.php");

$error_message = "";
$success_message = "";

$services = getServices();

closeConnection();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Read Services</title>
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
            margin: 50px;
            padding: 20px;
            justify-content: center;
            align-items: center;
            min-height: 86vh;
        }

        .form-container {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 20px;
            border-radius: 10px;
            width: 80%;
            max-width: 600px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.7);
            margin-bottom: 20px;
        }

        h1 {
            text-align: center;
            margin-top: 0;
            color: black;
        }

        table {
            width: 75%;
            max-width: 100%;
            border-collapse: collapse;
            font-size: 0.9em;
            font-family: sans-serif;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            color: black;
            background-color: rgba(245, 245, 220, 0.5);
            border-radius: 10px;
            margin: auto;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: rgba(245, 245, 220, 0.5);
        }
    </style>
</head>

<body>

    <?php if (!empty ($error_message)): ?>
        <p style="color: red;">
            <?php echo $error_message; ?>
        </p>
    <?php endif; ?>
    <?php if (empty ($services)): ?>
        <p>No services available.</p>
    <?php else: ?>
        <h1>Read Services</h1>
        <table class="read-table">
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
                            <?php echo isset ($service["service_type"]) ? $service["service_type"] : ""; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

</body>

</html>
<?php
include ("../user/db_connection.php");
include ("./common/crud_booking.php");

$error_message = "";
$success_message = "";

$bookings = getBookings();

closeConnection();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Bookings CRUD</title>
    <link rel="stylesheet" href="../webpage/styles.css">
    <?php @include '../Admin/admin_nav.php' ?>
    <style>
        body {
            background-image: url('../Assets/booking_bg.jpeg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            font-family: Poppins, sans-serif;
            color: white;
            padding: 20px;
            margin: 50px;
            justify-content: center;
            align-items: center;
            min-height: 86vh;
        }

        .content {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 20px;
            border-radius: 10px;
            width: 80%;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.7);
            overflow-x: auto;
        }

        h1 {
            text-align: center;
            margin-top: 0;
            color: white;
        }

        .read-table {
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

        .read-table thead tr {
            background-color: #343a40;
            color: black;
        }

        .read-table th,
        .read-table td {
            padding: 12px 15px;
            border: 2px solid white;
            vertical-align: middle;
        }

        .read-table th {
            background-color: rgba(245, 245, 220, 0.5);
        }

        .read-table tbody tr {
            border-bottom: 1px solid #dddddd;
        }

        .read-table tbody tr:nth-of-type(even) {
            background-color: #495057;
        }

        .read-table tbody tr:last-of-type {
            border-bottom: 2px solid #009879;
        }

        .read-table tbody tr.active-row {
            font-weight: bold;
            color: #009879;
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

        @media screen and (max-width: 768px) {

            body {
                margin-top: 70px;
            }

            /* Adjust table font size and padding for smaller screens */
            .read-table {
                font-size: 0.8em;
            }

            .read-table th,
            .read-table td {
                padding: 8px 10px;
            }
        }
    </style>
</head>

<body>

    <?php if (!empty ($error_message)): ?>
        <p style="color: red;">
            <?php echo $error_message; ?>
        </p>
    <?php endif; ?>

    <?php if (empty ($bookings)): ?>
        <p>No bookings available.</p>
    <?php else: ?>
        <h1>Read Booking</h1>
        <table class="read-table">
            <thead>
                <tr>
                    <th>Booking ID</th>
                    <th>User ID</th>
                    <th>Bride Name</th>
                    <th>Groom Name</th>
                    <th>Description</th>
                    <th>Wedding Date</th>
                    <th>Wedding Type</th>
                    <th>Booking Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bookings as $booking): ?>
                    <tr>
                        <td>
                            <?php echo $booking["bookingID"]; ?>
                        </td>
                        <td>
                            <?php echo $booking["Users_Id"]; ?>
                        </td>
                        <td>
                            <?php echo $booking["Bride_name"]; ?>
                        </td>
                        <td>
                            <?php echo $booking["Groom_name"]; ?>
                        </td>
                        <td>
                            <?php echo $booking["Description"]; ?>
                        </td>
                        <td>
                            <?php echo $booking["Wedding_date"]; ?>
                        </td>
                        <td>
                            <?php echo $booking["Wedding_type"]; ?>
                        </td>
                        <td>
                            <?php echo $booking["Booking_status"]; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

</body>

</html>
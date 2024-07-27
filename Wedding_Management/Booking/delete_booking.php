<?php
include ("../User/db_connection.php");
include ("./common/crud_booking.php");

$error_message = "";
$success_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset ($_POST["booking_id"]) && !empty ($_POST["booking_id"])) {

        $delete_booking = filter_var($_POST["booking_id"], FILTER_SANITIZE_NUMBER_INT);

        $result = deleteAssociatedRows($delete_booking);
        if ($result !== true) {
            $error_message = $result;
        } else {
            $result = deleteBooking($delete_booking);

            if ($result === true) {
                $success_message = "Booking deleted successfully.";
            } else {
                $error_message = $result;
            }
        }
    } else {
        $error_message = "Error: Booking ID not provided.";
    }
}

$bookings = getBookings();

closeConnection();

function deleteAssociatedRows($booking_id)
{
    $result1 = deleteDecorations($booking_id);
    $result2 = deleteServices($booking_id);
    $result3 = deletePayments($booking_id);

    if ($result1 !== true) {
        return $result1;
    } elseif ($result2 !== true) {
        return $result2;
    } elseif ($result3 !== true) {
        return $result3;
    }

    return true;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Booking</title>
    <link rel="stylesheet" href="../webpage/styles.css">
    <?php @include '../Admin/admin_nav.php' ?>
    <style>
        body {
            background-image: url('../Assets/booking_bg.jpeg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            font-family: 'Poppins', sans-serif;
            color: white;
            padding: 20px;
            margin: 30;
            min-height: 86vh;
        }

        .container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
        }

        h2 {
            text-align: center;
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
            color: white;
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
            color: white;
            background-color: rgba(0, 0, 0, 0.5);
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
            background-color: #343a40;
            color: white;
        }

        .styled-table tbody tr:nth-child(even) {
            background-color: #495057;
        }

        .styled-table tbody tr:hover {
            background-color: #6c757d;
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

    <!-- Delete Booking Form -->
    <h2>Delete Booking</h2>
    <form method="post" action="">
        <label for="booking_id">Booking ID:</label>
        <input type="number" name="booking_id" required>
        <input type="submit" value="Delete Booking">
    </form>

    <!-- Read Operation -->
    <h2>Bookings List</h2>

    <?php if (empty ($bookings)): ?>
        <p>No bookings available.</p>
    <?php else: ?>
        <table class="styled-table">
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

    <!-- Include your JavaScript file here if needed -->

</body>

</html>
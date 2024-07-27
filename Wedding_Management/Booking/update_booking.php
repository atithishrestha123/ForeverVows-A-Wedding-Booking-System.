<?php
@include '../User/db_connection.php';

function updateBookingStatus($booking_id, $booking_status)
{
    global $conn;

    $stmt = $conn->prepare("UPDATE booking SET Booking_status=? WHERE bookingID=?");

    $stmt->bind_param("si", $booking_status, $booking_id);

    if ($stmt->execute()) {
        $stmt->close();
        return true;
    } else {
        $error_message = "Error updating booking status: " . $stmt->error;
        $stmt->close();
        return $error_message;
    }
}

$error_message = "";
$success_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["booking_id"]) && !empty($_POST["booking_id"]) && isset($_POST["booking_status"]) && !empty($_POST["booking_status"])) {

        $booking_id = filter_var($_POST["booking_id"], FILTER_SANITIZE_NUMBER_INT);
        $booking_status = filter_var($_POST["booking_status"], FILTER_SANITIZE_STRING);

        $result = updateBookingStatus($booking_id, $booking_status);

        if ($result === true) {
            $success_message = "Booking status updated successfully.";
        } else {
            $error_message = $result;
        }
    } else {
        $error_message = "Error: One or more fields are missing.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Booking Status</title>
    <link rel="stylesheet" href="../webpage/styles.css">
    <?php @include '../Admin/admin_nav.php' ?>
    <style>
        body {
            background-image: url('../Assets/booking_bg.jpeg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            font-family: Arial, sans-serif;
            color: white;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        h2 {
            margin-bottom: 20px;
            text-align: center;
        }

        form {
            background-color: rgba(0, 0, 0, 0.5);
            padding: 20px;
            border-radius: 10px;
            max-width: 400px;
            width: 100%;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: none;
        }

        input[type="submit"] {
            background-color: #ffafbd;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #DC143C;
        }

        p.error-message {
            color: red;
            text-align: center;
        }

        p.success-message {
            color: green;
            text-align: center;
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }
    </style>
</head>

<body>

    <?php if (!empty($error_message)): ?>
        <p class="error-message">
            <?php echo $error_message; ?>
        </p>
    <?php endif; ?>

    <!-- Success message popup -->
    <?php if (!empty($success_message)): ?>
        <p class="success-message" id="successMessage">
            <?php echo $success_message; ?>
        </p>
    <?php endif; ?>

    <!-- Update Booking Status Form -->
    <div>
        <h2>Update Booking Status</h2>
        <form id="updateForm" method="post" action="">
            <label for="booking_id">Booking ID:</label>
            <input type="text" name="booking_id" required><br>
            <label for="booking_status">Booking Status:</label>
            <select name="booking_status" required>
                <option value="Pending">Pending</option>
                <option value="Confirmed">Confirmed</option>
                <option value="Cancelled">Cancelled</option>
            </select><br>
            <input type="submit" value="Update Booking Status">
        </form>
    </div>

    <script>
        window.onload = function () {
            var successMessage = document.getElementById("successMessage");
            if (successMessage) {

                successMessage.style.display = "block";
                setTimeout(function () {
                    window.location.href = "read_booking.php";
                }, 3000);
            }
        };
    </script>

</body>

</html>
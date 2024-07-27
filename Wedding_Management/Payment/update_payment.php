<?php
@include '../User/db_connection.php';

function updatePaymentStatus($booking_id, $payment_status)
{
    global $conn;

    $query = "UPDATE payment SET Payment_status=? WHERE Booking_ID=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $payment_status, $booking_id);

    if ($stmt->execute()) {
        $stmt->close();
        return true;
    } else {
        $error_message = "Error updating payment status: " . $stmt->error;
        error_log($error_message);
        $stmt->close();
        return $error_message;
    }
}

$error_message = "";
$success_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["booking_id"]) && !empty($_POST["booking_id"]) && isset($_POST["payment_status"]) && !empty($_POST["payment_status"])) {
        $booking_id = filter_var($_POST["booking_id"], FILTER_SANITIZE_NUMBER_INT);
        $payment_status = filter_var($_POST["payment_status"], FILTER_SANITIZE_STRING);

        $result = updatePaymentStatus($booking_id, $payment_status);

        if ($result === true) {
            $success_message = "Payment status updated successfully.";
            header("Location: read_payment.php");
        } else {
            $error_message = $result;
        }
    } else {
        $error_message = "Error: Booking ID or New Payment Status not provided.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Payment Status</title>
    <link rel="stylesheet" href="../webpage/styles.css">
    <?php @include '../Admin/admin_nav.php' ?>
    <style>
        body {
            background-image: url('../Assets/paymentbg.jpeg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            font-family: 'Poppins', sans-serif;
            color: black;
            margin: 50px;
            padding: 20px;
            justify-content: center;
            align-items: center;
            max-height: 100vh;
        }

        .container {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 20px;
            border-radius: 10px;
            width: 80%;
            max-width: 600px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.7);
            margin-bottom: 20px;
        }

        h2 {
            text-align: center;
            margin-top: 0;
            color: black;
        }

        form {
            width: 50%;
            border-collapse: collapse;
            font-size: 0.9em;
            font-family: sans-serif;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            color: black;
            background-color: rgba(245, 245, 220, 0.5);
            border-radius: 10px;
            margin: auto;
        }

        label {
            margin-bottom: 5px;
            font-weight: bold;
            display: inline-block;
            width: 45%;
            text-align: right;
            padding-right: 5px;
        }

        input[type="text"],
        select {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #ccc;
            width: 50%;
            box-sizing: border-box;
        }

        select {
            width: calc(50% + 2px);
        }

        input[type="submit"] {
            background-color: #ffafbd;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-left: 50%;
            transform: translateX(-50%);
        }

        input[type="submit"]:hover {
            background-color: #DC143C;
        }

        p {
            text-align: center;
            margin-top: 20px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <?php if (!empty($error_message)): ?>
        <p style="color: red;">
            <?php echo $error_message; ?>
        </p>
    <?php endif; ?>
    <?php if (!empty($success_message)): ?>
        <p style="color: green;">
            <?php echo $success_message; ?>
        </p>
    <?php endif; ?>

    <h2>Update Payment Status</h2>
    <form method="post" action=""><label for="booking_id">Booking ID:</label><input type="text" name="booking_id"
            required><br><label for="payment_status">New Payment Status:</label><select name="payment_status" required>
            <option value="Pending">Pending</option>
            <option value="Confirmed">Confirmed</option>
            <option value="Cancelled">Cancelled</option>
        </select><br><input type="submit" value="Update Payment Status"></form>
</body>

</html>
<?php
include '../User/db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $booking_id = $_POST['booking_id'];
    $amount = $_POST['amount'];
    $payment_type = $_POST['payment_type'];
    $description = $_POST['description'];
    $advance_payment = isset ($_POST['advance_payment']) ? 1 : 0;
    $payment_status = 'Pending';
    $date_issued = date('Y-m-d');

    // Format amount to dollars with 2 decimal points
    $amount = number_format((float) $amount, 2, '.', '');

    $sql = "INSERT INTO payment (Booking_ID, Amount, Payment_type, Date_issued, Payment_status, Description, Advance_payment)
                VALUES ('$booking_id', '$amount', '$payment_type', '$date_issued', '$payment_status', '$description', '$advance_payment')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Payment record inserted successfully.');
        window.location.replace('../webpage/dashboard.php');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Form</title>
    <link rel=stylesheet href="../Webpage/styles.css">
    <?php @include '../Webpage/navbar.php'; ?>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('../Assets/paymentbg.jpeg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 30px;
            padding: 0;
        }

        form {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        select,
        textarea {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="checkbox"] {
            margin-right: 5px;
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        /* Responsive adjustments */
        @media only screen and (max-width: 600px) {
            body {
                margin-top: 70px;
            }

            form {
                max-width: 90%;
            }
        }
    </style>
</head>

<body>
    <div>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="booking_id">Booking ID:</label>
            <input type="text" id="booking_id" name="booking_id" required><br><br>
            <label for="amount">Amount:</label>
            <input type="text" id="amount" name="amount" required><br><br>
            <label for="payment_type">Payment Type:</label>
            <select id="payment_type" name="payment_type" required>
                <option value="Credit Card">Credit Card</option>
                <option value="Debit Card">Debit Card</option>
                <option value="Cash">Cash</option>
                <option value="Bank Transfer">Bank Transfer</option>
            </select><br><br>
            <label for="description">Description:</label><br>
            <textarea id="description" name="description"></textarea><br><br>
            <label for="advance_payment">Advance Payment:</label>
            <input type="checkbox" id="advance_payment" name="advance_payment"><br><br>
            <input type="submit" value="Submit">
        </form>
    </div>
</body>

</html>
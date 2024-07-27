<?php
include ("../User/db_connection.php");
include ("./common/crud_payment.php");

$error_message = "";
$success_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset ($_POST["payment_id"]) && !empty ($_POST["payment_id"])) {

        $delete_payment = filter_var($_POST["payment_id"], FILTER_SANITIZE_NUMBER_INT);


        $result = deletePayment($delete_payment);


        if ($result === true) {
            $success_message = "Payment deleted successfully.";
            header("Location: read_payment.php");
        } else {
            $error_message = $result;
        }
    } else {
        $error_message = "Error: Payment ID not provided.";
    }
}

$payments = readPayment();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Payment</title>
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

    <!-- Delete Payment Form -->
    <h2>Delete Payment</h2>
    <form method="post" action="delete_payment.php">
        <label for="payment_id">Payment ID:</label>
        <input type="number" name="payment_id" required>
        <input type="submit" value="Delete Payment">
    </form>

    <!-- Read Operation -->
    <h2>Payments List</h2>

    <?php if ($payments === false): ?>
        <p>No payments available.</p>
    <?php else: ?>
        <table class="styled-table">
            <thead>
                <tr>
                    <th>Payment ID</th>
                    <th>Booking ID</th>
                    <th>Amount</th>
                    <th>Payment Type</th>
                    <th>Date Issued</th>
                    <th>Payment Status</th>
                    <th>Description</th>
                    <th>Advance Payment</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $payments->fetch_assoc()): ?>
                    <tr>
                        <td>
                            <?php echo $row['PaymentID']; ?>
                        </td>
                        <td>
                            <?php echo $row['Booking_ID']; ?>
                        </td>
                        <td>
                            <?php echo $row['Amount']; ?>
                        </td>
                        <td>
                            <?php echo $row['Payment_type']; ?>
                        </td>
                        <td>
                            <?php echo $row['Date_issued']; ?>
                        </td>
                        <td>
                            <?php echo $row['Payment_status']; ?>
                        </td>
                        <td>
                            <?php echo $row['Description']; ?>
                        </td>
                        <td>
                            <?php echo $row['Advance_payment']; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <!-- Include your JavaScript file here if needed -->

</body>

</html>
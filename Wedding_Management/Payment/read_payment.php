<?php
@include './common/crud_payment.php';
@include '../User/db_connection.php';

$result = readPayment();

if ($result !== false) {
    echo "<h2>Payments</h2>";
    echo "<table border='1'>
    <tr>
    <th>Payment ID</th>
    <th>Booking ID</th>
    <th>Amount</th>
    <th>Payment Type</th>
    <th>Date Issued</th>
    <th>Payment Status</th>
    <th>Description</th>
    <th>Advance Payment</th>
    </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['PaymentID'] . "</td>";
        echo "<td>" . $row['Booking_ID'] . "</td>";
        echo "<td>" . $row['Amount'] . "</td>";
        echo "<td>" . $row['Payment_type'] . "</td>";
        echo "<td>" . $row['Date_issued'] . "</td>";
        echo "<td>" . $row['Payment_status'] . "</td>";
        echo "<td>" . $row['Description'] . "</td>";
        echo "<td>" . $row['Advance_payment'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No payments found.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Read Payments</title>
    <link rel="stylesheet" href="../webpage/styles.css">
    <?php @include '../Admin/admin_nav.php' ?>
</head>

<body>
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

        .table-container {
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

        @media screen and (max-width: 600px) {
            .table-container {
                width: 75%;
            }
        }
    </style>
</body>

</html>
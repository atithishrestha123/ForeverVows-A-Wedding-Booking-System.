<?php
include '../User/db_connection.php';

function createPayment($booking_id, $amount, $payment_type, $description, $advance_payment)
{
    global $conn;

    $date_issued = date('Y-m-d'); // Get current date
    $payment_status = 'Pending';

    // Format amount to dollars with 2 decimal points
    $amount = number_format((float) $amount, 2, '.', '');

    $sql = "INSERT INTO payment (Booking_ID, Amount, Payment_type, Date_issued, Payment_status, Description, Advance_payment)
            VALUES ('$booking_id', '$amount', '$payment_type', '$date_issued', '$payment_status', '$description', '$advance_payment')";

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}

function readPayment()
{
    global $conn;

    $sql = "SELECT * FROM payment";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return $result;
    } else {
        return false;
    }
}


function updatePaymentStatus($payment_id, $payment_status)
{
    global $conn;

    // Check if the payment with the specified payment_id exists
    $checkPaymentQuery = $conn->prepare("SELECT COUNT(*) FROM payment WHERE PaymentID = ?");
    $checkPaymentQuery->bind_param("i", $payment_id);
    $checkPaymentQuery->execute();
    $checkPaymentQuery->bind_result($paymentCount);
    $checkPaymentQuery->fetch();
    $checkPaymentQuery->close();

    if ($paymentCount == 0) {
        return "Error: Payment with ID $payment_id does not exist.";
    }

    // Proceed with updating the payment status
    $stmt = $conn->prepare("UPDATE payment SET Payment_status=? WHERE PaymentID=?");
    $stmt->bind_param("si", $payment_status, $payment_id);

    if ($stmt->execute()) {
        $stmt->close();
        return true;
    } else {
        $error_message = "Error updating payment status: " . $stmt->error;
        $stmt->close();
        return $error_message;
    }
}


function deletePayment($payment_id)
{
    global $conn;

    // Check if the payment with the specified payment_id exists
    $checkPaymentQuery = $conn->prepare("SELECT COUNT(*) FROM payment WHERE PaymentID = ?");
    $checkPaymentQuery->bind_param("i", $payment_id);
    $checkPaymentQuery->execute();
    $checkPaymentQuery->bind_result($paymentCount);
    $checkPaymentQuery->fetch();
    $checkPaymentQuery->close();

    if ($paymentCount == 0) {
        return "Error: Payment with ID $payment_id does not exist.";
    }

    // Proceed with deleting the payment
    $stmt = $conn->prepare("DELETE FROM payment WHERE PaymentID = ?");
    $stmt->bind_param("i", $payment_id);

    if ($stmt->execute()) {
        $stmt->close();
        return true;
    } else {
        $error_message = "Error deleting payment: " . $stmt->error;
        $stmt->close();
        return $error_message;
    }
}
?>
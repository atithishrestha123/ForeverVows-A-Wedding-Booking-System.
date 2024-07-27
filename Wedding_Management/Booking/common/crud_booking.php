<?php
include("../User/db_connection.php");

function getBookings()
{
    global $conn;
    $bookings = [];
    $sql = "SELECT * FROM booking";
    $result = $conn->query($sql);
    if (!$result) {
        return false;
    }

    while ($row = $result->fetch_assoc()) {
        $bookings[] = $row;
    }

    return $bookings;
}

function createBooking($user_id, $bride_name, $groom_name, $description, $wedding_date, $wedding_type)
{
    global $conn;

    $stmt = $conn->prepare("INSERT INTO booking (Users_Id, Bride_name, Groom_name, Description, Wedding_date, Wedding_type, Booking_status) VALUES (?, ?, ?, ?, ?, ?, 'Pending')");
    $stmt->bind_param("isssss", $user_id, $bride_name, $groom_name, $description, $wedding_date, $wedding_type);

    if ($stmt->execute()) {
        $stmt->close();
        return true;
    } else {
        $error_message = "Error adding booking: " . $stmt->error;
        $stmt->close();
        return $error_message;
    }
}

function updateBooking($booking_id, $user_id, $bride_name, $groom_name, $description, $wedding_date, $wedding_type, $booking_status)
{
    global $conn;

    $stmt = $conn->prepare("UPDATE booking SET Users_Id=?, Bride_name=?, Groom_name=?, Description=?, Wedding_date=?, Wedding_type=?, Booking_status=? WHERE bookingID=?");
    $stmt->bind_param("issssssi", $user_id, $bride_name, $groom_name, $description, $wedding_date, $wedding_type, $booking_status, $booking_id);

    if ($stmt->execute()) {
        $stmt->close();
        return true;
    } else {
        $error_message = "Error updating booking: " . $stmt->error;
        $stmt->close();
        return $error_message;
    }
}

function deleteBooking($booking_id)
{
    global $conn;

    // Check if the booking with the specified booking_id exists
    $checkBookingQuery = $conn->prepare("SELECT COUNT(*) FROM booking WHERE bookingID = ?");
    $checkBookingQuery->bind_param("i", $booking_id);
    $checkBookingQuery->execute();
    $checkBookingQuery->bind_result($bookingCount);
    $checkBookingQuery->fetch();
    $checkBookingQuery->close();

    if ($bookingCount == 0) {
        return "Error: Booking with ID $booking_id does not exist.";
    }

    // Proceed with deleting the booking
    $stmt = $conn->prepare("DELETE FROM booking WHERE bookingID = ?");
    $stmt->bind_param("i", $booking_id);

    if ($stmt->execute()) {
        $stmt->close();
        return true;
    } else {
        $error_message = "Error deleting booking: " . $stmt->error;
        $stmt->close();
        return $error_message;
    }
}

// Function to delete associated decorations
function deleteDecorations($booking_id)
{
    global $conn;

    $sql = "DELETE FROM decoration WHERE Booking_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $booking_id);
    if ($stmt->execute()) {
        return true;
    } else {
        return "Error deleting decorations: " . $stmt->error;
    }
}

// Function to delete associated services
function deleteServices($booking_id)
{
    global $conn;

    $sql = "DELETE FROM service WHERE Booking_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $booking_id);
    if ($stmt->execute()) {
        return true;
    } else {
        return "Error deleting services: " . $stmt->error;
    }
}

// Function to delete associated payments
function deletePayments($booking_id)
{
    global $conn;

    $sql = "DELETE FROM payment WHERE Booking_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $booking_id);
    if ($stmt->execute()) {
        return true;
    } else {
        return "Error deleting payments: " . $stmt->error;
    }
}


function closeConnection()
{
    global $conn;
    $conn->close();
}
?>
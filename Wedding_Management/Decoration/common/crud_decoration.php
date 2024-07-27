<?php
include("../User/db_connection.php");

function getDecorations()
{
    global $conn;
    $decorations = [];
    $sql = "SELECT * FROM decoration";
    $result = $conn->query($sql);
    if (!$result) {
        return false;
    }

    while ($row = $result->fetch_assoc()) {
        $decorations[] = $row;
    }

    return $decorations;
}

function createDecoration($booking_id, $description, $decoration_type)
{
    global $conn;

    $stmt = $conn->prepare("INSERT INTO decoration (Booking_ID, Description, Decoration_type) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $booking_id, $description, $decoration_type);

    if ($stmt->execute()) {
        $stmt->close();
        return true;
    } else {
        $error_message = "Error adding decoration: " . $stmt->error;
        $stmt->close();
        return $error_message;
    }
}

function updateDecoration($decoration_id, $booking_id, $description, $decoration_type)
{
    global $conn;

    $stmt = $conn->prepare("UPDATE decoration SET Booking_ID=?, Description=?, Decoration_type=? WHERE DecorationID=?");
    $stmt->bind_param("issi", $booking_id, $description, $decoration_type, $decoration_id);

    if ($stmt->execute()) {
        $stmt->close();
        return true;
    } else {
        $error_message = "Error updating decoration: " . $stmt->error;
        $stmt->close();
        return $error_message;
    }
}

function deleteDecoration($decoration_id)
{
    global $conn;

    // Check if the decoration with the specified decoration_id exists
    $checkDecorationQuery = $conn->prepare("SELECT COUNT(*) FROM decoration WHERE DecorationID = ?");
    $checkDecorationQuery->bind_param("i", $decoration_id);
    $checkDecorationQuery->execute();
    $checkDecorationQuery->bind_result($decorationCount);
    $checkDecorationQuery->fetch();
    $checkDecorationQuery->close();

    if ($decorationCount == 0) {
        return "Error: Decoration with ID $decoration_id does not exist.";
    }

    // Proceed with deleting the decoration
    $stmt = $conn->prepare("DELETE FROM decoration WHERE DecorationID = ?");
    $stmt->bind_param("i", $decoration_id);

    if ($stmt->execute()) {
        $stmt->close();
        return true;
    } else {
        $error_message = "Error deleting decoration: " . $stmt->error;
        $stmt->close();
        return $error_message;
    }
}

function closeConnection()
{
    global $conn;
    $conn->close();
}
?>
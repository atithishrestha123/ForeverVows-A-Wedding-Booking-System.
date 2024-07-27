<?php
include("../User/db_connection.php");

function getServices()
{
    global $conn;
    $services = [];
    $sql = "SELECT * FROM service";
    $result = $conn->query($sql);
    if (!$result) {
        return false;
    }

    while ($row = $result->fetch_assoc()) {
        $services[] = $row;
    }

    return $services;
}

function createService($booking_id, $description, $service_type)
{
    global $conn;

    $stmt = $conn->prepare("INSERT INTO service (Booking_ID, Description, Service_type) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $booking_id, $description, $service_type);

    if ($stmt->execute()) {
        $stmt->close();
        return true;
    } else {
        $error_message = "Error adding service: " . $stmt->error;
        $stmt->close();
        return $error_message;
    }
}

function updateService($service_id, $booking_id, $description, $service_type)
{
    global $conn;

    $stmt = $conn->prepare("UPDATE service SET Booking_ID=?, Description=?, Service_type=? WHERE ServiceID=?");
    $stmt->bind_param("issi", $booking_id, $description, $service_type, $service_id);

    if ($stmt->execute()) {
        $stmt->close();
        return true;
    } else {
        $error_message = "Error updating service: " . $stmt->error;
        $stmt->close();
        return $error_message;
    }
}

function deleteService($service_id)
{
    global $conn;

    // Check if the service with the specified service_id exists
    $checkServiceQuery = $conn->prepare("SELECT COUNT(*) FROM service WHERE ServiceID = ?");
    $checkServiceQuery->bind_param("i", $service_id);
    $checkServiceQuery->execute();
    $checkServiceQuery->bind_result($serviceCount);
    $checkServiceQuery->fetch();
    $checkServiceQuery->close();

    if ($serviceCount == 0) {
        return "Error: Service with ID $service_id does not exist.";
    }

    // Proceed with deleting the service
    $stmt = $conn->prepare("DELETE FROM service WHERE ServiceID = ?");
    $stmt->bind_param("i", $service_id);

    if ($stmt->execute()) {
        $stmt->close();
        return true;
    } else {
        $error_message = "Error deleting service: " . $stmt->error;
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
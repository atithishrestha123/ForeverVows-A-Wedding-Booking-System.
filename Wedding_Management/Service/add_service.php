<?php
@include '../User/db_connection.php';

function serviceExists($booking_id)
{
    global $conn;

    $check_service_sql = "SELECT COUNT(*) AS count FROM service WHERE Booking_ID = ?";
    $check_service_stmt = $conn->prepare($check_service_sql);
    $check_service_stmt->bind_param("i", $booking_id);
    $check_service_stmt->execute();
    $check_service_result = $check_service_stmt->get_result();
    $row = $check_service_result->fetch_assoc();
    $count = $row['count'];

    return $count > 0;
}

function addService($booking_id, $description, $service_type)
{
    global $conn;

    $check_booking_sql = "SELECT COUNT(*) AS count FROM booking WHERE bookingID = ?";
    $check_booking_stmt = $conn->prepare($check_booking_sql);
    $check_booking_stmt->bind_param("i", $booking_id);
    $check_booking_stmt->execute();
    $check_booking_result = $check_booking_stmt->get_result();
    $row = $check_booking_result->fetch_assoc();
    $count = $row['count'];

    if ($count == 0) {
        return "Error: The provided booking ID does not exist.";
    }

    $stmt = $conn->prepare("INSERT INTO service (Booking_ID, Description, Service_Type) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $booking_id, $description, $service_type);

    if ($stmt->execute() === TRUE) {
        $stmt->close();
        return true;
    } else {
        $stmt->close();
        return "Error: " . $stmt->error;
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $booking_id = $_POST['booking_id'];
    $description = $_POST['description'];
    $service_type = $_POST['service_type'];

    $result = addService($booking_id, $description, $service_type);

    if ($result === true) {
        header("Location: ../Decoration/ask_decoration.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services</title>
    <!-- Link Font Awesome CSS if not already linked -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel=stylesheet href="../Webpage/styles.css">
    <?php @include '../Webpage/navbar.php'; ?>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background-image: url('../Assets/servicebg.jpeg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .container {
            max-width: 1200px;
            margin: 70px auto 0;
            padding: 20px;
            display: flex;
            justify-content: space-between;
        }

        .services-container,
        .form-container {
            width: 45%;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 30px;
        }

        .services-container {
            margin-bottom: 20px;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .services-list {
            flex-grow: 1;
            overflow-y: auto;
            padding-right: 10px;
        }

        .services-list::-webkit-scrollbar {
            width: 8px;
        }

        .services-list::-webkit-scrollbar-thumb {
            background-color: #888;
            border-radius: 4px;
        }

        .more-services-button {
            background-color: #ffafbd;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 16px;
            margin-top: 10px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .more-services-button:hover {
            background-color: #DC143C;
        }

        .services-arrow {
            color: #ffafbd;
            font-size: 24px;
            cursor: pointer;
            margin-top: 10px;
        }

        .services-arrow:hover {
            color: #DC143C;
        }

        .services {
            list-style: none;
            padding: 0;
            margin: 0;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            grid-gap: 20px;
        }

        .service {
            border-radius: 5px;
            overflow: hidden;
        }

        .service img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
        }

        .service h3 {
            margin-top: 10px;
            padding: 10px;
            font-size: 18px;
            text-align: center;
        }

        .form-container h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-container label {
            display: block;
            margin-bottom: 10px;
            color: #333;
        }

        .form-container input[type="text"],
        .form-container input[type="submit"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        .form-button {
            background: #ffafbd;
            color: #fff;
            text-transform: capitalize;
            font-size: 20px;
            cursor: pointer;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background 0.3s, color 0.3s;
        }

        .form-button:hover {
            background: #DC143C;
            color: #fff;
        }

        @media screen and (max-width: 768px) {
            .container {
                flex-direction: column;
                align-items: center;
            }

            .services-container,
            .form-container {
                width: 100%;
                margin-bottom: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="services-container">
            <h1>List of Services</h1>
            <div class="services-list">
                <ul class="services">
                    <li class="service">
                        <img src="../Assets/service1.jpg" alt="Service 1">
                        <h3>Videography and Photography Service</h3>
                    </li>
                    <li class="service">
                        <img src="../Assets/service2.jpg" alt="Service 2">
                        <h3>MakeUp Service</h3>
                    </li>
                </ul>
            </div>
            <button class="more-services-button" onclick="location.href='service.php'"><i class="fas fa-arrow-left"></i>
                More Services </button>

        </div>
        <div class="form-container">
            <h1>Add New Service</h1>
            <form method="post" action="add_service.php">
                <div class="form-group">
                    <label for="booking_id"><i class="fas fa-id-badge"></i> Booking ID:</label>
                    <input type="text" id="booking_id" name="booking_id" placeholder="Enter your booking Id">
                </div>
                <div class="form-group">
                    <label for="description"><i class="fas fa-file-alt"></i> Description:</label>
                    <input type="text" id="description" name="description"
                        placeholder="Enter description for service you want">
                </div>
                <div class="form-group">
                    <label for="service_type"><i class="fas fa-tools"></i> Service Type:</label>
                    <input type="text" id="service_type" name="service_type" placeholder="Enter service type">
                </div>

                <input type="submit" name="submit" value="Add Service" class="form-button">
            </form>
        </div>
    </div>
</body>

</html>
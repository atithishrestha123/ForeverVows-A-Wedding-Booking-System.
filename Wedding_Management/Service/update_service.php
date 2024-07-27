<?php
@include '../User/db_connection.php';

function updateService($booking_id, $description, $service_type)
{
    global $conn;

    $stmt = $conn->prepare("UPDATE service SET Description=?, Service_type=? WHERE Booking_ID=?");

    $stmt->bind_param("ssi", $description, $service_type, $booking_id);

    if ($stmt->execute()) {
        $stmt->close();
        return true;
    } else {
        $error_message = "Error updating service: " . $stmt->error;
        $stmt->close();
        return $error_message;
    }
}

$error_message = "";
$success_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["booking_id"]) && !empty($_POST["booking_id"]) && isset($_POST["description"]) && !empty($_POST["description"]) && isset($_POST["service_type"]) && !empty($_POST["service_type"])) {
        $booking_id = filter_var($_POST["booking_id"], FILTER_SANITIZE_NUMBER_INT);
        $description = filter_var($_POST["description"], FILTER_SANITIZE_STRING);
        $service_type = filter_var($_POST["service_type"], FILTER_SANITIZE_STRING);

        $result = updateService($booking_id, $description, $service_type);

        if ($result === true) {
            $success_message = "Service updated successfully.";
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
    <title>Update Service</title>
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

    <div class="container">
        <div class="form-container">
            <h1>Update Service</h1>
            <form method="post" action="update_service.php">
                <div class="form-group">
                    <label for="booking_id">Booking ID:</label>
                    <input type="text" name="booking_id" required><br>
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <input type="text" name="description" required><br>
                </div>
                <div class="form-group">
                    <label for="service_type">Service Type:</label>
                    <input type="text" name="service_type" required><br>
                </div>
                <input type="submit" value="Update Service" class="form-button">
            </form>
        </div>
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
            <button class="more-services-button" onclick="location.href='service.php'">
                More Services <i class="fas fa-arrow-right"></i> </button>
        </div>
    </div>
</body>

</html>
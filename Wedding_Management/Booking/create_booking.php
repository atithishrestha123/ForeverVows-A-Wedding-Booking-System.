<?php

include '../User/db_connection.php';

$brideName = $groomName = $description = $weddingDate = $weddingType = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ensure session is started
    session_start();

    // Sanitize form inputs
    $brideName = mysqli_real_escape_string($conn, $_POST["brideName"]);
    $groomName = mysqli_real_escape_string($conn, $_POST["groomName"]);
    $description = mysqli_real_escape_string($conn, $_POST["description"]);
    $weddingDate = mysqli_real_escape_string($conn, $_POST["weddingDate"]);
    $weddingType = mysqli_real_escape_string($conn, $_POST["weddingType"]);

    // Check if booking date is valid
    $today = date("Y-m-d");
    $threeDaysAhead = date("Y-m-d", strtotime($today . "+3 days"));
    if ($weddingDate < $threeDaysAhead) {
        echo "<script>alert('Error: Venue cannot be booked less than 3 days before the event.')</script>";
    } else {
        if (isset ($_SESSION['UserID'])) {
            $userID = $_SESSION['UserID'];

            $sql = "INSERT INTO booking (Users_Id, Bride_name, Groom_name, Description, Wedding_date, Wedding_type, Booking_status) 
            VALUES ('$userID', '$brideName', '$groomName', '$description', '$weddingDate', '$weddingType', 'Pending')";
            if ($conn->query($sql) === TRUE) {
                $last_id = $conn->insert_id;
                echo "<script>alert('Booking created successfully. Your Booking ID is: $last_id');</script>";
                echo "<script>window.location.href='../Service/ask_service.php';</script>";
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Error: User ID not found in session. Please log in.";
        }
    }
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Form</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel=stylesheet href="../Webpage/styles.css">
    <?php @include '../Webpage/navbar.php' ?>
    <style>
        * {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            outline: none;
            border: none;
            text-decoration: none;
        }

        body {
            font-family: Arial, sans-serif;
            background-image: url('../Assets/booking_bg.jpeg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 92vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            max-width: 600px;
            width: 80%;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            margin-top: 25px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
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
                width: 90%;
            }
        }

        @media screen and (max-width: 576px) {
            .container {
                width: 95%;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Your Booking Starts Here!</h1>
        <form method="post" action="create_booking.php">
            <!-- You can add a hidden input field to pass the user ID -->
            <input type="hidden" name="userID" value="123"> <!-- Replace '123' with the actual user ID -->
            <div class="form-group">
                <label for="brideName">Bride Name:</label>
                <input type="text" class="form-control" id="brideName" name="brideName" required
                    placeholder="Enter bride name">
            </div>
            <div class="form-group">
                <label for="groomName">Groom Name:</label>
                <input type="text" class="form-control" id="groomName" name="groomName" required
                    placeholder="Enter groom name">
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description"
                    placeholder="Enter description for booking"></textarea>
            </div>
            <div class="form-group">
                <label for="weddingDate">Wedding Date:</label>
                <input type="date" class="form-control" id="weddingDate" name="weddingDate" required>
            </div>
            <div class="form-group">
                <label for="weddingType">Wedding Type:</label>
                <input type="text" class="form-control" id="weddingType" name="weddingType" required
                    placeholder="Enter wedding type ">
            </div>
            <button type="submit" class="form-button">Submit</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
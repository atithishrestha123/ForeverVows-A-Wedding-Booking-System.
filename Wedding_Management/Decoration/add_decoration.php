<?php
@include '../User/db_connection.php';

function decorationExists($booking_id)
{
    global $conn;

    $check_decoration_sql = "SELECT COUNT(*) AS count FROM decoration WHERE Booking_ID = ?";
    $check_decoration_stmt = $conn->prepare($check_decoration_sql);
    $check_decoration_stmt->bind_param("i", $booking_id);
    $check_decoration_stmt->execute();
    $check_decoration_result = $check_decoration_stmt->get_result();
    $row = $check_decoration_result->fetch_assoc();
    $count = $row['count'];

    return $count > 0;
}

function addDecoration($booking_id, $description, $decoration_type)
{
    global $conn;

    if (decorationExists($booking_id)) {
        echo "<script>alert('Error: A decoration already exists for the provided booking ID.');</script>";
        return false;
    }

    $stmt = $conn->prepare("INSERT INTO decoration (Booking_ID, Description, Decoration_type) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $booking_id, $description, $decoration_type);

    if ($stmt->execute() === TRUE) {
        $stmt->close();
        return true;
    } else {
        $stmt->close();
        return " " . $stmt->error;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset ($_POST["submit"])) {
    $booking_id = $_POST['booking_id'];
    $description = $_POST['description'];
    $decoration_type = $_POST['decoration_type'];

    $result = addDecoration($booking_id, $description, $decoration_type);

    if ($result === true) {
        header("Location: ../Payment/add_payment.php");
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Decoration</title>
    <!-- Link Font Awesome CSS if not already linked -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../Webpage/styles.css">
    <?php @include '../Webpage/navbar.php' ?>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background-image: url('../Assets/decorationbg.jpeg');

        }

        .container {
            max-width: 1200px;
            margin: 70px auto 0;
            /* Added margin-top of 50px */
            padding: 20px;
            display: flex;
            justify-content: space-between;
        }

        .decorations-container,
        .form-container {
            width: 45%;
            background-color: #fff;
            /* White background color */
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 30px;
        }

        .decorations-container {
            margin-bottom: 20px;
            height: 100%;
            /* Set height to 100% */
            display: flex;
            flex-direction: column;
        }

        .decorations-list {
            flex-grow: 1;
            overflow-y: auto;
            padding-right: 10px;
            /* Add padding to prevent scrollbar overlay */
        }

        .decorations-list::-webkit-scrollbar {
            width: 8px;
        }

        .decorations-list::-webkit-scrollbar-thumb {
            background-color: #888;
            border-radius: 4px;
        }

        .more-decorations-button {
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

        .more-decorations-button:hover {
            background-color: #DC143C;
        }

        .decorations-arrow {
            color: #ffafbd;
            font-size: 24px;
            cursor: pointer;
            margin-top: 10px;
        }

        .decorations-arrow:hover {
            color: #DC143C;
        }

        .decorations {
            list-style: none;
            padding: 0;
            margin: 0;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            grid-gap: 20px;
        }

        .decoration {
            border-radius: 5px;
            overflow: hidden;
        }

        .decoration img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
        }

        .decoration h3 {
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
            /* Black border for input fields */
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        .form-button {
            background: #ffafbd;
            /* Baby pink button background color */
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

            .decorations-container,
            .form-container {
                width: 100%;
                margin-bottom: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="decorations-container">
            <h1>List of Decorations</h1>
            <div class="decorations-list">
                <ul class="decorations">
                    <li class="decoration">
                        <img src="../Assets/decoration1.jpg" alt="Decoration 1">
                        <h3>Floral Decoration</h3>
                    </li>
                    <li class="service">
                        <img src="../Assets/decoration2.jpg" alt="Decoration 2">
                        <h3>Christian Wedding Decor</h3>
                    </li>
                </ul>
            </div>
            <button class="more-decorations-button" onclick="location.href='decoration.php'"><i
                    class="fas fa-arrow-left"></i>
                More Decorations </button>

        </div>
        <div class="form-container">
            <h1>Add New Decoration</h1>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-group">
                    <label for="booking_id"><i class="fas fa-id-badge"></i> Booking ID:</label>
                    <input type="text" id="booking_id" name="booking_id" placeholder="Enter your booking Id">
                </div>
                <div class="form-group">
                    <label for="description"><i class="fas fa-file-alt"></i> Description:</label>
                    <input type="text" id="description" name="description"
                        placeholder="Enter description for decoration you want">
                </div>
                <div class="form-group">
                    <label for="decoration_type"><i class="fas fa-tools"></i> Decoration Type:</label>
                    <input type="text" id="decoration_type" name="decoration_type" placeholder="Enter decoration type">
                </div>

                <input type="submit" name="submit" value="Add Decoration" class="form-button">
            </form>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelector('.more-decorations-button').addEventListener('click', function () {
                window.location.href = 'decoration.php';
            });
        });
    </script>
</body>

</html>
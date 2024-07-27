<?php
include ("../User/db_connection.php");
include ("./common/crud_decoration.php");

$error_message = "";
$success_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset ($_POST["decoration_id"]) && !empty ($_POST["decoration_id"])) {
        $delete_decoration = filter_var($_POST["decoration_id"], FILTER_SANITIZE_NUMBER_INT);

        $result = deleteDecoration($delete_decoration);

        if ($result === true) {
            $success_message = "Decoration deleted successfully.";
            header("Location: read_decoration.php");
        } else {
            $error_message = $result;
        }
    } else {
        $error_message = "Error: Decoration ID not provided.";
    }
}

$decorations = getDecorations();

closeConnection();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Decoration</title>
    <link rel="stylesheet" href="../webpage/styles.css">
    <?php @include '../Admin/admin_nav.php' ?>
    <style>
        body {
            background-image: url('../Assets/decorationbg.jpeg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            font-family: 'Poppins', sans-serif;
            color: white;
            padding: 20px;
            margin-top: 30px;
            min-height: 92vh;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: white;
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

    <h2>Delete Decoration</h2>
    <form method="post" action="">
        <label for="decoration_id">Decoration ID:</label>
        <input type="number" name="decoration_id" required>
        <input type="submit" value="Delete Decoration">
    </form>

    <h2>Decorations List</h2>

    <?php if (empty ($decorations)): ?>
        <p>No decorations available.</p>
    <?php else: ?>
        <table class="styled-table">
            <thead>
                <tr>
                    <th>Decoration ID</th>
                    <th>Booking ID</th>
                    <th>Description</th>
                    <th>Decoration Type</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($decorations as $decoration): ?>
                    <tr>
                        <td>
                            <?php echo $decoration["DecorationID"]; ?>
                        </td>
                        <td>
                            <?php echo $decoration["Booking_ID"]; ?>
                        </td>
                        <td>
                            <?php echo $decoration["Description"]; ?>
                        </td>
                        <td>
                            <?php echo $decoration["Decoration_type"]; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

</body>

</html>
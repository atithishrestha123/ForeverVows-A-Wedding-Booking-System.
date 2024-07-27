<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wedding Types</title>
    <!-- Link Font Awesome CSS if not already linked -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../Webpage/styles.css">
    <?php @include '../Webpage/navbar.php' ?>
    <style>
        body {
            margin-top: 30px;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .container h1 {
            text-align: center;
        }

        .wedding-types {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            grid-gap: 20px;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .wedding-type {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .wedding-type img {
            width: 100%;
            height: 400px;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
        }

        .wedding-type h3 {
            margin-top: 10px;
            padding: 10px;
            font-size: 18px;
            text-align: center;
        }

        .add-wedding-type-button {
            display: block;
            width: 100%;
            padding: 10px;
            font-size: 16px;
            text-align: center;
            background-color: #ffafbd;
            color: #fff;
            border: none;
            border-radius: 5px;
            margin-top: 20px;
            cursor: pointer;
            text-decoration: none;
        }

        .add-wedding-type-button:hover {
            background-color: #DC143C;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>List of Wedding Types</h1>
        <ul class="wedding-types">
            <li class="wedding-type">
                <img src="../Assets/bg-2.jpeg" alt="Wedding Type 1">
                <h3>Traditional Wedding</h3>
            </li>
            <li class="wedding-type">
                <img src="../Assets/wedding_type2.jpeg" alt="Wedding Type 2">
                <h3>Religious Wedding</h3>
            </li>
            <li class="wedding-type">
                <img src="../Assets/wedding_type3.jpeg" alt="Wedding Type 3">
                <h3>Beach Wedding</h3>
            </li>
            <li class="wedding-type">
                <img src="../Assets/wedding_type4.jpeg" alt="Wedding Type 4">
                <h3>Vintage Wedding</h3>
            </li>
            <li class="wedding-type">
                <img src="../Assets/wedding_type5.jpeg" alt="Wedding Type 5">
                <h3>Christian Wedding</h3>
            </li>
            <li class="wedding-type">
                <img src="../Assets/wedding_type6.jpeg" alt="Wedding Type 6">
                <h3>Hindu Wedding</h3>
            </li>
            <li class="wedding-type">
                <img src="../Assets/wedding_type7.jpeg" alt="Wedding Type 7">
                <h3>Islamic Wedding</h3>
            </li>
            <li class="wedding-type">
                <img src="../Assets/wedding_type8.jpeg" alt="Wedding Type 8">
                <h3>Destination Wedding</h3>
            </li>
            <li class="wedding-type">
                <img src="../Assets/wedding_type9.jpeg" alt="Wedding Type 9">
                <h3>Civil Wedding</h3>
            </li>
        </ul>
        <a href="create_booking.php" class="add-wedding-type-button">Add Wedding Type</a>
    </div>
</body>

</html>
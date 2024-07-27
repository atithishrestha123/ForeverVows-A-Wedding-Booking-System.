<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Decorations</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel=stylesheet href="../Webpage/styles.css">
    <?php @include '../Webpage/navbar.php' ?>
    <style>
        body {
            margin: 30px;
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

        .decorations {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            grid-gap: 20px;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .decoration {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .decoration img {
            width: 100%;
            height: 400px;
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

        .add-decoration-button {
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

        .add-decoration-button:hover {
            background-color: #DC143C;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>List of Decorations</h1>
        <ul class="decorations">
            <li class="decoration">
                <img src="../Assets/decoration1.jpg" alt="Decoration 1">
                <h3>Traditional Decor</h3>
            </li>
            <li class="decoration">
                <img src="../Assets/decoration2.jpg" alt="Decoration 2">
                <h3>Christian Wedding Decor</h3>
            </li>
            <li class="decoration">
                <img src="../Assets/decoration3.jpg" alt="Decoration 3">
                <h3>Floral Decor</h3>
            </li>
            <li class="decoration">
                <img src="../Assets/decoration4.jpeg" alt="Decoration 4">
                <h3>Royal Red Wedding Decor</h3>
            </li>
            <li class="decoration">
                <img src="../Assets/decoration5.jpeg" alt="Decoration 5">
                <h3>Beach Wedding Decor</h3>
            </li>
            <li class="decoration">
                <img src="../Assets/decoration6.jpeg" alt="Decoration 6">
                <h3>Balloon Arch</h3>
            </li>
            <li class="decoration">
                <img src="../Assets/decoration7.jpeg" alt="Decoration 7">
                <h3>Pink Theme</h3>
            </li>
            <li class="decoration">
                <img src="../Assets/decoration8.jpeg" alt="Decoration 8">
                <h3>Indoor Wedding </h3>
            </li>
        </ul>
        <a href="add_decoration.php" class="add-decoration-button">Add Decoration</a>
    </div>
</body>

</html>
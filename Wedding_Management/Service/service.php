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

        .services {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            grid-gap: 20px;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .service {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .service img {
            width: 100%;
            height: 400px;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
        }

        .service h3 {
            margin-top: 10px;
            padding: 10px;
            font-size: 18px;
            text-align: center;
        }

        .add-service-button {
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

        .add-service-button:hover {
            background-color: #DC143C;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>List of Services</h1>
        <ul class="services">
            <li class="service">
                <img src="../Assets/service1.jpg" alt="Service 1">
                <h3>Videography and Photography Service</h3>
            </li>
            <li class="service">
                <img src="../Assets/service2.jpg" alt="Service 2">
                <h3>MakeUp Service</h3>
            </li>
            <li class="service">
                <img src="../Assets/service3.jpg" alt="Service 3">
                <h3>DJ Service</h3>
            </li>
            <li class="service">
                <img src="../Assets/service4.jpeg" alt="Service 4">
                <h3>Clothing Service</h3>
            </li>
            <li class="service">
                <img src="../Assets/service5.jpg" alt="Service 5">
                <h3>Horse Carriage Service</h3>
            </li>
            <li class="service">
                <img src="../Assets/service6.jpeg" alt="Service 6">
                <h3>Live Event Painting</h3>
            </li>
            <li class="service">
                <img src="../Assets/service7.jpeg" alt="Service 7">
                <h3>Catering Service</h3>
            </li>
            <li class="service">
                <img src="../Assets/service8.jpeg" alt="Service 8">
                <h3>Mehendi Service</h3>
            </li>
            <li class="service">
                <img src="../Assets/service9.jpeg" alt="Service 9">
                <h3>Wedding Tent Service</h3>
            </li>
        </ul>
        <a href="add_service.php" class="add-service-button">Add Service</a>
    </div>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../Webpage/styles.css">
    <?php @include '../Webpage/navbar.php' ?>
    <style>
        body {
            margin: 55px;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }

        .container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        .gallery {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            grid-gap: 20px;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .gallery-item {
            border-radius: 5px;
            overflow: hidden;
        }

        .gallery-item img {
            width: 100%;
            height: 400px;
            object-fit: cover;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
            transition: transform 0.3s ease-in-out;
        }

        .gallery-item:hover img {
            transform: scale(1.1);
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Gallery</h1>
        <ul class="gallery">
            <li class="gallery-item">
                <img src="../Assets/image1.jpg" alt="Image 1">
            </li>
            <li class="gallery-item">
                <img src="../Assets/image2.jpeg" alt="Image 2">
            </li>
            <li class="gallery-item">
                <img src="../Assets/image3.jpeg" alt="Image 3">
            </li>
            <li class="gallery-item">
                <img src="../Assets/img4.jpeg" alt="Image 4">
            </li>
            <li class="gallery-item">
                <img src="../Assets/img5.jpeg" alt="Image 5">
            </li>
            <li class="gallery-item">
                <img src="../Assets/image8.jpeg" alt="Image 8">
            </li>
            <li class="gallery-item">
                <img src="../Assets/image9.jpeg" alt="Image 9">
            </li>
            <li class="gallery-item">
                <img src="../Assets/image6.jpeg" alt="Image 6">
            </li>
            <li class="gallery-item">
                <img src="../Assets/image7.jpeg" alt="Image 7">
            </li>
            <li class="gallery-item">
                <img src="../Assets/image10.jpeg" alt="Image 10">
            </li>
            <li class="gallery-item">
                <img src="../Assets/image12.jpeg" alt="Image 12">
            </li>
            <li class="gallery-item">
                <img src="../Assets/image11.jpeg" alt="Image 11">
            </li>
        </ul>
    </div>
</body>

</html>
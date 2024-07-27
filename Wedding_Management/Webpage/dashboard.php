<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        .container-fluid {
            padding: 0;
        }

        .image-section {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(18%, 1fr));
            overflow-x: auto;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        .image-section::-webkit-scrollbar {
            display: none;
        }

        .image-section img {
            width: 100%;
            height: auto;
        }

        .content {
            padding: 20px;
        }

        .content h1 {
            font-size: 30px;
            color: #333;
            margin-bottom: 20px;
        }

        .content .row {
            margin-bottom: 20px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .col-md-6 {
            flex: 0 0 calc(50% - 10px);
            max-width: calc(50% - 10px);
            margin-bottom: 20px;
        }

        /* Card styling */
        .card {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .card:hover {
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .card-title {
            font-size: 20px;
            font-weight: bold;
        }

        .card-text {
            font-size: 16px;
            color: #555;
        }

        .card-body {
            padding: 20px;
            flex-grow: 1;
        }

        .card a.btn {
            text-decoration: none;
            color: #fff;
        }

        .card a.btn:hover {
            color: #fff;
            text-decoration: none;
        }

        .btn {
            font-size: 16px;
            padding: 10px 20px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        @media screen and (max-width: 768px) {
            .col-md-6 {
                flex: 0 0 calc(100% - 20px);
                max-width: calc(100% - 20px);
            }
        }
    </style>
    <?php @include './navbar.php'; ?>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="image-section">
                    <img src="../Assets/bg-5.jpeg" alt="Background Image 5">
                    <img src="../Assets/bg-3.jpeg" alt="Background Image 3">
                    <img src="../Assets/bg-2.jpeg" alt="Background Image 2">
                    <img src="../Assets/bg-4.jpeg" alt="Background Image 4">
                    <img src="../Assets/bg-1.jpeg" alt="Background Image 1">
                </div>
            </div>
        </div>
    </div>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
        <div class="content">
            <div class="row">
                <!-- Gallery Section -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Gallery</h5>
                            <p class="card-text">View our collection of wedding photos.</p>
                            <a href="../Gallery/gallery.php" class="btn btn-primary">View Gallery</a>
                        </div>
                    </div>
                </div>
                <!-- Services Section -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Services</h5>
                            <p class="card-text">Explore the services we offer for your dream wedding.</p>
                            <a href="../Service/service.php" class="btn btn-primary">View Services</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <!-- Images Section -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Wedding Types</h5>
                            <p class="card-text">Browse through our collection of wedding types.</p>
                            <a href="../Booking/wedding_types.php" class="btn btn-primary">View Wedding Types</a>
                        </div>
                    </div>
                </div>
                <!-- Other Sections -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Decorations</h5>
                            <p class="card-text">Explore the decorations we offer for your dream wedding.</p>
                            <a href="../Decoration/decoration.php" class="btn btn-primary">View Decorations</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
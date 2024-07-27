<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Page</title>
    <link rel="stylesheet" href="User/style.css">
    <style>
        body,
        html {
            height: 100%;
            margin: 0;
            font-family: Poppins, sans-serif;
        }

        .container {
            position: relative;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .content {
            position: relative;
            z-index: 1;
            text-align: center;
            padding: 20px;
        }

        .content p {
            color: #F9E897;
        }

        .animated-text {
            display: inline-block;
            overflow: hidden;
            white-space: nowrap;
            font-size: 36px;
            color: beige;
        }

        .animated-text span {
            animation: reveal 5s infinite linear;
            opacity: 0;
            display: inline-block;
        }

        @keyframes reveal {
            0% {
                opacity: 0;
                transform: translateY(100%);
            }

            50% {
                opacity: 1;
                transform: translateY(0);
            }

            100% {
                opacity: 0;
                transform: translateY(-100%);
            }
        }

        .buttons {
            margin-top: 20px;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            margin-right: 10px;
        }

        #video-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            object-fit: cover;
        }

        .container .animated-text {
            max-height: 70%;
            overflow: hidden;
        }

        /* Responsive Styles */
        @media screen and (max-width: 768px) {
            .content {
                padding: 10px;
            }

            .button {
                margin-right: 5px;
            }
        }

        @media screen and (max-width: 576px) {
            .content h3 {
                font-size: 24px;
            }

            .content p {
                font-size: 16px;
            }

            .buttons {
                margin-top: 10px;
            }

            .button {
                padding: 8px 15px;
                margin-right: 5px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="content">
            <div class="animated-text">
                <span>Welcome to <i>FOREVERVOWS</i>.</span>
            </div>
            <p>We are here to help you plan your dream wedding!</p>
            <p>Please login or register to get started.</p>
            <div class="buttons">
                <a href="User/login.php" class="button">Login</a>
                <a href="User/register.php" class="button">Register</a>
            </div>
        </div>
    </div>
    <video autoplay muted loop id="video-background">
        <source src="Assets/bg.mp4" type="video/mp4">
    </video>
</body>

</html>
<?php
if (isset ($_POST['add_decoration'])) {
    header("Location: add_decoration.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Decoration Confirmation</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel=stylesheet href="../Webpage/styles.css">
    <?php @include '../Webpage/navbar.php' ?>
    <style>
        body {
            background-image: url('../Assets/ask_decoration.jpeg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            padding-top: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 92vh;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.5);
            border-radius: 5px;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 450px;
            width: 100%;
        }

        .form-group {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Decoration Confirmation</h2>
        <p>Do you want to add the decoration?</p>
        <form method="post" action="../Decoration/add_decoration.php">
            <div class="form-group">
                <button type="submit" class="btn btn-success" name="add_decoration">Yes</button>
                <a href="../Webpage/navbar.php" class="btn btn-danger">No</a>
            </div>
        </form>
    </div>
</body>

</html>
<?php
include_once("model/model.php");



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP FILE UPLOAD</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.css">

    <style>
    .error {
        text-align: center;
        font-style: italic;
        font-weight: bold;
    }
    </style>
</head>

<body>
    <div class="container">
        <h1>FILE UPLOAD</h1>
        <p class="error m-2">
            <?php echo $finalReps;?>
        </p>

        <form action="" method="post" class="form-control m-3" enctype="multipart/form-data" name="form">
            <label for="name">Name:</label>
            <input type="text" class="form-control m-2" name="name" id="name" required>
            <label for="email">email:</label>
            <input type="text" class="form-control m-2" name="email" id="email" required>
            <label for="file">file:</label>
            <input type="file" class="form-control m-2" name="fileUpload" required>
            <input type="submit" class="btn btn-primary" name="submit">
        </form>





    </div>

    <script src="assets/bootstrap/js/bootstrap.js"></script>
</body>

</html>
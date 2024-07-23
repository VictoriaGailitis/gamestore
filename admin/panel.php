<?php
    include '../connect.php';
    session_start();
    if ($_SESSION['access'] != "admin") {
        header('Location: ../errors/access_error.php');
    }
?>

<?php include ("../blocks/admin_header.php");?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KeyLand</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/12be2a89a6.js" crossorigin="anonymous"></script>
</head>
<body>
<div class="px-4 pt-5 my-5 text-center">
    <h1 class="display-4 fw-bold text-body-emphasis">Админ-панель</h1>
    <div class="col-lg-6 mx-auto">
        <p class="lead mb-4">Здесь администратор может управлять любой информацией из базы данных.</p>
    </div>
</div>
</body>
</html>

<?php include ("../blocks/admin_footer.php");?>
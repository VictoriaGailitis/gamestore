<?php
    include '../connect.php';
    session_start();
    if ($_SESSION['access'] != "admin") {
        header('Location: ../errors/access_error.php');
    }
    if (isset($_POST['genre_id'])) {
        $genre_id = $_POST['genre_id'];
        $genre_name = $_POST['genre_name'];
        $sql_insert = "INSERT INTO genres (genre_id, genre_name) VALUES ('$genre_id', '$genre_name')";
        $result = mysqli_query($link, $sql_insert);
    }
?>
<!DOCTYPE html>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавление</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/12be2a89a6.js" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
<main>
    <div class="py-5 text-center">
    <?php
    if (isset($_POST['genre_id'])) {
        if($result) {
            echo '<i class="fa-solid fa-check" style="color: #2267dd; font-size: xxx-large;"></i>
            <h1 class="text-body-emphasis">Успешно!</h1>
            <p class="col-lg-6 mx-auto mb-4">
            Запись добавлена!
            </p>
            <a class="btn btn-primary px-5 mb-5" href="genres.php" role="button">
            Вернуться к таблице
            </a>';
        }
        else {
            echo '<i class="fa-solid fa-x" style="color: #d72323; font-size: xxx-large;"></i>
            <h1 class="text-body-emphasis">Произошла ошибка</h1>
            <p class="col-lg-6 mx-auto mb-4">
            Ошибка при добавлении </p>';
        }
    }
    else {
        echo '<i class="fa-solid fa-user-plus" style="color: #2267dd; font-size: xxx-large;"></i>
        <h2>Добавление записи</h2>
        </div>
        <div class="d-flex flex-column mb-3 align-items-center">
            <form method="post">
            <div class="row g-3">
            <div class="col-sm-6">
            <label for="genre_id" class="form-label">ID жанра</label>
            <input type="number" class="form-control" id="genre_id" name="genre_id">
            </div>
    
            <div class="col-sm-6">
            <label for="genre_name" class="form-label">Название жанра</label>
            <input type="text" class="form-control" id="genre_name" name="genre_name">
            </div>
            </div>
    
            <hr class="my-4">
            <button class="w-100 btn btn-primary btn-lg" type="submit">Добавить</button>
            </form>';
    }
?>
</div>
</div>
</body>
</html>
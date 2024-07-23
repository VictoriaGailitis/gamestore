<?php
    include '../connect.php';
    session_start();
    if ($_SESSION['access'] != "admin") {
        header('Location: ../errors/access_error.php');
    }
    if (isset($_POST['game_id'])) {
        $game_id = $_POST['game_id'];
        $game_name = $_POST['game_name'];
        $developer_id = $_POST['developer_id'];
        $publisher_id = $_POST['publisher_id'];
        $genre_id = $_POST['genre_id'];
        $release_date = $_POST['release_date'];
        $age_rating = $_POST['age_rating'];
        $image_url = $_POST['image_url'];
        $sql_insert = "INSERT INTO games (game_id, game_name, developer_id, publisher_id, release_date, age_rating, genre_id, image_url) 
        VALUES ('$game_id', '$game_name', '$developer_id', '$publisher_id', '$release_date', '$age_rating', '$genre_id', '$image_url')";
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
    if (isset($_POST['game_id'])) {
        if($result) {
            echo '<i class="fa-solid fa-check" style="color: #2267dd; font-size: xxx-large;"></i>
            <h1 class="text-body-emphasis">Успешно!</h1>
            <p class="col-lg-6 mx-auto mb-4">
            Запись добавлена!
            </p>
            <a class="btn btn-primary px-5 mb-5" href="games.php" role="button">
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
            <div class="col-sm-12">
            <label for="game_id" class="form-label">ID игры</label>
            <input type="number" class="form-control" id="game_id" name="game_id">
            </div>
    
            <div class="col-sm-12">
            <label for="game_name" class="form-label">Название игры</label>
            <input type="text" class="form-control" id="game_name" name="game_name">
            </div>

            <div class="col-sm-12">
            <label for="developer_id" class="form-label">Разработчик</label>
                <select class="form-select" name="developer_id" aria-label="Default select example">';
                $sql_select = "SELECT developer_id, developer_name FROM developers";
                $result_select = mysqli_query($link, $sql_select);
                while ($row = mysqli_fetch_array($result_select))
                {
                    echo "<option value = ' ".$row['developer_id']."'>".$row['developer_name']."</option>";
                }
                echo '</select>
            </div>

            <div class="col-sm-12">
            <label for="publisher_id" class="form-label">Издатель</label>
            <select class="form-select" name="publisher_id" aria-label="Default select example">';
            $sql_select = "SELECT publisher_id, publisher_name FROM publishers";
                $result_select = mysqli_query($link, $sql_select);
                while ($row = mysqli_fetch_array($result_select))
                {
                    echo "<option value = ' ".$row['publisher_id']."'>".$row['publisher_name']."</option>";
                }
                echo '</select>
                </div>

            <div class="col-sm-12">
            <label for="genre_id" class="form-label">Жанр</label>
            <select class="form-select" name="genre_id" aria-label="Default select example">';
            $sql_select = "SELECT genre_id, genre_name FROM genres";
                $result_select = mysqli_query($link, $sql_select);
                while ($row = mysqli_fetch_array($result_select))
                {
                    echo "<option value = ' ".$row['genre_id']."'>".$row['genre_name']."</option>";
                }
                echo '</select>
                </div>

            <div class="col-sm-12">
            <label for="release_date" class="form-label">Дата релиза</label>
            <input type="date" class="form-control" id="release_date" name="release_date">
            </div>
            
            <div class="col-sm-12">
            <label for="age_rating" class="form-label">Возрастное ограничение</label>
            <input type="number" class="form-control" id="age_rating" name="age_rating">
            </div>

            <div class="col-sm-12">
            <label for="image_url" class="form-label">Ссылка на изображение</label>
            <input type="text" class="form-control" id="image_url" name="image_url">
            </div>

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
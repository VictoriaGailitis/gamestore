<?php
    include '../connect.php';
    session_start();
    if ($_SESSION['access'] != 'admin') {
        header('Location: ../errors/access_error.php');
    }
    if (isset($_POST['game_name'])) {
        if (isset($_GET['red_id']))
        {
            $sql_update = "UPDATE games SET game_name = '{$_POST['game_name']}',
            developer_id = '{$_POST['developer_id']}', publisher_id = '{$_POST['publisher_id']}',
            genre_id = '{$_POST['genre_id']}', release_date = '{$_POST['release_date']}',
            age_rating = '{$_POST['age_rating']}', image_url = '{$_POST['image_url']}'
            WHERE game_id = {$_GET['red_id']}";
            $result_update = mysqli_query($link, $sql_update);
            }
    }
    if (isset($_GET['red_id'])) {
        $sql_select = "SELECT game_name, developer_id, publisher_id, genre_id, release_date, age_rating, image_url FROM games WHERE game_id = {$_GET['red_id']}";
        $result_select = mysqli_query($link, $sql_select);
        $row = mysqli_fetch_array($result_select);
    }
    else {
        header('Location: ../errors/access_error.php');
    }
?>
<!DOCTYPE html>
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактирование</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/12be2a89a6.js" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
<main>
    <div class="py-5 text-center">
    <i class="fas fa-edit" style="color: #2267dd; font-size: xxx-large;"></i>
    <h2>Редактирование</h2>
    <?php
    if (isset($_POST['game_name'])) {
        if (isset($_GET['red_id']))
        {
            if ($result_update) {
                echo '<p>Успешно!</p>';
            } 
            else {
                echo '<p>Произошла ошибка: ' . mysqli_error($link). '</p>';
            }
        }
    }
        ?>
    </div>
    <div class="d-flex flex-column mb-3 align-items-center">
        <form method="post">
        <div class="row g-3">
            <div class="col-sm-12">
            <label for="game_name" class="form-label">Название игры</label>
            <input type="text" class="form-control" id="game_name" name="game_name" value="<?=isset($_GET['red_id']) ? $row['game_name'] : ''; ?>">
            </div>

            <div class="col-sm-12">
            <label for="developer_id" class="form-label">Разработчик</label>
            <select class="form-select" name="developer_id">
                <?php
                include 'connect.php';
                $sql_select = "SELECT developer_id, developer_name FROM developers";
                $result_select = mysqli_query($link, $sql_select);
                while ($row_select = mysqli_fetch_array($result_select))
                {
                    if (isset($_GET['red_id']) && $row['developer_id'] == $row_select['developer_id']) {
                        echo "<option selected value = ' ".$row_select['developer_id']."'>".$row_select['developer_name']."</option>";
                    }
                    else {
                        echo "<option value = ' ".$row_select['developer_id']."'>".$row_select['developer_name']."</option>";
                    }
                    
                }
                ?>
                </select>
            </div>

            <div class="col-sm-12">
            <label for="publisher_id" class="form-label">Издатель</label>
            <select class="form-select" name="publisher_id">
                <?php
                include 'connect.php';
                $sql_select = "SELECT publisher_id, publisher_name FROM publishers";
                $result_select = mysqli_query($link, $sql_select);
                while ($row_select = mysqli_fetch_array($result_select))
                {
                    if (isset($_GET['red_id']) && $row['publisher_id'] == $row_select['publisher_id']) {
                        echo "<option selected value = ' ".$row_select['publisher_id']."'>".$row_select['publisher_name']."</option>";
                    }
                    else {
                        echo "<option value = ' ".$row_select['publisher_id']."'>".$row_select['publisher_name']."</option>";
                    }
                    
                }
                ?>
                </select>
            </div>

            <div class="col-sm-12">
            <label for="genre_id" class="form-label">Жанр</label>
            <select class="form-select" name="genre_id">
                <?php
                include 'connect.php';
                $sql_select = "SELECT genre_id, genre_name FROM genres";
                $result_select = mysqli_query($link, $sql_select);
                while ($row_select = mysqli_fetch_array($result_select))
                {
                    if (isset($_GET['red_id']) && $row['genre_id'] == $row_select['genre_id']) {
                        echo "<option selected value = ' ".$row_select['genre_id']."'>".$row_select['genre_name']."</option>";
                    }
                    else {
                        echo "<option value = ' ".$row_select['genre_id']."'>".$row_select['genre_name']."</option>";
                    }
                    
                }
                ?>
                </select>
            </div>

            <div class="col-sm-12">
            <label for="release_date" class="form-label">Дата релиза</label>
            <input type="date" class="form-control" id="release_date" name="release_date" value="<?=isset($_GET['red_id']) ? $row['release_date'] : ''; ?>">
            </div>

            <div class="col-sm-12">
            <label for="age_rating" class="form-label">Возрастное ограничение</label>
            <input type="number" class="form-control" id="age_rating" name="age_rating" value="<?=isset($_GET['red_id']) ? $row['age_rating'] : ''; ?>">
            </div>

            <div class="col-sm-12">
            <label for="image_url" class="form-label">Ссылка на изображение</label>
            <input type="text" class="form-control" id="image_url" name="image_url" value="<?=isset($_GET['red_id']) ? $row['image_url'] : ''; ?>">
            </div>
        </div>

        <hr class="my-4">
        <button class="w-100 btn btn-primary btn-lg" type="submit">Сохранить изменения</button>
        </form>
        <form method="post" action="games.php">
            <input type="submit" value="Назад" class="btn btn-lg btn-secondary mt-2">
        </form>
    </div>
</main>
</div>
</body>
</html>
<?php
    include '../connect.php';
    if (isset($_GET['del_id']))
    {
        $sql_delete = "DELETE FROM games WHERE game_id = {$_GET['del_id']}";
        $result_delete = mysqli_query ($link, $sql_delete);

        if ($result_delete) {
            header('Location: games.php');
        } 
        else {
            echo '<p>Произошла ошибка: ' .mysqli_error($link) . '</p>';
        }
    }
    if (isset($_GET['page'])){ 
        $page = $_GET['page']; 
    }else $page = 1; 
    $kol = 3;
    $art = ($page * $kol) - $kol; 
    $res = mysqli_query($link, "SELECT COUNT(game_id) FROM games"); 
    $row_pag = mysqli_fetch_row($res); 
    $total = $row_pag[0];
    $str_pag = ceil($total / $kol);
?>
<!DOCTYPE html>
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Игры</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/12be2a89a6.js" crossorigin="anonymous"></script>
</head>
<body>
<?php include ("../blocks/admin_header.php");?>
    <div class="px-4 pt-5 my-5 text-center">
        <h1 class="display-4 fw-bold text-body-emphasis">Таблица "Игры"</h1>
    </div>
    <div class="album py-5 bg-body-tertiary">
    <div class="container">
    <section class="py-5 text-center container">
    <form method="post">
    <div class="input-group mb-3">
        <input type="text" name="search" class="form-control" placeholder="Поиск" aria-label="Поиск" value="<?=$_POST['search']; ?>" aria-describedby="button-addon2">
        <input class="btn btn-outline-secondary" type="submit" role="button" name="ok" id="button-addon2"></input>
    </div>
    </form>
        <div class="row py-lg-5">
        <div class="col-lg-6 col-md-8 mx-auto">
            <?php 
                for ($i = 1; $i <= $str_pag; $i++){ 
                    echo "<a type='button' role='button' class=\"btn btn-sm btn-outline-secondary me-1\" href=games.php?page=".$i."> Страница ".$i." 
                        </a>"; 
                } 
            ?>
        </div>
        </div>
    </section>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
    <table class="table">
    <thead>
    <tr>
        <th scope="col">ID игры<a href="games.php?sort=GAME_ID-asc"><i class="fa-solid fa-sort-up" style="color: #2267dd;"></i></a><a href="games.php?sort=GAME_ID-desc"><i class="fa-solid fa-sort-down" style="color: #2267dd;"></i></a></th>
        <th scope="col">Название<a href="games.php?sort=GAME_NAME-asc"><i class="fa-solid fa-sort-up" style="color: #2267dd;"></i></a><a href="games.php?sort=GAME_NAME-desc"><i class="fa-solid fa-sort-down" style="color: #2267dd;"></i></a></th>
        <th scope="col">Разработчик<a href="games.php?sort=DEVELOPER_NAME-asc"><i class="fa-solid fa-sort-up" style="color: #2267dd;"></i></a><a href="games.php?sort=DEVELOPER_NAME-desc"><i class="fa-solid fa-sort-down" style="color: #2267dd;"></i></a></th>
        <th scope="col">Издатель<a href="games.php?sort=PUBLISHER_NAME-asc"><i class="fa-solid fa-sort-up" style="color: #2267dd;"></i></a><a href="games.php?sort=PUBLISHER_NAME-desc"><i class="fa-solid fa-sort-down" style="color: #2267dd;"></i></a></th>
        <th scope="col">Жанр<a href="games.php?sort=GENRE_NAME-asc"><i class="fa-solid fa-sort-up" style="color: #2267dd;"></i></a><a href="games.php?sort=GENRE_NAME-desc"><i class="fa-solid fa-sort-down" style="color: #2267dd;"></i></a></th>
        <th scope="col">Дата релиза<a href="games.php?sort=RELEASE_DATE-asc"><i class="fa-solid fa-sort-up" style="color: #2267dd;"></i></a><a href="games.php?sort=RELEASE_DATE-desc"><i class="fa-solid fa-sort-down" style="color: #2267dd;"></i></a></th>
        <th scope="col">Возрастное ограничение<a href="games.php?sort=AGE_RATING-asc"><i class="fa-solid fa-sort-up" style="color: #2267dd;"></i></a><a href="games.php?sort=AGE_RATING-desc"><i class="fa-solid fa-sort-down" style="color: #2267dd;"></i></a></th>
        <th scope="col">Ссылка на изображение</th>
        <th scope="col">Удалить</th>
        <th scope="col">Изменить</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $search = $_POST['search'];
    $reset = $_POST['reset'];
    $sorting = $_GET['sort'];
    switch ($sorting) { 
        case "GAME_ID-asc": 
            $sorting_sql = 'ORDER BY GAME_ID ASC'; 
        break; 
        case "GAME_ID-desc": 
            $sorting_sql = 'ORDER BY GAME_ID DESC'; 
            break; 
        case "GAME_NAME-asc": 
            $sorting_sql = 'ORDER BY GAME_NAME ASC'; 
            break; 
        case "GAME_NAME-desc": 
            $sorting_sql = 'ORDER BY GAME_NAME DESC'; 
            break;
        case "PUBLISHER_NAME-asc": 
            $sorting_sql = 'ORDER BY PUBLISHER_NAME ASC'; 
            break; 
        case "PUBLISHER_NAME-desc": 
            $sorting_sql = 'ORDER BY PUBLISHER_NAME DESC'; 
            break;
        case "DEVELOPER_NAME-asc": 
            $sorting_sql = 'ORDER BY DEVELOPER_NAME ASC'; 
            break; 
        case "DEVELOPER_NAME-desc": 
            $sorting_sql = 'ORDER BY DEVELOPER_NAME DESC'; 
            break;
        case "GENRE_NAME-asc": 
            $sorting_sql = 'ORDER BY GENRE_NAME ASC'; 
            break; 
        case "GENRE_NAME-desc": 
            $sorting_sql = 'ORDER BY GENRE_NAME DESC'; 
            break;
        case "RELEASE_DATE-asc": 
            $sorting_sql = 'ORDER BY RELEASE_DATE ASC'; 
            break; 
        case "RELEASE_DATE-desc": 
            $sorting_sql = 'ORDER BY RELEASE_DATE DESC'; 
            break;
        case "AGE_RATING-asc": 
            $sorting_sql = 'ORDER BY AGE_RATING ASC'; 
            break; 
        case "AGE_RATING-desc": 
            $sorting_sql = 'ORDER BY AGE_RATING DESC'; 
            break;                          
        case "default": 
            $sorting_sql = ''; 
            break; 
        }  
    if(empty($search)) {
        $sql = "SELECT game_id, game_name, publisher_name, developer_name, genre_name, release_date, age_rating, image_url FROM games INNER JOIN publishers
        ON publishers.publisher_id = games.publisher_id INNER JOIN developers ON developers.developer_id = games.developer_id INNER JOIN genres
        ON genres.genre_id = games.genre_id $sorting_sql LIMIT $art,$kol";
    }
    else {
        $sql = "SELECT game_id, game_name, publisher_name, developer_name, genre_name, release_date, age_rating, image_url FROM games INNER JOIN publishers
        ON publishers.publisher_id = games.publisher_id INNER JOIN developers ON developers.developer_id = games.developer_id INNER JOIN genres
        ON genres.genre_id = games.genre_id WHERE game_id LIKE '%$search%' OR game_name
        LIKE '%$search%' OR publisher_name LIKE '%$search%' OR developer_name LIKE '%$search%' OR genre_name LIKE '%$search%'
        OR release_date LIKE '%$search%' OR age_rating LIKE '%$search%' OR image_url LIKE '%$search%' $sorting_sql";
    }
    $result = mysqli_query($link, $sql);
    if (!($result)) {
        echo '
        <div class="col-lg-3 col-md-8 mx-auto" style="text-align: center;">
        <h3>Таблица пуста</h3>
        </div>
        ';
    }
    else {
        while ($row = mysqli_fetch_array($result)) {
            echo '<tr>'.
            "<th scope='row'>{$row['game_id']}</th>".
            "<td>{$row['game_name']}</td>".
            "<td>{$row['developer_name']}</td>".
            "<td>{$row['publisher_name']}</td>".
            "<td>{$row['genre_name']}</td>".
            "<td>{$row['release_date']}</td>".
            "<td>{$row['age_rating']}</td>".
            "<td>{$row['image_url']}</td>".
            "<td><a type=\"button\" role=\"button\" class=\"btn btn-outline-primary me-2\" href='?del_id={$row['game_id']}'>Удалить</a></td>".
            "<td><a type=\"button\" role=\"button\" class=\"btn btn-outline-primary me-2\" href='update_game.php?red_id={$row['game_id']}'>Изменить</a></td>".
            '</tr>';
        }
    }
    echo '</tbody>'.
        '</table>';
?>    
    </div>
    <?php echo '<div class="d-flex justify-content-center align-items-center">'.
        '<div class="btn-group">'.
        "<a type=\"button\" class=\"btn btn-sm btn-outline-secondary\" href=\"add_game.php\" role=\"button\">Добавить</a>".
        "</div>".
        '</div>'; ?>
    </div>
</div>
<?php include ("../blocks/admin_footer.php");?>
</body>
</html>
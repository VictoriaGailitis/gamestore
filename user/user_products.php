<!DOCTYPE html>
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Товары</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/12be2a89a6.js" crossorigin="anonymous"></script>
</head>
<body>
<?php
    include('../connect.php');
    session_start();
    if ($_SESSION['access'] != "user") {
        header('Location: ../errors/access_error.php');
    }
    if (isset($_GET['page'])){ 
        $page = $_GET['page']; 
    }else $page = 1; 
    $kol = 3;
    $art = ($page * $kol) - $kol; 
    $res = mysqli_query($link, "SELECT COUNT(product_id) FROM products"); 
    $row_pag = mysqli_fetch_row($res); 
    $total = $row_pag[0];
    $str_pag = ceil($total / $kol); 
    $sql_products = "SELECT product_id, game_name, genre_name, developer_name, publisher_name,
                        release_date, age_rating, image_url, product_platform, 
                        product_key, product_price FROM products INNER JOIN games
                        ON products.game_id = games.game_id INNER JOIN developers
    ON games.developer_id = developers.developer_id INNER JOIN publishers
    ON games.publisher_id = publishers.publisher_id INNER JOIN genres
    ON games.genre_id = genres.genre_id LIMIT $art,$kol";
    $result_products = mysqli_query($link, $sql_products);
?>
<?php include ("../blocks/user_header.php");?>
<main>
<section class="py-5 text-center container">
<div class="row py-lg-5">
    <div class="col-lg-6 col-md-8 mx-auto">
    <h1 class="fw-light">Товары</h1>
    <p class="lead text-body-secondary">Выберите игру и совершите заказ</p>
    </div>
</div>
</section>

<div class="album py-5 bg-body-tertiary">
<div class="container">
<section class="py-5 text-center container">
        <div class="row py-lg-5">
        <div class="col-lg-6 col-md-8 mx-auto">
            <?php 
                for ($i = 1; $i <= $str_pag; $i++){ 
                    echo "<a type='button' role='button' class=\"btn btn-sm btn-outline-secondary me-1\" href=user_products.php?page=".$i."> Страница ".$i." 
                        </a>"; 
                } 
            ?>
        </div>
        </div>
    </section>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
    <?php
        while ($row = mysqli_fetch_array($result_products)) {
            echo '<div class="col">'.
            '<div class=card shadow-sm">'.
            "<img src=\"{$row['image_url']}\" class=\"card-img-top\" alt=\"{$row['game_name']}\">".
            '<div class="card-body">'.
            "<h3>{$row['game_name']}</h3>".
            "<p>Жанр: {$row['genre_name']}</p>".
            "<p>Разработчик: {$row['developer_name']}</p>".
            "<p>Издатель: {$row['publisher_name']}</p>".
            "<p>Дата выхода: {$row['release_date']}</p>".
            "<p>Ворастное ограничение: {$row['age_rating']}+</p>".
            "<p>Платформа: {$row['product_platform']}</p>".
            "<h4>Цена: {$row['product_price']}</h4>".
            '<div class="d-flex justify-content-between align-items-center">'.
            '<div class="btn-group">'.
            "<a type=\"button\" class=\"btn btn-sm btn-outline-secondary\" href=\"order.php?ord_id={$row['product_id']}\" role=\"button\">Совершить заказ</a>".
            '</div>'.
            '</div>'.
            '</div>'.
            '</div>'.
            '</div>';
        }
?>    
    </div>
    </div>
</div>
<?php include ("../blocks/user_footer.php");?>
</body>
</html>
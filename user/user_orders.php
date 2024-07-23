<?php
    include '../connect.php';
    session_start();
    if ($_SESSION['access'] != "user") {
        header('Location: ../errors/access_error.php');
    }
    if (isset($_GET['del_id']))
    {
        $sql_delete = "DELETE FROM feedback WHERE feedback_id = {$_GET['del_id']}";
        $result_delete = mysqli_query ($link, $sql_delete);

        if ($result_delete) {
            header('Location: user_orders.php');
        } 
        else {
            echo '<p>Произошла ошибка: ' .mysqli_error($link) . '</p>';
        }
    }
    $user_name = $_SESSION['user_name'];
    if (isset($_GET['page'])){ 
        $page = $_GET['page']; 
    }else $page = 1; 
    $kol = 3;
    $art = ($page * $kol) - $kol; 
    $res = mysqli_query($link, "SELECT COUNT(order_id) FROM orders INNER JOIN users ON users.user_id = orders.user_id
                                WHERE user_name = '$user_name'"); 
    $row_pag = mysqli_fetch_row($res); 
    $total = $row_pag[0];
    $str_pag = ceil($total / $kol); 
    $result_orders = mysqli_query($link, "SELECT order_id, game_name, user_name, product_platform, product_price,
    order_state, order_date, order_type, product_key FROM orders INNER JOIN products
    ON products.product_id = orders.product_id INNER JOIN games ON
    products.game_id = games.game_id INNER JOIN users ON users.user_id = orders.user_id
    WHERE user_name = '$user_name' LIMIT $art,$kol");
?>
<!DOCTYPE html>
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Заказы</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/12be2a89a6.js" crossorigin="anonymous"></script>
</head>
<body>
<?php include ("../blocks/user_header.php");?>
<main>
<section class="py-5 text-center container">
<div class="row py-lg-5">
    <div class="col-lg-6 col-md-8 mx-auto">
    <h1 class="fw-light">Заказы</h1>
    <p class="lead text-body-secondary">Просматривайте и управляйте своими текущими и завершенными заказми</p>
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
                    echo "<a type='button' role='button' class=\"btn btn-sm btn-outline-secondary me-1\" href=user_orders.php?page=".$i."> Страница ".$i." 
                        </a>"; 
                } 
            ?>
        </div>
        </div>
    </section>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
    <?php
    if (!($result_orders)) {
        echo '
        <div class="col-lg-3 col-md-8 mx-auto" style="text-align: center;">
        <h3>Нет заказов :(</h3>
        <p>Совершите свой первый заказ!</p>
        </div>
        ';
    }
    else {
        while ($row = mysqli_fetch_array($result_orders)) {
            $order_id = $row["order_id"];
            $sql_feedback = "SELECT feedback_id, rating, text, posted_date FROM feedback WHERE order_id = '$order_id'";
            $result_feedback = mysqli_query($link, $sql_feedback);
            $row_feedback = mysqli_fetch_array($result_feedback);
            if($row['order_state'] == "Доставлен") {
                $delivered = "<p>Товар доставлен! Ключ для активации игры: {$row['product_key']}</p>";
            }
            else {
                $delivered = "";
            }
            if($row_feedback) {
                $button_feedback = "<h4>Отзыв: </h4>".
                "<p>Оценка: {$row_feedback['rating']}</p>".
                "<p>Текст: {$row_feedback['text']}</p>".
                "<p>Дата: {$row_feedback['posted_date']}</p>".
                "<a type=\"button\" class=\"btn btn-sm btn-outline-secondary\" href=\"change_feedback.php?red_id={$row_feedback['feedback_id']}\" role=\"button\">Отредактировать</a>".
                "<a type=\"button\" class=\"btn btn-sm btn-outline-secondary\" href=\"?del_id={$row_feedback['feedback_id']}\" role=\"button\">Удалить отзыв</a>";
            }
            else {
                $button_feedback = '<div class="d-flex justify-content-between align-items-center">'.
                '<div class="btn-group">'.
                "<a type=\"button\" class=\"btn btn-sm btn-outline-secondary\" href=\"make_feedback.php?ord_id={$row['order_id']}\" role=\"button\">Оставить отзыв</a>".
                "</div>".
                '</div>';
            }
            echo '<div class="col">'.
            '<div class=card shadow-sm">'.
            '<div class="card-body">'.
            "<h3>Заказ №{$row['order_id']}</h3>".
            "<p>Игра: {$row['game_name']}</р>".
            "<p>Платформа: {$row['product_platform']}</p>".
            "<p>Цена: {$row['product_price']}</p>".
            "<p>Дата оформления: {$row['order_date']}</p>".
            "<p>Статус: {$row['order_state']}</p>".
            "<p>Тип заказа: {$row['order_type']}</p>".
            $delivered.
            $button_feedback.
            '</div>'.
            '</div>'.
            '</div>';
        }
    }
        
?>    
    </div>
    </div>
</div>
</main>
<?php include ("../blocks/user_footer.php");?>
</body>
</html>

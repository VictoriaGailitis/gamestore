<?php
    include '../connect.php';
    if (isset($_GET['del_id']))
    {
        $sql_delete = "DELETE FROM feedback WHERE feedback_id = {$_GET['del_id']}";
        $result_delete = mysqli_query ($link, $sql_delete);

        if ($result_delete) {
            header('Location: feedback.php');
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
    $res = mysqli_query($link, "SELECT COUNT(feedback_id) FROM feedback"); 
    $row_pag = mysqli_fetch_row($res); 
    $total = $row_pag[0];
    $str_pag = ceil($total / $kol);
?>
<!DOCTYPE html>
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Отзывы</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/12be2a89a6.js" crossorigin="anonymous"></script>
</head>
<body>
<?php include ("../blocks/admin_header.php");?>
    <div class="px-4 pt-5 my-5 text-center">
        <h1 class="display-4 fw-bold text-body-emphasis">Таблица "Отзывы"</h1>
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
                    echo "<a type='button' role='button' class=\"btn btn-sm btn-outline-secondary me-1\" href=feedback.php?page=".$i."> Страница ".$i." 
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
        <th scope="col">ID отзыва<a href="feedback.php?sort=FEEDBACK_ID-asc"><i class="fa-solid fa-sort-up" style="color: #2267dd;"></i></a><a href="feedback.php?sort=FEEDBACK_ID-desc"><i class="fa-solid fa-sort-down" style="color: #2267dd;"></i></a></th>
        <th scope="col">Дата<a href="feedback.php?sort=POSTED_DATE-asc"><i class="fa-solid fa-sort-up" style="color: #2267dd;"></i></a><a href="feedback.php?sort=POSTED_DATE-desc"><i class="fa-solid fa-sort-down" style="color: #2267dd;"></i></a></th>
        <th scope="col">Заказ от<a href="feedback.php?sort=ORDER_DATE-asc"><i class="fa-solid fa-sort-up" style="color: #2267dd;"></i></a><a href="feedback.php?sort=ORDER_DATE-desc"><i class="fa-solid fa-sort-down" style="color: #2267dd;"></i></a></th>
        <th scope="col">Оценка<a href="feedback.php?sort=RATING-asc"><i class="fa-solid fa-sort-up" style="color: #2267dd;"></i></a><a href="feedback.php?sort=RATING-desc"><i class="fa-solid fa-sort-down" style="color: #2267dd;"></i></a></th>
        <th scope="col">Текст<a href="feedback.php?sort=TEXT-asc"><i class="fa-solid fa-sort-up" style="color: #2267dd;"></i></a><a href="feedback.php?sort=TEXT-desc"><i class="fa-solid fa-sort-down" style="color: #2267dd;"></i></a></th>
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
        case "FEEDBACK_ID-asc": 
            $sorting_sql = 'ORDER BY FEEDBACK_ID ASC'; 
        break; 
        case "FEEDBACK_ID-desc": 
            $sorting_sql = 'ORDER BY FEEDBACK_ID DESC'; 
            break; 
        case "POSTED_DATE-asc": 
            $sorting_sql = 'ORDER BY POSTED_DATE ASC'; 
            break; 
        case "POSTED_DATE-desc": 
            $sorting_sql = 'ORDER BY POSTED_DATE DESC'; 
            break;
        case "ORDER_DATE-asc": 
            $sorting_sql = 'ORDER BY ORDER_DATE ASC'; 
            break; 
        case "ORDER_DATE-desc": 
            $sorting_sql = 'ORDER BY ORDER_DATE DESC'; 
            break;
        case "RATING-asc": 
            $sorting_sql = 'ORDER BY RATING ASC'; 
            break; 
        case "RATING-desc": 
            $sorting_sql = 'ORDER BY RATING DESC'; 
            break;
        case "TEXT-asc": 
            $sorting_sql = 'ORDER BY TEXT ASC'; 
            break; 
        case "TEXT-desc": 
            $sorting_sql = 'ORDER BY TEXT DESC'; 
            break;
        case "default": 
            $sorting_sql = ''; 
            break; 
        }  
    if(empty($search)) {
        $sql = "SELECT feedback_id, posted_date, order_date, rating, text FROM feedback 
        INNER JOIN orders ON orders.order_id = feedback.order_id
        $sorting_sql LIMIT $art,$kol";
    }
    else {
        $sql = "SELECT feedback_id, posted_date, order_date, rating, text FROM feedback 
        INNER JOIN orders ON orders.order_id = feedback.order_id
        WHERE feedback_id LIKE '%$search%' OR posted_date
        LIKE '%$search%' OR order_date LIKE '%$search%' OR rating LIKE '%$search%'
        OR text LIKE '%$search%'
        $sorting_sql LIMIT $art,$kol";
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
            "<th scope='row'>{$row['feedback_id']}</th>".
            "<td>{$row['posted_date']}</td>".
            "<td>{$row['order_date']}</td>".
            "<td>{$row['rating']}</td>".
            "<td>{$row['text']}</td>".
            "<td><a type=\"button\" role=\"button\" class=\"btn btn-outline-primary me-2\" href='?del_id={$row['feedback_id']}'>Удалить</a></td>".
            "<td><a type=\"button\" role=\"button\" class=\"btn btn-outline-primary me-2\" href='update_feedback.php?red_id={$row['feedback_id']}'>Изменить</a></td>".
            '</tr>';
        }
    }
    echo '</tbody>'.
        '</table>';
?>    
    </div>
    <?php echo '<div class="d-flex justify-content-center align-items-center">'.
        '<div class="btn-group">'.
        "<a type=\"button\" class=\"btn btn-sm btn-outline-secondary\" href=\"add_feedback.php\" role=\"button\">Добавить</a>".
        "</div>".
        '</div>'; ?>
    </div>
</div>
<?php include ("../blocks/admin_footer.php");?>
</body>
</html>
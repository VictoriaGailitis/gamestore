<?php
    include '../connect.php';
    if (isset($_GET['del_id']))
    {
        $sql_delete = "DELETE FROM developers WHERE developer_id = {$_GET['del_id']}";
        $result_delete = mysqli_query ($link, $sql_delete);

        if ($result_delete) {
            header('Location: genres.php');
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
    $res = mysqli_query($link, "SELECT COUNT(developer_id) FROM developers"); 
    $row_pag = mysqli_fetch_row($res); 
    $total = $row_pag[0];
    $str_pag = ceil($total / $kol);
?>
<!DOCTYPE html>
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Разработчики</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/12be2a89a6.js" crossorigin="anonymous"></script>
</head>
<body>
<?php include ("../blocks/admin_header.php");?>
    <div class="px-4 pt-5 my-5 text-center">
        <h1 class="display-4 fw-bold text-body-emphasis">Таблица "Разработчики"</h1>
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
                    echo "<a type='button' role='button' class=\"btn btn-sm btn-outline-secondary me-1\" href=developers.php?page=".$i."> Страница ".$i." 
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
        <th scope="col">ID разработчика<a href="developers.php?sort=DEVELOPER_ID-asc"><i class="fa-solid fa-sort-up" style="color: #2267dd;"></i></a><a href="developers.php?sort=DEVELOPER_ID-desc"><i class="fa-solid fa-sort-down" style="color: #2267dd;"></i></a></th>
        <th scope="col">Название компании<a href="developers.php?sort=DEVELOPER_NAME-asc"><i class="fa-solid fa-sort-up" style="color: #2267dd;"></i></a><a href="developers.php?sort=DEVELOPER_NAME-desc"><i class="fa-solid fa-sort-down" style="color: #2267dd;"></i></a></th>
        <th scope="col">Страна<a href="developers.php?sort=DEVELOPER_COUNTRY-asc"><i class="fa-solid fa-sort-up" style="color: #2267dd;"></i></a><a href="developers.php?sort=DEVELOPER_COUNTRY-desc"><i class="fa-solid fa-sort-down" style="color: #2267dd;"></i></a></th>
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
        case "DEVELOPER_ID-asc": 
            $sorting_sql = 'ORDER BY DEVELOPER_ID ASC'; 
        break; 
        case "DEVELOPER_ID-desc": 
            $sorting_sql = 'ORDER BY DEVELOPER_ID DESC'; 
            break; 
        case "DEVELOPER_NAME-asc": 
            $sorting_sql = 'ORDER BY DEVELOPER_NAME ASC'; 
            break; 
        case "DEVELOPER_NAME-desc": 
            $sorting_sql = 'ORDER BY DEVELOPER_NAME DESC'; 
            break;
        case "DEVELOPER_COUNTRY-asc": 
            $sorting_sql = 'ORDER BY DEVELOPER_COUNTRY ASC'; 
            break; 
        case "DEVELOPER_COUNTRY-desc": 
            $sorting_sql = 'ORDER BY DEVELOPER_COUNTRY DESC'; 
            break;  
        case "default": 
            $sorting_sql = ''; 
            break; 
        }  
    if(empty($search)) {
        $sql = "SELECT developer_id, developer_name, developer_country FROM developers $sorting_sql LIMIT $art,$kol";
    }
    else {
        $sql = "SELECT developer_id, developer_name, developer_country FROM developers WHERE developer_id LIKE '%$search%' OR developer_name
        LIKE '%$search%' OR developer_country LIKE '%$search%' $sorting_sql";
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
            "<th scope='row'>{$row['developer_id']}</th>".
            "<td>{$row['developer_name']}</td>".
            "<td>{$row['developer_country']}</td>".
            "<td><a type=\"button\" role=\"button\" class=\"btn btn-outline-primary me-2\" href='?del_id={$row['developer_id']}'>Удалить</a></td>".
            "<td><a type=\"button\" role=\"button\" class=\"btn btn-outline-primary me-2\" href='update_developer.php?red_id={$row['developer_id']}'>Изменить</a></td>".
            '</tr>';
        }
    }
    echo '</tbody>'.
        '</table>';
?>    
    </div>
    <?php echo '<div class="d-flex justify-content-center align-items-center">'.
        '<div class="btn-group">'.
        "<a type=\"button\" class=\"btn btn-sm btn-outline-secondary\" href=\"add_developer.php\" role=\"button\">Добавить</a>".
        "</div>".
        '</div>'; ?>
    </div>
</div>
<?php include ("../blocks/admin_footer.php");?>
</body>
</html>
<?php
    include '../connect.php';
    if (isset($_GET['del_id']))
    {
        $sql_delete = "DELETE FROM users WHERE user_id = {$_GET['del_id']}";
        $result_delete = mysqli_query ($link, $sql_delete);

        if ($result_delete) {
            header('Location: users.php');
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
    $res = mysqli_query($link, "SELECT COUNT(user_id) FROM users"); 
    $row_pag = mysqli_fetch_row($res); 
    $total = $row_pag[0];
    $str_pag = ceil($total / $kol);
?>
<!DOCTYPE html>
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Пользователи</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/12be2a89a6.js" crossorigin="anonymous"></script>
</head>
<body>
<?php include ("../blocks/admin_header.php");?>
    <div class="px-4 pt-5 my-5 text-center">
        <h1 class="display-4 fw-bold text-body-emphasis">Таблица "Пользователи"</h1>
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
                    echo "<a type='button' role='button' class=\"btn btn-sm btn-outline-secondary me-1\" href=users.php?page=".$i."> Страница ".$i." 
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
        <th scope="col">ID пользователя<a href="users.php?sort=USER_ID-asc"><i class="fa-solid fa-sort-up" style="color: #2267dd;"></i></a><a href="users.php?sort=USER_ID-desc"><i class="fa-solid fa-sort-down" style="color: #2267dd;"></i></a></th>
        <th scope="col">Имя пользователя<a href="users.php?sort=USER_NAME-asc"><i class="fa-solid fa-sort-up" style="color: #2267dd;"></i></a><a href="users.php?sort=USER_NAME-desc"><i class="fa-solid fa-sort-down" style="color: #2267dd;"></i></a></th>
        <th scope="col">Email<a href="users.php?sort=USER_EMAIL-asc"><i class="fa-solid fa-sort-up" style="color: #2267dd;"></i></a><a href="users.php?sort=USER_EMAIL-desc"><i class="fa-solid fa-sort-down" style="color: #2267dd;"></i></a></th>
        <th scope="col">Банковская карта<a href="users.php?sort=USER_CARD-asc"><i class="fa-solid fa-sort-up" style="color: #2267dd;"></i></a><a href="users.php?sort=USER_CARD-desc"><i class="fa-solid fa-sort-down" style="color: #2267dd;"></i></a></th>
        <th scope="col">Дата регистрации<a href="users.php?sort=REGISTRED_DATE-asc"><i class="fa-solid fa-sort-up" style="color: #2267dd;"></i></a><a href="users.php?sort=REGISTRED_DATE-desc"><i class="fa-solid fa-sort-down" style="color: #2267dd;"></i></a></th>
        <th scope="col">Пароль<a href="users.php?sort=PASSWORD-asc"><i class="fa-solid fa-sort-up" style="color: #2267dd;"></i></a><a href="users.php?sort=PASSWORD-desc"><i class="fa-solid fa-sort-down" style="color: #2267dd;"></i></a></th>
        <th scope="col">Роль на сайте<a href="users.php?sort=ACCESS-asc"><i class="fa-solid fa-sort-up" style="color: #2267dd;"></i></a><a href="users.php?sort=ACCESS-desc"><i class="fa-solid fa-sort-down" style="color: #2267dd;"></i></a></th>
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
        case "USER_ID-asc": 
            $sorting_sql = 'ORDER BY USER_ID ASC'; 
        break; 
        case "USER_ID-desc": 
            $sorting_sql = 'ORDER BY USER_ID DESC'; 
            break; 
        case "USER_NAME-asc": 
            $sorting_sql = 'ORDER BY USER_NAME ASC'; 
            break; 
        case "USER_NAME-desc": 
            $sorting_sql = 'ORDER BY USER_NAME DESC'; 
            break;
        case "USER_EMAIL-asc": 
            $sorting_sql = 'ORDER BY USER_EMAIL ASC'; 
            break; 
        case "USER_EMAIL-desc": 
            $sorting_sql = 'ORDER BY USER_EMAIL DESC'; 
            break;
        case "USER_CARD-asc": 
            $sorting_sql = 'ORDER BY USER_CARD ASC'; 
            break; 
        case "USER_CARD-desc": 
            $sorting_sql = 'ORDER BY USER_CARD DESC'; 
            break;
        case "REGISTRED_DATE-asc": 
            $sorting_sql = 'ORDER BY REGISTRED_DATE ASC'; 
            break; 
        case "REGISTRED_DATE-desc": 
            $sorting_sql = 'ORDER BY REGISTRED_DATE DESC'; 
            break;
        case "PASSWORD-asc": 
            $sorting_sql = 'ORDER BY PASSWORD ASC'; 
            break; 
        case "PASSWORD-desc": 
            $sorting_sql = 'ORDER BY PASSWORD DESC'; 
            break;
        case "ACCESS-asc": 
            $sorting_sql = 'ORDER BY ACCESS ASC'; 
            break; 
        case "ACCESS-desc": 
            $sorting_sql = 'ORDER BY ACCESS DESC'; 
            break;                
        case "default": 
            $sorting_sql = ''; 
            break; 
        }  
    if(empty($search)) {
        $sql = "SELECT user_id, user_name, user_email, user_card, registred_date, password, access FROM users $sorting_sql LIMIT $art,$kol";
    }
    else {
        $sql = "SELECT user_id, user_name, user_email, user_card, registred_date, password, access FROM users WHERE user_id LIKE '%$search%' OR user_name
        LIKE '%$search%' OR user_email LIKE '%$search%' OR user_card LIKE '%$search%' OR registred_date LIKE '%$search%' OR password LIKE '%$search%'
        OR access LIKE '%$search%' $sorting_sql";
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
            "<th scope='row'>{$row['user_id']}</th>".
            "<td>{$row['user_name']}</td>".
            "<td>{$row['user_email']}</td>".
            "<td>{$row['user_card']}</td>".
            "<td>{$row['registred_date']}</td>".
            "<td>{$row['password']}</td>".
            "<td>{$row['access']}</td>".
            "<td><a type=\"button\" role=\"button\" class=\"btn btn-outline-primary me-2\" href='?del_id={$row['user_id']}'>Удалить</a></td>".
            "<td><a type=\"button\" role=\"button\" class=\"btn btn-outline-primary me-2\" href='update_user.php?red_id={$row['user_id']}'>Изменить</a></td>".
            '</tr>';
        }
    }
    echo '</tbody>'.
        '</table>';
?>    
    </div>
    <?php echo '<div class="d-flex justify-content-center align-items-center">'.
        '<div class="btn-group">'.
        "<a type=\"button\" class=\"btn btn-sm btn-outline-secondary\" href=\"add_user.php\" role=\"button\">Добавить</a>".
        "</div>".
        '</div>'; ?>
    </div>
</div>
<?php include ("../blocks/admin_footer.php");?>
</body>
</html>
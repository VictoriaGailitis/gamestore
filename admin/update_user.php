<?php
    include '../connect.php';
    session_start();
    if ($_SESSION['access'] != 'admin') {
        header('Location: ../errors/access_error.php');
    }
    if (isset($_POST['user_name'])) {
        if (isset($_GET['red_id']))
        {
            $sql_update = "UPDATE users SET user_name = '{$_POST['user_name']}',
            user_email = '{$_POST['user_email']}', user_card = '{$_POST['user_card']}', registred_date = '{$_POST['registred_date']}',
            password = '{$_POST['password']}', access = '{$_POST['access']}'
            WHERE user_id = {$_GET['red_id']}";
            $result_update = mysqli_query($link, $sql_update);
            }
    }
    if (isset($_GET['red_id'])) {
        $sql_select = "SELECT user_name, user_email, user_card, registred_date, password, access FROM users WHERE user_id = {$_GET['red_id']}";
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
    if (isset($_POST['user_name'])) {
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
            <label for="user_name" class="form-label">Имя пользователя</label>
            <input type="text" class="form-control" id="user_name" name="user_name" value="<?=isset($_GET['red_id']) ? $row['user_name'] : ''; ?>">
            </div>

            <div class="col-sm-12">
            <label for="user_email" class="form-label">Email</label>
            <input type="email" class="form-control" id="user_email" name="user_email" value="<?=isset($_GET['red_id']) ? $row['user_email'] : ''; ?>">
            </div>

            <div class="col-sm-12">
            <label for="user_card" class="form-label">Банковская карта</label>
            <input type="number" class="form-control" id="user_card" name="user_card" value="<?=isset($_GET['red_id']) ? $row['user_card'] : ''; ?>">
            </div>

            <div class="col-sm-12">
            <label for="registred_date" class="form-label">Дата регистрации</label>
            <input type="date" class="form-control" id="registred_date" name="registred_date" value="<?=isset($_GET['red_id']) ? $row['registred_date'] : ''; ?>">
            </div>

            <div class="col-sm-12">
            <label for="password" class="form-label">Пароль</label>
            <input type="text" class="form-control" id="password" name="password" value="<?=isset($_GET['red_id']) ? $row['password'] : ''; ?>">
            </div>

            <div class="col-sm-12">
            <label for="access" class="form-label">Роль на сайте</label>
            <input type="text" class="form-control" id="access" name="access" value="<?=isset($_GET['red_id']) ? $row['access'] : ''; ?>">
            </div>
        </div>

        <hr class="my-4">
        <button class="w-100 btn btn-primary btn-lg" type="submit">Сохранить изменения</button>
        </form>
        <form method="post" action="users.php">
            <input type="submit" value="Назад" class="btn btn-lg btn-secondary mt-2">
        </form>
    </div>
</main>
</div>
</body>
</html>
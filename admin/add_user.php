<?php
    include '../connect.php';
    session_start();
    if ($_SESSION['access'] != "admin") {
        header('Location: ../errors/access_error.php');
    }
    if (isset($_POST['user_id'])) {
        $user_id = $_POST['user_id'];
        $user_name = $_POST['user_name'];
        $user_email = $_POST['user_email'];
        $user_card = $_POST['user_card'];
        $registred_date = $_POST['registred_date'];
        $password = $_POST['password'];
        $access = $_POST['access'];
        $sql_insert = "INSERT INTO users (user_id, user_name, user_email, user_card, registred_date, password, access) VALUES ('$user_id', '$user_name', '$user_email',
        '$user_card', '$registred_date', '$password', '$access')";
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
    if (isset($_POST['user_id'])) {
        if($result) {
            echo '<i class="fa-solid fa-check" style="color: #2267dd; font-size: xxx-large;"></i>
            <h1 class="text-body-emphasis">Успешно!</h1>
            <p class="col-lg-6 mx-auto mb-4">
            Запись добавлена!
            </p>
            <a class="btn btn-primary px-5 mb-5" href="users.php" role="button">
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
            <label for="user_id" class="form-label">ID пользователя</label>
            <input type="number" class="form-control" id="user_id" name="user_id">
            </div>
    
            <div class="col-sm-6">
            <label for="user_name" class="form-label">Имя пользователя</label>
            <input type="text" class="form-control" id="user_name" name="user_name">
            </div>

            <div class="col-sm-12">
            <label for="user_email" class="form-label">Email</label>
            <input type="email" class="form-control" id="user_email" name="user_email">
            </div>

            <div class="col-sm-12">
            <label for="user_card" class="form-label">Банковская карта</label>
            <input type="number" class="form-control" id="user_card" name="user_card">
            </div>

            <div class="col-sm-12">
            <label for="registred_date" class="form-label">Дата регистрации</label>
            <input type="date" class="form-control" id="registred_date" name="registred_date">
            </div>

            <div class="col-sm-12">
            <label for="password" class="form-label">Пароль</label>
            <input type="text" class="form-control" id="password" name="password">
            </div>

            <div class="col-sm-12">
            <label for="access" class="form-label">Роль на сайте</label>
                <select class="form-select" name="access" aria-label="Default select example">
                    <option value="admin">Администратор</option>
                    <option value="user">Пользователь</option>
                </select>
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
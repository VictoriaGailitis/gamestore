<?php
    include '../connect.php';
    session_start();
    if (isset($_POST['user_name'])) {
        if (isset($_SESSION['user_name']))
        {
            $sql_update = "UPDATE users SET user_name = '{$_POST['user_name']}',
            user_email = '{$_POST['user_email']}', user_card = '{$_POST['user_card']}',
            password = '{$_POST['password']}'
            WHERE user_name = '{$_SESSION["user_name"]}'";
            $result_update = mysqli_query($link, $sql_update);
            }
    }
    if (isset($_SESSION['user_name'])) {
        $sql_select = "SELECT user_name, user_email, user_card, registred_date,
            password FROM users WHERE user_name = '{$_SESSION['user_name']}'";
        $result_select = mysqli_query($link, $sql_select);
        $row = mysqli_fetch_array($result_select);
    }
    else {
        header('Location: ../errors/access_error.php');
    }
    $exit = $_POST['exit'];
    if (!empty($exit)) {
        session_unset();
        session_destroy(); 
        header('Location: ../authorization/login.php');
}
?>
<!DOCTYPE html>
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личный кабинет</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/12be2a89a6.js" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
<?php include ("../blocks/user_header.php");?>
<main>
    <div class="py-5 text-center">
    <i class="fa-solid fa-user" style="color: #2267dd; font-size: xxx-large;"></i>
    <h2>Личный кабинет</h2>
    <?php
    if (isset($_POST['user_name'])) {
        if (isset($_SESSION['user_name']))
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
        <form method="post" action="profile.php">
        <div class="row g-3">
            <div class="col-sm-6">
            <label for="username" class="form-label">Имя пользователя</label>
            <input type="text" class="form-control" id="username" name="user_name" value="<?=isset($_SESSION['user_name']) ? $row['user_name'] : ''; ?>">
            </div>

            <div class="col-12">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="user_email" value="<?=isset($_SESSION['user_name']) ? $row['user_email'] : ''; ?>">
            </div>

            <div class="col-12">
            <label for="card" class="form-label">Банковская карта</label>
            <input type="text" class="form-control" id="card" name="user_card" value="<?=isset($_SESSION['user_name']) ? $row['user_card'] : ''; ?>">
            </div>

            <div class="col-12">
            <label for="password" class="form-label">Пароль</label>
            <input type="text" class="form-control" id="password" name="password" value="<?=isset($_SESSION['user_name']) ? $row['password'] : ''; ?>">
            </div>

            <div class="col-12">
                <p>Дата регистрации: <?php echo $row["registred_date"] ?></p>
            </div>
        </div>

        <hr class="my-4">
        <button class="w-100 btn btn-primary btn-lg" type="submit">Сохранить изменения</button>
        </form>
        <form method="post">
            <input type="submit" value="Выйти" name="exit" class="btn btn-lg btn-secondary mt-2">
        </form>
    </div>
</main>
</div>
<?php include ("../blocks/user_footer.php");?>
</body>
</html>
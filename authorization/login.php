<?php
session_start();
include('../connect.php');
$login = stripslashes( htmlspecialchars(trim($_POST['login'])));
$pass = trim($_POST['pass']);
if (!empty($login) && !empty($pass)){
    $sql = "SELECT `user_id`, `user_name`, `password`, `access` FROM 
    `users` where `user_name`='$login' and `password` = '$pass'";
    $result = mysqli_query($link, $sql);
    $row = mysqli_num_rows ($result);
    if ($row == 0) {
        exit("Неверный логин или пароль!") ;
    } else
    {
        $row1 = mysqli_fetch_array($result);
        if ($row1['access'] == 'admin') {
            $_SESSION["access"] = "admin";
            header('Location: ../admin/panel.php');
        }
        if ($row1['access'] == 'user') {
            $_SESSION["access"] = "user";
            $_SESSION["user_name"] = $login;
            header('Location: ../user/profile.php');
        }
    }
}
mysqli_close($link);
?>
<!DOCTYPE html>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/12be2a89a6.js" crossorigin="anonymous"></script>
</head>
<body>
<div class="bg-body-tertiary position-absolute top-50 start-50 translate-middle">
<main class="form-signin w-100 m-auto">
<form method="post" name="myForm">
    <i class="fa-solid fa-gamepad" style="color: #2267dd; font-size:xx-large;"></i>
    <h1 class="h3 mb-3 fw-normal">Вход</h1>

    <div class="form-floating mb-2">
    <input type="text" class="form-control" id="floatingInput" name="login" placeholder="Логин">
    <label for="floatingInput">Логин</label>
    </div>
    <div class="form-floating mb-2">
    <input type="password" class="form-control" id="floatingPassword" name="pass" placeholder="Пароль">
    <label for="floatingPassword">Пароль</label>
    </div>
    <button class="btn btn-primary w-100 py-2" type="submit" name="enter">Войти</button>
</form>
</main>
</div>
</body>
</html>
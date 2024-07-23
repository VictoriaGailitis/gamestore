<?php
    include '../connect.php';
    session_start();
    $sql_get_max_id = "SELECT user_id FROM users ORDER BY user_id DESC LIMIT 1";
    $result_get_max_id = mysqli_query($link, $sql_get_max_id);
    $row_max_id = mysqli_fetch_array($result_get_max_id);
    $user_id = $row_max_id['user_id'] + 1;
    $username = htmlentities(trim($_POST['user_name']));
    $user_email = htmlentities(trim($_POST['user_email']));
    $user_card = htmlentities(trim($_POST['user_card']));
    $password = htmlentities(trim($_POST['password']));
    $registred_date = date('Y-m-d');
    $access = "user";
    if (isset($user_id) && isset($registred_date) && isset($username) && isset($user_email) && isset($user_card) && isset($password)) 
    {
        $sql = "INSERT INTO users (user_id, user_name, user_email, user_card, registred_date,
        password, access) VALUES ('$user_id', '$username', '$user_email', '$user_card',
        '$registred_date', '$password', '$access')";
        $result = mysqli_query($link, $sql);
    }
    mysqli_close($link);
?>
<!DOCTYPE html>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/12be2a89a6.js" crossorigin="anonymous"></script>
</head>
<body>
<div class="container my-5">
<div class="position-relative p-5 text-center text-muted bg-body border border-dashed rounded-5">
    <?php 
        if($result) {
            $_SESSION["access"] = "user";
            $_SESSION["user_name"] = $username;
            echo '<i class="fa-solid fa-check" style="color: #2267dd; font-size: xxx-large;"></i>
            <h1 class="text-body-emphasis">Успешно!</h1>
            <p class="col-lg-6 mx-auto mb-4">
            Регистрация прошла успешно! Теперь Вы можете перейти в свой личный кабинет и начать покупки в нашем
            </p>
            <a class="btn btn-primary px-5 mb-5" href="../user/profile.php" role="button">
            Перейти в личный кабинет
            </a>';
        }
        else {
            echo '<i class="fa-solid fa-x" style="color: #d72323; font-size: xxx-large;"></i>
            <h1 class="text-body-emphasis">Произошла ошибка</h1>
            <p class="col-lg-6 mx-auto mb-4">
            Ошибка при регистрации </p>';
        }
    ?>
</div>
</div>
</body>
</html>

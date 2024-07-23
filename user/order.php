<?php
    include '../connect.php';
    session_start();
    if ($_SESSION['access'] != "user") {
        header('Location: ../errors/access_error.php');
    }
    if (isset($_GET['ord_id'])) 
    {
        $sql_get_max_id = "SELECT order_id FROM orders ORDER BY order_id DESC LIMIT 1";
        $result_get_max_id = mysqli_query($link, $sql_get_max_id);
        $row_max_id = mysqli_fetch_array($result_get_max_id);
        $order_id = $row_max_id['order_id'] + 1;
        $product_id = $_GET['ord_id'];
        $user_name = $_SESSION['user_name'];
        $sql_get_user = "SELECT user_id FROM users WHERE user_name = '$user_name'";
        $result_get_user = mysqli_query($link, $sql_get_user);
        $row_get_user = mysqli_fetch_array($result_get_user);
        $user_id = $row_get_user['user_id'];
        $order_state = 'Оформлен';
        $order_date = date('Y-m-d');
        if (isset($_POST['order_type'])) {
            $order_type = $_POST['order_type'];
            $sql_insert = "INSERT INTO orders (order_id, product_id, user_id, order_state,
            order_date, order_type) VALUES ('$order_id', '$product_id', '$user_id', '$order_state',
            '$order_date', '$order_type')";
            $result = mysqli_query($link, $sql_insert);
        }
    }
?>
<!DOCTYPE html>
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Оформление заказа</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/12be2a89a6.js" crossorigin="anonymous"></script>
</head>
<body>
<div class="container my-5">
<div class="position-relative p-5 text-center text-muted bg-body border border-dashed rounded-5">
    <?php
    if (isset($_POST['order_type'])) {
        if($result) {
            echo '<i class="fa-solid fa-check" style="color: #2267dd; font-size: xxx-large;"></i>
            <h1 class="text-body-emphasis">Успешно!</h1>
            <p class="col-lg-6 mx-auto mb-4">
            Заказ оформлен успешно! Теперь Вы можете перейти во вкладку "Заказы" и отследить статус совершенных покупок
            </p>
            <a class="btn btn-primary px-5 mb-5" href="user_orders.php" role="button">
            Перейти к своим заказам
            </a>';
        }
        else {
            '<i class="fa-solid fa-x" style="color: #d72323; font-size: xxx-large;"></i>
            <h1 class="text-body-emphasis">Произошла ошибка</h1>
            <p class="col-lg-6 mx-auto mb-4">
            Ошибка при оформлении заказа </p>';
        }
    }
    else {
        echo '<i class="fa-solid fa-spinner fa-spin" style="color: #2267dd; font-size: xxx-large;"></i>
        <h1 class="text-body-emphasis">Почти готово!</h1>
        <p class="col-lg-6 mx-auto mb-4">
        Для завершения оформления заказа выберите тип заказа:
        </p>
        <form method="post">
        <div class="form-check col-lg-2 mx-auto mb-4">
            <input class="form-check-input" type="radio" name="order_type" id="flexRadioDefault1" value="Себе" checked>
            <label class="form-check-label" for="flexRadioDefault1">
                Себе
            </label>
            </div>
        <div class="form-check col-lg-2 mx-auto mb-4">
            <input class="form-check-input" type="radio" name="order_type" id="flexRadioDefault2" value="В подарок">
            <label class="form-check-label" for="flexRadioDefault2">
                В подарок
            </label>
        </div>
        <button class="btn btn-primary px-5 mb-5" type="submit">
            Оформить заказ
        </button>
        </form>';
    }
?>
</div>
</div>
</body>
</html>
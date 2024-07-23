<?php
    include '../connect.php';
    session_start();
    if ($_SESSION['access'] != "admin") {
        header('Location: ../errors/access_error.php');
    }
    if (isset($_POST['order_id'])) {
        $order_id = $_POST['order_id'];
        $product_id = $_POST['product_id'];
        $user_id = $_POST['user_id'];
        $order_state = $_POST['order_state'];
        $order_date = $_POST['order_date'];
        $order_type = $_POST['order_type'];
        $sql_insert = "INSERT INTO orders (order_id, product_id, user_id, order_state, order_date, order_type) 
        VALUES ('$order_id', '$product_id', '$user_id', '$order_state', '$order_date', '$order_type')";
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
    if (isset($_POST['order_id'])) {
        if($result) {
            echo '<i class="fa-solid fa-check" style="color: #2267dd; font-size: xxx-large;"></i>
            <h1 class="text-body-emphasis">Успешно!</h1>
            <p class="col-lg-6 mx-auto mb-4">
            Запись добавлена!
            </p>
            <a class="btn btn-primary px-5 mb-5" href="orders.php" role="button">
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
            <div class="col-sm-12">
            <label for="order_id" class="form-label">ID заказа</label>
            <input type="number" class="form-control" id="order_id" name="order_id">
            </div>
    
            <div class="col-sm-12">
            <label for="product_id" class="form-label">Товар</label>
                <select class="form-select" name="product_id" aria-label="Default select example">';
                $sql_select = "SELECT product_id, product_key FROM products";
                $result_select = mysqli_query($link, $sql_select);
                while ($row = mysqli_fetch_array($result_select))
                {
                    echo "<option value = ' ".$row['product_id']."'>".$row['product_key']."</option>";
                }
                echo '</select>
            </div>

            <div class="col-sm-12">
            <label for="user_id" class="form-label">Пользователь</label>
                <select class="form-select" name="user_id" aria-label="Default select example">';
                $sql_select = "SELECT user_id, user_name FROM users";
                $result_select = mysqli_query($link, $sql_select);
                while ($row = mysqli_fetch_array($result_select))
                {
                    echo "<option value = ' ".$row['user_id']."'>".$row['user_name']."</option>";
                }
                echo '</select>
            </div>

            <div class="col-sm-12">
            <label for="order_state" class="form-label">Статус заказа</label>
            <input type="text" class="form-control" id="order_state" name="order_state">
            </div>
            
            <div class="col-sm-12">
            <label for="order_date" class="form-label">Дата заказа</label>
            <input type="date" class="form-control" id="order_date" name="order_date">
            </div>

            <div class="col-sm-12">
            <label for="order_type" class="form-label">Тип заказа</label>
            <input type="text" class="form-control" id="order_type" name="order_type">
            </div>

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
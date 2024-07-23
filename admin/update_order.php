<?php
    include '../connect.php';
    session_start();
    if ($_SESSION['access'] != 'admin') {
        header('Location: ../errors/access_error.php');
    }
    if (isset($_POST['product_id'])) {
        if (isset($_GET['red_id']))
        {
            $sql_update = "UPDATE orders SET product_id = '{$_POST['product_id']}',
            user_id = '{$_POST['user_id']}', order_state = '{$_POST['order_state']}',
            order_date = '{$_POST['order_date']}', order_type = '{$_POST['order_type']}'
            WHERE order_id = {$_GET['red_id']}";
            $result_update = mysqli_query($link, $sql_update);
            }
    }
    if (isset($_GET['red_id'])) {
        $sql_select = "SELECT product_id, user_id, order_state, order_date, order_type FROM orders
        WHERE order_id = {$_GET['red_id']}";
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
    if (isset($_POST['product_id'])) {
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
            <label for="product_id" class="form-label">Продукт</label>
            <select class="form-select" name="product_id">
                <?php
                include 'connect.php';
                $sql_select = "SELECT product_id, product_key FROM products";
                $result_select = mysqli_query($link, $sql_select);
                while ($row_select = mysqli_fetch_array($result_select))
                {
                    if (isset($_GET['red_id']) && $row['product_id'] == $row_select['product_id']) {
                        echo "<option selected value = ' ".$row_select['product_id']."'>".$row_select['product_key']."</option>";
                    }
                    else {
                        echo "<option value = ' ".$row_select['product_id']."'>".$row_select['product_key']."</option>";
                    }
                    
                }
                ?>
                </select>
            </div>

            <div class="col-sm-12">
            <label for="user_id" class="form-label">Пользователь</label>
            <select class="form-select" name="user_id">
                <?php
                include 'connect.php';
                $sql_select = "SELECT user_id, user_name FROM users";
                $result_select = mysqli_query($link, $sql_select);
                while ($row_select = mysqli_fetch_array($result_select))
                {
                    if (isset($_GET['red_id']) && $row['user_id'] == $row_select['user_id']) {
                        echo "<option selected value = ' ".$row_select['user_id']."'>".$row_select['user_name']."</option>";
                    }
                    else {
                        echo "<option value = ' ".$row_select['user_id']."'>".$row_select['user_name']."</option>";
                    }
                    
                }
                ?>
                </select>
            </div>

            <div class="col-sm-12">
            <label for="order_state" class="form-label">Статус заказа</label>
            <input type="text" class="form-control" id="order_state" name="order_state" value="<?=isset($_GET['red_id']) ? $row['order_state'] : ''; ?>">
            </div>

            <div class="col-sm-12">
            <label for="order_date" class="form-label">Дата заказа</label>
            <input type="date" class="form-control" id="order_date" name="order_date" value="<?=isset($_GET['red_id']) ? $row['order_date'] : ''; ?>">
            </div>

            <div class="col-sm-12">
            <label for="order_type" class="form-label">Тип заказа</label>
            <input type="text" class="form-control" id="order_type" name="order_type" value="<?=isset($_GET['red_id']) ? $row['order_type'] : ''; ?>">
            </div>

        <hr class="my-4">
        <button class="w-100 btn btn-primary btn-lg" type="submit">Сохранить изменения</button>
        </form>
        <form method="post" action="orders.php">
            <input type="submit" value="Назад" class="btn btn-lg btn-secondary mt-2">
        </form>
    </div>
</main>
</div>
</body>
</html>
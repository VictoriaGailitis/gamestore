<?php
    include '../connect.php';
    session_start();
    if ($_SESSION['access'] != 'admin') {
        header('Location: ../errors/access_error.php');
    }
    if (isset($_POST['posted_date'])) {
        if (isset($_GET['red_id']))
        {
            $sql_update = "UPDATE feedback SET posted_date = '{$_POST['posted_date']}',
            order_id = '{$_POST['order_id']}', rating = '{$_POST['rating']}',
            text = '{$_POST['text']}'
            WHERE feedback_id = {$_GET['red_id']}";
            $result_update = mysqli_query($link, $sql_update);
            }
    }
    if (isset($_GET['red_id'])) {
        $sql_select = "SELECT posted_date, order_id, rating, text FROM feedback
        WHERE feedback_id = {$_GET['red_id']}";
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
    if (isset($_POST['posted_date'])) {
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
            <label for="posted_date" class="form-label">Дата</label>
            <input type="date" class="form-control" id="posted_date" name="posted_date" value="<?=isset($_GET['red_id']) ? $row['posted_date'] : ''; ?>">
            </div>

            <div class="col-sm-12">
            <label for="order_id" class="form-label">Заказ</label>
            <select class="form-select" name="order_id">
                <?php
                include 'connect.php';
                $sql_select = "SELECT order_id, order_date FROM orders";
                $result_select = mysqli_query($link, $sql_select);
                while ($row_select = mysqli_fetch_array($result_select))
                {
                    if (isset($_GET['red_id']) && $row['order_id'] == $row_select['order_id']) {
                        echo "<option selected value = ' ".$row_select['order_id']."'> Заказ от ".$row_select['order_date']."</option>";
                    }
                    else {
                        echo "<option value = ' ".$row_select['order_id']."'> Заказ от ".$row_select['order_date']."</option>";
                    }
                    
                }
                ?>
                </select>
            </div>

            <div class="col-sm-12">
            <label for="rating" class="form-label">Оценка</label>
            <input type="number" class="form-control" id="rating" name="rating" value="<?=isset($_GET['red_id']) ? $row['rating'] : ''; ?>">
            </div>

            <div class="col-sm-12">
            <label for="text" class="form-label">Текст</label>
            <input type="text" class="form-control" id="text" name="text" value="<?=isset($_GET['red_id']) ? $row['text'] : ''; ?>">
            </div>

        <hr class="my-4">
        <button class="w-100 btn btn-primary btn-lg" type="submit">Сохранить изменения</button>
        </form>
        <form method="post" action="feedback.php">
            <input type="submit" value="Назад" class="btn btn-lg btn-secondary mt-2">
        </form>
    </div>
</main>
</div>
</body>
</html>
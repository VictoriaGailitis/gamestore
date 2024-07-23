<?php
    include '../connect.php';
    session_start();
    if ($_SESSION['access'] != "admin") {
        header('Location: ../errors/access_error.php');
    }
    if (isset($_POST['feedback_id'])) {
        $feedback_id = $_POST['feedback_id'];
        $posted_date = $_POST['posted_date'];
        $order_id = $_POST['order_id'];
        $rating = $_POST['rating'];
        $text = $_POST['text'];
        $sql_insert = "INSERT INTO feedback (feedback_id, posted_date, order_id, rating, text) 
        VALUES ('$feedback_id', '$posted_date', '$order_id', '$rating', '$text')";
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
    if (isset($_POST['feedback_id'])) {
        if($result) {
            echo '<i class="fa-solid fa-check" style="color: #2267dd; font-size: xxx-large;"></i>
            <h1 class="text-body-emphasis">Успешно!</h1>
            <p class="col-lg-6 mx-auto mb-4">
            Запись добавлена!
            </p>
            <a class="btn btn-primary px-5 mb-5" href="feedback.php" role="button">
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
            <label for="feedback_id" class="form-label">ID отзыва</label>
            <input type="number" class="form-control" id="feedback_id" name="feedback_id">
            </div>

            <div class="col-sm-12">
            <label for="posted_date" class="form-label">Дата</label>
            <input type="date" class="form-control" id="posted_date" name="posted_date">
            </div>

            <div class="col-sm-12">
            <label for="order_id" class="form-label">Заказ</label>
                <select class="form-select" name="order_id" aria-label="Default select example">';
                $sql_select = "SELECT order_id, order_date FROM orders";
                $result_select = mysqli_query($link, $sql_select);
                while ($row = mysqli_fetch_array($result_select))
                {
                    echo "<option value = ' ".$row['order_id']."'>Заказ от ".$row['order_date']."</option>";
                }
                echo '</select>
            </div>

            <div class="col-sm-12">
            <label for="rating" class="form-label">Оценка</label>
            <input type="number" class="form-control" id="rating" name="rating">
            </div>
            
            <div class="col-sm-12">
            <label for="text" class="form-label">Текст</label>
            <input type="text" class="form-control" id="text" name="text">
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